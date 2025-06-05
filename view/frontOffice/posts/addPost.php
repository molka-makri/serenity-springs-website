<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #d4e8d4, #9cbfa9);
            color: #2e4d34;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }
        .form-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        button {
            background-color: #5d946b;
            color: #fff;
            border: none;
            transition: transform 0.2s, background-color 0.3s;
        }
        button:hover {
            background-color: #497a55;
            transform: scale(1.05);
        }
        .error {
            color: #b33a3a;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<?php
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include '../../../Controller/PostController.php';

    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $imagePath = null;

    $bannedWords = ['damn', 'hell', 'idiot', 'stupid', 'fool', 'crap', 'bastard', 'jerk', 'moron', 'asshole', 'dumb', 'shit', 'bitch', 'f***', 'a**', 'c***', 'slut', 'whore'];

    foreach ($bannedWords as $word) {
        if (stripos($title, $word) !== false || stripos($content, $word) !== false) {
            $error = "The input contains inappropriate words. Please revise your text.";
            break;
        }
    }

    if (!$error && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $uploadDir = '../../../uploads/';
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (!in_array($_FILES['image']['type'], $allowedTypes)) {
            $error = "Invalid image type. Only JPG, PNG, and GIF are allowed.";
        } elseif (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        } elseif (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $error = "Failed to upload image.";
        }
    }

    if (!$error) {
        if (!preg_match('/^[A-Za-z0-9\s.,!?()-]+$/', $title)) {
            $error = "Invalid title: Only letters, numbers, spaces, and basic punctuation are allowed.";
        } elseif (strlen($title) < 5 || strlen($title) > 100) {
            $error = "Title must be between 5 and 100 characters.";
        } elseif (strlen($content) < 10) {
            $error = "Content must be at least 10 characters long.";
        } else {
            $post = new Post(null, $title, $content, $imagePath);
            $postController = new PostController();
            $postController->addPost($post);
            header('Location: post.php');
            exit;
        }
    }
}
?>

<div class="form-container">
    <form action="" method="POST" enctype="multipart/form-data">
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert"> <?php echo $error; ?> </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" 
                   minlength="5" maxlength="100" 
                   pattern="^[A-Za-z0-9\s.,!?()-]+$" 
                   title="Only letters, numbers, spaces, and basic punctuation are allowed."
                   required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" 
                      minlength="10" required><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success w-100">Add Post</button>
    </form>

    
</div>

</body>
</html>
