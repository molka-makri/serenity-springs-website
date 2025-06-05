<?php
include 'C:/xampp/htdocs/projetagriculture/Controller/CommandeC.php';
include 'C:/xampp/htdocs/projetagriculture/model/Commande.php';

$error = "";

// Créer une instance de Commande
$commande = null;

// Créer une instance du contrôleur
$commandeC = new CommandeC();

if (
    isset($_POST["type"]) &&
    isset($_POST["prix"]) &&
    isset($_POST["dateCommande"]) &&
    isset($_POST["quantite"])
) {
    if (
        !empty($_POST['type']) &&
        !empty($_POST["prix"]) &&
        !empty($_POST["dateCommande"]) &&
        !empty($_POST["quantite"])
    ) {
        // Validation du type (doit être soit 'Légume' soit 'Fruit')
        $validTypes = ['Légume', 'Fruit'];
        if (!in_array($_POST['type'], $validTypes)) {
            $error = "Le type de produit doit être 'Légume' ou 'Fruit'.";
        } else {
            $commande = new Commande(
                null,
                $_POST['type'],
                $_POST['prix'],
                $_POST['dateCommande'],
                $_POST['quantite']
            );
            $commandeC->addCommande($commande);
            header('Location:listCommandes.php');
            exit();
        }
    } else {
        $error = "Toutes les informations doivent être renseignées.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Ajouter Commande</title>
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
                            <h4 class="text-section">Commande</h4>
                        </li>
                        <li class="nav-item">
                            <a href="index.php">
                                <i class="fas fa-layer-group"></i>
                                <p>Commandes</p>
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
        </nav>
        <!-- End Navbar -->

        <!-- Main Content -->
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title text-center">Ajouter une nouvelle commande</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" onsubmit="return validateForm()">
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <input type="text" class="form-control" name="type" id="type" />
                                            <div class="form-error" id="errorType" style="color: red; display: none;">Le type doit être 'Légume' ou 'Fruit'.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="prix">Prix</label>
                                            <input type="number" step="0.01" class="form-control" name="prix" id="prix" />
                                            <div class="form-error" id="errorPrix" style="color: red; display: none;">Le prix est obligatoire et doit être positif.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="dateCommande">Date Commande</label>
                                            <input type="date" class="form-control" name="dateCommande" id="dateCommande"  />
                                            <div class="form-error" id="errorDate" style="color: red; display: none;">La date de commande est obligatoire.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantite">Quantité</label>
                                            <input type="number" class="form-control" name="quantite" id="quantite" />
                                            <div class="form-error" id="errorQuantite" style="color: red; display: none;">La quantité est obligatoire et doit être positive.</div>
                                        </div>
                                        <div class="form-group text-center">
                                            <!-- Bouton Ajouter en vert -->
                                            <button type="submit" class="btn btn-success">Ajouter Commande</button>
                                            
                                            <!-- Bouton Annuler en vert clair -->
                                            <a href="listCommandes.php" class="btn btn-outline-success">Annuler</a>
                                        </div>
                                    </form>

                                    <!-- Affichage d'erreurs côté serveur -->
                                    <?php if (!empty($error)) : ?>
                                        <div class="alert alert-danger mt-3">
                                            <?= $error ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Main Content -->
    </div>

    <script>
        function validateForm() {
            let isValid = true;

            document.querySelectorAll('.form-error').forEach(el => el.style.display = 'none');

            const type = document.getElementById('type').value.trim();
            if (!type || !['Légume', 'Fruit'].includes(type)) {
                document.getElementById('errorType').style.display = 'block';
                isValid = false;
            }

            const prix = document.getElementById('prix').value;
            if (!prix || prix <= 0) {
                document.getElementById('errorPrix').style.display = 'block';
                isValid = false;
            }

            const dateCommande = document.getElementById('dateCommande').value;
            if (!dateCommande) {
                document.getElementById('errorDate').style.display = 'block';
                isValid = false;
            }

            const quantite = document.getElementById('quantite').value;
            if (!quantite || quantite <= 0) {
                document.getElementById('errorQuantite').style.display = 'block';
                isValid = false;
            }

            return isValid;
        }
    </script>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/plugin/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
