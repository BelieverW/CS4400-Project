<?php session_start() ?>
<?php
include "dbinfo.php";
//include "checkuser.php";

if(!isset($_REQUEST['coursenumber'])) {
    header("location: 404.html");
} else {
    $_SESSION['course_name'] = $_REQUEST['coursenumber'];
    $username = $_SESSION['login_user'];
    $coursenumber = $_REQUEST['coursenumber'];
    $sql1 = "SELECT * FROM COURSE WHERE CNumber = '$coursenumber'";
    $sql2 = "SELECT CaName FROM COURSE_CATEGORY WHERE CNumber = '$coursenumber'";
    $result1 = $db->query($sql1);
    $category = $db->query($sql2);
    $db->close();

    $row=mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $numofstudent = $row['EstimatedNoOfStudents'];
    $instructor = $row['Instructor'];
    $designation = $row['DesName'];
    $coursename = $row['CName'];
}

//$db->close();
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
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>
    <link rel="SHORTCUT ICON" href="images/GTYellowJacketSmall.png">
    

    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/premium.css">
    

</head>
<body class=" theme-blue">



    <style type="text/css">
        .navbar-default .navbar-brand, .navbar-default .navbar-brand:hover { 
            color: #fff;
        }
    </style>



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
                <li><a tabindex="-1" href="sign-in.html">Logout</a></li>
              </ul>
            </li>    
          <li class="visible-xs"><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li><li class="visible-xs"><ul class="dashboard-menu nav nav-list collapse">
            <li><a href="index.php"><span class="fa fa-caret-right"></span> Main</a></li>
            <li><a href="users.html"><span class="fa fa-caret-right"></span> User List</a></li>
            <li><a href="user.html"><span class="fa fa-caret-right"></span> User Profile</a></li>
            <li><a href="media.html"><span class="fa fa-caret-right"></span> Media</a></li>
            <li><a href="calendar.html"><span class="fa fa-caret-right"></span> Calendar</a></li>
    </ul></li><li data-popover="true" data-content="Items in this group require a <strong><a href='http://portnine.com/bootstrap-themes/aircraft' target='blank'>premium license</a><strong>." rel="popover" data-placement="right" data-original-title="" title="" class="visible-xs"><a href="#" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-fighter-jet"></i> Premium Features<i class="fa fa-collapse"></i></a></li><li class="visible-xs"><ul class="premium-menu nav nav-list collapse in">
                <li class="visible-xs visible-sm"><a href="#">- Premium features require a license -</a>
            </li><li><a href="premium-profile.html"><span class="fa fa-caret-right"></span> Enhanced Profile</a></li>
            <li><a href="premium-blog.html"><span class="fa fa-caret-right"></span> Blog</a></li>
            <li class="active"><a href="premium-blog-item.html"><span class="fa fa-caret-right"></span> Blog Page</a></li>
            <li><a href="premium-pricing-tables.html"><span class="fa fa-caret-right"></span> Pricing Tables</a></li>
            <li><a href="premium-upgrade-account.html"><span class="fa fa-caret-right"></span> Upgrade Account</a></li>
            <li><a href="premium-widgets.html"><span class="fa fa-caret-right"></span> Widgets</a></li>
            <li><a href="premium-timeline.html"><span class="fa fa-caret-right"></span> Activity Timeline</a></li>
            <li><a href="premium-users.html"><span class="fa fa-caret-right"></span> Enhanced Users List</a></li>
            <li><a href="premium-media.html"><span class="fa fa-caret-right"></span> Enhanced Media</a></li>
            <li><a href="premium-invoice.html"><span class="fa fa-caret-right"></span> Invoice</a></li>
            <li><a href="premium-build.html"><span class="fa fa-caret-right"></span> Advanced Tools</a></li>
            <li><a href="premium-colors.html"><span class="fa fa-caret-right"></span> Additional Color Themes</a></li>
    </ul></li><li class="visible-xs"><a href="#" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i> Account <span class="label label-info">+3</span></a></li><li class="visible-xs"><ul class="accounts-menu nav nav-list collapse">
            <li><a href="sign-in.html"><span class="fa fa-caret-right"></span> Sign In</a></li>
            <li><a href="sign-up.html"><span class="fa fa-caret-right"></span> Sign Up</a></li>
            <li><a href="reset-password.html"><span class="fa fa-caret-right"></span> Reset Password</a></li>
    </ul></li><li class="visible-xs"><a href="#" data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Legal<i class="fa fa-collapse"></i></a></li><li class="visible-xs"><ul class="legal-menu nav nav-list collapse">
            <li><a href="privacy-policy.html"><span class="fa fa-caret-right"></span> Privacy Policy</a></li>
            <li><a href="terms-and-conditions.html"><span class="fa fa-caret-right"></span> Terms and Conditions</a></li>
    </ul></li><li class="visible-xs"><a href="help.html" class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Help</a></li><li class="visible-xs"><a href="faq.html" class="nav-header"><i class="fa fa-fw fa-comment"></i> Faq</a></li><li class="visible-xs"><a href="http://portnine.com/bootstrap-themes/aircraft" class="nav-header" target="blank"><i class="fa fa-fw fa-heart"></i> Get Premium</a></li></ul>

        </div>
      </div>
    
    

    <div class="sidebar-nav">
    <ul>
    <li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li>
    <li><ul class="dashboard-menu nav nav-list collapse">
            <li><a href="index.php"><span class="fa fa-caret-right"></span> Main</a></li>
            <li><a href="users.html"><span class="fa fa-caret-right"></span> User List</a></li>
            <li><a href="user.html"><span class="fa fa-caret-right"></span> User Profile</a></li>
            <li><a href="media.html"><span class="fa fa-caret-right"></span> Media</a></li>
            <li><a href="calendar.html"><span class="fa fa-caret-right"></span> Calendar</a></li>
    </ul></li>

    <li data-popover="true" data-content="Items in this group require a <strong><a href='http://portnine.com/bootstrap-themes/aircraft' target='blank'>premium license</a><strong>." rel="popover" data-placement="right" data-original-title="" title=""><a href="#" data-target=".premium-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-fighter-jet"></i> Premium Features<i class="fa fa-collapse"></i></a></li>
        <li><ul class="premium-menu nav nav-list collapse in">
                <li class="visible-xs visible-sm"><a href="#">- Premium features require a license -</a>
            </li><li><a href="premium-profile.html"><span class="fa fa-caret-right"></span> Enhanced Profile</a></li>
            <li><a href="premium-blog.html"><span class="fa fa-caret-right"></span> Blog</a></li>
            <li class="active"><a href="premium-blog-item.html"><span class="fa fa-caret-right"></span> Blog Page</a></li>
            <li><a href="premium-pricing-tables.html"><span class="fa fa-caret-right"></span> Pricing Tables</a></li>
            <li><a href="premium-upgrade-account.html"><span class="fa fa-caret-right"></span> Upgrade Account</a></li>
            <li><a href="premium-widgets.html"><span class="fa fa-caret-right"></span> Widgets</a></li>
            <li><a href="premium-timeline.html"><span class="fa fa-caret-right"></span> Activity Timeline</a></li>
            <li><a href="premium-users.html"><span class="fa fa-caret-right"></span> Enhanced Users List</a></li>
            <li><a href="premium-media.html"><span class="fa fa-caret-right"></span> Enhanced Media</a></li>
            <li><a href="premium-invoice.html"><span class="fa fa-caret-right"></span> Invoice</a></li>
            <li><a href="premium-build.html"><span class="fa fa-caret-right"></span> Advanced Tools</a></li>
            <li><a href="premium-colors.html"><span class="fa fa-caret-right"></span> Additional Color Themes</a></li>
    </ul></li>

        <li><a href="#" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i> Account <span class="label label-info">+3</span></a></li>
        <li><ul class="accounts-menu nav nav-list collapse">
            <li><a href="sign-in.html"><span class="fa fa-caret-right"></span> Sign In</a></li>
            <li><a href="sign-up.html"><span class="fa fa-caret-right"></span> Sign Up</a></li>
            <li><a href="reset-password.html"><span class="fa fa-caret-right"></span> Reset Password</a></li>
    </ul></li>

        <li><a href="#" data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Legal<i class="fa fa-collapse"></i></a></li>
        <li><ul class="legal-menu nav nav-list collapse">
            <li><a href="privacy-policy.html"><span class="fa fa-caret-right"></span> Privacy Policy</a></li>
            <li><a href="terms-and-conditions.html"><span class="fa fa-caret-right"></span> Terms and Conditions</a></li>
    </ul></li>

        <li><a href="help.html" class="nav-header"><i class="fa fa-fw fa-question-circle"></i> Help</a></li>
            <li><a href="faq.html" class="nav-header"><i class="fa fa-fw fa-comment"></i> Faq</a></li>
                <li><a href="http://portnine.com/bootstrap-themes/aircraft" class="nav-header" target="blank"><i class="fa fa-fw fa-heart"></i> Get Premium</a></li>
            </ul>
    </div>

    
    <div class="content">
        <div class="header">
            
            <h1 class="page-title"><?php echo $coursenumber;?></h1>
            
        </div>
        <div class="main-content">
            
<div class="row">
    <div class="col-xs-12 col-sm-6">
		<h3>Course Name</h3>
        <p>
            <?php echo $coursename;?>
        </p>
		
        <h3>Instructor</h3>
        <p>
            <?php echo $instructor;?>
        </p>
		
		<div>
            <h3>Estimated Number of Students</h3>
            <div class="widget-body number">
                <a><span class="large label tag label-danger"><?php echo $numofstudent;?></span></a>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div>
            <h3>Categories</h3>
            <div class="widget-body category">
                <?php
                while($rs = $category->fetch_array(MYSQLI_ASSOC)) {
                    $ca = $rs['CaName'];
                    echo "
                                <a ><span class=\"large label tag label-primary\">$ca</span></a>
                             ";
                }
                ?>
            </div>
        </div>
        <div>
            <h3>Designation</h3>
            <div class="widget-body designation">
                <a><span class="large label tag label-primary"><?php echo $designation; ?></span></a>
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
    <script src="lib/d3.v3.min.js"></script>
    <script type="text/javascript">
        
    </script>



    
</body></html>
