[]<?php
include_once '../../../Controller/PaymentC.php';

$paymentC = new PaymentController();
$paiements = $paymentC->listPayments();

$newPayments = [];
foreach ($paiements as $paiement) {
    if (strtolower(trim($paiement['statusPaiement'])) === 'en attente') {
        $newPayments[] = [
            'idPaiement' => $paiement['idPaiement'],
            'montant' => $paiement['montant']
        ];
    }
}

header('Content-Type: application/json');
echo json_encode(['newPayments' => $newPayments]);
?>
