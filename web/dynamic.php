<html>
<title><?php echo $_REQUEST['title']; ?> <?php echo $_REQUEST['name']; ?></title>
<head>
    <style>
        .bio{
            padding-left:200px;
            width:600px;
        }
    </style>
</head>
<body>
<div class="bio">
    <h1><?php echo $_REQUEST['title']; ?> <?php echo $_REQUEST['name']; ?></h1>
    <img src="<?php echo $_REQUEST['image']; ?>" width="150px" height="200px"/>
    <p>Name : <?php echo $_REQUEST['name']; ?><p>
    <p>Born : <?php echo $_REQUEST['born']; ?><p>
    <p>Country : <?php echo $_REQUEST['country']; ?><p>
    <p>Short biography : </p>
    <p><?php echo $_REQUEST['desc']; ?><p>
</div>
</body>
</html>