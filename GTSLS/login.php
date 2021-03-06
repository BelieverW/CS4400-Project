<?php session_start() ?>
<?php
$userNotExist = FALSE;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        include "dbinfo.php";

        $myusername = mysqli_real_escape_string($db, $_POST['username']);
        $mypassword = mysqli_real_escape_string($db, $_POST['password']);

        $sql = "SELECT UName, UserType, Year, MName FROM USER WHERE UName = '$myusername' and Pw = '$mypassword'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //$active = $row['active'];

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {
            $_SESSION['login_user'] = $myusername;
            $_SESSION['user_type'] = $row["UserType"];
            $_SESSION['user_year'] = $row['Year'];
            $_SESSION['user_major'] = $row['MName'];
            if ($row['UserType'] == 'student') {
                header("location: index_user.php");
            } else if ($row['UserType'] == 'admin') {
                header("location: index_admin.php");
            } else {
                header("location: 404.html");
            }
        } else {
            $userNotExist = TRUE;
        }
        $db->close();
    }
}

?>
<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Georgia Tech SLS System</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Team-56">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>
    <link rel="SHORTCUT ICON" href="images/GTYellowJacketSmall.png">



    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">

</head>
<body class=" theme-blue">

<!-- Demo page code -->

<script type="text/javascript">
    $(function() {
        var match = document.cookie.match(new RegExp('color=([^;]+)'));
        if(match) var color = match[1];
        if(color) {
            $('body').removeClass(function (index, css) {
                return (css.match (/\btheme-\S+/g) || []).join(' ')
            })
            $('body').addClass('theme-' + color);
        }

        $('[data-popover="true"]').popover({html: true});

    });
</script>
<style type="text/css">
    #line-chart {
        height:300px;
        width:800px;
        margin: 0px auto;
        margin-top: 1em;
    }
    .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover {
        color: #fff;
    }
</style>

<script type="text/javascript">
    $(function() {
        var uls = $('.sidebar-nav > ul > *').clone();
        uls.addClass('visible-xs');
        $('#main-menu').append(uls.clone());
    });
</script>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="../assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">


<!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
<!--[if IE 7 ]> <body class="ie ie7 "> <![endif]-->
<!--[if IE 8 ]> <body class="ie ie8 "> <![endif]-->
<!--[if IE 9 ]> <body class="ie ie9 "> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->

<!--<![endif]-->

<div class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <a class="" href="index.php"><span class="navbar-brand"><img src="images/GTYellowJacket3.png" height="30"></span> <span class="navbar-brand">Georgia Tech SLS</span></a></div>

    <div class="navbar-collapse collapse" style="height: 1px;">

    </div>
</div>
</div>


<div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Sign In</p>
        <div class="panel-body">
            <form role="form" action="login.php" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control span12" name="username"/>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-controlspan12 form-control" name="password"/>
                </div>
                <?php
                    if ($userNotExist === TRUE) {
                        echo '<p class="text-danger" id="msg">
                                <strong>Your Login Name or Password is invalid.</strong>
                            </p>';
                        echo '<script>
                                 window.setTimeout("hideMsg()", 10000);
                              </script>';
                    }
                ?>
                <input class="btn btn-primary pull-right" type="submit" name="submit" value="Log In" />
                <label class="remember-me"><input type="checkbox"> Remember me</label>
                <div class="clearfix"></div>
                <div class="alert alert-warning alert-dismissible" role="alert" id="info">
                    <p>All users must login before using this application. There are two
                        types of users: students and admin.</p>
                    <div class="row">
                        <div class="col-sm-6">Student<br>
                            <ul>
                                <li>Username: demo123</li>
                                <li>Password: demo</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">Admin<br>
                            <ul>
                                <li>Username: admin</li>
                                <li>Password: 1234</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <p class="pull-right" style=""><a href="signup.php" style="font-size: .75em; margin-top: .25em;">Don't have an account? Get Started</a></p>
    <p><a href="reset-password.html">Forgot your password?</a></p>
    <p>For more information, please click this <a href="https://github.com/BelieverW/CS4400-Project" target="_blank">link</a></p>
</div>





<script src="lib/bootstrap/js/bootstrap.js"></script>
<script src="lib/d3.v3.min.js"></script>
<script type="text/javascript">
    function hideMsg() {
        d3.select("#msg").remove();
    }
</script>


</body></html>


