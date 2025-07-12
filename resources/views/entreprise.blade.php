<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test API - Création d'Entreprise</title>
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
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
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

        .form-container {
            padding: 40px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }

        .form-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e6ed;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .form-section h3 {
            color: #4facfe;
            margin-bottom: 20px;
            font-size: 1.3rem;
            border-bottom: 2px solid #4facfe;
            padding-bottom: 10px;
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

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e0e6ed;
            border-radius: 10px;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: #fafbfc;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4facfe;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
            background: white;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: block;
            padding: 12px 16px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #6c757d;
        }

        .file-input-label:hover {
            background: #e9ecef;
            border-color: #4facfe;
            color: #4facfe;
        }

        .file-input-label.has-file {
            background: #d1ecf1;
            border-color: #4facfe;
            color: #0c5460;
        }

        .api-config {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .api-config h3 {
            color: #495057;
            margin-bottom: 15px;
        }

        .api-config input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            margin: 0 auto;
            min-width: 200px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .response-container {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            display: none;
        }

        .response-container.show {
            display: block;
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .response-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .response-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .required {
            color: #dc3545;
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .header h1 {
                font-size: 2rem;
            }
            
            .form-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏢 Test API Entreprise</h1>
            <p>Formulaire de test pour l'endpoint de création d'entreprise</p>
        </div>

        <div class="form-container">
            <div class="api-config">
                <h3>Configuration API</h3>
                <input type="text" id="apiUrl" placeholder="URL de l'API (ex: https://your-api.com/api/entreprises)" value="http://localhost:8000/api/entreprises">
                <input type="text" id="apiToken" placeholder="Token d'authentification (optionnel)">
            </div>

            <form id="entrepriseForm">
                <div class="form-grid">
                    <!-- Informations de base -->
                    <div class="form-section">
                        <h3>📋 Informations de base</h3>
                        <div class="form-group">
                            <label for="nom_entreprise">Nom de l'entreprise <span class="required">*</span></label>
                            <input type="text" id="nom_entreprise" name="nom_entreprise" required>
                        </div>
                        <div class="form-group">
                            <label for="nom_commercial">Nom commercial</label>
                            <input type="text" id="nom_commercial" name="nom_commercial">
                        </div>
                        <div class="form-group">
                            <label for="type_entreprise">Type d'entreprise <span class="required">*</span></label>
                            <select id="type_entreprise" name="type_entreprise" required>
                                <option value="">Sélectionner...</option>
                                <option value="SARL">SARL</option>
                                <option value="SA">SA</option>
                                <option value="EURL">EURL</option>
                                <option value="Auto-entrepreneur">Auto-entrepreneur</option>
                                <option value="Association">Association</option>
                                <option value="Individuel">Individuel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="secteur_activite">Secteur d'activité</label>
                            <input type="text" id="secteur_activite" name="secteur_activite">
                        </div>
                        <div class="form-group">
                            <label for="description_activite">Description de l'activité</label>
                            <textarea id="description_activite" name="description_activite"></textarea>
                        </div>
                    </div>

                    <!-- Informations légales -->
                    <div class="form-section">
                        <h3>⚖️ Informations légales</h3>
                        <div class="form-group">
                            <label for="numero_identification_fiscale">Numéro d'identification fiscale</label>
                            <input type="text" id="numero_identification_fiscale" name="numero_identification_fiscale">
                        </div>
                        <div class="form-group">
                            <label for="numero_registre_commerce">Numéro de registre de commerce</label>
                            <input type="text" id="numero_registre_commerce" name="numero_registre_commerce">
                        </div>
                        <div class="form-group">
                            <label for="numero_siren">Numéro SIREN</label>
                            <input type="text" id="numero_siren" name="numero_siren">
                        </div>
                        <div class="form-group">
                            <label for="numero_siret">Numéro SIRET</label>
                            <input type="text" id="numero_siret" name="numero_siret">
                        </div>
                        <div class="form-group">
                            <label for="numero_tva_intracommunautaire">Numéro TVA intracommunautaire</label>
                            <input type="text" id="numero_tva_intracommunautaire" name="numero_tva_intracommunautaire">
                        </div>
                        <div class="form-group">
                            <label for="capital_social">Capital social</label>
                            <input type="text" id="capital_social" name="capital_social">
                        </div>
                        <div class="form-group">
                            <label for="annee_creation_entreprise">Année de création</label>
                            <input type="number" id="annee_creation_entreprise" name="annee_creation_entreprise" min="1900" max="2026">
                        </div>
                    </div>

                    <!-- Adresse -->
                    <div class="form-section">
                        <h3>📍 Adresse du siège social</h3>
                        <div class="form-group">
                            <label for="adresse_siege_social">Adresse</label>
                            <input type="text" id="adresse_siege_social" name="adresse_siege_social">
                        </div>
                        <div class="form-group">
                            <label for="ville_siege_social">Ville</label>
                            <input type="text" id="ville_siege_social" name="ville_siege_social">
                        </div>
                        <div class="form-group">
                            <label for="code_postal_siege_social">Code postal</label>
                            <input type="text" id="code_postal_siege_social" name="code_postal_siege_social">
                        </div>
                        <div class="form-group">
                            <label for="pays_siege_social">Pays <span class="required">*</span></label>
                            <select id="pays_siege_social" name="pays_siege_social" required>
                                <option value="">Sélectionner...</option>
                                <option value="Bénin">Bénin</option>
                                <option value="Cameroun">Cameroun</option>
                                <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                <option value="Guinée-Bissau">Guinée-Bissau</option>
                                <option value="Guinée-Conakry">Guinée-Conakry</option>
                                <option value="Mali">Mali</option>
                                <option value="Niger">Niger</option>
                                <option value="République Centrafricaine">République Centrafricaine</option>
                                <option value="Congo-Brazzaville">Congo-Brazzaville</option>
                                <option value="Sénégal">Sénégal</option>
                                <option value="Tchad">Tchad</option>
                                <option value="Togo">Togo</option>
                                <option value="Ouganda">Ouganda</option>
                                <option value="Afrique du Sud">Afrique du Sud</option>
                                <option value="Botswana">Botswana</option>
                                <option value="MoneyGhana">MoneyGhana</option>
                                <option value="Rwanda">Rwanda</option>
                                <option value="Soudan">Soudan</option>
                                <option value="Zambie">Zambie</option>
                                <option value="MoneyBénin">MoneyBénin</option>
                            </select>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="form-section">
                        <h3>📞 Informations de contact</h3>
                        <div class="form-group">
                            <label for="numero_telephone">Numéro de téléphone</label>
                            <input type="text" id="numero_telephone" name="numero_telephone">
                        </div>
                        <div class="form-group">
                            <label for="email_contact_principal">Email de contact principal</label>
                            <input type="email" id="email_contact_principal" name="email_contact_principal">
                        </div>
                        <div class="form-group">
                            <label for="telephone_contact_principal">Téléphone de contact principal</label>
                            <input type="text" id="telephone_contact_principal" name="telephone_contact_principal">
                        </div>
                        <div class="form-group">
                            <label for="site_web_url">Site web</label>
                            <input type="url" id="site_web_url" name="site_web_url">
                        </div>
                        <div class="form-group">
                            <label for="logo_url">URL du logo</label>
                            <input type="url" id="logo_url" name="logo_url">
                        </div>
                    </div>

                    <!-- Statut KYB -->
                    <div class="form-section">
                        <h3>✅ Statut KYB</h3>
                        <div class="form-group">
                            <label for="statut_kyb">Statut KYB</label>
                            <select id="statut_kyb" name="statut_kyb">
                                <option value="en_attente">En attente</option>
                                <option value="approuve">Approuvé</option>
                                <option value="rejete">Rejeté</option>
                                <option value="en_revision">En révision</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="motif_statut">Motif du statut</label>
                            <textarea id="motif_statut" name="motif_statut"></textarea>
                        </div>
                    </div>

                    <!-- Documents -->
                    <div class="form-section">
                        <h3>📄 Documents</h3>
                        <div class="form-group">
                            <label for="rccm_file">Fichier RCCM (PDF, JPG, PNG - Max 10MB)</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="rccm_file" name="rccm_file" accept=".pdf,.jpg,.png">
                                <label for="rccm_file" class="file-input-label">Choisir un fichier</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_expiration_rccm">Date d'expiration RCCM</label>
                            <input type="number" id="date_expiration_rccm" name="date_expiration_rccm" min="1900" max="2026">
                        </div>
                        
                        <div class="form-group">
                            <label for="attestation_fiscale_file">Attestation fiscale (PDF, JPG, PNG - Max 10MB)</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="attestation_fiscale_file" name="attestation_fiscale_file" accept=".pdf,.jpg,.png">
                                <label for="attestation_fiscale_file" class="file-input-label">Choisir un fichier</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_expiration_attestation_fiscale">Date d'expiration attestation fiscale</label>
                            <input type="number" id="date_expiration_attestation_fiscale" name="date_expiration_attestation_fiscale" min="1900" max="2026">
                        </div>
                        
                        <div class="form-group">
                            <label for="statuts_societe_file">Statuts de la société (PDF - Max 10MB)</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="statuts_societe_file" name="statuts_societe_file" accept=".pdf">
                                <label for="statuts_societe_file" class="file-input-label">Choisir un fichier</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_maj_statuts">Date de mise à jour des statuts</label>
                            <input type="number" id="date_maj_statuts" name="date_maj_statuts" min="1900" max="2026">
                        </div>
                        
                        <div class="form-group">
                            <label for="declaration_regularite_file">Déclaration de régularité (PDF - Max 10MB)</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="declaration_regularite_file" name="declaration_regularite_file" accept=".pdf">
                                <label for="declaration_regularite_file" class="file-input-label">Choisir un fichier</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_emission_declaration_regularite">Date d'émission déclaration de régularité</label>
                            <input type="number" id="date_emission_declaration_regularite" name="date_emission_declaration_regularite" min="1900" max="2026">
                        </div>
                        
                        <div class="form-group">
                            <label for="attestation_immatriculation_file">Attestation d'immatriculation (PDF, JPG, PNG - Max 10MB)</label>
                            <div class="file-input-wrapper">
                                <input type="file" id="attestation_immatriculation_file" name="attestation_immatriculation_file" accept=".pdf,.jpg,.png">
                                <label for="attestation_immatriculation_file" class="file-input-label">Choisir un fichier</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_emission_attestation_immatriculation">Date d'émission attestation d'immatriculation</label>
                            <input type="number" id="date_emission_attestation_immatriculation" name="date_emission_attestation_immatriculation" min="1900" max="2026">
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <span id="btn-text">🚀 Créer l'entreprise</span>
                    <span id="loading-text" style="display: none;">⏳ Création en cours...</span>
                </button>
            </form>

            <div id="response" class="response-container">
                <h3>Réponse de l'API</h3>
                <pre id="response-content"></pre>
            </div>
        </div>
    </div>

    <script>
        // Gestion des fichiers
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const label = this.nextElementSibling;
                if (this.files && this.files.length > 0) {
                    label.textContent = `Fichier sélectionné: ${this.files[0].name}`;
                    label.classList.add('has-file');
                } else {
                    label.textContent = 'Choisir un fichier';
                    label.classList.remove('has-file');
                }
            });
        });

        // Soumission du formulaire
        document.getElementById('entrepriseForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            const apiUrl = document.getElementById('apiUrl').value;
            const apiToken = document.getElementById('apiToken').value;
            
            const submitBtn = document.querySelector('.submit-btn');
            const btnText = document.getElementById('btn-text');
            const loadingText = document.getElementById('loading-text');
            const responseDiv = document.getElementById('response');
            const responseContent = document.getElementById('response-content');
            
            // État de chargement
            submitBtn.classList.add('loading');
            btnText.style.display = 'none';
            loadingText.style.display = 'inline';
            responseDiv.style.display = 'none';
            
            try {
                const headers = {
                    'Accept': 'application/json',
                };
                
                if (apiToken) {
                    headers['Authorization'] = `Bearer ${apiToken}`;
                }
                
                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: headers,
                    body: formData
                });
                
                const data = await response.json();
                
                // Affichage de la réponse
                responseContent.textContent = JSON.stringify(data, null, 2);
                responseDiv.className = 'response-container show';
                
                if (response.ok) {
                    responseDiv.classList.add('response-success');
                    responseDiv.classList.remove('response-error');
                } else {
                    responseDiv.classList.add('response-error');
                    responseDiv.classList.remove('response-success');
                }
                
            } catch (error) {
                responseContent.textContent = JSON.stringify({
                    error: 'Erreur de connexion',
                    message: error.message
                }, null, 2);
                responseDiv.className = 'response-container show response-error';
            } finally {
                // Restaurer l'état du bouton
                submitBtn.classList.remove('loading');
                btnText.style.display = 'inline';
                loadingText.style.display = 'none';
                
                // Scroll vers la réponse
                responseDiv.scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script>
</body>
</html>