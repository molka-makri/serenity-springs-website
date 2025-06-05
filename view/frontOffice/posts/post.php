<?php
include '../../../Controller/PostController.php';
include '../../../Controller/CommentController.php';

$postController = new PostController();
$posts = $postController->listPosts();

function getCommentsByPostId($postId) {
    $commentController = new CommentController();
    return $commentController->getCommentsByPostId($postId); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Posts</title>
    <link href="../TheEvent1/img/favicon.ico" rel="icon">
    <link href="../TheEvent1/img/favicon.ico" type="img/x-icon" rel="apple-touch-icon">

    <style>


body {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    color: #333;
    animation: fadeIn 1.5s ease-out, backgroundSlide 30s infinite; /* Apply both fade-in and background slideshow animations */
    background-size: cover;
    background-position: center;
    height: 100vh; /* Ensure the background covers the full viewport height */
}

/* Animation for fading in the content */

/* Animation for fading in the content */
@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

/* Header styling */
header {
    background: linear-gradient(135deg, #388e3c, #66bb6a);
    color: white;
    padding: 1.5rem;
    text-align: center;
    border-bottom: 5px solid #2c6e2f;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    animation: slideIn 0.5s ease-out;
}

@keyframes slideIn {
    0% {
        transform: translateY(-50px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}
@keyframes backgroundSlide {
    0% {
        background: url('../images/85.jpg') center center / cover no-repeat fixed;
    }
    16.67% {
        background: url('../images/86.jpg') center center / cover no-repeat fixed;
    }
    33.33% {
        background: url('../images/87.jpg') center center / cover no-repeat fixed;
    }
    50% {
        background: url('../images/88.jpg') center center / cover no-repeat fixed;
    }
    66.67% {
        background: url('../images/89.jpg') center center / cover no-repeat fixed;
    }
   
}


/* Navigation Bar Styling */
.navigation {
    background-color: #2c6e2f;
    padding: 10px 0;
    text-align: center;
}

.nav-menu {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 20px;
}

.nav-menu li {
    display: inline;
}

.nav-menu a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    padding: 10px 15px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.nav-menu a:hover {
    background-color: #66bb6a;
    color: #fff;
}

/* Main content area */
main {
    max-width: 800px;
    margin: 20px auto;
    padding: 25px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.8);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Post styling */
.post {
    background: #fff;
    margin-bottom: 20px;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.post:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
}

.post h2 {
    margin-top: 0;
    color: #388e3c;
    font-size: 1.6rem;
}

.post p {
    color: #555;
    line-height: 1.6;
}

/* Like button and comment section */
.like-info {
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.like-button {
    display: inline-block;
    padding: 5px 10px;
    color: white;
    text-decoration: none;
    background-color: #388e3c;
    border-radius: 5px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.like-button:hover {
    background-color: #2c6e2f;
}

.likes-count {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
}

.likes-count span {
    margin-left: 10px;
    font-size: 20px;
    color: #007bff;
}

.comments {
    margin-top: 20px;
}

.actions {
    margin-top: 10px;
    text-align: center;
}

.actions a {
    text-decoration: none;
    color: #388e3c;
    font-weight: bold;
    padding: 8px 15px;
    border: 2px solid #388e3c;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.actions a:hover {
    background-color: #388e3c;
    color: #fff;
}

/* Button for adding posts */
.add-post-btn-container {
    text-align: left;
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 10;
}

.add-post-btn {
    display: inline-block;
    padding: 12px 18px;
    background-color: #388e3c;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.add-post-btn:hover {
    background-color: #2c6e2f;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Image styling */
.post-image img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px;
}

@media (max-width: 600px) {
    body {
        padding: 10px;
    }

    header {
        font-size: 1.2rem;
    }

    .post {
        padding: 15px;
    }

    .add-post-btn {
        font-size: 14px;
    }
}
    </style>
</head>
<body>
    <header>
        <h1>Social Posts</h1>
    </header>

    <div class="navigation">
        <ul class="nav-menu">
            <li><a href="../index.html">Home</a></li>
            <li><a href="../#about">About</a></li>
            <li><a href="../productPage.php">Products</a></li>
            <li><a href="../TheEvent1/index.php">Events</a></li>
        </ul>
    </div>

    <main>
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2><?php echo htmlspecialchars($post['content']); ?></h2>
                    <p><small>Posted on: <?php echo htmlspecialchars($post['created_at']); ?></small></p>

                    <!-- Display Image if Exists -->
                    <?php if (!empty($post['image_path'])): ?>
                        <div class="post-image">
                            <img src="../../../uploads/<?php echo basename($post['image_path']); ?>" alt="Post Image">
                        </div>
                    <?php endif; ?>

                    <div class="comments">
                        <?php 
                        $postComments = getCommentsByPostId($post['id']);
                        if (!empty($postComments)): ?>
                            <?php foreach ($postComments as $comment): ?>
                                <p><strong>Comment:</strong> <?php echo htmlspecialchars($comment['content']); ?></p>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No comments for this post.</p>
                        <?php endif; ?>
                    </div>

                    <div class="actions">
                        <div class="like-info">
                            <p class="likes-count">Likes: <span><?php echo htmlspecialchars($post['likes']); ?></span></p>
                            <a href="increaseLikes.php?post_id=<?php echo urlencode($post['id']); ?>" class="like-button">
                                <img src="../images/like1.png" alt="like image" class="like-button-img">
                            </a>
                        </div>

                        <a href="addComment.php?post_id=<?php echo urlencode($post['id']); ?>">Add Comment</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center;">No posts available.</p>
        <?php endif; ?>
    </main>

    <div class="add-post-btn-container">
        <a href="addPost.php" class="add-post-btn">Add New Post</a>
    </div>
</body>
</html>
