<?php
include '../../../Controller/PostController.php';

$postController = new PostController();


if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $postController->increaseLikes($postId);
}


header("Location: post.php");
exit;
?>
