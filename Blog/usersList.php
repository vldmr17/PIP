
<?php
$link=mysqli_connect("localhost", "root", "12345678", "db_blog");
$query =$link->query("SELECT * FROM users");
$row = mysqli_fetch_assoc($query);
$href = "http://localhost:63342/Blog/userService.php/?user=";
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
        </ul>
    </nav>


</div>
<div class="col-xs-12 col-sm-9 col-md-5 col-lg-5 mx-auto" >
    <h1>Users List</h1>
<?php while($user = $query ->fetch_assoc()){ ?>
    <?php if(!$user['isAdmin']){?>
    <?php if(!$user['isBanned']) {?>
            <div class="article">
                <h4><?php echo $user['login'] ?></h4><a href=<?php echo $href.$user['id']."&type=block"?>>Block user</a><br></div>
    <?php } else {?>
            <div class="article"><h4><?php echo $user['login'] ?></h4><a href="<?php echo $href.$user['id']."&type=unblock"; ?>">Unblock user</a><br></div>
    <?php } }?>
<?php } ?>
</div>
