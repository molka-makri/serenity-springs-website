<?php
// Inclure les fichiers nécessaires pour la base de données et les classes

// Include the category controller
require_once "../../controller/userC.php";

$message = '';

if (isset($_POST['entrer'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mdp = $_POST['mot_de_passe'];
    $verification_mdp = $_POST['verification'];
    $role = $_POST['role'];

    try {
        // Vérifier si l'e-mail existe déjà
        $pdo = config::getConnexion();
        $checkIfExists = "SELECT COUNT(*) as count FROM user WHERE email = ?";
        $stmtCheck = $pdo->prepare($checkIfExists);
        $stmtCheck->execute([$email]);
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
            // Afficher un message si l'email existe
            $message = '<span style="color: red;">Cette adresse mail est déjà associée à un compte existant. Veuillez utiliser une autre adresse.</span>';
        } else {
            // Ajouter l'utilisateur
            $user = new User(null, $nom, $email, password_hash($mdp, PASSWORD_DEFAULT),  $role);
            $userC = new UserC();
            $userC->addUser($user);

            

  // Set session variables to display user notification
  session_start();

            $_SESSION['user_added'] = true;
            $_SESSION['user_email'] = $email; // Store the email



            // Succès
            echo '<script>
                    alert("Inscription réussie !");
                    window.location.href = "index.html";
                  </script>';





                  
            exit();
        }
    } catch (Exception $e) {
        $message = '<span style="color: red;">Erreur : ' . $e->getMessage() . '</span>';
    }
}

// Fonction pour afficher le nom du rôle
function getRoleName($role) {
    switch ($role) {
        case '1':
            return 'Administrateur';
        case '2':
            return 'Agriculteur';
        default:
            return 'Utilisateur';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Serenity Springs</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="TheEvent1/img/favicon.ico" rel="icon">
    <link href="TheEvent1/img/favicon.ico" type="img/x-icon" rel="apple-touch-icon">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #3c3c3c;
        }

        nav {
            background-color:rgb(15, 24, 17);
        }

        nav .navbar-brand {
            color: #1b5e20;
            font-weight: 600;
        }

        header {
    background-color: #004d26; /* Darker green for a stronger, more elegant look */
    color: white;
    text-align: center;
    padding: 80px 0; /* Increased padding for more space */
    border-bottom: 4px solid #1b5e20; /* A subtle border for contrast */
}

        header h1 {
    font-size: 3rem; /* Increased font size for better visibility */
    font-weight: 700; /* Bold for more impact */
    margin-bottom: 20px; /* Space between the title and subtitle */
}

header p {
    font-size: 1.4rem; /* Increased font size for readability */
    font-weight: 300;
    margin-bottom: 30px; /* Added space below the paragraph */
}
header form button {
    background-color: #1b5e20; /* Lush green color */
    color: white;
    font-size: 1.2rem; /* Slightly larger font size */
    padding: 12px 30px; /* Increased padding for a more comfortable button size */
    border: none;
    border-radius: 50px; /* Rounded button edges for a modern feel */
    text-transform: uppercase;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease; /* Added transform for effect */
    margin-top: 30px; /* Space between the header text and button */
}

header form button:hover {
    background-color: #1f5d38; /* Darker green on hover */
    transform: translateY(-3px); /* Button lifts on hover */
}

/* Optional: Focus style to make the button more interactive */
header form button:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

        .container {
            padding: 50px 0;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 40px;
            background-color: #fff;
            border-radius: 12px;
        }

        .card-title {
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            font-size: 1rem;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: #2f6a3a;
            box-shadow: 0 0 10px rgba(47, 106, 58, 0.5);
        }

        .btn-success {
            background-color: #2f6a3a;
            border-color: #2f6a3a;
            color: #fff;
            padding: 12px 20px;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #1b5e20;
        }

        .alert {
            font-weight: 600;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .chatbot-popup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #7caf7f;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 15px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .chatbot-popup:hover {
            background-color: #5b8e5b;
        }
        header.bg-success {
    background-color: #7caf7f !important;
}

header form button.btn-secondary {
    background-color: #1b5e20 !important;
}
.btn-custom {
    background-color: #2e8b57;
    color: white;
    font-size: 1.2rem;
    padding: 12px 30px;
    border: none;
    border-radius: 50px;
    text-transform: uppercase;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.btn-custom:hover {
    background-color: #1f5d38;
    transform: translateY(-3px);
}




/* Updated SE CONNECTER Button Style */

        /* Style for the Sign In Button */



        /* Chatbot Styles */
        #chatbot {
            position: fixed;
            bottom: 0;
            right: 20px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            display: none;
            flex-direction: column;
        }

        #chatbot-header {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #chatbot-body {
            display: flex;
            flex-direction: column;
            height: 300px;
        }

        #chatbot-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        #chatbot-input {
            border: 1px solid #ddd;
            padding: 10px;
            width: calc(100% - 20px);
            margin: 0 10px 10px;
            border-radius: 5px;
        }

        #send-chatbot {
            background-color: rgb(154, 200, 155);
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: calc(100% - 20px);
            margin: 0 10px 10px;
            border-radius: 5px;
        }

        #open-chatbot {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: rgb(124, 170, 125);
            color: white;
            border: none;
            border-radius: 50%;
            padding: 15px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        #send-chatbot:hover,
        #open-chatbot:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <a class="navbar-brand" href="#">Serenity Springs</a>
