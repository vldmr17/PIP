<?php
session_start();
$link=mysqli_connect("localhost", "root", "12345678", "db_blog");

if($_GET['authtype'] == 'signup'){

    $err = [];

    //ищем пользователя с введенным логином в бд
    $query = mysqli_query($link, "SELECT id FROM users WHERE login='".mysqli_real_escape_string($link, $_POST['login'])."'");

    if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    if(count($err) == 0)
    {

        //добавляем нового пользователя в бд
        mysqli_query($link,"INSERT INTO users SET login='".$_POST['login']."', password='".md5($_POST['password'])."', isAdmin = 0 , isBanned = 0");

        //получаем id пользователя
        $userid = mysqli_query($link, "SELECT id FROM users WHERE login='".mysqli_real_escape_string($link, $_POST['login'])."'");

        $row = mysqli_fetch_assoc($userid);

        //устанавливаем id сессии
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['isAdmin'] = false;

        header("Location: http://localhost:63342/Blog/index.php");
        exit;
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
} elseif($_GET['authtype'] == 'signin') {
    //получаем из бд пользователя с введенным логином
    $query = mysqli_query($link,"SELECT id, password, isAdmin, isBanned FROM users WHERE login='".mysqli_real_escape_string($link,$_POST['login'])."' LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if($data['password'] === md5($_POST['password'])) {
        if($data['isAdmin'] == false) {
            if($data['isBanned'] == false) {
                //успешная авторизация обычного пользователя
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['id'] = $data['id'];
                $_SESSION['isAdmin'] = false;
                header("Location: http://localhost:63342/Blog/index.php");
                exit;
            } else {
                echo 'sorry, your account is banned';
            }
        } else {
            //успешная авторизация админа
            $_SESSION['login'] = $_POST['login'];
            $_SESSION['id'] = $data['id'];
            $_SESSION['isAdmin'] = true;
            header("Location: http://localhost:63342/Blog/index.php");
            exit;
        }
    } else {
        echo 'incorrect password';
    }
} elseif ($_GET['authtype'] == 'signout'){
    //уничтожаем сессию и выходим из аккаунта
    unset($_SESSION['login']);
    unset($_SESSION['id']);
    unset($_SESSION['isAdmin']);
    header("Location: http://localhost:63342/Blog/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<title>Auth Failed</title>
<body>
<a href="http://localhost:63342/Blog/index.php">Go Back</a>
</body>
</html>
