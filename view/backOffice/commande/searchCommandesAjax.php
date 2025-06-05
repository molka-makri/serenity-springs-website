<?php
// Inclure le contrôleur CommandeC
include '../../../Controller/CommandeC.php';

// Créer une instance du contrôleur CommandeC
$commandeC = new CommandeC();

// Initialiser la variable des commandes
$listeCommandes = [];

// Vérifier si une recherche est effectuée
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchKeyword = htmlspecialchars($_GET['search']);
    // Appeler la méthode de recherche
    $listeCommandes = $commandeC->searchCommandes($searchKeyword);
} else {
    // Si aucune recherche, afficher toutes les commandes
    $listeCommandes = $commandeC->listCommandes();
}

// Retourner les lignes de la table avec les commandes
foreach ($listeCommandes as $commande) {
    echo "<tr>
            <td>" . htmlspecialchars($commande['idCommande']) . "</td>
            <td>" . htmlspecialchars($commande['type']) . "</td>
            <td>" . htmlspecialchars($commande['prix']) . " TND</td>
            <td>" . htmlspecialchars($commande['dateCommande']) . "</td>
            <td>" . htmlspecialchars($commande['quantite']) . " kg</td>
            <td class='actions'>
                <a href='updateCommande.php?idCommande=" . $commande['idCommande'] . "'>Modifier</a>
                <a href='deleteCommande.php?idCommande=" . $commande['idCommande'] . "' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?');\">Supprimer</a>
            </td>
        </tr>";
}
?>
