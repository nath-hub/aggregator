<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Entreprises</title>
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
            max-width: 1400px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        .header {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
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

        .actions-bar {
            background: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border: 2px solid #e5e7eb;
            border-radius: 25px;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .search-box input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 1.2em;
        }

        .add-btn {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .add-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        }

        .entreprises-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .entreprise-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .entreprise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .entreprise-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }

        .entreprise-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .entreprise-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .entreprise-info h3 {
            color: #1f2937;
            margin-bottom: 5px;
            font-size: 1.3em;
        }

        .entreprise-info p {
            color: #6b7280;
            font-size: 0.9em;
        }

        .entreprise-details {
            margin-bottom: 20px;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 5px 0;
            border-bottom: 1px solid #f3f4f6;
        }

        .detail-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.9em;
        }

        .detail-value {
            color: #1f2937;
            font-size: 0.9em;
            text-align: right;
            max-width: 150px;
            word-break: break-word;
        }

        .entreprise-actions {
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9em;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-view {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }

        .btn-edit {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
        }

        .btn-delete {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
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

        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #6b7280;
        }

        .empty-icon {
            font-size: 4em;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #374151;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
            animation: modalSlideIn 0.3s ease-out;
        }

        @keyframes modalSlideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: white;
            font-size: 24px;
        }

        .modal-title {
            font-size: 1.5em;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .modal-subtitle {
            color: #6b7280;
            font-size: 0.9em;
        }

        .modal-body {
            margin-bottom: 30px;
            line-height: 1.6;
            color: #374151;
        }

        .modal-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .modal-btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            transition: all 0.3s ease;
        }

        .modal-btn-cancel {
            background: #f3f4f6;
            color: #374151;
        }

        .modal-btn-confirm {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            color: white;
        }

        .modal-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .close:hover {
            color: #000;
        }

        .success-message {
            background: #f0fdf4;
            color: #166534;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #bbf7d0;
            display: none;
        }

        .error-message {
            background: #fef2f2;
            color: #dc2626;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #fecaca;
            display: none;
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

            .actions-bar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                min-width: auto;
            }

            .entreprises-grid {
                grid-template-columns: 1fr;
            }

            .entreprise-actions {
                flex-direction: column;
                gap: 8px;
            }

            .modal-content {
                margin: 20% auto;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Gestion des Entreprises</h1>
            <p>Administrez vos entreprises et leurs documents</p>
        </div>

        <div class="content">
            <div class="success-message" id="successMessage">
                <strong>Succès!</strong> <span id="successText"></span>
            </div>

            <div class="error-message" id="errorMessage">
                <strong>Erreur!</strong> <span id="errorText"></span>
            </div>

            <div class="actions-bar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Rechercher une entreprise...">
                    <span class="search-icon">🔍</span>
                </div>
                <button class="add-btn" onclick="addEntreprise()">
                    <span>+</span>
                    Ajouter une entreprise
                </button>
            </div>

            <div id="loading" class="loading">
                <div class="spinner"></div>
                <p>Chargement des entreprises...</p>
            </div>

            <div id="emptyState" class="empty-state" style="display: none;">
                <div class="empty-icon">🏢</div>
                <h3>Aucune entreprise trouvée</h3>
                <p>Commencez par ajouter votre première entreprise</p>
            </div>

            <div id="entreprisesGrid" class="entreprises-grid">
                <!-- Les entreprises seront injectées ici -->
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDeleteModal()">&times;</span>
            <div class="modal-header">
                <div class="modal-icon">⚠️</div>
                <div>
                    <div class="modal-title">Confirmer la suppression</div>
                    <div class="modal-subtitle">Cette action est irréversible</div>
                </div>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer l'entreprise <strong id="entrepriseToDelete"></strong> ?</p>
                <p style="margin-top: 10px; color: #dc2626;">
                    <strong>Attention :</strong> Tous les documents associés seront également supprimés définitivement.
                </p>
            </div>
            <div class="modal-actions">
                <button class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Annuler</button>
                <button class="modal-btn modal-btn-confirm" onclick="confirmDelete()">Supprimer</button>
            </div>
        </div>
    </div>

    <script>
        let entreprises = [];
        let currentDeleteId = null;

        // Chargement des entreprises
        async function loadEntreprises() {
            const loading = document.getElementById('loading');
            const grid = document.getElementById('entreprisesGrid');
            const emptyState = document.getElementById('emptyState');

            loading.style.display = 'block';
            grid.style.display = 'none';
            emptyState.style.display = 'none';

            try {
                // Simulation d'un appel API
                const response = await fetch('/api/entreprises', {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + (localStorage.getItem('authToken') || 'dummy-token'),
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                const data = await response.json();
                entreprises = data;
                displayEntreprises(entreprises);

            } catch (error) {
                console.error('Erreur:', error);
                // Simulation avec des données mock
                setTimeout(loadMockData, 1000);
            }
        }

        // Données de simulation
        function loadMockData() {
            entreprises = [
                {
                    id: 1,
                    nom: "TechCorp Solutions",
                    email: "contact@techcorp.com",
                    telephone: "+33 1 23 45 67 89",
                    adresse: "123 Avenue des Champs-Élysées, Paris",
                    secteur: "IT",
                    created_at: "2024-01-15T10:30:00Z",
                    fichiers: [
                        { id: 1, nom: "Statuts.pdf" },
                        { id: 2, nom: "Registre.pdf" }
                    ]
                },
                {
                    id: 2,
                    nom: "Green Energy Co",
                    email: "info@greenenergy.com",
                    telephone: "+33 1 98 76 54 32",
                    adresse: "456 Rue de la Paix, Lyon",
                    secteur: "Énergie",
                    created_at: "2024-02-20T14:15:00Z",
                    fichiers: [
                        { id: 3, nom: "Contrat.pdf" }
                    ]
                },
                {
                    id: 3,
                    nom: "Food Delights",
                    email: "contact@fooddelights.fr",
                    telephone: "+33 1 11 22 33 44",
                    adresse: "789 Boulevard Saint-Germain, Paris",
                    secteur: "Restauration",
                    created_at: "2024-03-10T09:00:00Z",
                    fichiers: []
                }
            ];
            displayEntreprises(entreprises);
        }

        // Affichage des entreprises
        function displayEntreprises(entreprisesList) {
            const loading = document.getElementById('loading');
            const grid = document.getElementById('entreprisesGrid');
            const emptyState = document.getElementById('emptyState');

            loading.style.display = 'none';

            if (entreprisesList.length === 0) {
                emptyState.style.display = 'block';
                grid.style.display = 'none';
                return;
            }

            grid.style.display = 'grid';
            emptyState.style.display = 'none';

            grid.innerHTML = entreprisesList.map(entreprise => `
                <div class="entreprise-card">
                    <div class="entreprise-header">
                        <div class="entreprise-icon">
                            ${entreprise.nom ? entreprise.nom.charAt(0).toUpperCase() : 'E'}
                        </div>
                        <div class="entreprise-info">
                            <h3>${entreprise.nom || 'Nom non défini'}</h3>
                            <p>ID: ${entreprise.id}</p>
                        </div>
                    </div>

                    <div class="entreprise-details">
                        <div class="detail-row">
                            <span class="detail-label">Email:</span>
                            <span class="detail-value">${entreprise.email || 'Non défini'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Téléphone:</span>
                            <span class="detail-value">${entreprise.telephone || 'Non défini'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Secteur:</span>
                            <span class="detail-value">${entreprise.secteur || 'Non défini'}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Documents:</span>
                            <span class="detail-value">${entreprise.fichiers ? entreprise.fichiers.length : 0} fichier(s)</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Créée le:</span>
                            <span class="detail-value">${entreprise.created_at ? new Date(entreprise.created_at).toLocaleDateString('fr-FR') : 'Non définie'}</span>
                        </div>
                    </div>

                    <div class="entreprise-actions">
                        <button class="btn btn-view" onclick="viewEntreprise(${entreprise.id})">
                            👁️ Voir
                        </button>
                        <button class="btn btn-edit" onclick="editEntreprise(${entreprise.id})">
                            ✏️ Modifier
                        </button>
                        <button class="btn btn-delete" onclick="deleteEntreprise(${entreprise.id}, '${entreprise.nom}')">
                            🗑️ Supprimer
                        </button>
                    </div>
                </div>
            `).join('');
        }

        // Recherche
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const filteredEntreprises = entreprises.filter(entreprise => 
                (entreprise.nom && entreprise.nom.toLowerCase().includes(searchTerm)) ||
                (entreprise.email && entreprise.email.toLowerCase().includes(searchTerm)) ||
                (entreprise.secteur && entreprise.secteur.toLowerCase().includes(searchTerm))
            );
            displayEntreprises(filteredEntreprises);
        });

        // Actions
        function viewEntreprise(id) {
            window.location.href = {{ url(`/entreprise/${id}`) }}; //`/entreprise/${id}`;
        }

        function editEntreprise(id) {
            window.location.href = `/entreprise/${id}/edit`;
        }

        function addEntreprise() {
            window.location.href = {{ url(`/entreprise/create`) }};
        }

        function deleteEntreprise(id, nom) {
            currentDeleteId = id;
            document.getElementById('entrepriseToDelete').textContent = nom;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            currentDeleteId = null;
        }

        async function confirmDelete() {
            if (!currentDeleteId) return;

            try {
                const response = await fetch(`/api/entreprises/${currentDeleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': 'Bearer ' + (localStorage.getItem('authToken') || 'dummy-token'),
                        'Content-Type': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                const result = await response.json();
                
                // Simulation de la suppression
                entreprises = entreprises.filter(e => e.id !== currentDeleteId);
                displayEntreprises(entreprises);
                
                showSuccessMessage('Entreprise supprimée avec succès');
                closeDeleteModal();

            } catch (error) {
                console.error('Erreur lors de la suppression:', error);
                
                // Simulation de la suppression en cas d'erreur API
                entreprises = entreprises.filter(e => e.id !== currentDeleteId);
                displayEntreprises(entreprises);
                
                showSuccessMessage('Entreprise supprimée avec succès (mode démo)');
                closeDeleteModal();
            }
        }

        function showSuccessMessage(message) {
            const successMsg = document.getElementById('successMessage');
            const successText = document.getElementById('successText');
            
            successText.textContent = message;
            successMsg.style.display = 'block';
            
            setTimeout(() => {
                successMsg.style.display = 'none';
            }, 5000);
        }

        function showErrorMessage(message) {
            const errorMsg = document.getElementById('errorMessage');
            const errorText = document.getElementById('errorText');
            
            errorText.textContent = message;
            errorMsg.style.display = 'block';
            
            setTimeout(() => {
                errorMsg.style.display = 'none';
            }, 5000);
        }

        // Fermer le modal en cliquant à l'extérieur
        window.onclick = function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeDeleteModal();
            }
        }

        // Chargement initial
        document.addEventListener('DOMContentLoaded', function() {
            loadEntreprises();
        });
    </script>
</body>
</html>