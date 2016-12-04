<?php session_start() ?>
<?php
    include "dbinfo.php";
    include "checkuser.php";
    include "checkuser_student.php";
    $username = $_SESSION['login_user'];
    $usertype = $_SESSION['user_type'];
    $sql1 = "SELECT * FROM USER WHERE UName = '$username'";
    // $sql2 = "SELECT DISTINCT MName FROM MAJOR";
    $result1 = $db->query($sql1);
    $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    $gtemail = $row['GTEmail'];
    $year = $row['Year'];
    $major = $row['MName'];

    $sql2 = "SELECT DName FROM MAJOR WHERE MName='$major'";
    $department = mysqli_fetch_array($db->query($sql2),MYSQLI_ASSOC)['DName'];

    $sql3 = "SELECT DISTINCT MName FROM MAJOR WHERE DName='$department'";
    $allMajor = $db->query($sql3);

    if (isset($_GET['save'])) {
        $newYear = $_GET['DropDownYear'];
        $newMajor = $_GET['DropDownMajor'];
        $update = "UPDATE USER SET MName = '$newMajor', Year = '$newYear' WHERE UName = '$username'";
        mysqli_query($db, $update);

        echo "
            <script src='lib/jquery-1.11.1.min.js' type='text/javascript'></script>
                <script>
                    $(document).ready(function(){
                        $('#confirm').modal('show');
                    })
                </script>
                <div class=\"modal large fade\" id=\"confirm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                                <h3 id=\"myModalLabel\">Confirmation</h3>
                            </div>
                            <div class=\"modal-body\">
                                <p class=\"text\"><i class=\"fa fa-thumbs-up modal-icon\"></i><span id=\"info\">You have update your profile successfully!</span></p>
                            </div>
                            <div class=\"modal-footer\">
                                <button class=\"btn btn-default\" data-dismiss=\"modal\" aria-hidden=\"true\">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

        ";
    }
    if (isset($_GET['update'])) {
        if (isset($_GET['newPassword']) &&  $_GET['newPassword'] != "") {
            $newPassword = $_GET['newPassword'];
            $update2 = "UPDATE USER SET Pw = '$newPassword' WHERE UName = '$username'";
            mysqli_query($db, $update2);
            echo "
                <script src='lib/jquery-1.11.1.min.js' type='text/javascript'></script>
                <script>
                    $(document).ready(function(){
                        $('#confirm').modal('show');
                    })
                </script>
                <div class=\"modal large fade\" id=\"confirm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                                <h3 id=\"myModalLabel\">Confirmation</h3>
                            </div>
                            <div class=\"modal-body\">
                                <p class=\"text\"><i class=\"fa fa-thumbs-up modal-icon\"></i><span id=\"info\">You have update your password successfully!</span></p>
                            </div>
                            <div class=\"modal-footer\">
                                <button class=\"btn btn-default\" data-dismiss=\"modal\" aria-hidden=\"true\">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>

        ";
        } else {
            echo "
                <script src='lib/jquery-1.11.1.min.js' type='text/javascript'></script>
                <script>
                    $(document).ready(function(){
                        $('#confirm').modal('show');
                    })
                </script>
                <div class=\"modal large fade\" id=\"confirm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                                <h3 id=\"myModalLabel\">Confirmation</h3>
                            </div>
                            <div class=\"modal-body\">
                                <p class=\"text\"><i class=\"fa fa-warning modal-icon\"></i><span id=\"info\">You Must Input Your New Password BEFORE Update!</span></p>
                            </div>
                            <div class=\"modal-footer\">
                                <button class=\"btn btn-default\" data-dismiss=\"modal\" aria-hidden=\"true\">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
            ";

        }
    }

    $db->close();
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
            
            <h1 class="page-title">Edit My Profile</h1>
        </ul>

        </div>
        <div class="main-content">
            
<ul class="nav nav-tabs">
  <li class="active"><a href="#home" data-toggle="tab">Profile</a></li>
  <li><a href="#profile" data-toggle="tab">Password</a></li>
</ul>

<div class="row">
  <div class="col-md-4">
    <br>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane active in" id="home">
      <form id="tab" role="form" method="get">
        <div class="form-group">
            <label>Username</label>
            <input type="text" <?php echo 'value="'. $username .'"'?> class="form-control" readonly>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="text" <?php echo 'value="'. $gtemail .'"'?> class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Department</label>
            <input type="text" <?php echo 'value="'. $department .'"'?> class="form-control" readonly>
        </div>
          
        <div class="form-group">
          <label>Major</label>
          <select name="DropDownMajor" id="DropDownMajor" class="form-control">
              <option value="Null"<?=$major == 'Null' ? ' selected="selected"' : '';?>>Null</option>
              <?php
                  while($rs = $allMajor->fetch_array(MYSQLI_ASSOC)) {
                      $majorname = $rs['MName'];
                      if ($major == $majorname) {
                          echo "<option value='$majorname' selected='selected'>$majorname</option>";
                      } else {
                          echo "<option value='$majorname'>$majorname</option>";
                      }
                  }
              ?>
            </select>
        </div>
          
        <div class="form-group">
            <label>Year</label>
            <select name="DropDownYear" id="DropDownYear" class="form-control">
                <option value="Null"<?=$year == 'Null' ? ' selected="selected"' : '';?>>Null</option>
                <option value="Freshman"<?=$year == 'Freshman' ? ' selected="selected"' : '';?>>Freshman</option>
                <option value="Sophomore"<?=$year == 'Sophomore' ? ' selected="selected"' : '';?>>Sophomore</option>
                <option value="Junior"<?=$year == 'Junior' ? ' selected="selected"' : '';?>>Junior</option>
                <option value="Senior"<?=$year == 'Senior' ? ' selected="selected"' : '';?>>Senior</option>
            </select>
          </div>
          <div class="btn-toolbar list-toolbar">
            <button class="btn btn-primary" type="submit" name="save"><i class="fa fa-save"></i> Save</button>
            <a href="#myModal" data-toggle="modal" class="btn btn-danger">Cancel</a>
        </div>
      </form>
      </div>

      <div class="tab-pane fade" id="profile">

        <form id="tab2" role="form" method="get">
          <div class="form-group">
            <label>New Password</label>
            <input name="newPassword" type="password" class="form-control">
          </div>
         <button class="btn btn-primary" type="submit" name="update">Update</button>
          </div>
        </form>
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
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>
    
  
</body></html>
