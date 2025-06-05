<?php
include 'C:/xampp/htdocs/projetagriculture/Controller/CommandeC.php';
include 'C:/xampp/htdocs/projetagriculture/model/Commande.php';

$error = "";

// Initialiser le contrôleur
$commandeC = new CommandeC();

// Récupérer l'ID de la commande à éditer
if (isset($_GET['idCommande'])) {
    $idCommande = $_GET['idCommande'];
    $commande = $commandeC->showCommande($idCommande);
} else {
    header('Location: listCommandes.php'); // Rediriger si aucun ID n'est fourni
    exit;
}

// Gérer la mise à jour de la commande
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
        $commande = new Commande(
            null,
            $_POST['type'],
            $_POST['prix'],
            $_POST['dateCommande'],
            $_POST['quantite']
        );

        $commandeC->updateCommande($commande, $_POST['idCommande']);

        header('Location: listCommandes.php'); // Rediriger après la mise à jour
        exit;
    } else {
        $error = "Veuillez remplir tous les champs.";
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
     <style>
        .form-error {
            color: #ff4d4d;
            font-size: 14px;
            display: none;
        }

        .btn-submit {
            background-color: #28a745; /* Green color */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #218838; /* Darker green */
        }

        .main-panel {
            margin-left: 250px; /* Adjust to sidebar width */
        }

        .container-form {
            max-width: 800px;
            margin: 50px auto;
        }

        .form-container {
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #28a745;
        }

        .form-container input {
            margin-bottom: 15px;
        }

        .form-group label {
            color: #28a745; /* Green color for labels */
        }
</style>

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
                <h1 class="text-center text-success">Modifier la Commande</h1>

                <!-- Display error message -->
                <div id="error" class="alert alert-danger" style="display:<?php echo $error ? 'block' : 'none'; ?>"><?php echo $error; ?></div>

                <?php if ($commande) { ?>
                    <div class="container-form">
                        <form id="commandeForm" action="" method="POST" onsubmit="return validateForm()">
                            <div class="form-container">
                                <h2>Formulaire de Mise à Jour</h2>

                                <div class="form-group">
                                    <label for="idCommande">ID Commande :</label>
                                    <input type="text" id="idCommande" name="idCommande" class="form-control" value="<?php echo $commande['idCommande']; ?>" readonly />
                                </div>

                                <div class="form-group">
                                    <label for="type">Type :</label>
                                    <input type="text" id="type" name="type" class="form-control" value="<?php echo $commande['type']; ?>" />
                                    <div id="errorType" class="form-error">Type requis.</div>
                                </div>

                                <div class="form-group">
                                    <label for="prix">Prix :</label>
                                    <input type="number" id="prix" name="prix" class="form-control" value="<?php echo $commande['prix']; ?>" />
                                    <div id="errorPrix" class="form-error">Prix valide requis.</div>
                                </div>

                                <div class="form-group">
                                    <label for="dateCommande">Date Commande :</label>
                                    <input type="date" id="dateCommande" name="dateCommande" class="form-control" value="<?php echo $commande['dateCommande']; ?>" />
                                    <div id="errorDate" class="form-error">Date valide requise.</div>
                                </div>

                                <div class="form-group">
                                    <label for="quantite">Quantité :</label>
                                    <input type="number" id="quantite" name="quantite" class="form-control" value="<?php echo $commande['quantite']; ?>" />
                                    <div id="errorQuantite" class="form-error">Quantité valide requise.</div>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn-submit">Mettre à jour</button>
                                    <button type="reset" class="btn-submit">Réinitialiser</button>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } else { ?>
                    <p>Commande non trouvée.</p>
                <?php } ?>
            </div>
        </div>
        <!-- End Main Content -->
    </div>

    <!-- JavaScript -->
    <script>
        function validateForm() {
            let isValid = true;

            const type = document.getElementById('type').value;
            if (!type) {
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
</body>

</html>
