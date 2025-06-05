<?php
include '../../../Controller/PaymentC.php';
// include '../../model/Payment.php';


$error = "";

// Créer une instance de Payment
$payment = null;

// Créer une instance du contrôleur PaymentC
$paymentC = new PaymentController();

if (
    isset($_POST["idCommande"]) &&
    isset($_POST["datePayment"]) &&
    isset($_POST["montant"]) &&
    isset($_POST["moyenPaiement"]) &&
    isset($_POST["statutPaiement"])
) {
    if (
        !empty($_POST['idCommande']) &&
        !empty($_POST["datePayment"]) &&
        !empty($_POST["montant"]) &&
        !empty($_POST["moyenPaiement"]) &&
        !empty($_POST["statutPaiement"])
    ) {
        // Validation du moyen de paiement (doit être 'Carte Bancaire' ou 'PayPal')
        $validPaymentMethods = ['Carte Bancaire', 'PayPal'];
        if (!in_array($_POST['moyenPaiement'], $validPaymentMethods)) {
            $error = "Le moyen de paiement doit être 'Carte Bancaire' ou 'PayPal'.";
        } else {
            $payment = new Payment(
                null,
                $_POST['idCommande'],
                $_POST['datePayment'],
                $_POST['montant'],
                $_POST['moyenPaiement'],
                isset($_POST['numeroCarte']) ? $_POST['numeroCarte'] : null,
                $_POST['statutPaiement']
            );
            $paymentC->addPayment($payment);
            header('Location:listPayments.php');
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
    <title>Ajouter Paiement</title>
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
                            <h4 class="text-section">Paiement</h4>
                        </li>
                        <li class="nav-item">
                            <a href="index.php">
                                <i class="fas fa-credit-card"></i>
                                <p>Paiements</p>
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
                                    <h4 class="card-title text-center">Ajouter un nouveau paiement</h4>
                                </div>
                                <div class="card-body">
                                    <form action="" method="POST" onsubmit="return validateForm()">
                                        <div class="form-group">
                                            <label for="idCommande">ID Commande</label>
                                            <input type="number" class="form-control" name="idCommande" id="idCommande" />
                                            <div class="form-error" id="errorIdCommande" style="color: red; display: none;">L'ID de la commande est obligatoire.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="datePayment">Date de Paiement</label>
                                            <input type="date" class="form-control" name="datePayment" id="datePayment" />
                                            <div class="form-error" id="errorDatePayment" style="color: red; display: none;">La date de paiement est obligatoire.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="montant">Montant</label>
                                            <input type="number" step="0.01" class="form-control" name="montant" id="montant" />
                                            <div class="form-error" id="errorMontant" style="color: red; display: none;">Le montant est obligatoire et doit être positif.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="moyenPaiement">Moyen de Paiement</label>
                                            <input type="text" class="form-control" name="moyenPaiement" id="moyenPaiement" />
                                            <div class="form-error" id="errorMoyenPaiement" style="color: red; display: none;">Le moyen de paiement doit être 'Carte Bancaire' ou 'PayPal'.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="numeroCarte">Numéro de Carte (si carte bancaire)</label>
                                            <input type="text" class="form-control" name="numeroCarte" id="numeroCarte" />
                                        </div>
                                        <div class="form-group">
                                            <label for="statutPaiement">Statut du Paiement</label>
                                            <input type="text" class="form-control" name="statutPaiement" id="statutPaiement" />
                                            <div class="form-error" id="errorStatutPaiement" style="color: red; display: none;">Le statut du paiement est obligatoire.</div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button type="submit" class="btn btn-success">Ajouter Paiement</button>
                                            <a href="listPayments.php" class="btn btn-outline-success">Annuler</a>
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

           
