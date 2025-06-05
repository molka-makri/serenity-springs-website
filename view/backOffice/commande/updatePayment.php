<?php
// Inclure le fichier PaymentC.php avec un chemin correct
include_once '../../../Controller/PaymentC.php';

$paymentC = new PaymentController();

// Récupérer un paiement par ID si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $paiement = $paymentC->getPayment($_GET['id']);
    if (!$paiement) {
        header("Location: listPayment.php");
        exit();
    }
} else {
    // Si l'ID n'est pas fourni, rediriger vers la liste des paiements
    header("Location: listPayment.php");
    exit();
}

// Lorsque le formulaire est soumis, mettre à jour les informations du paiement
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les données du formulaire côté serveur
    if (empty($_POST['datePayment'])) {
        $errors[] = "La date de paiement est obligatoire.";
    }
    if (empty($_POST['montant']) || $_POST['montant'] <= 0) {
        $errors[] = "Le montant doit être un nombre positif.";
    }
    if ($_POST['moyenPaiement'] === 'carte_credit' || $_POST['moyenPaiement'] === 'virement') {
        if (empty($_POST['numeroCarte']) || !preg_match('/^\d{16}$/', $_POST['numeroCarte'])) {
            $errors[] = "Le numéro de carte bancaire doit être composé de 16 chiffres.";
        }
    }
    if (empty($_POST['statusPaiement'])) {
        $errors[] = "Le statut du paiement est obligatoire.";
    }

    if (empty($errors)) {
        $paymentData = [
            'idPaiement' => $_POST['idPaiement'],
            'datePayment' => $_POST['datePayment'],
            'montant' => $_POST['montant'],
            'moyenPaiement' => $_POST['moyenPaiement'],
            'numeroCarte' => $_POST['numeroCarte'] ?? null,
            'statusPaiement' => $_POST['statusPaiement']
        ];

        // Appel à la méthode pour mettre à jour le paiement
        $paymentC->updatePayment($paymentData);

        // Rediriger vers la liste des paiements après la mise à jour
        header("Location: listPayment.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Paiement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        // Validation côté client
        function validateForm() {
            let datePayment = document.getElementById('datePayment').value;
            let montant = document.getElementById('montant').value;
            let numeroCarte = document.getElementById('numeroCarte').value;
            let moyenPaiement = document.getElementById('moyenPaiement').value;
            let errors = [];

            if (!datePayment) {
                errors.push("La date de paiement est obligatoire.");
            }
            if (!montant || montant <= 0) {
                errors.push("Le montant doit être un nombre positif.");
            }

            // Vérification pour "carte_credit" ou "virement"
            if ((moyenPaiement === 'carte_credit' || moyenPaiement === 'virement') && (!numeroCarte || !/^\d{16}$/.test(numeroCarte))) {
                errors.push("Le numéro de carte bancaire doit être composé de 16 chiffres.");
            }

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }
            return true;
        }

        // Ajout d'un contrôle pour empêcher la saisie de caractères non numériques dans le champ "numeroCarte"
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('numeroCarte').addEventListener('input', function(e) {
                // Remplace tous les caractères non numériques par une chaîne vide
                let originalValue = this.value;
                this.value = this.value.replace(/\D/g, ''); // Supprimer tout caractère non numérique

                // Si des caractères non numériques ont été saisis, afficher un message
                if (originalValue !== this.value) {
                    alert("Le numéro de carte doit être composé uniquement de chiffres.");
                }

                // Limiter la longueur à 16 chiffres maximum
                if (this.value.length > 16) {
                    this.value = this.value.slice(0, 16);  // Limiter à 16 caractères
                    alert("Le numéro de carte doit être composé uniquement de 16 chiffres.");
                }
            });
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Modifier le Paiement</h1>

        <!-- Afficher les erreurs côté serveur -->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulaire de modification des données du paiement -->
        <form action="" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="idPaiement" value="<?= htmlspecialchars($paiement['idPaiement']) ?>">

            <div class="mb-3">
                <label for="datePayment" class="form-label">Date de Paiement :</label>
                <input type="date" id="datePayment" name="datePayment" class="form-control" value="<?= htmlspecialchars($paiement['datePayment']) ?>" >
            </div>

            <div class="mb-3">
                <label for="montant" class="form-label">Montant :</label>
                <input type="number" id="montant" name="montant" class="form-control" value="<?= htmlspecialchars($paiement['montant']) ?>" >
            </div>

            <div class="mb-3">
                <label for="moyenPaiement" class="form-label">Moyen de Paiement :</label>
                <select id="moyenPaiement" name="moyenPaiement" class="form-select" >
                    <option value="carte_credit" <?= $paiement['moyenPaiement'] == 'carte_credit' ? 'selected' : '' ?>>Carte de Crédit</option>
                    <option value="virement" <?= $paiement['moyenPaiement'] == 'virement' ? 'selected' : '' ?>>Virement Bancaire</option>
                    <option value="paypal" <?= $paiement['moyenPaiement'] == 'paypal' ? 'selected' : '' ?>>PayPal</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="numeroCarte" class="form-label">Numéro de Carte (si applicable) :</label>
                <input type="text" id="numeroCarte" name="numeroCarte" class="form-control" value="<?= htmlspecialchars($paiement['numeroCarte']) ?>" 
                    <?= $paiement['moyenPaiement'] == 'carte_credit' || $paiement['moyenPaiement'] == 'virement' ?  : '' ?>>
            </div>

            <div class="mb-3">
                <label for="statusPaiement" class="form-label">Statut du Paiement :</label>
                <select id="statusPaiement" name="statusPaiement" class="form-select" >
                    <option value="en_attente" <?= isset($paiement['statusPaiement']) && $paiement['statusPaiement'] == 'en_attente' ? 'selected' : '' ?>>En Attente</option>
                    <option value="resolu" <?= isset($paiement['statusPaiement']) && $paiement['statusPaiement'] == 'resolu' ? 'selected' : '' ?>>Résolu</option>
                    <option value="en_cours" <?= isset($paiement['statusPaiement']) && $paiement['statusPaiement'] == 'en_cours' ? 'selected' : '' ?>>En Cours</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
