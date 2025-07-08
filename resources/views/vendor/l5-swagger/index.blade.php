<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gateway API Documentation</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui.css" />
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }
        *, *:before, *:after {
            box-sizing: inherit;
        }
        body {
            margin: 0;
            background: #ffffff;
        }
        .swagger-ui .topbar {
            background-color: #2c3e50;
        }
        .swagger-ui .topbar .download-url-wrapper .select-label {
            color: #fff;
        }
        .swagger-ui .topbar .download-url-wrapper input[type=text] {
            border: 2px solid #34495e;
        }
        .custom-header {
            background: linear-gradient(135deg, #39be65 0%, #920166 100%);
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 0;
        }
        .custom-header h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: 300;
        }
        .custom-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        .health-status {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .health-btn {
            background: #27ae60;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        .health-btn:hover {
            background: #2ecc71;
            transform: translateY(-2px);
        }
        .health-popup {
            display: none;
            position: absolute;
            top: 45px;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-width: 300px;
        }
        .service-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .service-status:last-child {
            border-bottom: none;
        }
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .status-up { background: #27ae60; }
        .status-down { background: #e74c3c; }
        .refresh-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #3498db;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
            transition: all 0.3s;
            z-index: 1000;
        }
        .refresh-btn:hover {
            background: #2980b9;
            transform: scale(1.1);
        }
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }
        /* Styles pour la gestion du token */
        .token-manager {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 1000;
        }
        .token-btn {
            background: #9b59b6;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            margin-bottom: 5px;
        }
        .token-btn:hover {
            background: #8e44ad;
            transform: translateY(-2px);
        }
        .token-popup {
            display: none;
            position: absolute;
            top: 45px;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-width: 350px;
        }
        .token-input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: monospace;
        }
        .token-actions {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .token-action-btn {
            flex: 1;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }
        .btn-save { background: #27ae60; color: white; }
        .btn-clear { background: #e74c3c; color: white; }
        .btn-save:hover { background: #2ecc71; }
        .btn-clear:hover { background: #c0392b; }
        .token-status {
            margin-top: 10px;
            padding: 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        .token-valid { background: #d5f4e6; color: #27ae60; }
        .token-expired { background: #fadbd8; color: #e74c3c; }
        .token-none { background: #f8f9fa; color: #6c757d; }
    </style>
</head>
<body>
    <!-- En-tête personnalisé -->
    <div class="custom-header">
        <h1>🚀 Gateway API Documentation</h1>
        <p>Documentation unifiée pour tous les microservices</p>
    </div>

    <!-- Bouton de statut des services -->
    <div class="health-status">
        <button class="health-btn" onclick="toggleHealthStatus()">
            <span id="health-icon">💚</span> Services Status
        </button>
        <div class="health-popup" id="health-popup">
            <div id="health-content">
                <div style="text-align: center; padding: 20px;">
                    <div style="font-size: 20px;">⏳</div>
                    <div>Chargement...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gestionnaire de token -->
    <div class="token-manager">
        <button class="token-btn" onclick="toggleTokenManager()">
            <span id="token-icon">🔑</span> Bearer Token
        </button>
        <div class="token-popup" id="token-popup">
            <div>
                <label for="token-input" style="font-weight: bold; display: block; margin-bottom: 5px;">
                    Bearer Token (expire dans 60min)
                </label>
                <input type="password" id="token-input" class="token-input" 
                       placeholder="Coller votre token Bearer ici..." />
                <div class="token-actions">
                    <button class="token-action-btn btn-save" onclick="saveToken()">💾 Sauvegarder</button>
                    <button class="token-action-btn btn-clear" onclick="clearToken()">🗑️ Effacer</button>
                </div>
                <div id="token-status" class="token-status token-none">
                    Aucun token configuré
                </div>
            </div>
        </div>
    </div>

    <!-- Bouton de refresh -->
    <button class="refresh-btn" onclick="refreshSwagger()" title="Actualiser la documentation">
        <span id="refresh-icon">🔄</span>
    </button>

    <!-- Interface Swagger UI -->
    <div id="swagger-ui"></div>

    <script src="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui-bundle.js"></script>
    <script src="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui-standalone-preset.js"></script>
    <script>
        // Variables globales pour la gestion du token
        let swaggerUI = null;
        const TOKEN_STORAGE_KEY = 'swagger_bearer_token';
        const TOKEN_EXPIRY_KEY = 'swagger_token_expiry';
        const TOKEN_DURATION = 60 * 60 * 1000; // 60 minutes en millisecondes

        window.onload = function() {
            // Configuration Swagger UI
            swaggerUI = SwaggerUIBundle({
                url: "{{ route('swagger.json') }}",
                dom_id: '#swagger-ui',
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "StandaloneLayout",
                tryItOutEnabled: true,
                filter: true,
                supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
                onComplete: function() {
                    console.log('Swagger UI loaded successfully');
                    // Restaurer le token après le chargement de Swagger
                    restoreToken();
                },
                onFailure: function(data) {
                    console.error('Failed to load Swagger UI:', data);
                },
                // Intercepter les requêtes pour ajouter automatiquement le token
                requestInterceptor: function(request) {
                    const token = getValidToken();
                    if (token && !request.headers.Authorization) {
                        request.headers.Authorization = `Bearer ${token}`;
                    }
                    return request;
                },
                // Gérer les réponses d'erreur d'authentification
                responseInterceptor: function(response) {
                    if (response.status === 401) {
                        console.warn('Token expiré ou invalide');
                        clearToken();
                        updateTokenStatus();
                    }
                    return response;
                }
            });

            // Charger le statut des services au démarrage
            loadHealthStatus();
            
            // Initialiser l'affichage du token
            updateTokenStatus();
            
            // Vérifier l'expiration du token toutes les minutes
            setInterval(checkTokenExpiry, 60000);
        };

        // === GESTION DU TOKEN ===
        
        function toggleTokenManager() {
            const popup = document.getElementById('token-popup');
            const isVisible = popup.style.display === 'block';
            
            if (isVisible) {
                popup.style.display = 'none';
            } else {
                popup.style.display = 'block';
                // Charger le token actuel dans l'input
                const token = localStorage.getItem(TOKEN_STORAGE_KEY);
                if (token) {
                    document.getElementById('token-input').value = token;
                }
            }
        }

        function saveToken() {
            const tokenInput = document.getElementById('token-input');
            const token = tokenInput.value.trim();
            
            if (!token) {
                alert('Veuillez saisir un token');
                return;
            }
            
            // Sauvegarder le token avec sa date d'expiration
            const expiryTime = Date.now() + TOKEN_DURATION;
            localStorage.setItem(TOKEN_STORAGE_KEY, token);
            localStorage.setItem(TOKEN_EXPIRY_KEY, expiryTime.toString());
            
            // Mettre à jour l'interface
            updateTokenStatus();
            applyTokenToSwagger(token);
            
            // Fermer le popup
            document.getElementById('token-popup').style.display = 'none';
            
            console.log('Token sauvegardé avec succès');
        }

        function clearToken() {
            localStorage.removeItem(TOKEN_STORAGE_KEY);
            localStorage.removeItem(TOKEN_EXPIRY_KEY);
            document.getElementById('token-input').value = '';
            updateTokenStatus();
            
            // Effacer le token de Swagger UI
            if (swaggerUI) {
                swaggerUI.preauthorizeApiKey('Bearer', '');
            }
            
            console.log('Token effacé');
        }

        function getValidToken() {
            const token = localStorage.getItem(TOKEN_STORAGE_KEY);
            const expiry = localStorage.getItem(TOKEN_EXPIRY_KEY);
            
            if (!token || !expiry) {
                return null;
            }
            
            // Vérifier si le token a expiré
            if (Date.now() > parseInt(expiry)) {
                clearToken();
                return null;
            }
            
            return token;
        }

        function restoreToken() {
            const token = getValidToken();
            if (token) {
                applyTokenToSwagger(token);
                console.log('Token restauré automatiquement');
            }
        }

        function applyTokenToSwagger(token) {
            if (swaggerUI) {
                // Appliquer le token à Swagger UI
                swaggerUI.preauthorizeApiKey('Bearer', `Bearer ${token}`);
            }
        }

        function updateTokenStatus() {
            const statusDiv = document.getElementById('token-status');
            const tokenIcon = document.getElementById('token-icon');
            const token = getValidToken();
            
            if (!token) {
                statusDiv.className = 'token-status token-none';
                statusDiv.textContent = 'Aucun token configuré';
                tokenIcon.textContent = '🔓';
            } else {
                const expiry = localStorage.getItem(TOKEN_EXPIRY_KEY);
                const remainingTime = parseInt(expiry) - Date.now();
                const remainingMinutes = Math.floor(remainingTime / 60000);
                
                if (remainingMinutes > 5) {
                    statusDiv.className = 'token-status token-valid';
                    statusDiv.textContent = `✅ Token valide (expire dans ${remainingMinutes}min)`;
                    tokenIcon.textContent = '🔑';
                } else {
                    statusDiv.className = 'token-status token-expired';
                    statusDiv.textContent = `⚠️ Token expire bientôt (${remainingMinutes}min)`;
                    tokenIcon.textContent = '⚠️';
                }
            }
        }

        function checkTokenExpiry() {
            const token = localStorage.getItem(TOKEN_STORAGE_KEY);
            const expiry = localStorage.getItem(TOKEN_EXPIRY_KEY);
            
            if (token && expiry && Date.now() > parseInt(expiry)) {
                console.log('Token expiré, suppression automatique');
                clearToken();
            }
            
            updateTokenStatus();
        }

        // === GESTION DU STATUT DES SERVICES (code existant) ===

        function toggleHealthStatus() {
            const popup = document.getElementById('health-popup');
            const isVisible = popup.style.display === 'block';
            
            if (isVisible) {
                popup.style.display = 'none';
            } else {
                popup.style.display = 'block';
                loadHealthStatus();
            }
        }

        async function loadHealthStatus() {
            try {
                const response = await fetch("{{ route('swagger.health') }}");
                const data = await response.json();
                
                let healthHtml = '';
                let allUp = true;
                
                Object.values(data).forEach(service => {
                    const statusClass = service.status === 'UP' ? 'status-up' : 'status-down';
                    const statusIcon = service.status === 'UP' ? '✅' : '❌';
                    
                    if (service.status !== 'UP') allUp = false;
                    
                    healthHtml += `
                        <div class="service-status">
                            <div style="display: flex; align-items: center;">
                                <div class="status-indicator ${statusClass}"></div>
                                <strong>${service.name}</strong>
                            </div>
                            <div>
                                ${statusIcon} ${service.status}
                                ${service.response_time ? `(${Math.round(service.response_time * 1000)}ms)` : ''}
                            </div>
                        </div>
                    `;
                });
                
                document.getElementById('health-content').innerHTML = healthHtml;
                document.getElementById('health-icon').textContent = allUp ? '💚' : '💔';
                
            } catch (error) {
                console.error('Erreur lors du chargement du statut:', error);
                document.getElementById('health-content').innerHTML = `
                    <div style="text-align: center; color: #e74c3c;">
                        <div style="font-size: 20px;">❌</div>
                        <div>Erreur de chargement</div>
                    </div>
                `;
                document.getElementById('health-icon').textContent = '💔';
            }
        }

        async function refreshSwagger() {
            const refreshBtn = document.querySelector('.refresh-btn');
            const refreshIcon = document.getElementById('refresh-icon');
            
            refreshBtn.classList.add('loading');
            refreshIcon.textContent = '⏳';
            
            try {
                await fetch("{{ route('swagger.refresh') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                });
                
                setTimeout(() => {
                    window.location.reload();
                }, 500);
                
            } catch (error) {
                console.error('Erreur lors du refresh:', error);
                refreshIcon.textContent = '❌';
                
                setTimeout(() => {
                    refreshBtn.classList.remove('loading');
                    refreshIcon.textContent = '🔄';
                }, 2000);
            }
        }

        // === GESTION DES ÉVÉNEMENTS ===

        document.addEventListener('click', function(event) {
            const healthStatus = document.querySelector('.health-status');
            const tokenManager = document.querySelector('.token-manager');
            const healthPopup = document.getElementById('health-popup');
            const tokenPopup = document.getElementById('token-popup');
            
            // Fermer le popup de health si on clique ailleurs
            if (!healthStatus.contains(event.target)) {
                healthPopup.style.display = 'none';
            }
            
            // Fermer le popup de token si on clique ailleurs
            if (!tokenManager.contains(event.target)) {
                tokenPopup.style.display = 'none';
            }
        });

        // Auto-refresh du statut toutes les 30 secondes
        setInterval(function() {
            if (document.getElementById('health-popup').style.display === 'block') {
                loadHealthStatus();
            }
        }, 30000);
    </script>
</body>
</html>