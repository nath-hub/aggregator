<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Entreprise</title>
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
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .header {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
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
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
            position: relative;
            z-index: 1;
        }

        .content {
            padding: 40px;
        }

        .loading {
            text-align: center;
            padding: 60px;
            color: #666;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4f46e5;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .entreprise-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border: 1px solid #e5e7eb;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .entreprise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .entreprise-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
        }

        .entreprise-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }

        .entreprise-info h2 {
            font-size: 1.8em;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .entreprise-info p {
            color: #6b7280;
            font-size: 1.1em;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .detail-item {
            background: #f8fafc;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #4f46e5;
            transition: background-color 0.3s ease;
        }

        .detail-item:hover {
            background: #f1f5f9;
        }

        .detail-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            font-size: 0.95em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            color: #1f2937;
            font-size: 1.1em;
            word-break: break-word;
        }

        .fichiers-section {
            background: #f8fafc;
            padding: 25px;
            border-radius: 15px;
            margin-top: 30px;
        }

        .fichiers-section h3 {
            color: #1f2937;
            margin-bottom: 20px;
            font-size: 1.4em;
            display: flex;
            align-items: center;
        }

        .fichiers-section h3::before {
            content: "📁";
            margin-right: 10px;
            font-size: 1.2em;
        }

        .fichier-item {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .fichier-item:hover {
            border-color: #4f46e5;
            transform: translateX(5px);
        }

        .fichier-info {
            display: flex;
            align-items: center;
        }

        .fichier-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 16px;
        }

        .download-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 0.9em;
            transition: all 0.3s ease;
        }

        .download-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .error-message {
            background: #fef2f2;
            color: #dc2626;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #fecaca;
            text-align: center;
            margin: 20px 0;
        }

        .error-icon {
            font-size: 3em;
            margin-bottom: 10px;
        }

        .refresh-btn {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .refresh-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .back-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            background: rgba(255, 255, 255, 0.9);
            color: #4f46e5;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 15px;
            }

            .header h1 {
                font-size: 2em;
            }

            .content {
                padding: 20px;
            }

            .details-grid {
                grid-template-columns: 1fr;
            }

            .entreprise-header {
                flex-direction: column;
                text-align: center;
            }

            .entreprise-icon {
                margin-right: 0;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <button class="back-btn" onclick="history.back()">← Retour</button>

    <div class="container">
        <div class="header">
            <h1>Détails de l'Entreprise</h1>
            <p>Informations complètes de votre entreprise</p>
        </div>

        <div class="content">
            <div id="loading" class="loading">
                <div class="spinner"></div>
                <p>Chargement des informations...</p>
            </div>

            <div id="error" class="error-message" style="display: none;">
                <div class="error-icon">⚠️</div>
                <h3>Erreur de chargement</h3>
                <p id="error-message"></p>
                <button class="refresh-btn" onclick="loadEntreprise()">Réessayer</button>
            </div>

            <div id="entreprise-details" style="display: none;">
                <!-- Le contenu sera injecté ici par JavaScript -->
            </div>
        </div>
    </div>

    <script>
        // Simulation d'un token d'authentification
        const authToken = localStorage.getItem('authToken') || 'dummy-token';

        async function loadEntreprise() {
            const loading = document.getElementById('loading');
            const error = document.getElementById('error');
            const details = document.getElementById('entreprise-details');

            loading.style.display = 'block';
            error.style.display = 'none';
            details.style.display = 'none';

            try {
                // Simulation d'un appel API
                const response = await fetch('/api/entreprise/show-by-token', {
                    method: 'GET',
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                const entreprise = await response.json();
                displayEntreprise(entreprise);
                
            } catch (err) {
                console.error('Erreur:', err);
                showError('Impossible de charger les informations de l\'entreprise. Vérifiez votre connexion.');
            } finally {
                loading.style.display = 'none';
            }
        }

        function displayEntreprise(entreprise) {
            const details = document.getElementById('entreprise-details');
            
            const html = `
                <div class="entreprise-card">
                    <div class="entreprise-header">
                        <div class="entreprise-icon">
                            ${entreprise.nom ? entreprise.nom.charAt(0).toUpperCase() : 'E'}
                        </div>
                        <div class="entreprise-info">
                            <h2>${entreprise.nom || 'Nom non défini'}</h2>
                            <p>ID: ${entreprise.id}</p>
                        </div>
                    </div>

                    <div class="details-grid">
                        <div class="detail-item">
                            <div class="detail-label">Nom de l'entreprise</div>
                            <div class="detail-value">${entreprise.nom || 'Non défini'}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">${entreprise.email || 'Non défini'}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Téléphone</div>
                            <div class="detail-value">${entreprise.telephone || 'Non défini'}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Adresse</div>
                            <div class="detail-value">${entreprise.adresse || 'Non définie'}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Secteur d'activité</div>
                            <div class="detail-value">${entreprise.secteur || 'Non défini'}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Date de création</div>
                            <div class="detail-value">${entreprise.created_at ? new Date(entreprise.created_at).toLocaleDateString('fr-FR') : 'Non définie'}</div>
                        </div>
                    </div>

                    ${entreprise.fichiers && entreprise.fichiers.length > 0 ? `
                        <div class="fichiers-section">
                            <h3>Documents attachés</h3>
                            ${entreprise.fichiers.map(fichier => `
                                <div class="fichier-item">
                                    <div class="fichier-info">
                                        <div class="fichier-icon">📄</div>
                                        <div>
                                            <div style="font-weight: 600;">${fichier.nom || 'Document'}</div>
                                            <div style="color: #6b7280; font-size: 0.9em;">${fichier.type || 'Type inconnu'}</div>
                                        </div>
                                    </div>
                                    <button class="download-btn" onclick="downloadFile('${fichier.id}')">
                                        Télécharger
                                    </button>
                                </div>
                            `).join('')}
                        </div>
                    ` : `
                        <div class="fichiers-section">
                            <h3>Documents attachés</h3>
                            <p style="color: #6b7280; text-align: center; padding: 20px;">
                                Aucun document attaché à cette entreprise.
                            </p>
                        </div>
                    `}
                </div>
            `;

            details.innerHTML = html;
            details.style.display = 'block';
        }

        function showError(message) {
            const error = document.getElementById('error');
            const errorMessage = document.getElementById('error-message');
            
            errorMessage.textContent = message;
            error.style.display = 'block';
        }

        function downloadFile(fileId) {
            // Simulation du téléchargement
            console.log(`Téléchargement du fichier ${fileId}`);
            
            // En réalité, vous feriez un appel API pour télécharger le fichier
            const link = document.createElement('a');
            link.href = `/api/fichiers/${fileId}/download`;
            link.download = '';
            link.click();
        }

        // Simuler des données d'entreprise pour la démonstration
        function simulateEntreprise() {
            const mockData = {
                id: 1,
                nom: "TechCorp Solutions",
                email: "contact@techcorp.com",
                telephone: "+33 1 23 45 67 89",
                adresse: "123 Avenue des Champs-Élysées, Paris, France",
                secteur: "Technologies de l'Information",
                created_at: "2024-01-15T10:30:00Z",
                user_id: 1,
                fichiers: [
                    {
                        id: 1,
                        nom: "Statuts de l'entreprise.pdf",
                        type: "PDF",
                        taille: "2.3 MB"
                    },
                    {
                        id: 2,
                        nom: "Registre du commerce.pdf",
                        type: "PDF",
                        taille: "1.8 MB"
                    }
                ]
            };

            displayEntreprise(mockData);
            document.getElementById('loading').style.display = 'none';
        }

        // Chargement initial
        document.addEventListener('DOMContentLoaded', function() {
            // En mode démo, on simule les données
            setTimeout(simulateEntreprise, 1500); 
            // loadEntreprise();
        });
    </script>
</body>
</html>