<?php
// Inclure le fichier Payment.php avec le chemin absolu
include_once __DIR__ . '/../Model/Payment.php'; // Vérifiez le chemin du fichier Payment.php


class PaymentController {
    private $paymentModel;

    public function __construct() {
        if (!class_exists('Payment')) {
            die("Erreur : La classe Payment n'a pas été trouvée. Vérifiez l'inclusion.");
        }
        $this->paymentModel = new Payment();
    }

    // Ajouter un paiement
    public function addPayment($paymentData) {
        return $this->paymentModel->addPayment($paymentData);
    }

    // Lire tous les paiements
    public function listPayments() {
        return $this->paymentModel->getAllPayments();
    }

    // Lire un paiement par ID
    public function getPayment($idPaiement) {
        return $this->paymentModel->getPaymentById($idPaiement);
    }

    // Mettre à jour un paiement
    public function updatePayment($paymentData) {
        return $this->paymentModel->updatePayment($paymentData);
    }

    // Supprimer un paiement
    public function deletePayment($idPaiement) {
        return $this->paymentModel->deletePayment($idPaiement);
    }

    // Recherche des paiements par ID de commande
    public function searchPaymentsByIdCommande($idCommande) {
        return $this->paymentModel->getPaymentsByCommandeId($idCommande);
    }
    
}
?>
