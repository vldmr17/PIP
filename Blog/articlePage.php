<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$link=mysqli_connect("localhost", "root", "12345678", "db_blog");
$query = mysqli_query($link, "SELECT text, title, author_id, date FROM articles WHERE id=".$_GET['article']);
$row = mysqli_fetch_assoc($query);
$text1 = str_replace("{cat}","",$row['text']);
$text = str_replace("{/cat}","",$text1);

$href = "http://localhost:63342/Blog/writeComment.php/?article=".$_GET['article'];
$deleteHref = "http://localhost:63342/Blog/deleteArticle.php/?article=".$_GET['article'];
$commentsQuery =$link->query("SELECT c.id, c.author_id, c.text, c.date, u.login FROM comments c JOIN users u ON c.author_id = u.id WHERE c.article_id=".$_GET['article']);

?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="http://localhost:63342/Blog/index.css" rel="stylesheet" type="text/css"/>
</head>
<div class="">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item active">
                <a class="nav-link" href="auth.php/?authtype=signout">Sign Out</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://localhost:63342/Blog/home.php">Go Back</a>
            </li>
            <li class="nav-item">
                <?php if($_SESSION['id'] === $row['author_id'] || $_SESSION['isAdmin'] === true) {?>
                    <a class="nav-link" href="<?php echo $deleteHref; ?>">Delete</a>
                <?php } ?>
            </li>
        </ul>
    </nav>


</div>
<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5 mx-auto">
            <h1><?php echo  $row['title']?></h1>
            <a><?php echo $text?></a><br>
            <a><?php echo $row['date']?></a>
</div>
<br><br>
<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5 mx-auto" >
    <h2>Comments</h2>
    <a href="<?php echo $href; ?>">Write a comment</a><br>
    <?php while($comment = $commentsQuery ->fetch_assoc()){ ?>
        <div class="article">
            <h3><?php echo $comment['login'] ?></h3>
            <a><?php echo $comment['text'] ?></a><br>
            <a><?php echo $comment['date'] ?></a><br>
        </div>

    <?php } ?>
</div>
