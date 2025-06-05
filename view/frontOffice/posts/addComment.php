<?php
include '../../../Controller/CommentController.php';

if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $content = htmlspecialchars(trim($_POST['content']));

        $bannedWords = [
            'damn', 'hell', 'idiot', 'stupid', 'fool', 'crap', 'bastard', 'jerk', 'moron', 'asshole', 'dumb', 'shit', 'bitch', 'f***','a**', 'c***', 'slut', 'whore'
        ];

        // Check for banned words
        foreach ($bannedWords as $word) {
            if (stripos($content, $word) !== false) {
                $error = "The comment contains inappropriate language. Please revise your text.";
                break;
            }
        }

        if (!$error) {
            if (strlen($content) < 5) {
                $error = "Content must be at least 5 characters long.";
            } elseif (!preg_match('/^[A-Za-z0-9\s.,!?()]+$/u', $content)) {
                $error = "Content contains invalid characters. Only letters, numbers, and basic punctuation are allowed.";
            } else {
                // Add the comment to the database
                $commentController = new CommentController();
                $commentController->addComment(new Comment(null, $postId, $content));

                // Redirect to the post page
                header('Location: post.php');
                exit;
            }
        }
    }
} else {
    echo "Invalid post ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Comment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #c8e6c9; /* Soft light green background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .form-container {
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            opacity: 0;
            animation: fadeIn 1s forwards; /* Fade-in animation */
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #388e3c; /* Green label */
        }
        textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #388e3c;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2c6e2f;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add Your Comment</h1>

        <?php if (isset($error) && $error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="content">Content</label>
            <textarea id="content" name="content" minlength="5" 
                      pattern="^[A-Za-z0-9\s.,!?()ء-ي]+$" 
                      title="Only letters, numbers, spaces, and basic punctuation are allowed." 
                      required><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>

            <button type="submit">Add Comment</button>
        </form>
    </div>
</body>
</html>
