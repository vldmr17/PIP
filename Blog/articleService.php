<?php
session_start();
$link=mysqli_connect("localhost", "root", "12345678", "db_blog");


    mysqli_query($link,"INSERT INTO articles SET title='".$_POST['title']."', text='".$_POST['text']."', author_id =".$_SESSION['id'].", date  = NOW()");
    header("Location: http://localhost:63342/Blog/home.php");
    exit;
?>
