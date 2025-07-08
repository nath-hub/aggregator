<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SwaggerController extends Controller
{
    private $microservices = [
        'user' => [
            'name' => 'User Service',
            'url' => 'http://127.0.0.1:8001',
            'prefix' => '/api'
        ],
        'apikeys' => [
            'name' => 'Api Service',
            'url' => 'http://127.0.0.1:8002',
            'prefix' => '/api'
        ],
        'wallet' => [
            'name' => 'Wallet Service',
            'url' => 'http://wallet-service:8003',
            'prefix' => '/api/wallets'
        ],
        'notification' => [
            'name' => 'Notification Service',
            'url' => 'http://notification-service:8004',
            'prefix' => '/api/notifications'
        ]
    ];

    /**
     * Endpoint principal pour servir le Swagger unifié
     */
    public function index()
    {

        return view('vendor/l5-swagger/index');
    }

    /**
     * API endpoint qui retourne le JSON Swagger unifié
     */
    // public function json()
    // {
    //     $swagger = Cache::remember('unified_swagger', 300, function () {
    //         return $this->buildUnifiedSwagger();
    //     });

    //     return response()->json($swagger);
    // }

    /**
     * Construit le Swagger unifié en récupérant tous les microservices
     */
    private function buildUnifiedSwagger()
    {
        // Base Swagger pour le Gateway
        $baseSwagger = [
            'openapi' => '3.0.0',
            'info' => [
                'title' => 'Gateway API - Unified Documentation',
                'description' => 'Documentation unifiée pour tous les microservices',
                'version' => '1.0.0'
            ],
            'servers' => [
                [
                    'url' => config('app.url'),
                    'description' => 'Gateway Server'
                ]
            ],
            'paths' => [],
            'components' => [
                'schemas' => [],
                'securitySchemes' => [
                    'bearerAuth' => [
                        'type' => 'http',
                        'scheme' => 'bearer',
                        'bearerFormat' => 'JWT'
                    ]
                ]
            ],
            'tags' => [],
            'security' => [
                ['bearerAuth' => []]
            ]
        ];

        // Récupérer et merger chaque microservice
        foreach ($this->microservices as $key => $service) {
            try {
                $serviceSwagger = $this->fetchServiceSwagger($service);
                if ($serviceSwagger) {
                    $baseSwagger = $this->mergeSwagger($baseSwagger, $serviceSwagger, $service);
                }
            } catch (\Exception $e) {
                Log::warning("Impossible de récupérer Swagger pour {$service['name']}: " . $e->getMessage());
            }
        }

        return $baseSwagger;
    }



    /**
     * Récupère le Swagger d'un microservice
     */
    private function fetchServiceSwagger($service)
    {
        $response = Http::timeout(10)->get($service['url'] . '/docs?api-docs.json');

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    /**
     * Merge le Swagger d'un service dans le Swagger principal
     */
    private function mergeSwagger($baseSwagger, $serviceSwagger, $service)
    {
        // 1. GESTION DES TAGS - Transformer et préfixer les tags du microservice
        // $tagMapping = $this->transformServiceTags($baseSwagger, $serviceSwagger, $service);

        Log::info("Service: {$service['name']}", [
            'has_paths' => isset($serviceSwagger['paths']),
            'paths_count' => isset($serviceSwagger['paths']) ? count($serviceSwagger['paths']) : 0,
            'has_tags' => isset($serviceSwagger['tags']),
            'service_prefix' => $service['prefix']
        ]);

        if (isset($serviceSwagger['tags'])) {
            foreach ($serviceSwagger['tags'] as $tag) {
                // Éviter les doublons de tags
                $tagExists = false;
                foreach ($baseSwagger['tags'] as $existingTag) {
                    if ($existingTag['name'] === $tag['name']) {
                        $tagExists = true;
                        break;
                    }
                }

                if (!$tagExists) {
                    // Optionnel : préfixer la description avec le nom du service
                    if (isset($tag['description'])) {
                        $tag['description'] = "[{$service['name']}] " . $tag['description'];
                    }
                    $baseSwagger['tags'][] = $tag;
                }
            }
        }

        // 2. MERGER LES PATHS avec les nouveaux tags
        if (isset($serviceSwagger['paths']) && !empty($serviceSwagger['paths'])) {
            foreach ($serviceSwagger['paths'] as $path => $methods) {
                $cleanPath = $path;
                if (strpos($path, '/api/') === 0) {
                    $cleanPath = substr($path, 4); // Enlever "/api"
                }

                $gatewayPath = $service['prefix'] . $cleanPath;

                // Traiter chaque méthode HTTP
 $processedMethods = [];
                foreach ($methods as $method => $details) {
                    if (in_array(strtolower($method), ['get', 'post', 'put', 'patch', 'delete', 'options', 'head'])) {
                       
                        // Préserver les tags originaux au lieu de les écraser
                        if (isset($details['tags']) && is_array($details['tags']) && !empty($details['tags'])) {
                            // Garder les tags originaux
                            $processedMethods[$method] = $details;
                        } else {
                            // Si pas de tags originaux, utiliser le nom du service
                            $details['tags'] = [$service['name']];
                            $processedMethods[$method] = $details;
                        }

                        // Ajouter des infos sur le proxy
                        $processedMethods[$method]['description'] = ($details['description'] ?? '') .
                            "\n\n**Proxied to:** " . $service['name'];

                        // S'assurer que les propriétés obligatoires sont présentes
                        if (!isset($processedMethods[$method]['responses'])) {
                            $processedMethods[$method]['responses'] = [
                                '200' => [
                                    'description' => 'Success'
                                ]
                            ];
                        }
                    }
                }

                // if (!empty($processedMethods)) {
                $baseSwagger['paths'][$gatewayPath] = $processedMethods;
                // }
            }
        }

        // 3. MERGER LES SCHEMAS/COMPONENTS
        if (isset($serviceSwagger['components']['schemas'])) {
            foreach ($serviceSwagger['components']['schemas'] as $schemaName => $schema) {
                // Préfixer les schemas pour éviter les conflits
                $prefixedName = ucfirst($service['display_name']) . $schemaName;
                $baseSwagger['components']['schemas'][$prefixedName] = $schema;
            }
        }

        // 4. MERGER D'AUTRES COMPOSANTS si nécessaires
        if (isset($serviceSwagger['components']['parameters'])) {
            $baseSwagger['components']['parameters'] = array_merge(
                $baseSwagger['components']['parameters'] ?? [],
                $serviceSwagger['components']['parameters']
            );
        }

        if (isset($serviceSwagger['components']['responses'])) {
            $baseSwagger['components']['responses'] = array_merge(
                $baseSwagger['components']['responses'] ?? [],
                $serviceSwagger['components']['responses']
            );
        }

        return $baseSwagger;
    }

  

    /**
     * Endpoint pour forcer le refresh du cache
     */
    public function refresh()
    {
        Cache::forget('unified_swagger');
        return response()->json(['message' => 'Swagger cache refreshed']);
    }

    /**
     * Endpoint pour récupérer le JSON Swagger unifié
     */
    public function json()
    {
        try {
            $unifiedSwagger = $this->buildUnifiedSwagger();

            // Trier les tags par ordre alphabétique pour une meilleure présentation
            usort($unifiedSwagger['tags'], function ($a, $b) {
                return strcmp($a['name'], $b['name']);
            });

            return response()->json($unifiedSwagger);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la génération du Swagger unifié: ' . $e->getMessage());

            return response()->json([
                'error' => 'Impossible de générer la documentation',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Endpoint pour vérifier le statut des microservices
     */
    public function health()
    {
        $healthStatus = [];

        foreach ($this->microservices as $key => $service) {
            $startTime = microtime(true);

            try {
                $response = Http::timeout(5)->get($service['url'] . '/health');
                $responseTime = microtime(true) - $startTime;

                $healthStatus[$key] = [
                    'name' => $service['name'],
                    'status' => $response->successful() ? 'UP' : 'DOWN',
                    'response_time' => $responseTime,
                    'url' => $service['url']
                ];
            } catch (\Exception $e) {
                $responseTime = microtime(true) - $startTime;

                $healthStatus[$key] = [
                    'name' => $service['name'],
                    'status' => 'DOWN',
                    'response_time' => $responseTime,
                    'error' => $e->getMessage(),
                    'url' => $service['url']
                ];
            }
        }

        return response()->json($healthStatus);
    }
}
