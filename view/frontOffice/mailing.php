<?php
// Inclure PHPMailer via Composer
include (__DIR__ . "../../../vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && !empty($_POST['email'])) {
    $userEmail = $_POST['email']; // Récupérer l'email de l'utilisateur (à partir du formulaire)

    // Valider l'adresse email
    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        echo "L'adresse email fournie est invalide.";
        exit; // Arrêter l'exécution du script si l'email est invalide
    }

    $mail = new PHPMailer(true);

    try {
        // Paramètres SMTP de Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Serveur SMTP Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'moenes.kharoubi@esprit.tn'; // Remplacez par votre adresse Gmail
        $mail->Password = '231JMT7083'; // Remplacez par votre mot de passe Gmail (ou mot de passe d'application)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;  // Port SMTP de Gmail (TLS)

        // Destinataire
        $mail->setFrom('moenes.kharoubi@esprit.tn', 'Serenity Springs');
        $mail->addAddress($userEmail); // L'email de l'utilisateur

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = "Confirmation de votre demande";
        $mail->Body    = "Bonjour, votre demande a bien été reçue. Vous serez contacté dans les plus brefs délais.";

        // Ajouter les entêtes pour améliorer la réception
        $mail->addCustomHeader('X-Mailer', 'PHPMailer');
        $mail->addCustomHeader('MIME-Version', '1.0');
        $mail->addCustomHeader('Content-Type', 'text/html; charset=UTF-8');

        // Envoi de l'email
        if ($mail->send()) {
            echo "Un email de confirmation a été envoyé.";
            // Rediriger vers la page d'accueil après l'envoi de l'email
            header("Location: productPage.php");
            exit; // S'assurer que le script s'arrête ici après la redirection
        } else {
            echo "Erreur lors de l'envoi de l'email.";
        }
    } catch (Exception $e) {
        echo "Erreur : {$mail->ErrorInfo}";
    }
} else {
    echo "Veuillez saisir un email valide.";
}
?>

<!-- Formulaire d'email -->
<form method="POST" action="mailing.php">
    <label for="email">Entrez votre email :</label>
    <input type="email" name="email" id="email" required>
    <button type="submit">Envoyer</button>
</form>