</nav>

<!-- Header Section -->
<header class="bg-success text-white text-center py-4">
    <h1>Register</h1>
    <p>Join us and explore our services</p>

    <!-- Sign In Button -->
    <form action="login.php">
        <button type="submit" class="btn btn-secondary btn-lg">SE CONNECTER</button>
    </form>
</header>


<!-- Registration Form -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Create an Account</h2>
                        
                        <?php if (!empty($message)) echo $message; ?>
                        
                        <form method="POST" novalidate autocomplete="off">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="mot_de_passe" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="verification" required>
                            </div>
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role" required>
                                    <option value="1">Administrator</option>
                                    <option value="2">Farmer</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success" name="entrer">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Chatbot Button -->
<button id="open-chatbot" class="chatbot-popup">💬</button>

<!-- Chatbot -->
<div id="chatbot">
    <div id="chatbot-header">
        <h4>Assistant Virtuel</h4>
        <button id="close-chatbot">&times;</button>
    </div>
    <div id="chatbot-body">
        <div id="chatbot-messages"></div>
        <input type="text" id="chatbot-input" placeholder="Posez une question...">
        <button id="send-chatbot">Envoyer</button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Chatbot functionality and script here...
    
  const chatbot = document.getElementById("chatbot");
  const openChatbot = document.getElementById("open-chatbot");
  const closeChatbot = document.getElementById("close-chatbot");
  const sendChatbot = document.getElementById("send-chatbot");
  const chatbotInput = document.getElementById("chatbot-input");
  const chatbotMessages = document.getElementById("chatbot-messages");

  // Show chatbot
  openChatbot.addEventListener("click", () => {
    chatbot.style.display = "flex";
    openChatbot.style.display = "none";
  });

  // Hide chatbot
  closeChatbot.addEventListener("click", () => {
    chatbot.style.display = "none";
    openChatbot.style.display = "block";
  });

  // Handle sending messages
  sendChatbot.addEventListener("click", () => {
    const userMessage = chatbotInput.value.trim();
    if (userMessage) {
      appendMessage("Vous", userMessage);
      chatbotInput.value = "";
      getBotResponse(userMessage);
    }
  });

  // Append a message to the chatbot
  function appendMessage(sender, message) {
    const msgDiv = document.createElement("div");
    msgDiv.innerHTML = `<strong>${sender}:</strong> ${message}`;
    chatbotMessages.appendChild(msgDiv);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
  }

