<?php
session_start();

// Display the notification if a new user has been added
if (isset($_SESSION['user_added']) && $_SESSION['user_added'] == true) {
    $userEmail = htmlspecialchars($_SESSION['user_email']); // Get the user's email
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const notificationBox = document.getElementById("notification-box");
            notificationBox.innerHTML = "🔔neauveau utilisateur🔔  : <b>' . $userEmail . '</b>";
            notificationBox.style.display = "flex";
        });
    </script>';

    // Reset the session variables after displaying the notification
    unset($_SESSION['user_added']);
    unset($_SESSION['user_email']);
   


}




include_once '../../../Controller/userC.php';
$userController = new userC();



  $users = $userController->listUsers();

// Vérification si un ID de recherche est fourni
if (isset($_GET['search_id'])) {
  $searchId = $_GET['search_id'];
  // Recherche de l'utilisateur par ID
  $users = $userController->searchUserById($searchId);
} else {
  // Si aucune recherche n'est effectuée, liste tous les utilisateurs
  $users = $userController->listUsers();
}












 
// Vérification de la recherche par ID
if (isset($_GET['search_id'])) {
  $searchId = $_GET['search_id'];
  $users = $userController->searchUserById($searchId);
} else {
  $users = $userController->listUsers();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Serenity Springs - BackOffice</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>







  document.addEventListener("DOMContentLoaded", () => {
    const notificationBox = document.getElementById("notification-box");
    const notificationBtn = document.getElementById("open-notification");

    // Ouvrir ou fermer la notification
    notificationBtn.addEventListener("click", () => {
      if (notificationBox.style.display === "none" || notificationBox.style.display === "") {
        notificationBox.style.display = "flex";
      } else {
        notificationBox.style.display = "none";
      }
    });
  });


      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
          urls: ["../assets/css/fonts.min.css"],
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
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
       
      <div class="sidebar" data-background-color="green">
        <div class="sidebar-logo">
          <div class="logo-header" data-background-color="green">
            <a href="../../../../index.html" class="logo">
              <img src="../assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
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
                  <img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle" />
                </div>
                <span class="profile-username">Admin</span>
              </a>
              <ul class="dropdown-menu dropdown-user animated fadeIn">
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>



              <li class="nav-item">
                <a href="statistique.php" class="btn btn-danger">statistique</a>
            </li>








              <li class="nav-item">
                <a href="logout.php" class="btn btn-danger">Déconnexion</a>
            </li>

     


           






            </li>
          </ul>
        </div>
      </nav>


      

   
  









      <!-- End Navbar -->

      <!-- Main Content -->
  <!-- Main Content -->
  <div class="main-panel">
    <div class="content">
      <h1 class="main-title">Liste des utilisateurs</h1>









      <button id="open-notification">  🔔 NOTIFICATION</button>
      <!-- Conteneur de la notification -->
<div id="notification-box"></div>

<!-- Styles for notification -->
<style>
 #notification-box {
    position: fixed;
    bottom: 80px;
    right: 20px;
    width: 300px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    background-color: #f9f9f9;
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: #333;
    z-index: 1000;
}

#open-notification {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 50%;
    padding: 15px;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

#open-notification:hover {
    background-color: #45a049;
}
</style>






 <!-- Search form for user ID -->
 <div class="search-container">
            <form method="GET" action="index.php">
              <input type="text" name="search_id" placeholder="Rechercher par ID" required>
              <button type="submit">Rechercher</button>

            </form>
          </div>


   













     
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>RoleID</th>
            <th>roleName</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $user) { ?>
            <tr>
              <td><?php echo $user['id']; ?></td>
              <td><?php echo $user['nom']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php echo $user['role']; ?></td>
              <td><?php echo $user['roleName']; ?></td>
              <td class="actions">
                <a href="editUser.php?id=<?php echo $user['id']; ?>">Modifier</a>
                <a href="deleteUser.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">Supprimer</a>
              
              
              
              
              
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Core JS Files -->
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/bootstrap/js/bootstrap.min.js"></script>

</script>

</body>
</html>
