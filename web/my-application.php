<?php session_start() ?>
<?php
    include "dbinfo.php";
    include "checkuser.php";
    include "checkuser_student.php";

    $username = $_SESSION['login_user'];
    $usertype = $_SESSION['user_type'];
    $sql1 = "SELECT Date, PName, Status FROM APPLY, USER WHERE SName = UName and UName = '$username'";
    $result1 = $db->query($sql1);
    $db->close();
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
            <a class="" href="index_user.php"><span class="navbar-brand"><img src="images/GTYellowJacket3.png" height="30"></span> <span class="navbar-brand">Georgia Tech SLS</span></a></div>


        <div class="navbar-collapse collapse" style="height: 1px;">
            <ul id="main-menu" class="nav navbar-nav navbar-right">
                <li class="dropdown hidden-xs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?php echo $username;?>
                        <i class="fa fa-caret-down"></i>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="user.php">My Account</a></li>
                        <li class="divider"></li>
                        <li><a href="reset-password.html">Reset Password</a></li>
                        <li class="divider"></li>
                        <li><a tabindex="-1" href="login.html">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </div>
    </div>


    <div class="sidebar-nav">
        <ul>
            <li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li>
            <li><ul class="dashboard-menu nav nav-list collapse">
                    <li><a href="index_user.php"><span class="fa fa-caret-right"></span> Main</a></li>
                    <li ><a href="user.php"><span class="fa fa-caret-right"></span> My Profile</a></li>
                    <li ><a href="my-application.php"><span class="fa fa-caret-right"></span> My Application</a></li>


                </ul></li>

            <li><a href="#" data-target=".project-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Project and Course<i class="fa fa-collapse"></i></a></li>
            <li><ul class="project-menu nav nav-list collapse">
                    <li ><a href="View-and-Apply.php"><span class="fa fa-caret-right"></span> Project List</a></li>
                    <li ><a href="course-list.php"><span class="fa fa-caret-right"></span> Course List</a></li>


                </ul><li><a href="search.php" class="nav-header"><i class="fa fa-fw fa-search"></i> Search</a></li>
    </div>

    <div class="content">
        <div class="header">
            
            <h1 class="page-title">My Application</h1>
                    <ul class="breadcrumb">
            <li><a href="index_user.php">Home</a> </li>
            <li class="active">My Application</li>
        </ul>

        </div>
        <div class="main-content">
            <table id="my_applications" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Project Name</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($rs = $result1->fetch_array(MYSQLI_ASSOC)) {
                    $date = $rs['Date'];
                    $projectname = $rs['PName'];
                    $status = $rs['Status'];
                    echo "<tr><td id='$projectname'>$projectname</td><td id='date'>$date</td><td id='status'>$status</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>



<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Delete Confirmation</h3>
        </div>
        <div class="modal-body">
            <p class="error-text"><i class="fa fa-warning modal-icon"></i>Are you sure you want to delete the user?<br>This cannot be undone.</p>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-danger" data-dismiss="modal">Delete</button>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#my_applications').DataTable();
        });
    </script>
    
  
</body></html>
