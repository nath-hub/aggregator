<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API - Affichage Entreprise</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .header {
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 40px;
        }

        .api-config {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: 1px solid #e9ecef;
        }

        .api-config h3 {
            color: #495057;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        .config-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .config-grid input {
            padding: 12px 16px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .config-grid input:focus {
            outline: none;
            border-color: #0072ff;
            box-shadow: 0 0 0 3px rgba(0, 114, 255, 0.1);
        }

        .search-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border: 1px solid #e0e6ed;
        }

        .search-section h3 {
            color: #0072ff;
            margin-bottom: 20px;
            font-size: 1.3rem;
            border-bottom: 2px solid #0072ff;
            padding-bottom: 10px;
        }

        .search-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e0e6ed;
            border-radius: 50px;
            font-size: 16px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .search-input:focus {
            outline: none;
            border-color: #0072ff;
            box-shadow: 0 0 0 3px rgba(0, 114, 255, 0.1);
        }

        .btn {
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 198, 255, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-secondary:hover {
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .result-container {
            margin-top: 30px;
            display: none;
        }

        .result-container.show {
            display: block;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .entreprise-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .entreprise-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .entreprise-name {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .entreprise-type {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            padding: 30px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #0072ff;
        }

        .info-section h4 {
            color: #0072ff;
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #495057;
        }

        .info-value {
            color: #6c757d;
            text-align: right;
            max-width: 60%;
            word-wrap: break-word;
        }

        .files-section {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #2196f3;
        }

        .file-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .file-item:last-child {
            margin-bottom: 0;
        }

        .file-name {
            font-weight: 600;
            color: #1976d2;
            margin-bottom: 5px;
        }

        .file-url {
            color: #666;
            font-size: 0.9rem;
            word-break: break-all;
        }

        .error-container {
            background: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #f5c6cb;
        }

        .success-container {
            background: #d4edda;
            color: #155724;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #c3e6cb;
        }

        .json-response {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
            margin-top: 20px;
        }

        .json-response h4 {
            margin-bottom: 15px;
            color: #495057;
        }

        .json-response pre {
            background: #ffffff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            overflow-x: auto;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .config-grid {
                grid-template-columns: 1fr;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔍 Affichage d'une Entreprise</h1>
            <p>Testez l'endpoint de récupération d'une entreprise par ID</p>
        </div>

        <div class="content">
            <div class="api-config">
                <h3>Configuration API</h3>
                <div class="config-grid">
                    <input type="text" id="apiUrl" placeholder="URL de base de l'API" value="http://localhost:8000/api/entreprises">
                    <input type="text" id="apiToken" placeholder="Token d'authentification">
                </div>
            </div>

            <div class="search-section">
                <h3>Rechercher une entreprise</h3>
                <input type="number" id="entrepriseId" class="search-input" placeholder="Entrez l'ID de l'entreprise" min="1">
                <button id="searchBtn" class="btn">🔍 Rechercher</button>
                <button id="clearBtn" class="btn btn-secondary">🗑️ Effacer</button>
            </div>

            <div id="result" class="result-container"></div>
        </div>
    </div>

    <script>
        const apiUrlInput = document.getElementById('apiUrl');
        const apiTokenInput = document.getElementById('apiToken');
        const entrepriseIdInput = document.getElementById('entrepriseId');
        const searchBtn = document.getElementById('searchBtn');
        const clearBtn = document.getElementById('clearBtn');
        const resultDiv = document.getElementById('result');

        searchBtn.addEventListener('click', async function() {
            const id = entrepriseIdInput.value.trim();
            
            if (!id) {
                showError('Veuillez entrer un ID d\'entreprise');
                return;
            }

            await searchEntreprise(id);
        });

        clearBtn.addEventListener('click', function() {
            entrepriseIdInput.value = '';
            resultDiv.style.display = 'none';
        });

        entrepriseIdInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });

        async function searchEntreprise(id) {
            const apiUrl = apiUrlInput.value.trim();
            const apiToken = apiTokenInput.value.trim();
            
            if (!apiUrl) {
                showError('Veuillez configurer l\'URL de l\'API');
                return;
            }

            // État de chargement
            searchBtn.classList.add('loading');
            searchBtn.innerHTML = '⏳ Recherche...';
            resultDiv.style.display = 'none';

            try {
                const headers = {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                };
                
                if (apiToken) {
                    headers['Authorization'] = `Bearer ${apiToken}`;
                }

                const response = await fetch(`${apiUrl}/${id}`, {
                    method: 'GET',
                    headers: headers
                });

                const data = await response.json();

                if (response.ok) {
                    displayEntreprise(data.entreprise);
                } else {
                    showError(data.message || 'Erreur lors de la récupération', data);
                }

            } catch (error) {
                showError('Erreur de connexion à l\'API', { error: error.message });
            } finally {
                searchBtn.classList.remove('loading');
                searchBtn.innerHTML = '🔍 Rechercher';
            }
        }

        function displayEntreprise(entreprise) {
            const html = `
                <div class="entreprise-card">
                    <div class="entreprise-header">
                        <div class="entreprise-name">${entreprise.nom_entreprise || 'N/A'}</div>
                        <div class="entreprise-type">${entreprise.type_entreprise || 'N/A'}</div>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-section">
                            <h4>📋 Informations générales</h4>
                            <div class="info-item">
                                <span class="info-label">ID:</span>
                                <span class="info-value">${entreprise.id || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Nom commercial:</span>
                                <span class="info-value">${entreprise.nom_commercial || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Secteur d'activité:</span>
                                <span class="info-value">${entreprise.secteur_activite || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Année de création:</span>
                                <span class="info-value">${entreprise.annee_creation_entreprise || 'N/A'}</span>
                            </div>
                        </div>

                        <div class="info-section">
                            <h4>⚖️ Informations légales</h4>
                            <div class="info-item">
                                <span class="info-label">N° Identification fiscale:</span>
                                <span class="info-value">${entreprise.numero_identification_fiscale || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">N° Registre commerce:</span>
                                <span class="info-value">${entreprise.numero_registre_commerce || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">N° SIREN:</span>
                                <span class="info-value">${entreprise.numero_siren || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Capital social:</span>
                                <span class="info-value">${entreprise.capital_social || 'N/A'}</span>
                            </div>
                        </div>

                        <div class="info-section">
                            <h4>📍 Adresse</h4>
                            <div class="info-item">
                                <span class="info-label">Adresse:</span>
                                <span class="info-value">${entreprise.adresse_siege_social || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Ville:</span>
                                <span class="info-value">${entreprise.ville_siege_social || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Code postal:</span>
                                <span class="info-value">${entreprise.code_postal_siege_social || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Pays:</span>
                                <span class="info-value">${entreprise.pays_siege_social || 'N/A'}</span>
                            </div>
                        </div>

                        <div class="info-section">
                            <h4>📞 Contact</h4>
                            <div class="info-item">
                                <span class="info-label">Téléphone:</span>
                                <span class="info-value">${entreprise.numero_telephone || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Email:</span>
                                <span class="info-value">${entreprise.email_contact_principal || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Site web:</span>
                                <span class="info-value">${entreprise.site_web_url || 'N/A'}</span>
                            </div>
                        </div>

                        <div class="info-section">
                            <h4>✅ Statut KYB</h4>
                            <div class="info-item">
                                <span class="info-label">Statut:</span>
                                <span class="info-value">${entreprise.statut_kyb || 'N/A'}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Motif:</span>
                                <span class="info-value">${entreprise.motif_statut || 'N/A'}</span>
                            </div>
                        </div>

                        <div class="info-section">
                            <h4>👤 Utilisateur</h4>
                            <div class="info-item">
                                <span class="info-label">User ID:</span>
                                <span class="info-value">${entreprise.user_id || 'N/A'}</span>
                            </div>
                            ${entreprise.user ? `
                                <div class="info-item">
                                    <span class="info-label">Nom utilisateur:</span>
                                    <span class="info-value">${entreprise.user.name || 'N/A'}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Email utilisateur:</span>
                                    <span class="info-value">${entreprise.user.email || 'N/A'}</span>
                                </div>
                            ` : ''}
                        </div>
                    </div>

                    ${entreprise.fichiers ? `
                        <div class="files-section">
                            <h4>📄 Fichiers associés</h4>
                            ${generateFilesHtml(entreprise.fichiers)}
                        </div>
                    ` : ''}
                </div>

                <div class="json-response">
                    <h4>📝 Réponse JSON complète</h4>
                    <pre>${JSON.stringify(entreprise, null, 2)}</pre>
                </div>
            `;

            resultDiv.innerHTML = html;
            resultDiv.className = 'result-container show';
            resultDiv.scrollIntoView({ behavior: 'smooth' });
        }

        function generateFilesHtml(fichiers) {
            if (!fichiers || (Array.isArray(fichiers) && fichiers.length === 0)) {
                return '<p>Aucun fichier associé</p>';
            }

            // Si fichiers est un objet (relation one-to-one)
            if (!Array.isArray(fichiers)) {
                fichiers = [fichiers];
            }

            return fichiers.map(fichier => {
                const files = [];
                
                if (fichier.url_rccm) files.push({ name: 'RCCM', url: fichier.url_rccm, date: fichier.date_expiration_rccm });
                if (fichier.url_attestation_fiscale) files.push({ name: 'Attestation fiscale', url: fichier.url_attestation_fiscale, date: fichier.date_expiration_attestation_fiscale });
                if (fichier.url_statuts_societe) files.push({ name: 'Statuts société', url: fichier.url_statuts_societe, date: fichier.date_maj_statuts });
                if (fichier.url_declaration_regularite) files.push({ name: 'Déclaration régularité', url: fichier.url_declaration_regularite, date: fichier.date_emission_declaration_regularite });
                if (fichier.url_attestation_immatriculation) files.push({ name: 'Attestation immatriculation', url: fichier.url_attestation_immatriculation, date: fichier.date_emission_attestation_immatriculation });

                return files.map(file => `
                    <div class="file-item">
                        <div class="file-name">${file.name}</div>
                        <div class="file-url">${file.url}</div>
                        ${file.date ? `<div class="file-date">Date: ${file.date}</div>` : ''}
                    </div>
                `).join('');
            }).join('');
        }

        function showError(message, data = null) {
            const html = `
                <div class="error-container">
                    <h4>❌ Erreur</h4>
                    <p>${message}</p>
                    ${data ? `
                        <div class="json-response">
                            <h4>📝 Détails de l'erreur</h4>
                            <pre>${JSON.stringify(data, null, 2)}</pre>
                        </div>
                    ` : ''}
                </div>
            `;

            resultDiv.innerHTML = html;
            resultDiv.className = 'result-container show';
            resultDiv.scrollIntoView({ behavior: 'smooth' });
        }
    </script>
</body>
</html>