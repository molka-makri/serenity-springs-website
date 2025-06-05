<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Commandes</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- html2canvas -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>
<body class="bg-light">

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Statistiques des Commandes</h2>
            <div>
                <!-- Lien modifié ici -->
                <a href="listCommandes.php" class="btn btn-secondary me-2">Retour à la liste</a>
                <button id="downloadPdf" class="btn btn-primary">Télécharger PDF</button>
            </div>
        </div>

        <!-- Affichage du graphique -->
        <canvas id="statsChart" class="my-4"></canvas>
    </div>

    <script>
        // Données statiques simulées
        const stats = [
            { type: 'Fruit', total_quantite: 150, total_prix: 450 },
            { type: 'Légume', total_quantite: 120, total_prix: 300 }
        ];

        // Récupérer les données depuis le tableau PHP (simulé ici comme un tableau JavaScript)
        const labels = stats.map(stat => stat.type);
        const quantities = stats.map(stat => stat.total_quantite);
        const prices = stats.map(stat => stat.total_prix);

        // Configuration du graphique
        const ctx = document.getElementById('statsChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantité totale',
                    data: quantities,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }, {
                    label: 'Prix total',
                    data: prices,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Fonction pour télécharger le graphique en PDF
        document.getElementById('downloadPdf').addEventListener('click', () => {
            html2canvas(document.querySelector("#statsChart")).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const { jsPDF } = window.jspdf;
                const pdf = new jsPDF();
                pdf.addImage(imgData, 'PNG', 10, 10, 180, 90); // Taille ajustée pour PDF plus petit
                pdf.save("statistiques_commandes.pdf"); // Enregistrer sous le nom de fichier
            });
        });
    </script>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
