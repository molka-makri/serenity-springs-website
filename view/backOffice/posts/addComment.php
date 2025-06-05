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
              
                $commentController = new CommentController();
                $commentController->addComment(new Comment(null, $postId, $content));

               
                header('Location: listComments.php');
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
            background-color: #f0f8ff; 
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-top: 40px;
        }
        form {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Add Comment</h1>

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
</body>
</html>
