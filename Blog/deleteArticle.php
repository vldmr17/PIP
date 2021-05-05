<?php
$link=mysqli_connect("localhost", "root", "12345678", "db_blog");
$query = mysqli_query($link, "DELETE FROM articles WHERE id=".$_GET['article']);
$query = mysqli_query($link, "DELETE FROM comments WHERE article_id=".$_GET['article']);
header("Location: http://localhost:63342/Blog/home.php");
exit;
?>
