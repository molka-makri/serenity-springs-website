<?php
include_once '../../../Controller/userC.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../../../vendor/autoload.php';  // Assurez-vous que ce chemin est correct

$userC = new userC();

if (isset($_GET['id'])) {
    // Supprimer l'utilisateur de la base de données
    $userId = $_GET['id'];
    $userC->deleteUser($userId);
    
    // Envoi d'un email après suppression
    $mail = new PHPMailer(true);
    try {
        // Configuration du serveur de mail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Par exemple pour Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'salma.talbi@esprit.tn'; // Remplacez par votre adresse e-mail
        $mail->Password = 'vdkj wipt epad yejk'; // Remplacez par votre mot de passe
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinataire et expéditeur
        $mail->setFrom('salma.talbi@esprit.tn', 'Serenity Springs');
        $mail->addAddress('salma.talbi@esprit.tn'); // L'adresse email à laquelle l'email sera envoyé

        // Sujet et contenu
        $mail->isHTML(true);
        $mail->Subject = 'Suppression d\'un utilisateur';
        $mail->Body    = "
            <h2>Un utilisateur a été supprimé</h2>
            <p>ID de l'utilisateur supprimé : $userId</p>
            <p>Cette action a été effectuée sur la plateforme.</p>
        ";

        // Envoi de l'email
        $mail->send();

        echo 'L\'utilisateur a été supprimé et un e-mail a été envoyé à Salma Talbi.';
    } catch (Exception $e) {
        echo "L'email n'a pas pu être envoyé. Erreur : {$mail->ErrorInfo}";
    }

    // Rediriger après la suppression
    header('Location: index.php');
    exit();
}
?>