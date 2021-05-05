<?php
$servername = "127.0.0.1";
$username = "root";
$password = "12345678";
$dbName = "db_blog";

$mysqli = new mysqli($servername, $username, $password, $dbName);

if ($mysqli -> connect_error) {
    printf("Соединение не удалось: %s\n", $mysqli -> connect_error);
    exit();
};
