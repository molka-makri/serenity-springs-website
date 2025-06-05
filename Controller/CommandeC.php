<?php

include(__DIR__ . '/../Model/Payment.php');
// include_once __DIR__ . '/../config.php';  // Chemin relatif depuis le répertoire actuel



// CommandeC.php (le modèle)
class CommandeC {



    public function listCommandes()
    {
        $sql = "SELECT * FROM commande";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteCommande($idCommande)
    {
        $sql = "DELETE FROM commande WHERE idCommande = :idCommande";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':idCommande', $idCommande);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addCommande($commande)
    {
        $sql = "INSERT INTO commande (idCommande, type, prix, dateCommande, quantite)  
        VALUES (NULL, :type, :prix, :dateCommande, :quantite)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'type' => $commande->getType(),
                'prix' => $commande->getPrix(),
                'dateCommande' => $commande->getDateCommande(),
                'quantite' => $commande->getQuantite()
            ]);
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    function showCommande($idCommande)
{
    $sql = "SELECT * FROM commande WHERE idCommande = :idCommande";  // Use parameterized query
    $db = config::getConnexion();

    try {
        // Prepare and execute the SQL query with the bound idCommande parameter
        $query = $db->prepare($sql);
        $query->bindValue(':idCommande', $idCommande, PDO::PARAM_INT);
        $query->execute();

        // Fetch the result as an associative array
        $commande = $query->fetch(PDO::FETCH_ASSOC);
        
        // Return the retrieved commande
        return $commande;
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
// In your CommandeController.php (CommandeC.php)
function updateCommande($commande, $idCommande)
{   
    try {
        $db = config::getConnexion();
        
        // Prepare the SQL update query
        $query = $db->prepare(
            'UPDATE commande SET 
                type = :type, 
                prix = :prix, 
                dateCommande = :dateCommande, 
                quantite = :quantite
            WHERE idCommande = :idCommande'
        );

        // Execute the query with the values from the $commande object
        $query->execute([
            'idCommande' => $idCommande,
            'type' => $commande->getType(),
            'prix' => $commande->getPrix(),
            'dateCommande' => $commande->getDateCommande(),
            'quantite' => $commande->getQuantite(),
        ]);

        // Optionally echo how many rows were updated (if useful)
        echo $query->rowCount() . " record(s) UPDATED successfully <br>";

    } catch (PDOException $e) {
        die('Error: ' . $e->getMessage());
    }
}
    public function countNewCommandes() {
        $sql = "SELECT COUNT(*) FROM commandes WHERE statut = 'nouvelle'";  // 'nouvelle' est un exemple de statut
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    // Récupérer les commandes de type "fruit" et "légume" depuis la base de données
    public function getStatistiquesCommandes($conn) {
        // Préparer la requête
        $stmt = $conn->prepare("
            SELECT type, 
                   SUM(quantite) AS total_quantite, 
                   SUM(prix) AS total_prix
            FROM commandes
            WHERE type IN ('fruit', 'légume')
            GROUP BY type
            ORDER BY total_quantite DESC
            LIMIT 5
        ");

        // Exécuter la requête
        $stmt->execute();

        // Récupérer les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


class PaymentController {
    private $paymentModel;

    public function __construct() {
        $this->paymentModel = new Payment();
    }

    // Créer un paiement
    public function createPayment($idCommande, $montant, $datePayment, $moyenPaiement, $numeroCarte, $statusPaiement) {
        $result = $this->paymentModel->createPayment($idCommande, $montant, $datePayment, $moyenPaiement, $numeroCarte, $statusPaiement);
        return $result ? "Paiement ajouté avec succès !" : "Erreur lors de l'ajout du paiement.";
    }

    // Lire tous les paiements d'une commande donnée
    public function getPaymentsByCommande($idCommande) {
        return $this->paymentModel->getPaymentsByCommandeId($idCommande);
    }

    // Lire un paiement par ID
    public function getPayment($idPaiement) {
        return $this->paymentModel->getPaymentById($idPaiement);
    }

    // Mettre à jour un paiement
    public function updatePayment($idPaiement, $montant, $datePayment, $moyenPaiement, $numeroCarte, $statusPaiement) {
        $result = $this->paymentModel->updatePayment($idPaiement, $montant, $datePayment, $moyenPaiement, $numeroCarte, $statusPaiement);
        return $result ? "Paiement mis à jour avec succès !" : "Erreur lors de la mise à jour du paiement.";
    }

    // Supprimer un paiement
    public function deletePayment($idPaiement) {
        $result = $this->paymentModel->deletePayment($idPaiement);
        return $result ? "Paiement supprimé avec succès !" : "Erreur lors de la suppression du paiement.";
    }
}
?>