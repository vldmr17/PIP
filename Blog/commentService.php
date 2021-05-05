<?php
session_start();
$link=mysqli_connect("localhost", "root", "12345678", "db_blog");

mysqli_query($link,"INSERT INTO comments SET text='".$_POST['comment']."', date = NOW(), article_id=".$_GET['article'].", author_id=".$_SESSION['id']);
header("Location: http://localhost:63342/Blog/articlePage.php/?article=".$_GET['article']);
exit;
?>
