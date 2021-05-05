<?php
session_start();
$href = "http://localhost:63342/Blog/commentService.php/?article=".$_GET['article'];
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <link href="http://localhost:63342/Blog/index.css" rel="stylesheet" type="text/css"/>
</head>

<form action="<?php echo $href ?>" method="POST" id="text">
    <div class="container containerTop">
        <div class="col-xs-12 col-sm-9 col-md-5 col-lg-5 mx-auto">
            <h1>Write new comment</h1>
            <label for="comment"><b>Comment</b></label><br>
    <input type="text" name="comment" value=""><br>
    <input type="submit" class="registerbtn">
        </div>
    </div>
</form>
