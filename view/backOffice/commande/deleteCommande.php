<?php
// Include the CommandeController
include '../../../Controller/CommandeC.php';

// Create an instance of the CommandeController
$commandeC = new CommandeC();

// Call the deleteCommande function with the id passed from the URL
$commandeC->deleteCommande($_GET["idCommande"]);

// Redirect to the list of commandes page after deletion
header('Location: listCommandes.php');
exit; 