
<?php
// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id'])) {
    $idCommande = $_GET['id'];
} else {
    // Si l'ID n'est pas trouvé, rediriger vers index.php
    header("Location: productPage.php");
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once '../../Controller/PaymentC.php'; // Inclure le fichier PaymentC.php
    require '/../../vendor/autoload.php'; // Inclure PHPMailer via Composer

    $paymentC = new PaymentController();

    // Récupérer les données du formulaire
    $paymentData = [
        'idCommande' => $_POST['idCommande'],
        'datePayment' => $_POST['datePayment'],
        'montant' => $_POST['montant'],
        'moyenPaiement' => $_POST['moyenPaiement'],
        'numeroCarte' => $_POST['numeroCarte'] ?? null,
        'statusPaiement' => $_POST['statusPaiement']
    ];

    // Ajouter le paiement à la base de données
    $result = $paymentC->addPayment($paymentData);
    
    if ($result) {
        // Envoi de l'e-mail de confirmation
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Serveur SMTP Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'yousfi.islem@esprit.tn'; // Remplacez par votre adresse Gmail
            $mail->Password = 'fdwr dwnc eqgb khgq'; // Mot de passe généré pour l'application
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuration de l'e-mail
            $mail->setFrom('yousfi.islem@esprit.tn', 'Serenity Springs'); // Expéditeur
            $mail->addAddress('yousfi.islem@esprit.tn', 'Islem Yousfi'); // Destinataire
            $mail->Subject = 'Confirmation de Paiement';
            $mail->isHTML(true); // Activer le mode HTML pour l'e-mail

            $mailContent = "
                <h1>Confirmation de Paiement</h1>
                <p>Bonjour,</p>
                <p>Nous vous confirmons la réception de votre paiement.</p>
                <p><strong>Détails du paiement :</strong></p>
                <ul>
                    <li><strong>ID Commande :</strong> {$paymentData['idCommande']}</li>
                    <li><strong>Date de Paiement :</strong> {$paymentData['datePayment']}</li>
                    <li><strong>Montant :</strong> {$paymentData['montant']} €</li>
                    <li><strong>Moyen de Paiement :</strong> {$paymentData['moyenPaiement']}</li>
                    <li><strong>Statut :</strong> {$paymentData['statusPaiement']}</li>
                </ul>
                <p>Merci pour votre confiance.</p>
                <p>Cordialement,</p>
                <p>L'équipe de gestion des paiements.</p>
            ";

            $mail->Body = $mailContent;

            // Envoyer l'e-mail
            if ($mail->send()) {
                // Rediriger vers index.php après succès
                header("Location: index.php");
                exit();
            } else {
                $error = "Paiement ajouté, mais l'envoi de l'e-mail a échoué.";
            }
        } catch (Exception $e) {
            $error = "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}";
        }
    } else {
        $error = "Erreur lors de l'ajout du paiement. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Paiement Commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulaire de Paiement</h2>

        <!-- Afficher un message d'erreur en cas de problème -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Formulaire de paiement -->
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="idCommande" class="form-label">ID de Commande</label>
                <input type="text" class="form-control" id="idCommande" name="idCommande" value="<?= htmlspecialchars($idCommande); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="datePayment" class="form-label">Date de Paiement</label>
                <input type="date" class="form-control" id="datePayment" name="datePayment" >
            </div>
            <div class="mb-3">
                <label for="montant" class="form-label">Montant</label>
                <input type="number" class="form-control" id="montant" name="montant" min="0.01" step="0.01" >
            </div>
            <div class="mb-3">
                <label for="moyenPaiement" class="form-label">Moyen de Paiement</label>
                <select class="form-control" id="moyenPaiement" name="moyenPaiement" >
                    <option value="carte_credit">Carte de Crédit</option>
                    <option value="virement">Virement Bancaire</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="numeroCarte" class="form-label">Numéro de Carte (si applicable)</label>
                <input type="text" class="form-control" id="numeroCarte" name="numeroCarte">
            </div>
            <div class="mb-3">
                <label for="statusPaiement" class="form-label">Statut du Paiement</label>
                <select class="form-control" id="statusPaiement" name="statusPaiement" >
                    <option value="en_attente">En attente</option>
                    <option value="en_cours">En cours</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Confirmer le Paiement</button>
        </form>
    </div>

    <!-- Scripts JavaScript -->
    <script>
        function validateForm() {
            // Vérifier que tous les champs obligatoires sont remplis
            const datePayment = document.getElementById('datePayment').value;
            const montant = document.getElementById('montant').value;
            const moyenPaiement = document.getElementById('moyenPaiement').value;
            const numeroCarte = document.getElementById('numeroCarte').value;

            if (!datePayment || !montant || !moyenPaiement) {
                alert('Tous les champs obligatoires doivent être remplis.');
                return false;
            }

            // Vérifier que le montant est positif
            if (montant <= 0) {
                alert('Le montant doit être un nombre positif.');
                return false;
            }

            // Vérifier si le moyen de paiement est "Carte de Crédit"
            if (moyenPaiement === "carte_credit") {
                // Le numéro de carte doit être non vide et comporter exactement 16 chiffres
                if (!numeroCarte || numeroCarte.length !== 16 || !/^[0-9]{16}$/.test(numeroCarte)) {
                    alert('Le numéro de carte bancaire doit être composé de 16 chiffres.');
                    return false;
                }
            } 
            // Vérifier si le moyen de paiement est "Virement Bancaire"
            else if (moyenPaiement === "virement") {
                // Le numéro de carte doit être rempli pour un virement bancaire
                if (numeroCarte === "") {
                    alert('Le numéro de carte bancaire doit être rempli pour un virement bancaire.');
                    return false;
                }
            }

            return true;
        }

        // Ajouter un gestionnaire d'événements pour détecter la saisie des caractères non numériques dans le champ "numeroCarte"
        document.getElementById('numeroCarte').addEventListener('input', function() {
            let numeroCarteValue = this.value;
            // Supprimer tout caractère non numérique
            this.value = numeroCarteValue.replace(/\D/g, '');

            // Vérifier si des caractères non numériques ont été supprimés et afficher une alerte
            if (numeroCarteValue !== this.value) {
                alert('Le numéro de carte bancaire doit être composé uniquement de chiffres.');
            }

            // Limiter la longueur à 16 caractères
            if (this.value.length > 16) {
                this.value = this.value.slice(0, 16);
            }
        });
    </script>

    <!-- Inclusion du script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>
