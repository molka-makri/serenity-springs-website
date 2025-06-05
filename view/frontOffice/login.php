<?php
session_start();
// Include the category controller
require_once "../../controller/userC.php";

$message = '';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Connexion à la base de données
        $pdo = config::getConnexion();
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mdp'])) {
            // L'utilisateur existe et le mot de passe est correct
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nom' => $user['nom'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            // Rediriger vers index.php après une connexion réussie
            header('Location: ../frontOffice');
            exit();
        } else {
            $message = '<span style="color: red;">Email ou mot de passe incorrect.</span>';
        }
    } catch (Exception $e) {
        $message = '<span style="color: red;">Erreur : ' . $e->getMessage() . '</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Serenity Springs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">Connexion</h1>
    <?php if (!empty($message)): ?>
        <div class="alert alert-danger"><?= $message ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Adresse Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre email" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe" required>
        </div>
        <button type="submit" name="login" class="btn btn-success btn-block">Se connecter</button>
    </form>
    
   
</div>
</body>
</html>
