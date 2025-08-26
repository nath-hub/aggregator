<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class ProxyController extends Controller
{

    private $services;

    public function __construct()
    {
        $this->services = Config::get('keys.services'); // ou 'services.microservices' si tu renommes
    }

    public function register(Request $request)
    {
        return $this->proxyRequest('user', 'register', $request);
    }

    public function login(Request $request)
    {
        return $this->proxyRequest('user', 'login', $request);
    }

    public function forgotPassword(Request $request)
    {
        return $this->proxyRequest('user', 'password/reset', $request);
    }

    public function verify_code(Request $request)
    {
        return $this->proxyRequest('user', 'verify_code', $request);
    }


    private function cleanSwaggerPath($path)
    {

        // Supprimer les domaines qui se retrouvent dans le path
        $cleaned = preg_replace('/^docs\/[^\/]+\.elyft\.tech\/api\//', '', $path);

        // Si le pattern n'a pas matché, essayer sans le préfixe docs/
        if ($cleaned === $path) {
            $cleaned = preg_replace('/^[^\/]+\.elyft\.tech\/api\//', '', $path);
        }

        // Supprimer les doubles slashes
        $cleaned = preg_replace('/\/+/', '/', $cleaned);
        $cleaned = ltrim($cleaned, '/');

        // Supprimer les duplications pour tous les services connus
        $services = ['apikeys', 'transactions', 'users', 'entreprises', 'notifications'];
        foreach ($services as $service) {
            // Pattern pour matcher service/service/... et le remplacer par service/...
            $pattern = '/^' . preg_quote($service, '/') . '\/' . preg_quote($service, '/') . '(\/|$)/';
            if (preg_match($pattern, $cleaned)) {
                $cleaned = preg_replace($pattern, $service . '$1', $cleaned);

                break; // Une seule correction par appel
            }
        }

        return $cleaned;
    }


    /**
     * Méthode de routage intelligente qui détermine le bon service
     */
    public function smartProxy(Request $request, $path = '')
    {

        $cleanPath = $this->cleanSwaggerPath($path);

        $service = $this->determineServiceFromPath($cleanPath);

        return $this->proxyRequest($service, $path, $request);
    }

    /**
     * Détermine le service à utiliser basé sur le path
     */
    private function determineServiceFromPath($path)
    {
        // Supprimer les slashes en début et fin
        $path = trim($path, '/');

        // Patterns pour identifier les services
        $servicePatterns = [
            'apikeys' => '/^(apikeys|api-keys)/i',
            'transactions' => '/^transactions/i',
            'notifications' => '/^notifications/i',
            // Ajoutez d'autres services si nécessaire
        ];

        foreach ($servicePatterns as $service => $pattern) {
            if (preg_match($pattern, $path)) {
                return $service;
            }
        }

        return 'user';
    }

    /**
     * Méthode générique pour proxier les requêtes
     */
    private function proxyRequest($service, $path, Request $request)
    {

        try {
            $baseUrl = $this->services[$service];
            $cleanPath = $this->cleanSwaggerPath($path);


            $fullPath = $cleanPath ? '/api/' . ltrim($cleanPath, '/') : '';
            // $fullPath = $cleanPath ? '/' . ltrim($cleanPath, '/') : '';
            $url = rtrim($baseUrl, '/') . $fullPath;

            if ($request->getQueryString()) {
                $url .= '?' . $request->getQueryString();
            }

            Log::info("=== PROXY FULL DEBUG ===", [
                'incoming_request' => [
                    'path_param' => $path,
                    'content_type' => $request->header('Content-Type'),
                    'method' => $request->method(),
                ],
                'proxy_construction' => [
                    'service' => $service,
                    'final_url' => $url,
                ]
            ]);

            // Préparer les headers
            $headers = $this->prepareHeaders($request);

            // Initialiser la requête HTTP
            $httpRequest = Http::timeout(30)
                ->withHeaders($headers)
                ->withOptions([
                    'verify' => false, // Pour les environnements de dev
                ]);

            // Ajouter les paramètres de query
            // if ($request->getQueryString()) {
            //     $httpRequest = $httpRequest->withUrlParameters($request->query());
            // }

            // Exécuter la requête selon la méthode HTTP
            $response = match ($request->method()) {
                'GET' => $httpRequest->get($url),
                'POST' => $this->executePostRequest($httpRequest, $url, $request),
                'PUT' => $this->executePutRequest($httpRequest, $url, $request),
                'PATCH' => $this->executePatchRequest($httpRequest, $url, $request),
                'DELETE' => $this->executeDeleteRequest($httpRequest, $url, $request),
                default => $httpRequest->get($url)
            };

            // Retourner la réponse avec le même status code
            return response(
                $response->body(),
                $response->status(),
                $this->filterResponseHeaders($response->headers())
            );
        } catch (\Exception $e) {
            // Log de l'erreur
            Log::error("Proxy error for {$service}: " . $e->getMessage(), [
                'service' => $service,
                'path' => $path,
                'method' => $request->method(),
                'error' => $e->getMessage()
            ]);

            // Retourner une erreur générique
            return response()->json([
                'error' => 'Service temporarily unavailable',
                'message' => 'Unable to reach ' . ucfirst($service) . ' service',
                'code' => 'SERVICE_UNAVAILABLE'
            ], 503);
        }
    }

    /**
     * Exécuter une requête POST avec le bon format
     */
    private function executePostRequest($httpRequest, $url, Request $request)
    {
        if ($this->isMultipartRequest($request)) {
            return $this->executeMultipartRequest($httpRequest, $url, $request, 'POST');
        }

        return $httpRequest->post($url, $this->getRequestData($request));
    }

    /**
     * Exécuter une requête PUT avec le bon format
     */
    private function executePutRequest($httpRequest, $url, Request $request)
    {
        if ($this->isMultipartRequest($request)) {
            return $this->executeMultipartRequest($httpRequest, $url, $request, 'PUT');
        }

        return $httpRequest->put($url, $this->getRequestData($request));
    }

    /**
     * Exécuter une requête PATCH avec le bon format
     */
    private function executePatchRequest($httpRequest, $url, Request $request)
    {
        if ($this->isMultipartRequest($request)) {
            return $this->executeMultipartRequest($httpRequest, $url, $request, 'PATCH');
        }

        return $httpRequest->patch($url, $this->getRequestData($request));
    }

    /**
     * Exécuter une requête DELETE avec le bon format
     */
    private function executeDeleteRequest($httpRequest, $url, Request $request)
    {
        if ($this->isMultipartRequest($request)) {
            return $this->executeMultipartRequest($httpRequest, $url, $request, 'DELETE');
        }

        return $httpRequest->delete($url, $this->getRequestData($request));
    }

    /**
     * Vérifier si la requête est multipart/form-data
     */
    private function isMultipartRequest(Request $request)
    {
        $contentType = $request->header('Content-Type', '');
        return str_contains(strtolower($contentType), 'multipart/form-data') ||
            $request->hasFile('file') ||
            count($request->allFiles()) > 0;
    }

    /**
     * Exécuter une requête multipart
     */
    private function executeMultipartRequest($httpRequest, $url, Request $request, $method)
    {
        $multipartData = [];

        // Ajouter les données de formulaire
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $index => $item) {
                    $multipartData[] = [
                        'name' => $key . '[' . $index . ']',
                        'contents' => $item
                    ];
                }
            } else {
                $multipartData[] = [
                    'name' => $key,
                    'contents' => $value
                ];
            }
        }

        // Ajouter les fichiers
        foreach ($request->allFiles() as $key => $file) {
            if (is_array($file)) {
                foreach ($file as $index => $singleFile) {
                    $multipartData[] = [
                        'name' => $key . '[' . $index . ']',
                        'contents' => fopen($singleFile->getPathname(), 'r'),
                        'filename' => $singleFile->getClientOriginalName(),
                        'headers' => [
                            'Content-Type' => $singleFile->getMimeType()
                        ]
                    ];
                }
            } else {
                $multipartData[] = [
                    'name' => $key,
                    'contents' => fopen($file->getPathname(), 'r'),
                    'filename' => $file->getClientOriginalName(),
                    'headers' => [
                        'Content-Type' => $file->getMimeType()
                    ]
                ];
            }
        }

        // Utiliser la méthode appropriée avec multipart
        return match (strtoupper($method)) {
            'POST' => $httpRequest->asMultipart()->post($url, $multipartData),
            'PUT' => $httpRequest->asMultipart()->put($url, $multipartData),
            'PATCH' => $httpRequest->asMultipart()->patch($url, $multipartData),
            'DELETE' => $httpRequest->asMultipart()->delete($url, $multipartData),
            default => $httpRequest->asMultipart()->post($url, $multipartData)
        };
    }

    /**
     * Préparer les headers à transmettre au microservice
     */
    private function prepareHeaders(Request $request)
    {
        $headers = [];

        // Headers essentiels à transmettre
        $allowedHeaders = [
            'authorization',
            'content-type',
            'accept',
            'accept-language',
            'user-agent',
            'x-requested-with',
            'x-forwarded-for',
            'x-real-ip'
        ];

        foreach ($allowedHeaders as $header) {
            if ($request->hasHeader($header)) {
                $headerValue = $request->header($header);

                // Pour multipart/form-data, on laisse Laravel/Guzzle gérer le Content-Type
                if (strtolower($header) === 'content-type' && $this->isMultipartRequest($request)) {
                    continue;
                }
                // Exclure le header Authorization pour le service transactions
                if (strtolower($header) === 'authorization' && $this->isTransactionService($request)) {
                    continue;
                }

                $headers[$header] = $headerValue;
            }
        }

        // Ajouter TOUS les headers personnalisés X-* (sauf ceux déjà traités)
        foreach ($request->headers->all() as $headerName => $headerValues) {
            $lowerHeaderName = strtolower($headerName);

            // Permettre tous les headers qui commencent par 'x-' et qui ne sont pas déjà inclus
            if (str_starts_with($lowerHeaderName, 'x-') && !isset($headers[$lowerHeaderName])) {
                $headers[$headerName] = is_array($headerValues) ? $headerValues[0] : $headerValues;
            }
        }

        // Ajouter des headers custom du gateway
        $headers['X-Gateway-Request'] = 'true';
        $headers['X-Gateway-User-Id'] = auth()->id() ?? 'anonymous';
        $headers['X-Forwarded-Host'] = $request->getHost();

        return $headers;
    }

    /**
     * Vérifier si la requête est destinée au service transactions
     */
    private function isTransactionService(Request $request)
    {
        $path = $request->getPathInfo();
        $cleanPath = $this->cleanSwaggerPath($path);
        $service = $this->determineServiceFromPath($cleanPath);

        return $service === 'transactions';
    }

    /**
     * Récupérer les données de la requête (body)
     */
    private function getRequestData(Request $request)
    {
        // Pour les requêtes JSON
        if ($request->isJson()) {
            return $request->json()->all();
        }

        // Pour les requêtes multipart/form-data (géré séparément)
        if ($this->isMultipartRequest($request)) {
            return $request->all();
        }

        // Pour les autres types de contenu
        $contentType = $request->header('Content-Type', '');

        if (str_contains(strtolower($contentType), 'application/x-www-form-urlencoded')) {
            return $request->all();
        }

        // Par défaut, retourner toutes les données
        return $request->all();
    }

    /**
     * Filtrer les headers de réponse à retourner
     */
    private function filterResponseHeaders(array $headers)
    {
        $allowedHeaders = [
            'content-type',
            'accept',
            'content-length',
            'cache-control',
            'expires',
            'last-modified',
            'etag',
            'x-ratelimit-limit',
            'x-ratelimit-remaining',
            'x-pagination-total',
            'x-pagination-per-page'
        ];

        $filtered = [];
        foreach ($headers as $key => $value) {
            if (in_array(strtolower($key), $allowedHeaders)) {
                $filtered[$key] = is_array($value) ? $value[0] : $value;
            }
        }

        return $filtered;
    }

    /**
     * Méthode pour tester la connectivité des services
     */
    public function testConnectivity()
    {

        $results = [];

        foreach ($this->services as $service => $url) {
            try {

                $url = Config::get('keys.services.' . $service);
                $start = microtime(true);
                $response = Http::timeout(5)->post($url . '/api/transactions/operations');
                $end = microtime(true);

                $results[$service] = [
                    'status' => $response->successful() ? 'UP' : 'DOWN',
                    'response_time' => round(($end - $start) * 1000, 2) . 'ms',
                    'http_code' => $response->status()
                ];
            } catch (\Exception $e) {
                $results[$service] = [
                    'status' => 'DOWN',
                    'error' => $e->getMessage()
                ];
            }
        }

        return response()->json($results);
    }
}
