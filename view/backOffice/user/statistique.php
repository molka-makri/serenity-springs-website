<?php
include_once '../../../Controller/userC.php';
$userController = new userC();
$users = $userController->listUsers();

// Calcul des statistiques
$totalUsers = count($users);
$totalAdmins = 0;
$totalFarmers = 0;
$totalGeneralUsers = 0;

foreach ($users as $user) {
    switch ($user['role']) {
        case 1:
            $totalAdmins++;
            break;
        case 2:
            $totalFarmers++;
            break;
        default:
            $totalGeneralUsers++;
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des utilisateurs</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <style>
        .stats-container {
            width: 80%;
            margin: 50px auto;
            text-align: center;
        }
        .stats-card {
            display: inline-block;
            width: 250px;
            padding: 20px;
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .stats-card h3 {
            font-size: 36px;
            color: #4CAF50;
        }
        .stats-card p {
            font-size: 18px;
            color: #555;
        }
        #userChart {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
        }
    </style>
</head>
<body>



    
    <div class="stats-container">
        <h1>Statistiques des utilisateurs</h1>

        <div class="stats-card">
            <h3><?php echo $totalUsers; ?></h3>
            <p>Total Utilisateurs</p>
        </div>

        <div class="stats-card">
            <h3><?php echo $totalAdmins; ?></h3>
            <p>Total Administrateurs</p>
        </div>

        <div class="stats-card">
            <h3><?php echo $totalFarmers; ?></h3>
            <p>Total Agriculteurs</p>
        </div>

        <div class="stats-card">
            <h3><?php echo $totalGeneralUsers; ?></h3>
            <p>Total Utilisateurs Généraux</p>
        </div>

        <div id="userChart">
            <canvas id="userStatsChart"></canvas>
        </div>
    </div>

    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/plugin/bootstrap/js/bootstrap.min.js"></script>
    
    <script>
        // Données pour le graphique
        var ctx = document.getElementById('userStatsChart').getContext('2d');
        var userStatsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Administrateurs', 'Agriculteurs', 'Utilisateurs Généraux'],
                datasets: [{
                    label: 'Nombre d\'utilisateurs',
                    data: [<?php echo $totalAdmins; ?>, <?php echo $totalFarmers; ?>, <?php echo $totalGeneralUsers; ?>],
                    backgroundColor: ['#ff5733', '#33cc33', '#33b5ff'],
                    borderColor: ['#ff5733', '#33cc33', '#33b5ff'],
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









    </script>
</body>
</html>