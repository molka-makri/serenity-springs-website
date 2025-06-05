<?php
include '../../../Controller/PostController.php';
$postController = new PostController();
$postController->deletePost($_GET['id']);
header('Location: listPosts.php');
?>
