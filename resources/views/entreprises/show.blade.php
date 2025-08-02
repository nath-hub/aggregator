<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Entreprise</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            padding: 40px;
            text-align: center;
            color: white;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .header p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .auth-section {
            background: #f8fafc;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            border-left: 4px solid #4facfe;
        }

        .auth-section h3 {
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
        }

        input[type="text"],
        input[type="url"] {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            font-family: monospace;
        }

        input:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
        }

        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(79, 172, 254, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(79, 172, 254, 0.4);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }


         .btn-danger {
            background: linear-gradient(135deg, #ff3a3a 0%, #ff1dc7 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(119, 36, 36, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(124, 1, 1, 0.4);
        }

        .btn-danger:active {
            transform: translateY(0);
        }

        .btn-danger:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
         

          .btn-green {
            background: linear-gradient(135deg, #00ff15 0%, #00ff95 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(119, 36, 36, 0.3);
        }

        .btn-green:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(21, 184, 0, 0.4);
        }

        .btn-green:active {
            transform: translateY(0);
        }

        .btn-green:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }



        .btn-orange {
            background: linear-gradient(135deg, #f39e00 0%, #f8f400 100%);
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(119, 36, 36, 0.3);
        }

        .btn-orange:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(252, 193, 0, 0.4);
        }

        .btn-orange:active {
            transform: translateY(0);
        }

        .btn-orange:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }


        .loading {
            display: none;
            text-align: center;
            margin: 20px 0;
        }

        .loading::after {
            content: "";
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #4facfe;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .response-container {
            margin-top: 30px;
            display: none;
        }

        .response-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 20px;
            border-radius: 10px;
        }

        .response-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 20px;
            border-radius: 10px;
        }

        .entreprise-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 20px;
        }

        .entreprise-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px;
            color: white;
            text-align: center;
        }

        .entreprise-header h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .entreprise-header .type {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 10px;
        }

        .entreprise-body {
            padding: 30px;
        }

        .info-section {
            margin-bottom: 30px;
        }

        .info-section h3 {
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4facfe;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }

        .info-item {
            background: #f8fafc;
            padding: 15px;
            border-radius: 10px;
            border-left: 4px solid #4facfe;
        }

        .info-item label {
            font-weight: 600;
            color: #666;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 5px;
        }

        .info-item .value {
            color: #333;
            font-size: 1rem;
        }

        .info-item .empty {
            color: #999;
            font-style: italic;
        }

        .fichiers-section {
            background: #f8fafc;
            padding: 25px;
            border-radius: 15px;
            margin-top: 20px;
        }

        .fichiers-section h3 {
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .fichier-item {
            background: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border-left: 4px solid #27ae60;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fichier-info {
            flex: 1;
        }

        .fichier-name {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .fichier-meta {
            color: #666;
            font-size: 0.9rem;
        }

        .fichier-link {
            background: #4facfe;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .fichier-link:hover {
            background: #2196f3;
            transform: translateY(-1px);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-en-attente {
            background: #fff3cd;
            color: #856404;
        }

        .status-approuve {
            background: #d4edda;
            color: #155724;
        }

        .status-rejete {
            background: #f8d7da;
            color: #721c24;
        }

        .status-en-revision {
            background: #d1ecf1;
            color: #0c5460;
        }

        .user-info {
            background: #e8f4f8;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .user-info h4 {
            color: #333;
            margin-bottom: 10px;
        }

        .json-viewer {
            background: #2d3748;
            color: #e2e8f0;
            padding: 20px;
            border-radius: 10px;
            font-family: 'Courier New', monospace;
            font-size: 0.9rem;
            overflow-x: auto;
            white-space: pre-wrap;
            margin-top: 20px;
        }

        .toggle-json {
            background: #4a5568;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .toggle-json:hover {
            background: #2d3748;
        }

        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .content {
                padding: 20px;
            }
            
            .fichier-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Consultation Entreprise</h1>
            <p>Récupération des informations d'entreprise via token d'authentification</p>
        </div>

        <div class="content">
            <div class="auth-section">
                <h3>🎉 Configuration de l'API</h3> 
                   
                    <input type="url" hidden id="api-url" value="https://aggregator.elyft.tech/api/docs/aggragator.elyft.tech/api/entreprises/me/company" placeholder="https://aggregator.elyft.tech/api/docs/aggragator.elyft.tech/api/entreprises/me/company">
                  
                    <input type="text" hidden id="auth-token" placeholder="Bearer your-jwt-token-here">
             
                <button type="button" class="btn-primary" onclick="fetchEntreprise()">
                    🔥 Récupérer les informations de mon entreprise
                </button>
                
                 <div class="auth-section">
                    <h3>Recherche par ID d'entreprise</h3>
                    <div class="form-group">
                        <label for="entreprise-id">ID de l'entreprise:</label>
                        <input type="text" id="entreprise-id" placeholder="kjdnkdfjlsdksdmkl">
                    </div>
                    <button type="button" class="btn-primary" onclick="fetchEntrepriseById()">
                        Récupérer par ID
                    </button>
                </div>
                
                <div class="auth-section">
                    <h3>echerche par ID d'entreprise</h3>
                    
                     
                    <button type="button" class="btn-green" onclick="window.location.href='{{ route('entreprises.create') }}'">
                        Ajouter
                    </button>
                     <button type="button" class="btn-orange" onclick="window.location.href='{{ route('entreprises.update') }}'">
                        Modifier
                    </button>
                     <button type="button" class="btn-danger" onclick="deleteEntrepriseById()">
                        Supprimer
                    </button>
                    
                      
                    <button type="button" class="btn-primary" onclick="window.location.href='{{ route('auth') }}'">
                        Retourn
                    </button>
                    
                     
                </div>
                
                <div class="loading">Chargement en cours...</div>
            </div>

            <div class="response-container" id="response-container"></div>
        </div>
    </div>

    <script>
        async function fetchEntreprise() {
            const apiUrl = document.getElementById('api-url').value;
           const authToken = localStorage.getItem('auth_token');
            const responseContainer = document.getElementById('response-container');
            const loading = document.querySelector('.loading');
            const button = document.querySelector('.btn-primary');

            if (!apiUrl || !authToken) {
                showError('Veuillez remplir l\'URL de l\'API et le token d\'authentification.');
                return;
            }

            // Afficher le loading
            button.disabled = true;
            loading.style.display = 'block';
            responseContainer.style.display = 'none';

            try {
                const response = await fetch(apiUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    showEntreprise(data);
                } else {
                    showError(`Erreur ${response.status}: ${data.message || 'Erreur inconnue'}`, data);
                }
            } catch (error) {
                showError(`Erreur de connexion: ${error.message}`, null);
            } finally {
                button.disabled = false;
                loading.style.display = 'none';
            }
        }
        
        async function fetchEntrepriseById() {
            const apiUrl = document.getElementById('api-url').value;
            const authToken = document.getElementById('auth-token').value;
            const entrepriseId = document.getElementById('entreprise-id').value;
            
            if (!apiUrl || !authToken) {
                showError('Veuillez remplir l\'URL de l\'API et le token d\'authentification.');
                return;
            }

            if (!entrepriseId) {
                showError('Veuillez saisir un ID d\'entreprise.');
                return;
            }

            const fullUrl = `https://aggregator.elyft.tech/api/docs/aggragator.elyft.tech/api/entreprises/${entrepriseId}`;
            await makeRequest(fullUrl, authToken, 'GET');
        }
        
        
         async function deleteEntrepriseById() {
            const apiUrl = document.getElementById('api-url').value;
            const authToken = document.getElementById('auth-token').value;
            const entrepriseId = document.getElementById('entreprise-id').value;
            
            if (!apiUrl || !authToken) {
                showError('Veuillez remplir l\'URL de l\'API et le token d\'authentification.');
                return;
            }

            if (!entrepriseId) {
                showError('Veuillez saisir un ID d\'entreprise.');
                return;
            }

            const fullUrl = `https://aggregator.elyft.tech/api/docs/aggragator.elyft.tech/api/entreprises/${entrepriseId}`;
            await makeRequest(fullUrl, authToken, 'DELETE');
        }

        async function makeRequest(url, token, method) {
            const responseContainer = document.getElementById('response-container');
            const loading = document.querySelector('.loading');
            const buttons = document.querySelectorAll('.btn-primary, .btn-secondary');

            // Désactiver tous les boutons
            buttons.forEach(btn => btn.disabled = true);
            loading.style.display = 'block';
            responseContainer.style.display = 'none';

            try {
                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token.startsWith('Bearer ') ? token : `Bearer ${token}`,
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    showEntreprise(data);
                } else {
                    showError(`Erreur ${response.status}: ${data.message || 'Erreur inconnue'}`, data);
                }
            } catch (error) {
                showError(`Erreur de connexion: ${error.message}`, null);
            } finally {
                // Réactiver tous les boutons
                buttons.forEach(btn => btn.disabled = false);
                loading.style.display = 'none';
            }
        }

        function showEntreprise(entreprise) {
            const container = document.getElementById('response-container');
            container.className = 'response-container';
            
            const statusClass = `status-${entreprise.statut_kyb || 'en-attente'}`;
            const statusText = getStatusText(entreprise.statut_kyb);
            
            container.innerHTML = `
                <div class="entreprise-card">
                    <div class="entreprise-header">
                        <h2>${entreprise.nom_entreprise}</h2>
                        <div class="type">${entreprise.type_entreprise}</div>
                        <div class="status-badge ${statusClass}" style="margin-top: 10px;">${statusText}</div>
                    </div>
                    
                    <div class="entreprise-body">
                        ${entreprise.user ? `
                            <div class="user-info">
                                <h4>ðÂÂÂÂ¤ Utilisateur propriétaire</h4>
                                <div class="info-grid">
                                    <div class="info-item">
                                        <label>ID:</label>
                                        <div class="value">${entreprise.user.id}</div>
                                    </div>
                                    <div class="info-item">
                                        <label>Email:</label>
                                        <div class="value">${entreprise.user.email || '<span class="empty">Non renseigné</span>'}</div>
                                    </div>
                                    <div class="info-item">
                                        <label>Nom:</label>
                                        <div class="value">${entreprise.user.name || '<span class="empty">Non renseigné</span>'}</div>
                                    </div>
                                </div>
                            </div>
                        ` : ''}
                        
                        <div class="info-section">
                            <h3>ðÂÂÂÂÂÂ Informations générales</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>ID Entreprise:</label>
                                    <div class="value">${entreprise.id}</div>
                                </div>
                                <div class="info-item">
                                    <label>Nom commercial:</label>
                                    <div class="value">${entreprise.nom_commercial || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Secteur d'activité:</label>
                                    <div class="value">${entreprise.secteur_activite || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Année de création:</label>
                                    <div class="value">${entreprise.annee_creation_entreprise || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                            </div>
                            ${entreprise.description_activite ? `
                                <div class="info-item">
                                    <label>Description de l'activité:</label>
                                    <div class="value">${entreprise.description_activite}</div>
                                </div>
                            ` : ''}
                        </div>

                        <div class="info-section">
                            <h3>ðÂÂÂÂÂÂ Informations légales</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Numéro identification fiscale:</label>
                                    <div class="value">${entreprise.numero_identification_fiscale || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Registre du commerce:</label>
                                    <div class="value">${entreprise.numero_registre_commerce || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>SIREN:</label>
                                    <div class="value">${entreprise.numero_siren || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>SIRET:</label>
                                    <div class="value">${entreprise.numero_siret || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>TVA intracommunautaire:</label>
                                    <div class="value">${entreprise.numero_tva_intracommunautaire || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Capital social:</label>
                                    <div class="value">${entreprise.capital_social || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <h3>ðÂÂÂÂÂÂ Adresse</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Adresse du siège:</label>
                                    <div class="value">${entreprise.adresse_siege_social || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Ville:</label>
                                    <div class="value">${entreprise.ville_siege_social || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Code postal:</label>
                                    <div class="value">${entreprise.code_postal_siege_social || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Pays:</label>
                                    <div class="value">${entreprise.pays_siege_social || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <h3>ðÂÂÂÂÂÂ Contact</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Téléphone:</label>
                                    <div class="value">${entreprise.numero_telephone || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Email principal:</label>
                                    <div class="value">${entreprise.email_contact_principal || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Téléphone contact:</label>
                                    <div class="value">${entreprise.telephone_contact_principal || '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                                <div class="info-item">
                                    <label>Site web:</label>
                                    <div class="value">${entreprise.site_web_url ? `<a href="${entreprise.site_web_url}" target="_blank">${entreprise.site_web_url}</a>` : '<span class="empty">Non renseigné</span>'}</div>
                                </div>
                            </div>
                        </div>

                        ${entreprise.fichiers && entreprise.fichiers.length > 0 ? `
                            <div class="fichiers-section">
                                <h3>ðÂÂÂÂÂÂ Documents</h3>
                                ${generateFichiersHTML(entreprise.fichiers)}
                            </div>
                        ` : ''}

                        <button class="toggle-json" onclick="toggleJson()">
                            ðÂÂÂÂÂÂ Afficher/Masquer JSON brut
                        </button>
                        <div class="json-viewer" id="json-viewer" style="display: none;">
                            ${JSON.stringify(entreprise, null, 2)}
                        </div>
                    </div>
                </div>
            `;
            
            container.style.display = 'block';
            container.scrollIntoView({ behavior: 'smooth' });
        }

        function generateFichiersHTML(fichiers) {
            return fichiers.map(fichier => `
                <div class="fichier-item">
                    <div class="fichier-info">
                        <div class="fichier-name">Document ID: ${fichier.id}</div>
                        <div class="fichier-meta">
                            Statut: <span class="status-badge status-${fichier.statut_fichier}">${getStatusText(fichier.statut_fichier)}</span>
                        </div>
                        <div class="fichier-meta">
                            Créé le: ${new Date(fichier.created_at).toLocaleDateString('fr-FR')}
                        </div>
                    </div>
                </div>
                ${generateDocumentLinks(fichier)}
            `).join('');
        }

        function generateDocumentLinks(fichier) {
            const documents = [
                { key: 'url_rccm', label: 'RCCM', expire: fichier.date_expiration_rccm },
                { key: 'url_attestation_fiscale', label: 'Attestation Fiscale', expire: fichier.date_expiration_attestation_fiscale },
                { key: 'url_statuts_societe', label: 'Statuts Société', date: fichier.date_maj_statuts },
                { key: 'url_declaration_regularite', label: 'Déclaration Régularité', date: fichier.date_emission_declaration_regularite },
                { key: 'url_attestation_immatriculation', label: 'Attestation Immatriculation', date: fichier.date_emission_attestation_immatriculation }
            ];

            return documents.map(doc => {
                if (fichier[doc.key]) {
                    return `
                        <div class="fichier-item">
                            <div class="fichier-info">
                                <div class="fichier-name">${doc.label}</div>
                                <div class="fichier-meta">
                                    ${doc.expire ? `Expire en: ${doc.expire}` : ''}
                                    ${doc.date ? `Date: ${doc.date}` : ''}
                                </div>
                            </div>
                            <a href="${fichier[doc.key]}" target="_blank" class="fichier-link">
                                ðÂÂÂÂÂÂ Voir le document
                            </a>
                        </div>
                    `;
                }
                return '';
            }).join('');
        }

        function showError(message, data = null) {
            const container = document.getElementById('response-container');
            container.className = 'response-container';
            
            container.innerHTML = `
                <div class="response-error">
                    <h3>âÂÂÂÂ Erreur</h3>
                    <p>${message}</p>
                    ${data ? `
                        <button class="toggle-json" onclick="toggleJson()">
                            ðÂÂÂÂÂÂ Afficher/Masquer détails
                        </button>
                        <div class="json-viewer" id="json-viewer" style="display: none;">
                            ${JSON.stringify(data, null, 2)}
                        </div>
                    ` : ''}
                </div>
            `;
            
            container.style.display = 'block';
            container.scrollIntoView({ behavior: 'smooth' });
        }

        function toggleJson() {
            const jsonViewer = document.getElementById('json-viewer');
            jsonViewer.style.display = jsonViewer.style.display === 'none' ? 'block' : 'none';
        }

        function getStatusText(status) {
            const statusMap = {
                'en_attente': 'En attente',
                'approuve': 'Approuvé',
                'rejete': 'Rejeté',
                'en_revision': 'En révision'
            };
            return statusMap[status] || status;
        }

        // Gestion du token avec localStorage pour la persistance
        window.addEventListener('load', function() {
            const savedToken = localStorage.getItem('auth_token');
            if (savedToken) {
                document.getElementById('auth-token').value = savedToken;
            }
        });

        document.getElementById('auth-token').addEventListener('input', function() {
            localStorage.setItem('auth_token', this.value);
        });
    </script>
</body>
</html>