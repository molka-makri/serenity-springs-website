<?php
require_once __DIR__ . '/../config.php';  // Chemin relatif depuis le répertoire actuel

class Payment {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=serenity_springs", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function addPayment($paymentData) {
        try {
            $sql = "INSERT INTO paiements (idCommande, datePayment, montant, moyenPaiement, numeroCarte, statusPaiement) 
                    VALUES (:idCommande, :datePayment, :montant, :moyenPaiement, :numeroCarte, :statusPaiement)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($paymentData);
        } catch (PDOException $e) {
            die("Erreur lors de l'ajout du paiement : " . $e->getMessage());
        }
    }

    public function getAllPayments() {
        try {
            $sql = "SELECT * FROM paiements";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des paiements : " . $e->getMessage());
        }
    }

    public function getPaymentById($idPaiement) {
        try {
            $sql = "SELECT * FROM paiements WHERE idPaiement = :idPaiement";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':idPaiement', $idPaiement, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération du paiement : " . $e->getMessage());
        }
    }

    public function updatePayment($paymentData) {
        try {
            $sql = "UPDATE paiements 
                    SET datePayment = :datePayment, montant = :montant, moyenPaiement = :moyenPaiement, 
                        numeroCarte = :numeroCarte, statusPaiement = :statusPaiement
                    WHERE idPaiement = :idPaiement";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($paymentData);
        } catch (PDOException $e) {
            die("Erreur lors de la mise à jour du paiement : " . $e->getMessage());
        }
    }

    public function deletePayment($idPaiement) {
        try {
            $sql = "DELETE FROM paiements WHERE idPaiement = :idPaiement";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':idPaiement', $idPaiement, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur lors de la suppression du paiement : " . $e->getMessage());
        }
    }
}
?>
