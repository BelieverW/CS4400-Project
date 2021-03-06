<?php session_start() ?>
<?php
    $username = $_SESSION['login_user'];
    $usertype = $_SESSION['user_type'];
?>

<!doctype html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Bootstrap Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>

        <script src="lib/jQuery-Knob/js/jquery.knob.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $(".knob").knob();
        });
    </script>


    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">

</head>
<body class=" theme-blue">


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
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="" href="index.php"><span class="navbar-brand"><img src="images/GTYellowJacket3.png" height="30"></span> <span class="navbar-brand">Georgia Tech SLS</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">
            <ul id="main-menu" class="nav navbar-nav navbar-right">
                <li class="dropdown hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> Jack Smith
                        <i class="fa fa-caret-down"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="./">My Account</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Admin Panel</li>
                        <li><a href="./">Users</a></li>
                        <li><a href="./">Security</a></li>
                        <li><a tabindex="-1" href="./">Payments</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="login.html">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
    

    <div class="sidebar-nav">
    <ul>
    <li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li>
    <li><ul class="dashboard-menu nav nav-list collapse in">
            <li><a href="index.php"><span class="fa fa-caret-right"></span> Main</a></li>
            <li ><a href="users.html"><span class="fa fa-caret-right"></span> User List</a></li>
            <li ><a href="user.php"><span class="fa fa-caret-right"></span> User Profile</a></li>
            <li ><a href="media.html"><span class="fa fa-caret-right"></span> Media</a></li>
            <li ><a href="calendar.html"><span class="fa fa-caret-right"></span> Calendar</a></li>
    </ul></li>

    <li data-popover="true" data-content="Items in this group require a <strong><a href='http://portnine.com/bootstrap-themes/aircraft' target='blank'>premium license</a><strong>." rel="popover" data-placement="right"><a href="#" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-fighter-jet"></i> Premium Features<i class="fa fa-collapse"></i></a></li>
        <li><ul class="premium-menu nav nav-list collapse">
                <span class="visible-xs visible-sm"><a href="#">- Premium features require a license -</a></span>
            <li ><a href="premium-profile.html"><span class="fa fa-caret-right"></span> Enhanced Profile</a></li>
            <li ><a href="premium-blog.html"><span class="fa fa-caret-right"></span> Blog</a></li>
            <li ><a href="premium-blog-item.html"><span class="fa fa-caret-right"></span> Blog Page</a></li>
            <li ><a href="premium-pricing-tables.html"><span class="fa fa-caret-right"></span> Pricing Tables</a></li>
            <li ><a href="premium-upgrade-account.html"><span class="fa fa-caret-right"></span> Upgrade Account</a></li>
            <li ><a href="premium-widgets.html"><span class="fa fa-caret-right"></span> Widgets</a></li>
            <li ><a href="premium-timeline.html"><span class="fa fa-caret-right"></span> Activity Timeline</a></li>
            <li ><a href="premium-users.html"><span class="fa fa-caret-right"></span> Enhanced Users List</a></li>
            <li ><a href="premium-media.html"><span class="fa fa-caret-right"></span> Enhanced Media</a></li>
            <li ><a href="premium-invoice.html"><span class="fa fa-caret-right"></span> Invoice</a></li>
            <li ><a href="premium-build.html"><span class="fa fa-caret-right"></span> Advanced Tools</a></li>
            <li ><a href="premium-colors.html"><span class="fa fa-caret-right"></span> Additional Color Themes</a></li>
    </ul></li>

        <li><a href="#" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i> Account <span class="label label-info">+3</span></a></li>
        <li><ul class="accounts-menu nav nav-list collapse">
            <li ><a href="login.html"><span class="fa fa-caret-right"></span> Sign In</a></li>
            <li ><a href="signup.php"><span class="fa fa-caret-right"></span> Sign Up</a></li>
            <li ><a href="reset-password.html"><span class="fa fa-caret-right"></span> Reset Password</a></li>
    </ul></li>

        <li><a href="#" data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Legal<i class="fa fa-collapse"></i></a></li>
        <li><ul class="legal-menu nav nav-list collapse">
            <li ><a href="privacy-policy.html"><span class="fa fa-caret-right"></span> Privacy Policy</a></li>
            <li ><a href="terms-and-conditions.html"><span class="fa fa-caret-right"></span> Terms and Conditions</a></li>
    </ul></li>

        <li><a href="help.html" class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Help</a></li>
            <li><a href="faq.html" class="nav-header"><i class="fa fa-fw fa-comment"></i> Faq</a></li>
                <li><a href="http://portnine.com/bootstrap-themes/aircraft" class="nav-header" target="blank"><i class="fa fa-fw fa-heart"></i> Get Premium</a></li>
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
                        <a href="#widget1container" class="panel-heading" data-toggle="collapse">Collapsible </a>
                        <div id="widget1container" class="panel-body collapse in">
                            <h2>Here's a Tip</h2>
                            <p>This template was developed with <a href="http://middlemanapp.com/" target="_blank">Middleman</a> and includes .erb layouts and views.</p>
                            <p>All of the views you see here (sign in, sign up, users, etc) are already split up so you don't have to waste your time doing it yourself!</p>
                            <p>The layout.erb file includes the header, footer, and side navigation and all of the views are broken out into their own files.</p>
                            <p>If you aren't using Ruby, there is also a set of plain HTML files for each page, just like you would expect.</p>
                        </div>
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
    <script>
        $(document).ready(function() {
            var date = new Date();
            document.getElementById("year").innerHTML = date.getFullYear();
            document.getElementById("month").innerHTML = date.getMonth() + 1;
            document.getElementById("day").innerHTML = date.getDate();
        })
    </script>
    
  
</body></html>
