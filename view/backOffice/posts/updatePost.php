<?php
include '../../../Controller/PostController.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid Post ID.";
    exit;
}

$postController = new PostController();
$post = $postController->getPost($_GET['id']);
if (!$post) {
    echo "Post not found.";
    exit;
}

$error = '';
$imagePath = $post['image_path']; // المسار الحالي للصورة

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));

    $bannedWords = [
        'damn', 'hell', 'idiot', 'stupid', 'fool', 'crap', 'bastard', 'jerk', 'moron', 'asshole', 'dumb', 'shit', 'bitch', 'f***','a**', 'c***', 'slut', 'whore'
    ];

    foreach ($bannedWords as $word) {
        if (stripos($title, $word) !== false || stripos($content, $word) !== false) {
            $error = "The post contains inappropriate language. Please revise your text.";
            break;
        }
    }

    if (!$error) {
        if (!preg_match('/^[A-Za-z0-9\s.,!?()-]+$/', $title)) {
            $error = "Invalid title: Only letters, numbers, spaces, and basic punctuation are allowed.";
        } elseif (strlen($content) < 10) {
            $error = "Content must be at least 10 characters long.";
        } elseif (!preg_match('/^[A-Za-z0-9\s.,!?()ء-ي]+$/u', $content)) {
            $error = "Content contains invalid characters. Only letters, numbers, and basic punctuation are allowed.";
        } else {
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

            // تحديث المنشور إذا لم يكن هناك أخطاء
            if (!$error) {
                $updatedPost = new Post($_GET['id'], $title, $content, $imagePath);
                $postController->updatePost($updatedPost);

                header('Location: listPosts.php');
                exit;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa; 
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
        input, textarea, button {
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
        img {
            max-width: 100%;
            margin-bottom: 15px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>Update Post</h1>

    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>

        <label for="content">Content</label>
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>

        <?php if (!empty($post['image_path'])): ?>
            <label>Current Image</label>
            <img src="../../uploads/<?php echo htmlspecialchars($post['image_path']); ?>" alt="Post Image">
        <?php endif; ?>

        <label for="image">Upload New Image</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Update Post</button>
    </form>
</body>
</html>
