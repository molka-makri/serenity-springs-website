<?php
session_start();
session_destroy(); // Détruire toutes les données de session
header("Location: ../../frontOffice/signup.php"); // Rediriger vers la page de connexion
exit();
?>




