<?php
include '../../../Controller/CommentController.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid Comment ID.";
    exit;
}

$commentController = new CommentController();
$commentController->deleteComment($_GET['id']);


header('Location: listComments.php');
exit;
?>

