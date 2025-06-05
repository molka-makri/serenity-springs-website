<?php
include_once '../../../Controller/CommandeC.php';

// Créer une instance du contrôleur
$commandeC = new CommandeC();

// Récupérer la liste des commandes en tant que tableau
$listeCommandes = $commandeC->listCommandes()->fetchAll(PDO::FETCH_ASSOC); // Assurez-vous d'utiliser fetchAll pour obtenir un tableau

// Filtrer les commandes selon les critères de recherche
$searchId = isset($_POST['searchId']) ? trim($_POST['searchId']) : '';
$searchType = isset($_POST['searchType']) ? trim($_POST['searchType']) : '';
$filteredCommandes = array_filter($listeCommandes, function ($commande) use ($searchId, $searchType) {
    $matchesId = empty($searchId) || (int)$commande['idCommande'] == (int)$searchId;
    $matchesType = empty($searchType) || strtolower($commande['type']) == strtolower($searchType);
    return $matchesId && $matchesType;
});

// Récupérer le nombre de nouvelles commandes (exemple simple, toutes les commandes récentes sont considérées comme nouvelles)
$newOrders = count(array_filter($listeCommandes, function($commande) {
    // Supposons que la commande est nouvelle si elle a été ajoutée dans les dernières 24 heures
    return strtotime($commande['dateCommande']) > strtotime('-24 hours');
}));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Serenity Springs - BackOffice</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
          urls: ["assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <style>
      .table {
        width: 100%;
        margin: 20px auto;
        border-collapse: collapse;
      }
      .table th, .table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
      }
      .table th {
        background-color: #4CAF50;
        color: white;
        font-weight: bold;
      }
      .actions a {
        margin: 0 5px;
        color: #007BFF;
        text-decoration: none;
      }
      .actions a:hover {
        text-decoration: underline;
      }
      .main-title {
        text-align: center;
        font-weight: bold;
        font-size: 24px;
        margin: 20px 0;
      }
      .btn-add {
        display: block;
        width: 200px;
        margin: 0 auto 20px;
        text-align: center;
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
      }
      .btn-add:hover {
        background-color: #45a049;
      }
      .notification-icon {
        font-size: 24px;
        color: #007BFF;
        cursor: pointer;
        position: relative;
        display: inline-block;
      }
      .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: red;
        color: white;
        border-radius: 50%;
        padding: 5px;
        font-size: 12px;
      }
      .notification-dropdown {
        display: none;
        position: absolute;
        top: 35px;
        right: 0;
        width: 300px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 10px;
      }
      .notification-dropdown h5 {
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: bold;
      }
      .notification-dropdown a {
        padding: 10px;
        display: block;
        color: #007BFF;
        text-decoration: none;
      }
      .notification-dropdown a:hover {
        background-color: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <div class="sidebar" data-background-color="green">
        <div class="sidebar-logo">
          <div class="logo-header" data-background-color="green">
            <a href="index.html" class="logo">
              <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
              <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
          </div>
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item active">
                <a href="dashboard.php">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-section">
                <h4 class="text-section">commande</h4>
              </li>
              <li class="nav-item">
                <a href="listCommandes.php">
                  <i class="fas fa-layer-group"></i>
                  <p>commande</p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->

      <!-- Navbar -->
      <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
          <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-user dropdown hidden-caret">
              <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                <div class="avatar-sm">
                  <img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                </div>
                <span class="profile-username">Admin</span>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <a href="statistiques_commandes.php" class="btn btn-primary" style="background-color: #6f42c1; border-color: #6f42c1;">
            Voir les statistiques
            <a href="calendarCommandes.php" class="btn btn-primary">Voir le calendrier des commandes</a>

            

        </a>
      </nav>
      <!-- End Navbar -->

      <!-- Main Content -->
      <div class="main-panel">
        <div class="content">
          <h1 class="main-title">Liste des commandes</h1>

          <!-- Notification Icon sous le bouton Voir les statistiques -->
          <div class="d-flex justify-content-center mt-4">
            <div class="notification-icon" onclick="toggleNotificationDropdown()">
              <i class="fas fa-bell"></i>
              <?php if ($newOrders > 0): ?>
                <div class="notification-badge"><?= $newOrders ?></div>
              <?php endif; ?>
            </div>
          </div>
          <div id="notificationDropdown" class="notification-dropdown">
            <h5>Nouvelles commandes</h5>
            <?php if ($newOrders > 0): ?>
              <?php foreach ($filteredCommandes as $commande): ?>
                <?php if (strtotime($commande['dateCommande']) > strtotime('-24 hours')): ?>
                  <a href="updateCommande.php?idCommande=<?= $commande['idCommande'] ?>">Commande #<?= $commande['idCommande'] ?> - <?= $commande['type'] ?> - <?= $commande['quantite'] ?> kg</a>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php else: ?>
              <p>Aucune nouvelle commande</p>
            <?php endif; ?>
          </div>

          <!-- Recherche formulée centrée sous le titre -->
          <form method="POST" action="" class="mb-4 w-50 mx-auto">
            <div class="row mb-2">
              <div class="col-auto">
                <input type="number" name="searchId" class="form-control form-control-sm" placeholder="ID commande" value="<?= htmlspecialchars($searchId) ?>">
              </div>
              <div class="col-auto">
                <select name="searchType" class="form-select form-select-sm">
                  <option value="">Tous les types</option>
                  <option value="Légume" <?= $searchType === 'Légume' ? 'selected' : '' ?>>Légume</option>
                  <option value="Fruit" <?= $searchType === 'Fruit' ? 'selected' : '' ?>>Fruit</option>
                </select>
              </div>
              <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
              </div>
            </div>
          </form>

          <a href="addCommande.php" class="btn-add">Ajouter une nouvelle commande</a>

          <table class="table">
            <thead>
              <tr>
                <th>ID commande</th>
                <th>Type</th>
                <th>Prix</th>
                <th>Date commande</th>
                <th>Quantité</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($filteredCommandes)) : ?>
                <?php foreach ($filteredCommandes as $commande) : ?>
                  <tr>
                    <td><?= htmlspecialchars($commande['idCommande']) ?></td>
                    <td><?= htmlspecialchars($commande['type']) ?></td>
                    <td><?= htmlspecialchars($commande['prix']) ?> TND</td>
                    <td><?= htmlspecialchars($commande['dateCommande']) ?></td>
                    <td><?= htmlspecialchars($commande['quantite']) ?> kg</td>

                    <td class="actions">
                      <a href="updateCommande.php?idCommande=<?= $commande['idCommande'] ?>">Modifier</a>
                      <a href="deleteCommande.php?idCommande=<?= $commande['idCommande'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');">Supprimer</a>
                      

                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else : ?>
                <tr><td colspan="6">Aucune commande trouvée.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/plugin/bootstrap/js/bootstrap.min.js"></script>

    <script>
      // Fonction pour basculer l'affichage du menu déroulant de notifications
      function toggleNotificationDropdown() {
        var dropdown = document.getElementById('notificationDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
      }
    </script>
  </body>
</html>
