<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Entreprise</title>
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
            max-width: 900px;
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

        .form-container {
            padding: 40px;
        }

        .form-section {
            margin-bottom: 40px;
        }

        .section-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #4facfe;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .form-group {
            position: relative;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="url"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e8ed;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #4facfe;
            background: white;
            box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .file-input-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background: #f8fafc;
            border: 2px dashed #e1e8ed;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #666;
        }

        .file-input-label:hover {
            border-color: #4facfe;
            background: #f0f8ff;
        }

        .file-input-label.has-file {
            border-color: #27ae60;
            background: #f0fff4;
            color: #27ae60;
        }

        input[type="file"] {
            position: absolute;
            left: -9999px;
            opacity: 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 15px 40px;
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

        .form-actions {
            text-align: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #e1e8ed;
        }

        .response-container {
            margin-top: 30px;
            padding: 20px;
            border-radius: 10px;
            display: none;
        }

        .response-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .response-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .loading {
            display: none;
            text-align: center;
            margin-top: 20px;
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
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .api-config {
            background: #f8fafc;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .api-config h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .api-url-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: monospace;
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
            <h1>📊 Inscription Entreprise</h1>
            <p>Formulaire de test pour l'endpoint d'entreprise</p>
        </div>

        <div class="form-container">
            <div class="api-config"> 
                <input hidden type="text" id="api-url" class="api-url-input" value="https://aggregator.elyft.tech/api/docs/aggragator.elyft.tech/api/entreprises"
                    placeholder="https://aggregator.elyft.tech/api/docs/aggragator.elyft.tech/api/entreprises">
            </div>

            <form id="entrepriseForm">
                <!-- Informations de base -->
                <div class="form-section">
                    <h2 class="section-title">
                        🏢 Informations de base
                    </h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nom_entreprise" class="required">Nom de l'entreprise</label>
                            <input type="text" id="nom_entreprise" name="nom_entreprise" required>
                        </div>
                        <div class="form-group">
                            <label for="nom_commercial">Nom commercial</label>
                            <input type="text" id="nom_commercial" name="nom_commercial">
                        </div>
                        <div class="form-group">
                            <label for="type_entreprise" class="required">Type d'entreprise</label>
                            <select id="type_entreprise" name="type_entreprise" required>
                                <option value="">Sélectionnez un type</option>
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
                        <div class="form-group full-width">
                            <label for="description_activite">Description de l'activité</label>
                            <textarea id="description_activite" name="description_activite"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Informations légales -->
                <div class="form-section">
                    <h2 class="section-title">
                        📋 Informations légales
                    </h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="numero_identification_fiscale">Numéro d'identification fiscale</label>
                            <input type="text" id="numero_identification_fiscale"
                                name="numero_identification_fiscale">
                        </div>
                        <div class="form-group">
                            <label for="numero_registre_commerce">Numéro du registre du commerce</label>
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
                            <input type="text" id="numero_tva_intracommunautaire"
                                name="numero_tva_intracommunautaire">
                        </div>
                        <div class="form-group">
                            <label for="capital_social">Capital social</label>
                            <input type="text" id="capital_social" name="capital_social">
                        </div>
                        <div class="form-group">
                            <label for="annee_creation_entreprise">Année de création</label>
                            <input type="number" id="annee_creation_entreprise" name="annee_creation_entreprise"
                                min="1900" max="2026">
                        </div>
                    </div>
                </div>

                <!-- Adresse -->
                <div class="form-section">
                    <h2 class="section-title">
                        📍 Adresse du siège social
                    </h2>
                    <div class="form-grid">
                        <div class="form-group full-width">
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
                            <label for="pays_siege_social" class="required">Pays</label>
                            <select id="pays_siege_social" name="pays_siege_social" required>
                                <option value="">Sélectionnez un pays</option>
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
                </div>

                <!-- Contact -->
                <div class="form-section">
                    <h2 class="section-title">
                        📞 Informations de contact
                    </h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="numero_telephone">Numéro de téléphone</label>
                            <input type="text" id="numero_telephone" name="numero_telephone">
                        </div>
                        <div class="form-group">
                            <label for="email_contact_principal">Email principal</label>
                            <input type="email" id="email_contact_principal" name="email_contact_principal">
                        </div>
                        <div class="form-group">
                            <label for="telephone_contact_principal">Téléphone contact principal</label>
                            <input type="text" id="telephone_contact_principal"
                                name="telephone_contact_principal">
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
                </div>

                <!-- Documents -->
                <div class="form-section">
                    <h2 class="section-title">
                        📄 Documents
                    </h2>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="rccm_file">Document RCCM</label>
                            <div class="file-input-wrapper">
                                <label for="rccm_file" class="file-input-label">
                                    <span>📄 Choisir un fichier</span>
                                    <span class="file-name">Aucun fichier sélectionné</span>
                                </label>
                                <input type="file" id="rccm_file" name="rccm_file" accept=".pdf,.jpg,.png">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_expiration_rccm">Date d'expiration RCCM</label>
                            <input type="number" id="date_expiration_rccm" name="date_expiration_rccm"
                                min="1900" max="2026">
                        </div>

                        <div class="form-group">
                            <label for="attestation_fiscale_file">Attestation fiscale</label>
                            <div class="file-input-wrapper">
                                <label for="attestation_fiscale_file" class="file-input-label">
                                    <span>📄 Choisir un fichier</span>
                                    <span class="file-name">Aucun fichier sélectionné</span>
                                </label>
                                <input type="file" id="attestation_fiscale_file" name="attestation_fiscale_file"
                                    accept=".pdf,.jpg,.png">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_expiration_attestation_fiscale">Date d'expiration attestation
                                fiscale</label>
                            <input type="number" id="date_expiration_attestation_fiscale"
                                name="date_expiration_attestation_fiscale" min="1900" max="2026">
                        </div>

                        <div class="form-group">
                            <label for="statuts_societe_file">Statuts de la société</label>
                            <div class="file-input-wrapper">
                                <label for="statuts_societe_file" class="file-input-label">
                                    <span>📄 Choisir un fichier</span>
                                    <span class="file-name">Aucun fichier sélectionné</span>
                                </label>
                                <input type="file" id="statuts_societe_file" name="statuts_societe_file"
                                    accept=".pdf">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_maj_statuts">Date de mise à jour des statuts</label>
                            <input type="number" id="date_maj_statuts" name="date_maj_statuts" min="1900"
                                max="2026">
                        </div>

                        <div class="form-group">
                            <label for="declaration_regularite_file">Déclaration de régularité</label>
                            <div class="file-input-wrapper">
                                <label for="declaration_regularite_file" class="file-input-label">
                                    <span>📄 Choisir un fichier</span>
                                    <span class="file-name">Aucun fichier sélectionné</span>
                                </label>
                                <input type="file" id="declaration_regularite_file"
                                    name="declaration_regularite_file" accept=".pdf">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_emission_declaration_regularite">Date d'émission déclaration
                                régularité</label>
                            <input type="number" id="date_emission_declaration_regularite"
                                name="date_emission_declaration_regularite" min="1900" max="2026">
                        </div>

                        <div class="form-group">
                            <label for="attestation_immatriculation_file">Attestation d'immatriculation</label>
                            <div class="file-input-wrapper">
                                <label for="attestation_immatriculation_file" class="file-input-label">
                                    <span>📄 Choisir un fichier</span>
                                    <span class="file-name">Aucun fichier sélectionné</span>
                                </label>
                                <input type="file" id="attestation_immatriculation_file"
                                    name="attestation_immatriculation_file" accept=".pdf,.jpg,.png">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_emission_attestation_immatriculation">Date d'émission attestation
                                immatriculation</label>
                            <input type="number" id="date_emission_attestation_immatriculation"
                                name="date_emission_attestation_immatriculation" min="1900" max="2026">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        🚀 Créer l'entreprise
                    </button>
                    <div class="loading">Traitement en cours...</div>
                </div>
            </form>

            <div class="response-container" id="response-container"></div>
        </div>
    </div>

    <script>
        // Gestion des fichiers
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const label = this.parentElement.querySelector('.file-input-label');
                const fileName = label.querySelector('.file-name');

                if (this.files.length > 0) {
                    fileName.textContent = this.files[0].name;
                    label.classList.add('has-file');
                } else {
                    fileName.textContent = 'Aucun fichier sélectionné';
                    label.classList.remove('has-file');
                }
            });
        });

        // Soumission du formulaire
        document.getElementById('entrepriseForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const submitButton = this.querySelector('button[type="submit"]');
            const loading = document.querySelector('.loading');
            const responseContainer = document.getElementById('response-container');

            // Afficher le loading
            submitButton.disabled = true;
            loading.style.display = 'block';
            responseContainer.style.display = 'none';

            try {
                const formData = new FormData(this);
                const apiUrl = document.getElementById('api-url').value;
                let authToken = localStorage.getItem('auth_token');

                const response = await fetch(apiUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + authToken,
                        // Note: N'ajoutez pas Content-Type pour FormData, le navigateur le fait automatiquement
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    showResponse('success', 'Succès!', `
                        <p><strong>Message:</strong> ${data.message}</p>
                        <p><strong>Code:</strong> ${data.code}</p>
                        <p><strong>ID Entreprise:</strong> ${data.entreprise.id}</p>
                        <p><strong>Statut:</strong> ${data.status}</p>
                    `);
                    this.reset();
                    // Réinitialiser les labels de fichiers
                    document.querySelectorAll('.file-input-label').forEach(label => {
                        label.classList.remove('has-file');
                        label.querySelector('.file-name').textContent = 'Aucun fichier sélectionné';
                    });
                } else {
                    let errorMessage = '<p><strong>Erreurs de validation:</strong></p><ul>';
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            errorMessage +=
                                `<li><strong>${field}:</strong> ${data.errors[field].join(', ')}</li>`;
                        });
                    } else {
                        errorMessage += `<li>${data.message || 'Erreur inconnue'}</li>`;
                    }
                    errorMessage += '</ul>';
                    showResponse('error', 'Erreur!', errorMessage);
                }
            } catch (error) {
                showResponse('error', 'Erreur de connexion!', `
                    <p>Impossible de contacter le serveur.</p>
                    <p><strong>Erreur:</strong> ${error.message}</p>
                    <p>Vérifiez que votre API est accessible à l'URL: <code>${document.getElementById('api-url').value}</code></p>
                `);
            } finally {
                // Masquer le loading
                submitButton.disabled = false;
                loading.style.display = 'none';
            }
        });

        function showResponse(type, title, content) {
            const responseContainer = document.getElementById('response-container');
            responseContainer.className = `response-container response-${type}`;
            responseContainer.innerHTML = `
                <h3>${title}</h3>
                ${content}
            `;
            responseContainer.style.display = 'block';
            responseContainer.scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
</body>

</html>
