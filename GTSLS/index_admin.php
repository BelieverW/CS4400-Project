<?php session_start() ?>
<?php
    include "checkuser.php";
    include "checkuser_admin.php";
    $username = $_SESSION['login_user'];
    $usertype = $_SESSION['user_type'];
?>

<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Georgia Tech SLS System</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>
    <link rel="SHORTCUT ICON" href="images/GTYellowJacketSmall.png">


    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">


    <!-- Latest compiled and minified JavaScript -->
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <!-- Latest compiled and minified Locales -->
    <script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

</head>
<body class=" theme-blue">


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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="" href="index_admin.php"><span class="navbar-brand"><img src="images/GTYellowJacket3.png" height="30"></span> <span class="navbar-brand">Georgia Tech SLS</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
            <ul id="main-menu" class="nav navbar-nav navbar-right">
                <li class="dropdown hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?php echo $username;?>
                        <i class="fa fa-caret-down"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="reset-password.html">Reset Password</a></li>
                        <li><a tabindex="-1" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>



    <div class="sidebar-nav">
            <ul>
                <li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li>
                <li><ul class="dashboard-menu nav nav-list collapse in">
                        <li class="active"><a href="index_admin.php"><span class="fa fa-caret-right"></span> Main</a></li>
                        <li><a href="admin-view-application.php"><span class="fa fa-caret-right"></span> View Applications</a></li>
                        <li><a href="admin-popular-project.php"><span class="fa fa-caret-right"></span> Popular Project</a></li>
                        <li><a href="admin-application-report.php"><span class="fa fa-caret-right"></span> Application Report</a></li>
                    </ul></li>

                <li><a href="#" data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Add Project/Course<i class="fa fa-collapse"></i></a></li>
                <li><ul class="legal-menu nav nav-list collapse">
                        <li><a href="add-project.php"><span class="fa fa-caret-right"></span> Add a Project</a></li>
                        <li><a href="add-course.php"><span class="fa fa-caret-right"></span> Add a Course</a></li>
                    </ul></li>

            </ul>
    </div>

    <div class="content">
        <div class="header">
            <div class="stats">
    <p class="stat"><span class="label label-success" id="year"></span> Year</p>
    <p class="stat"><span class="label label-success" id="month"></span> Month</p>
    <p class="stat"><span class="label label-success" id="day"></span> Day</p>
</div>

            <h1 class="page-title">Welcome! <?php echo $username;?></h1>
                    <ul class="breadcrumb">
            <li><a href="index.php">Home</a> </li>
            <li class="active">Dashboard</li>
        </ul>

        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="panel panel-default">
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse">For Admin </a>
                        <div id="widget1container" class="panel-body collapse in">
                            <h2>Here's the introduction</h2>
                            <p>This database has the following function :</p>
                            <p>1. Add a project or course</p>
                            <p>2. View applications and decide to accept or reject</p>
                            <p>3. View popular application report to know the top 10 projects with most applications
                            <p>4. View application report to know the detail on number of applications and acceptance rate
                    </div>
                </div>
            </div>
        </div>



            <footer>
                <hr>
                <p>© 2016 <a href="http://www.gatech.edu/" target="_blank">Georgia Tech</a></p>
            </footer>
        </div>
    </div>


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script src="lib/angular/angular.min.js"></script>
    <script>
        $(document).ready(function() {
            var date = new Date();
            document.getElementById("year").innerHTML = date.getFullYear();
            document.getElementById("month").innerHTML = date.getMonth() + 1;
            document.getElementById("day").innerHTML = date.getDate();
        })
    </script>
    
  
</body></html>
