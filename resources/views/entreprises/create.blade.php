<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Entreprises - Interface de Test</title>
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
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }

        .nav-tabs {
            display: flex;
            background: #f8f9fa;
            border-bottom: 3px solid #667eea;
        }

        .nav-tab {
            flex: 1;
            padding: 15px 20px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            color: #555;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-tab:hover {
            background: #e9ecef;
            color: #667eea;
        }

        .nav-tab.active {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .nav-tab.active::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            right: 0;
            height: 3px;
            background: #764ba2;
        }

        .tab-content {
            display: none;
            padding: 30px;
            animation: fadeIn 0.5s ease-in-out;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95em;
        }

        .required::after {
            content: ' *';
            color: #e74c3c;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        textarea {
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
            display: flex;
            align-items: center;
            padding: 12px 15px;
            background: #f8f9fa;
            border: 2px dashed #667eea;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            justify-content: center;
        }

        .file-input-label:hover {
            background: #e9ecef;
            border-color: #764ba2;
        }

        .file-input-label::before {
            content: '📁';
            margin-right: 10px;
            font-size: 1.2em;
        }

        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #27ae60;
            color: white;
        }

        .btn-success:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .search-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            gap: 15px;
            align-items: end;
        }

        .search-form .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .entreprise-card {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .entreprise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .entreprise-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
        }

        .entreprise-title {
            font-size: 1.5em;
            font-weight: 700;
            color: #333;
        }

        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
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

        .entreprise-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .detail-item {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
        }

        .detail-label {
            font-weight: 600;
            color: #667eea;
            font-size: 0.9em;
        }

        .detail-value {
            margin-top: 5px;
            color: #333;
        }

        .file-links {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }

        .file-link {
            background: #667eea;
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9em;
            transition: all 0.3s ease;
        }

        .file-link:hover {
            background: #764ba2;
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 500;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-info {
            background: #cce7ff;
            color: #004085;
            border: 1px solid #b8daff;
        }

        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #667eea;
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

        .section-title {
            font-size: 1.8em;
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
            text-align: center;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 2px;
        }

        .form-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .form-section-title {
            font-size: 1.3em;
            font-weight: 600;
            color: #667eea;
            margin-bottom: 20px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }

            .nav-tabs {
                flex-direction: column;
            }

            .search-form {
                flex-direction: column;
            }

            .button-group {
                flex-direction: column;
            }

            .entreprise-details {
                grid-template-columns: 1fr;
            }
        }

        .api-endpoint {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
        }

        .method-post {
            color: #e74c3c;
        }

        .method-get {
            color: #27ae60;
        }

        .method-put {
            color: #f39c12;
        }

        .method-delete {
            color: #e74c3c;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>🏢 Gestion des Entreprises</h1>
            <p>Interface de test pour les fonctions Laravel</p>
        </div>

        <div class="nav-tabs">
            <button class="nav-tab active" onclick="showTab('create')">Créer une Entreprise</button>
            <button class="nav-tab" onclick="showTab('view')">Consulter</button>
            <button class="nav-tab" onclick="showTab('update')">Modifier</button>
            <button class="nav-tab" onclick="showTab('delete')">Supprimer</button>
            <button class="nav-tab" onclick="showTab('api')">API Documentation</button>
        </div>

        <!-- Onglet Créer -->
        <div id="create" class="tab-content active">
            <h2 class="section-title">Créer une Nouvelle Entreprise</h2>

            <form id="createForm">
                <div class="form-section">
                    <h3 class="form-section-title">Informations Générales</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required">Nom de l'entreprise</label>
                            <input type="text" name="nom_entreprise" required>
                        </div>
                        <div class="form-group">
                            <label>Nom commercial</label>
                            <input type="text" name="nom_commercial">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="required">Type d'entreprise</label>
                            <select name="type_entreprise" required>
                                <option value="">Sélectionner un type</option>
                                <option value="SARL">SARL</option>
                                <option value="SA">SA</option>
                                <option value="EURL">EURL</option>
                                <option value="Auto-entrepreneur">Auto-entrepreneur</option>
                                <option value="Association">Association</option>
                                <option value="Individuel">Individuel</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Secteur d'activité</label>
                            <input type="text" name="secteur_activite" maxlength="100">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description de l'activité</label>
                        <textarea name="description_activite" rows="3"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Année de création</label>
                            <input type="number" name="annee_creation_entreprise" min="1900" max="2026">
                        </div>
                        <div class="form-group">
                            <label>Capital social</label>
                            <input type="text" name="capital_social">
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Numéros d'Identification</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Numéro d'identification fiscale</label>
                            <input type="text" name="numero_identification_fiscale">
                        </div>
                        <div class="form-group">
                            <label>Numéro de registre de commerce</label>
                            <input type="text" name="numero_registre_commerce">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Numéro SIREN</label>
                            <input type="text" name="numero_siren">
                        </div>
                        <div class="form-group">
                            <label>Numéro SIRET</label>
                            <input type="text" name="numero_siret">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Numéro TVA intracommunautaire</label>
                        <input type="text" name="numero_tva_intracommunautaire">
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Adresse du Siège Social</h3>

                    <div class="form-group">
                        <label>Adresse</label>
                        <input type="text" name="adresse_siege_social" maxlength="255">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Ville</label>
                            <input type="text" name="ville_siege_social" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label>Code postal</label>
                            <input type="text" name="code_postal_siege_social" maxlength="20">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="required">Pays</label>
                        <select name="pays_siege_social" required>
                            <option value="">Sélectionner un pays</option>
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

                <div class="form-section">
                    <h3 class="form-section-title">Contact</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email de contact principal</label>
                            <input type="email" name="email_contact_principal">
                        </div>
                        <div class="form-group">
                            <label>Téléphone</label>
                            <input type="tel" name="numero_telephone">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Téléphone contact principal</label>
                            <input type="tel" name="telephone_contact_principal" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label>Site web</label>
                            <input type="url" name="site_web_url">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>URL du logo</label>
                        <input type="url" name="logo_url">
                    </div>
                </div>

                <div class="form-section">
                    <h3 class="form-section-title">Documents</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label>RCCM</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="rccm_file" accept=".pdf,.jpg,.png">
                                <div class="file-input-label">Choisir un fichier RCCM</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date d'expiration RCCM</label>
                            <input type="number" name="date_expiration_rccm" min="1900" max="2030">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Attestation fiscale</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="attestation_fiscale_file" accept=".pdf,.jpg,.png">
                                <div class="file-input-label">Choisir l'attestation fiscale</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date d'expiration attestation fiscale</label>
                            <input type="number" name="date_expiration_attestation_fiscale" min="1900"
                                max="2030">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Statuts de la société</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="statuts_societe_file" accept=".pdf">
                                <div class="file-input-label">Choisir les statuts</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date de mise à jour des statuts</label>
                            <input type="number" name="date_maj_statuts" min="1900" max="2030">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Déclaration de régularité</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="declaration_regularite_file" accept=".pdf">
                                <div class="file-input-label">Choisir la déclaration</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date d'émission déclaration</label>
                            <input type="number" name="date_emission_declaration_regularite" min="1900"
                                max="2030">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Attestation d'immatriculation</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="attestation_immatriculation_file"
                                    accept=".pdf,.jpg,.png">
                                <div class="file-input-label">Choisir l'attestation</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date d'émission attestation</label>
                            <input type="number" name="date_emission_attestation_immatriculation" min="1900"
                                max="2030">
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        <span class="loading" id="createLoading" style="display: none;"></span>
                        Créer l'entreprise
                    </button>
                    <button type="reset" class="btn btn-secondary">Réinitialiser</button>
                </div>
            </form>

            <div id="createResult"></div>
        </div>

        <!-- Onglet Consulter -->
        <div id="view" class="tab-content">
            <h2 class="section-title">Consulter les Entreprises</h2>

            <div class="search-section">
                <div class="search-form">
                    <div class="form-group">
                        <label>Rechercher par ID</label>
                        <input type="number" id="searchId" placeholder="ID de l'entreprise">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" onclick="searchEntreprise()">
                            <span class="loading" id="searchLoading" style="display: none;"></span>
                            Rechercher
                        </button>
                    </div>
                </div>

                <div style="margin-top: 15px;">
                    <button class="btn btn-success" onclick="getMyEntreprise()">
                        <span class="loading" id="myEntrepriseLoading" style="display: none;"></span>
                        Voir mon entreprise
                    </button>
                </div>
            </div>

            <div id="viewResult"></div>
        </div>

        <!-- Onglet Modifier -->
        <div id="update" class="tab-content">
            <h2 class="section-title">Modifier une Entreprise</h2>

            <div class="search-section">
                <div class="search-form">
                    <div class="form-group">
                        <label>ID de l'entreprise à modifier</label>
                        <input type="number" id="updateId" placeholder="ID de l'entreprise">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" onclick="loadEntrepriseForUpdate()">
                            <span class="loading" id="loadUpdateLoading" style="display: none;"></span>
                            Charger
                        </button>
                    </div>
                </div>
            </div>

            <div id="updateFormContainer" style="display: none;">
                <form id="updateForm">
                    <input type="hidden" id="updateEntrepriseId">

                    <div class="form-section">
                        <h3 class="form-section-title">Informations Générales</h3>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Nom de l'entreprise</label>
                                <input type="text" name="nom_entreprise" id="update_nom_entreprise">
                            </div>
                            <div class="form-group">
                                <label>Nom commercial</label>
                                <input type="text" name="nom_commercial" id="update_nom_commercial">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Type d'entreprise</label>
                                <select name="type_entreprise" id="update_type_entreprise">
                                    <option value="">Sélectionner un type</option>
                                    <option value="SARL">SARL</option>
                                    <option value="SA">SA</option>
                                    <option value="EURL">EURL</option>
                                    <option value="Auto-entrepreneur">Auto-entrepreneur</option>
                                    <option value="Association">Association</option>
                                    <option value="Individuel">Individuel</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Secteur d'activité</label>
                                <input type="text" name="secteur_activite" id="update_secteur_activite">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Description de l'activité</label>
                            <textarea name="description_activite" id="update_description_activite" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn btn-primary">
                            <span class="loading" id="updateLoading" style="display: none;"></span>
                            Modifier l'entreprise
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="cancelUpdate()">Annuler</button>
                    </div>
                </form>
            </div>

            <div id="updateResult"></div>
        </div>

        <!-- Onglet Supprimer -->
        <div id="delete" class="tab-content">
            <h2 class="section-title">Supprimer une Entreprise</h2>

            <div class="alert alert-danger">
                <strong>⚠️ Attention !</strong> La suppression d'une entreprise est irréversible. Tous les fichiers
                associés seront également supprimés.
            </div>

            <div class="search-section">
                <div class="search-form">
                    <div class="form-group">
                        <label>ID de l'entreprise à supprimer</label>
                        <input type="number" id="deleteId" placeholder="ID de l'entreprise">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" onclick="deleteEntreprise()">
                            <span class="loading" id="deleteLoading" style="display: none;"></span>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>

            <div id="deleteResult"></div>
        </div>

        <!-- Onglet API Documentation -->
        <div id="api" class="tab-content">
            <h2 class="section-title">Documentation API</h2>

            <div class="form-section">
                <h3 class="form-section-title">Endpoints disponibles</h3>

                <div class="api-endpoint">
                    <div class="method-post">POST</div> /api/entreprises
                    <div>Créer une nouvelle entreprise</div>
                </div>

                <div class="api-endpoint">
                    <div class="method-get">GET</div> /api/entreprises/{id}
                    <div>Récupérer une entreprise par ID</div>
                </div>

                <div class="api-endpoint">
                    <div class="method-get">GET</div> /api/entreprises/my
                    <div>Récupérer l'entreprise de l'utilisateur connecté</div>
                </div>

                <div class="api-endpoint">
                    <div class="method-put">PUT</div> /api/entreprises/{id}
                    <div>Modifier une entreprise</div>
                </div>

                <div class="api-endpoint">
                    <div class="method-delete">DELETE</div> /api/entreprises/{id}
                    <div>Supprimer une entreprise</div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section-title">Configuration requise</h3>
                <div class="alert alert-info">
                    <strong>Note:</strong> Cette interface nécessite que votre API Laravel soit configurée avec les
                    routes appropriées et l'authentification.
                </div>

                <div class="form-group">
                    <label>URL de base de l'API</label>
                    <input type="url" id="apiBaseUrl" value="http://127.0.0.1:8000/api"
                        placeholder="http://127.0.0.1:8000/api">
                </div>

                <div class="form-group">
                    <label>Token d'authentification</label>
                    <input type="text" id="authToken" placeholder="Bearer token...">
                </div>

                <div class="button-group">
                    <button class="btn btn-primary" onclick="saveApiConfig()">Sauvegarder la configuration</button>
                    <button class="btn btn-secondary" onclick="testApiConnection()">Tester la connexion</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Configuration API
        let apiConfig = {
            baseUrl: 'http://127.0.0.1:8000/api',
            token: ''
        };

        // Gestion des onglets
        function showTab(tabName) {
            // Masquer tous les contenus
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => content.classList.remove('active'));

            // Masquer tous les boutons actifs
            const tabButtons = document.querySelectorAll('.nav-tab');
            tabButtons.forEach(button => button.classList.remove('active'));

            // Afficher le contenu sélectionné
            document.getElementById(tabName).classList.add('active');

            // Activer le bouton correspondant
            event.target.classList.add('active');
        }

        // Gestion des inputs de fichier
        document.addEventListener('DOMContentLoaded', function() {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const label = this.nextElementSibling;
                    if (this.files.length > 0) {
                        label.textContent = this.files[0].name;
                        label.style.color = '#667eea';
                    } else {
                        label.textContent = label.getAttribute('data-original-text') ||
                            'Choisir un fichier';
                        label.style.color = '';
                    }
                });
            });
        });

        // Fonctions utilitaires
        function showLoading(elementId) {
            document.getElementById(elementId).style.display = 'inline-block';
        }

        function hideLoading(elementId) {
            document.getElementById(elementId).style.display = 'none';
        }

        function showResult(containerId, type, message) {
            const container = document.getElementById(containerId);
            container.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
            container.scrollIntoView({
                behavior: 'smooth'
            });
        }

        function getApiHeaders(authRequired = true, type = 'application/json') {
            const headers = {
                'Accept': 'application/json', 
                'X-Requested-With': 'XMLHttpRequest'
            };

            if (authRequired) {
                headers['Authorization'] = document.getElementById('authToken').value;
            }

            if (type === 'application/json') {
                headers['Content-Type'] = 'application/json';
            } else {
                headers['Content-type'] = type;
            }

            return headers;
        }

        // Créer une entreprise
        document.getElementById('createForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            showLoading('createLoading');

            const formData = new FormData(this);

            console.log('Form data:', Object.fromEntries(formData.entries()));

            try {
                const response = await fetch(`${apiConfig.baseUrl}/entreprises`, {
                    method: 'POST',
                    headers: getApiHeaders(authRequired = true, type = 'multipart/form-data'),
                    body: Object.fromEntries(formData.entries())
                });

                console.log(getApiHeaders(authRequired = true, type = 'multipart/form-data'));  

                const data = await response.json();

                if (response.ok) {
                    showResult('createResult', 'success',
                        `✅ Entreprise créée avec succès !<br>
                        <strong>ID:</strong> ${data.entreprise.id}<br>
                        <strong>Nom:</strong> ${data.entreprise.nom_entreprise}`
                    );
                    this.reset();
                } else {
                    showResult('createResult', 'danger',
                        `❌ Erreur lors de la création: ${data.message || 'Erreur inconnue'}`
                    );
                }
            } catch (error) {
                showResult('createResult', 'danger',
                    `❌ Erreur de connexion: ${error.message}`
                );
            } finally {
                hideLoading('createLoading');
            }
        });

        // Rechercher une entreprise
        async function searchEntreprise() {
            const id = document.getElementById('searchId').value;
            if (!id) {
                showResult('viewResult', 'danger', '❌ Veuillez saisir un ID d\'entreprise');
                return;
            }

            showLoading('searchLoading');

            try {
                const response = await fetch(`${apiConfig.baseUrl}/entreprises/${id}`, {
                    headers: getApiHeaders()
                });

                const data = await response.json();

                if (response.ok) {
                    displayEntreprise(data.entreprise, 'viewResult');
                } else {
                    showResult('viewResult', 'danger',
                        `❌ ${data.message || 'Entreprise non trouvée'}`
                    );
                }
            } catch (error) {
                showResult('viewResult', 'danger',
                    `❌ Erreur de connexion: ${error.message}`
                );
            } finally {
                hideLoading('searchLoading');
            }
        }

        // Récupérer mon entreprise
        async function getMyEntreprise() {
            showLoading('myEntrepriseLoading');

            try {
                const response = await fetch(`${apiConfig.baseUrl}/entreprises/my`, {
                    headers: getApiHeaders()
                });

                const data = await response.json();

                if (response.ok) {
                    displayEntreprise(data, 'viewResult');
                } else {
                    showResult('viewResult', 'danger',
                        `❌ ${data.message || 'Aucune entreprise trouvée'}`
                    );
                }
            } catch (error) {
                showResult('viewResult', 'danger',
                    `❌ Erreur de connexion: ${error.message}`
                );
            } finally {
                hideLoading('myEntrepriseLoading');
            }
        }

        // Afficher une entreprise
        function displayEntreprise(entreprise, containerId) {
            const statusClass = `status-${entreprise.statut_kyb || 'en_attente'}`;
            const statusText = entreprise.statut_kyb || 'en_attente';

            let filesHtml = '';
            if (entreprise.fichiers) {
                const fichiers = entreprise.fichiers;
                const fileLinks = [];

                if (fichiers.url_rccm) fileLinks.push(
                    `<a href="${fichiers.url_rccm}" target="_blank" class="file-link">RCCM</a>`);
                if (fichiers.url_attestation_fiscale) fileLinks.push(
                    `<a href="${fichiers.url_attestation_fiscale}" target="_blank" class="file-link">Attestation fiscale</a>`
                    );
                if (fichiers.url_statuts_societe) fileLinks.push(
                    `<a href="${fichiers.url_statuts_societe}" target="_blank" class="file-link">Statuts</a>`);
                if (fichiers.url_declaration_regularite) fileLinks.push(
                    `<a href="${fichiers.url_declaration_regularite}" target="_blank" class="file-link">Déclaration</a>`
                    );
                if (fichiers.url_attestation_immatriculation) fileLinks.push(
                    `<a href="${fichiers.url_attestation_immatriculation}" target="_blank" class="file-link">Immatriculation</a>`
                    );

                if (fileLinks.length > 0) {
                    filesHtml = `<div class="file-links">${fileLinks.join('')}</div>`;
                }
            }

            const html = `
                <div class="entreprise-card">
                    <div class="entreprise-header">
                        <h3 class="entreprise-title">${entreprise.nom_entreprise}</h3>
                        <div class="status-badge ${statusClass}">${statusText}</div>
                    </div>
                    
                    <div class="entreprise-details">
                        <div class="detail-item">
                            <div class="detail-label">ID</div>
                            <div class="detail-value">${entreprise.id}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Nom commercial</div>
                            <div class="detail-value">${entreprise.nom_commercial || 'Non renseigné'}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Type</div>
                            <div class="detail-value">${entreprise.type_entreprise}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Secteur</div>
                            <div class="detail-value">${entreprise.secteur_activite || 'Non renseigné'}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">${entreprise.email_contact_principal || 'Non renseigné'}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Téléphone</div>
                            <div class="detail-value">${entreprise.numero_telephone || 'Non renseigné'}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Pays</div>
                            <div class="detail-value">${entreprise.pays_siege_social || 'Non renseigné'}</div>
                        </div>
                        
                        <div class="detail-item">
                            <div class="detail-label">Année création</div>
                            <div class="detail-value">${entreprise.annee_creation_entreprise || 'Non renseigné'}</div>
                        </div>
                    </div>
                    
                    ${entreprise.description_activite ? `
                            <div class="detail-item" style="margin-top: 15px;">
                                <div class="detail-label">Description</div>
                                <div class="detail-value">${entreprise.description_activite}</div>
                            </div>
                        ` : ''}
                    
                    ${filesHtml}
                </div>
            `;

            document.getElementById(containerId).innerHTML = html;
        }

        // Charger entreprise pour modification
        async function loadEntrepriseForUpdate() {
            const id = document.getElementById('updateId').value;
            if (!id) {
                showResult('updateResult', 'danger', '❌ Veuillez saisir un ID d\'entreprise');
                return;
            }

            showLoading('loadUpdateLoading');

            try {
                const response = await fetch(`${apiConfig.baseUrl}/entreprises/${id}`, {
                    headers: getApiHeaders()
                });

                const data = await response.json();

                if (response.ok) {
                    populateUpdateForm(data.entreprise);
                    document.getElementById('updateFormContainer').style.display = 'block';
                    showResult('updateResult', 'info', '✅ Entreprise chargée avec succès');
                } else {
                    showResult('updateResult', 'danger',
                        `❌ ${data.message || 'Entreprise non trouvée'}`
                    );
                }
            } catch (error) {
                showResult('updateResult', 'danger',
                    `❌ Erreur de connexion: ${error.message}`
                );
            } finally {
                hideLoading('loadUpdateLoading');
            }
        }

        // Remplir le formulaire de modification
        function populateUpdateForm(entreprise) {
            document.getElementById('updateEntrepriseId').value = entreprise.id;
            document.getElementById('update_nom_entreprise').value = entreprise.nom_entreprise || '';
            document.getElementById('update_nom_commercial').value = entreprise.nom_commercial || '';
            document.getElementById('update_type_entreprise').value = entreprise.type_entreprise || '';
            document.getElementById('update_secteur_activite').value = entreprise.secteur_activite || '';
            document.getElementById('update_description_activite').value = entreprise.description_activite || '';
        }

        // Modifier une entreprise
        document.getElementById('updateForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('updateEntrepriseId').value;
            showLoading('updateLoading');

            const formData = new FormData(this);
            formData.append('_method', 'PUT');

            try {
                const response = await fetch(`${apiConfig.baseUrl}/entreprises/${id}`, {
                    method: 'POST',
                    headers: getApiHeaders(),
                    body: formData
                });

                const data = await response.json();

                if (response.ok) {
                    showResult('updateResult', 'success',
                        `✅ Entreprise modifiée avec succès !<br>
                        <strong>Nom:</strong> ${data.entreprise.nom_entreprise}`
                    );
                } else {
                    showResult('updateResult', 'danger',
                        `❌ Erreur lors de la modification: ${data.message || 'Erreur inconnue'}`
                    );
                }
            } catch (error) {
                showResult('updateResult', 'danger',
                    `❌ Erreur de connexion: ${error.message}`
                );
            } finally {
                hideLoading('updateLoading');
            }
        });

        // Annuler la modification
        function cancelUpdate() {
            document.getElementById('updateFormContainer').style.display = 'none';
            document.getElementById('updateId').value = '';
            document.getElementById('updateResult').innerHTML = '';
        }

        // Supprimer une entreprise
        async function deleteEntreprise() {
            const id = document.getElementById('deleteId').value;
            if (!id) {
                showResult('deleteResult', 'danger', '❌ Veuillez saisir un ID d\'entreprise');
                return;
            }

            if (!confirm('Êtes-vous sûr de vouloir supprimer cette entreprise ? Cette action est irréversible.')) {
                return;
            }

            showLoading('deleteLoading');

            try {
                const response = await fetch(`${apiConfig.baseUrl}/entreprises/${id}`, {
                    method: 'DELETE',
                    headers: getApiHeaders()
                });

                const data = await response.json();

                if (response.ok) {
                    showResult('deleteResult', 'success',
                        `✅ Entreprise supprimée avec succès !`
                    );
                    document.getElementById('deleteId').value = '';
                } else {
                    showResult('deleteResult', 'danger',
                        `❌ ${data.message || 'Erreur lors de la suppression'}`
                    );
                }
            } catch (error) {
                showResult('deleteResult', 'danger',
                    `❌ Erreur de connexion: ${error.message}`
                );
            } finally {
                hideLoading('deleteLoading');
            }
        }

        // Sauvegarder la configuration API
        function saveApiConfig() {
            apiConfig.baseUrl = document.getElementById('apiBaseUrl').value;
            apiConfig.token = document.getElementById('authToken').value;

            localStorage.setItem('apiConfig', JSON.stringify(apiConfig));
            showResult('api', 'success', '✅ Configuration sauvegardée avec succès');
        }

        // Tester la connexion API
        async function testApiConnection() {
            try {
                console.log(document.getElementById('apiBaseUrl').value);
                base = document.getElementById('apiBaseUrl').value;
                console.log(base);
                console.log(document.getElementById('authToken').value);
                const response = await fetch(base, {
                    headers: getApiHeaders(authRequired = true)
                });

                console.log(getApiHeaders());

                if (response.ok) {
                    showResult('api', 'success', '✅ Connexion API réussie');
                } else {
                    showResult('api', 'danger', '❌ Erreur de connexion API');
                }
            } catch (error) {
                showResult('api', 'danger', `❌ Erreur de connexion: ${error.message}`);
            }
        }

        // Charger la configuration sauvegardée
        document.addEventListener('DOMContentLoaded', function() {
            const savedConfig = localStorage.getItem('apiConfig');
            if (savedConfig) {
                apiConfig = JSON.parse(savedConfig);
                document.getElementById('apiBaseUrl').value = apiConfig.baseUrl;
                document.getElementById('authToken').value = apiConfig.token;
            }
        });
    </script>
</body>

</html>
