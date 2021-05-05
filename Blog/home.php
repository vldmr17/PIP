<?php
session_start();
$link=mysqli_connect("localhost", "root", "12345678", "db_blog");
//делаем вывод всех статей

//функция возвращает первые 80 слов из строки
function get_words($sentence, $count = 80) {
    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
    return $matches[0];
}

?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link rel=stylesheet type="text/css" href="index.css">
</head>
<div class="">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="auth.php/?authtype=signout">Sign Out</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="writeArticle.php/?type=add">Write new article</a>
            </li>
            <li class="nav-item">
                <?php if($_SESSION['isAdmin'] === true) {?>
                    <a class="nav-link" href="http://localhost:63342/Blog/usersList.php">Users list</a>
                <?php } ?>
            </li>
        </ul>
    </nav>
</div>
<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5 mx-auto">
<center>
    <h1>Welcome, <?php echo $_SESSION['login']?></h1>
</center>

        <?php
        $query =$link->query("SELECT * FROM articles ORDER BY date DESC");
        while($row = $query ->fetch_assoc()){ ?>
            <?php $href = "http://localhost:63342/Blog/articlePage.php/?article=".$row['id'] ?>
            <?php if (preg_match('~{cat}([^{]*){/cat}~i', $row['text'], $match)) { ?>
                <div class="article">
                <a href="<?php echo $href; ?>"><h1><?php echo $row['title'] ?></h1></a>
                <a><?php echo $match[1] ?></a><br>
                </div><?php } else {?>
                <div class="article">
                <a href="<?php echo $href; ?>"><h1><?php echo $row['title'] ?></h1></a>
                <a><?php echo get_words($row['text']); ?></a><br>
                </div> <?php } ?>
        <?php } ?>

</div>



