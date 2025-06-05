 <?php
include_once '../../../Controller/userC.php';
$userC = new userC();

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Récupération des informations de l'utilisateur
    $user = $userC->listUsersById($userId);

    if (!$user) {
        // Si aucun utilisateur n'est trouvé, redirection
        header('Location: error.php');
        exit();
    }

    // Si le formulaire est soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $mdp = $_POST["mdp"];
        $role = $_POST["role"];

        try {
            $user = new User($userId, $nom, $email, $mdp, $role);
            $userC->updateUser($userId, $user);

            header('Location: index.php');
            exit();
        } catch (PDOException $e) {
            echo "Erreur: " . $e->getMessage();
        }
    }
} else {
    header('Location: index.php');
    exit();
}
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
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

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
    </style>
  </head>
  <style>
    .form-container {
      margin: 50px auto;
      max-width: 600px;
      background: #f4f4f9;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .form-container h1 {
      text-align: center;
      margin-bottom: 20px;
    }
    .btn-submit {
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
      font-size: 16px;
    }
    .btn-submit:hover {
      background-color: #45a049;
    }
  </style>
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
                <h4 class="text-section">gestionUser</h4>
              </li>
              <li class="nav-item">
                <a href="index.php">
                  <i class="fas fa-layer-group"></i>
                  <p>gestionUser</p>
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
  <!-- Main Content -->
  <div class="main-panel">
    <div class="content">
      
       
        <div class="form-container">
        <h1>Modifier Utilisateur</h1>
        <form id="editForm" method="POST">
            <div class="mb-3">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?php echo $user->getNom(); ?>">
                <div id="nameError" class="error-message"></div>
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $user->getEmail(); ?>">
                <div id="emailError" class="error-message"></div>
            </div>
            <div class="mb-3">
                <label for="mdp">Mot de passe</label>
                <input type="password" id="mdp" name="mdp" value="<?php echo $user->getMdp(); ?>">
                <div id="passwordError" class="error-message"></div>
            </div>
            <div class="mb-3">
                <label for="role">Rôle</label>
                <select id="role" name="role">
                    <option value="0" <?php echo $user->getRole() == 0 ? 'selected' : ''; ?>>Utilisateur</option>
                    <option value="1" <?php echo $user->getRole() == 1 ? 'selected' : ''; ?>>Administrateur</option>
                    <option value="1" <?php echo $user->getRole() == 2 ? 'selected' : ''; ?>>Agriculteur</option>
                    
                </select>
                <div id="roleError" class="error-message"></div>
            </div>
            <button type="submit" class="btn-submit">Modifier</button>
        </form>
   
      </div>
    </div>
  </div>
</div>

    <script>
        document.getElementById('editForm').addEventListener('submit', function(e) {
            let isValid = true;

            // Effacer les messages d'erreur précédents
            document.getElementById('nameError').textContent = '';
            document.getElementById('emailError').textContent = '';
            document.getElementById('passwordError').textContent = '';
            document.getElementById('roleError').textContent = '';



            document.getElementById('logoutButton').addEventListener('click', function() {
    window.location.href = 'signup.php'; // Corrigez l'URL
});




            // Récupérer les valeurs du formulaire
            const name = document.getElementById('nom').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('mdp').value.trim();
            const role = document.getElementById('role').value;





            // Validation du nom
            if (name === '') {
                document.getElementById('nameError').textContent = 'Le nom est requis.';
                isValid = false;
            }

            // Validation de l'email
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === '') {
                document.getElementById('emailError').textContent = 'L\'email est requis.';
                isValid = false;
            } else if (!emailRegex.test(email)) {
                document.getElementById('emailError').textContent = 'Format d\'email invalide.';
                isValid = false;
            }

            // Validation du mot de passe
            if (password === '') {
                document.getElementById('passwordError').textContent = 'Le mot de passe est requis.';
                isValid = false;
            }

            // Validation du rôle
            if (role !== '0' && role !== '1' &&  role !== '2') {
                document.getElementById('roleError').textContent = 'Rôle invalide.';
                isValid = false;
            }

            // Annuler la soumission si des erreurs existent
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
