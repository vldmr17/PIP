<?php
$link=mysqli_connect("localhost", "root", "12345678", "db_blog");

if ($_GET['type'] === 'block') {
    mysqli_query($link, "UPDATE users SET isBanned = true WHERE id=".$_GET['user']);
    header("Location: http://localhost:63342/Blog/usersList.php");
    exit;
} else {
    mysqli_query($link, "UPDATE users SET isBanned = false WHERE id=".$_GET['user']);
    header("Location: http://localhost:63342/Blog/usersList.php");
    exit;
}
?>