// Generate bot response
function getBotResponse(message) {
    let response = "";
    switch (message.toLowerCase()) {
        case "bonjour":
        case "salut":
            response = "Bonjour ! Comment puis-je vous aider ?";
            break;
        case "quel est objectif principal de ce site ?":
            response = "Ce site est conçu pour vendre vos produits ou acheter des produits avec des prix raisonnables il contient des agriculteurs et tout ce qui touche à lagriculture.";
            break;
        case "comment puis-je inscrire pour utiliser les services du site ?":
            response = "Vous pouvez créer un compte directement sur cette page.";
            break;
        case "le site est-il destiné uniquement aux agriculteurs, ou tout le monde peut y participer ?":
            response = "Tout le monde peut y participer, pas uniquement les agriculteurs.";
            break;
        case "puis-je vendre mes propres produits agricoles sur ce site ?":
            response = "Oui, vous pouvez vendre vos propres produits agricoles sur ce site.";
            break;
        default:
            // Propose une liste de questions disponibles
            response = `
                Désolé, je ne connais pas la réponse à cette question pour l'instant.<br>
                Voici quelques questions que vous pouvez poser :
                <ul>
                    <li><button onclick="setSuggestedQuestion('Quel est objectif principal de ce site ?')">Quel est objectif principal de ce site ?</button></li>
                    <li><button onclick="setSuggestedQuestion('Comment puis-je inscrire pour utiliser les services du site ?')">Comment puis-je inscrire pour utiliser les services du site ?</button></li>
                    <li><button onclick="setSuggestedQuestion('Le site est-il destiné uniquement aux agriculteurs, ou tout le monde peut y participer ?')">Le site est-il destiné uniquement aux agriculteurs, ou tout le monde peut y participer ?</button></li>
                    <li><button onclick="setSuggestedQuestion('Puis-je vendre mes propres produits agricoles sur ce site ?')">Puis-je vendre mes propres produits agricoles sur ce site ?</button></li>
                </ul>
            `;
    }
    appendMessage("Chatbot", response);
}

// Fonction pour insérer la question choisie
function setSuggestedQuestion(question) {
    chatbotInput.value = question;
    sendChatbot.click(); // Simule le clic pour envoyer la question automatiquement
}


    // Validate the form before submission
    document.getElementById('registerForm').addEventListener('submit', function (e) {
        let isValid = true;
        

        // Clear previous error messages
        document.getElementById('nameError').textContent = '';
        document.getElementById('emailError').textContent = '';
        document.getElementById('passwordError').textContent = '';
        document.getElementById('confirmPasswordError').textContent = '';
        document.getElementById('roleError').textContent = '';

        // Get form values
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const confirmPassword = document.getElementById('password_confirmation').value.trim();
        const role = document.getElementById('role').value.trim();
       

        // Validate name
        if (name === '') {
            document.getElementById('nameError').textContent = 'Name is required.';
            isValid = false;
        }

        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            document.getElementById('emailError').textContent = 'Email is required.';
            isValid = false;
        } else if (!emailRegex.test(email)) {
            document.getElementById('emailError').textContent = 'Invalid email format.';
            isValid = false;
        }

        // Validate password
        if (password === '') {
            document.getElementById('passwordError').textContent = 'Password is required.';
            isValid = false;
        }

        // Validate confirm password
        if (confirmPassword === '') {
            document.getElementById('confirmPasswordError').textContent = 'Please confirm your password.';
            isValid = false;
        } else if (password !== confirmPassword) {
            document.getElementById('confirmPasswordError').textContent = 'Passwords do not match.';
            isValid = false;
        }
         // Validation du rôle
         if (role !== '0' && role !== '1' &&  role !== '2' ) {
                document.getElementById('roleError').textContent = 'Rôle invalide.';
                isValid = false;
            }

        // Prevent form submission if validation fails
        if (!isValid) {
            e.preventDefault();
        }
    });

    
</script>

</body>
</html>

