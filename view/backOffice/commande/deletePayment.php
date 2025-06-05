<?php
// Inclure le fichier PaymentC.php avec le chemin relatif ajusté
include_once __DIR__ . '/../../../Controller/PaymentC.php';  // Remonter de 2 niveaux pour atteindre Controller

// Vérifier si l'ID est présent dans l'URL
if (isset($_GET['id'])) {
    // Vérifier si le formulaire a été soumis pour suppression
    if (isset($_POST['confirm'])) {
        // Si l'utilisateur a confirmé, procéder à la suppression
        $paymentC = new PaymentController();
        $paymentC->deletePayment($_GET['id']);
        // Rediriger vers la liste des paiements après suppression
        header("Location: listPayment.php");
        exit();
    }
} else {
    // Si l'ID n'est pas trouvé dans l'URL, rediriger vers la liste des paiements
    header("Location: listPayment.php");
    exit();
}
?>

<!-- HTML pour afficher la confirmation -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de suppression</title>
    <!-- Inclure le CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Êtes-vous sûr de vouloir supprimer ce paiement ?</h2>
        
        <!-- Formulaire de confirmation de suppression -->
        <form method="POST">
            <div class="d-flex justify-content-between">
                <button type="submit" name="confirm" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce paiement ?');">Oui, supprimer</button>
                <a href="listPayment.php" class="btn btn-secondary">Non, annuler</a>
            </div>
        </form>
    </div>

    <!-- Inclure le JavaScript de Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
