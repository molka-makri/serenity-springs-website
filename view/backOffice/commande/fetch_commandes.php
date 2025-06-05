<?php
// Exemple d'un fichier PHP pour récupérer des commandes statiques

// En-têtes pour s'assurer que la réponse est en JSON
header('Content-Type: application/json');

// Données statiques des commandes
$commandes = [
    ['id' => 1, 'dateCommande' => '2024-12-01', 'details' => 'Commande pour le client A'],
    ['id' => 2, 'dateCommande' => '2024-12-05', 'details' => 'Commande pour le client B'],
    ['id' => 3, 'dateCommande' => '2024-12-10', 'details' => 'Commande pour le client C'],
    ['id' => 4, 'dateCommande' => '2024-12-15', 'details' => 'Commande pour le client D'],
    ['id' => 5, 'dateCommande' => '2024-12-20', 'details' => 'Commande pour le client E']
];

// Renvoyer les commandes au format JSON
echo json_encode($commandes);
?>
