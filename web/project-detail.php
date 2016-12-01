<?php session_start() ?>
<?php
    include "dbinfo.php";
    include "checkuser.php";

    if(isset($_GET['apply'])) {
        $projectname = $_REQUEST['name'];
        $username = $_SESSION['login_user'];
        $alreadyApplied = mysqli_num_rows($db->query("SELECT COUNT(*) FROM APPLY WHERE SName = '$username' and PName = '$projectname'"));
        if ($alreadyApplied == 1) {
            echo "
                <script src='lib/jquery-1.11.1.min.js' type='text/javascript'></script>
                <script>
                    $(document).ready(function(){
                        $('#confirm').modal('show');
                    })
                </script>
                <div class=\"modal small fade\" id=\"confirm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                                <h3 id=\"myModalLabel\">Confirmation</h3>
                            </div>
                            <div class=\"modal-body\">
                                <p class=\"text\"><i class=\"fa fa-warning modal-icon\"></i><span id=\"info\">You ALREADY applied this project. You CANNOT apply AGIAN!</span></p>
                            </div>
                            <div class=\"modal-footer\">
                                <button class=\"btn btn-default\" data-dismiss=\"modal\" aria-hidden=\"true\">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                ";
        } else {
            $userYear = $_SESSION['user_year'];
            $userMajor = $_SESSION['user_major'];
            $department = mysqli_fetch_array($db->query("SELECT DName FROM MAJOR WHERE MName='$usermajor'"),MYSQLI_ASSOC)['DName'];
            $search = "SELECT COUNT(*)
                        FROM PROJECT AS P
                        WHERE PName = '$projectname'
                        and (EXISTS (SELECT * FROM PROJECT_REQUIREMENT AS R WHERE P.PName = R.PName and PRequirement = '$userMajor') or
                          EXISTS (SELECT * FROM PROJECT_REQUIREMENT AS R WHERE P.PName = R.PName and PRequirement = '$department') or
                        (EXISTS (SELECT * FROM PROJECT_REQUIREMENT AS R WHERE P.PName = R.PName and PRequirement = 'NoMajRequirement') and
                          EXISTS (SELECT * FROM PROJECT_REQUIREMENT AS R WHERE P.PName = R.PName and PRequirement = 'NoDepRequirement')))
                        and EXISTS (SELECT * FROM PROJECT_REQUIREMENT AS R WHERE P.PName = R.PName and (PRequirement = '$userYear' or PRequirement = 'NoYearRequirement'))";
            $result = mysqli_query($db, $search);
            $count = mysqli_num_rows($result);
            if ($count == 0) {
                echo "
                <script src='lib/jquery-1.11.1.min.js' type='text/javascript'></script>
                <script>
                    $(document).ready(function(){
                        $('#confirm').modal('show');
                    })
                </script>
                <div class=\"modal small fade\" id=\"confirm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                                <h3 id=\"myModalLabel\">Confirmation</h3>
                            </div>
                            <div class=\"modal-body\">
                                <p class=\"text\"><i class=\"fa fa-warning modal-icon\"></i><span id=\"info\">You don't meet the requirements. You CANNOT apply this project!</span></p>
                            </div>
                            <div class=\"modal-footer\">
                                <button class=\"btn btn-default\" data-dismiss=\"modal\" aria-hidden=\"true\">Confirm</button>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            } else {
                $db->query("INSERT INTO APPLY VALUES ('$username','$projectname',CURDATE(),'Pending')");
                echo "
                <script src='lib/jquery-1.11.1.min.js' type='text/javascript'></script>
                <script>
                    $(document).ready(function(){
                        $('#confirm').modal('show');
                    })
                </script>
                <div class=\"modal small fade\" id=\"confirm\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">×</button>
                                <h3 id=\"myModalLabel\">Confirmation</h3>
                            </div>
                            <div class=\"modal-body\">
                                <p class=\"text\"><i class=\"fa fa-thumbs-up modal-icon\"></i><span id=\"info\">You have applied for this project successfully!</span></p>
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
        $_REQUEST['name'] = $_SESSION['project_name'];
    }

    if(!isset($_REQUEST['name'])) {
        header("location: 404.html");
    } else {
        $_SESSION['project_name'] = $_REQUEST['name'];
        $username = $_SESSION['login_user'];
        $projectname = $_REQUEST['name'];
        $sql1 = "SELECT * FROM PROJECT WHERE PName = '$projectname'";
        $sql2 = "SELECT CaName FROM PROJECT_CATEGORY WHERE PName = '$projectname'";
        $sql3 = "SELECT PRequirement FROM PROJECT_REQUIREMENT WHERE PName = '$projectname'";
        $result1 = $db->query($sql1);
        $category = $db->query($sql2);
        $requirement = $db->query($sql3);
        $db->close();

        $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
        $numofstudent = $row['EstimatedNoOfStudents'];
        $description = $row['Description'];
        $advisor = $row['AName'];
        $advisoremail = $row['AEmail'];
        $designation = $row['DesName'];
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
                <li><a href="user.php">My Profile</a></li>
                <li class="divider"></li>
                <li class="dropdown-header" style="text-transform: capitalize"><?php echo $_SESSION['user_type']?> Panel</li>
                <li><a href="./">Users</a></li>
                <li><a href="./">Security</a></li>
                <li><a tabindex="-1" href="./">Payments</a></li>
                <li class="divider"></li>
                <li><a tabindex="-1" href="logout.php">Logout</a></li>
              </ul>
            </li>    
          <li class="visible-xs"><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li><li class="visible-xs"><ul class="dashboard-menu nav nav-list collapse">
            <li><a href="index.php"><span class="fa fa-caret-right"></span> Main</a></li>
            <li><a href="users.html"><span class="fa fa-caret-right"></span> User List</a></li>
            <li><a href="user.php"><span class="fa fa-caret-right"></span> User Profile</a></li>
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
            <li><a href="login.html"><span class="fa fa-caret-right"></span> Sign In</a></li>
            <li><a href="signup.php"><span class="fa fa-caret-right"></span> Sign Up</a></li>
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
            <li><a href="user.php"><span class="fa fa-caret-right"></span> User Profile</a></li>
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
            <li><a href="login.html"><span class="fa fa-caret-right"></span> Sign In</a></li>
            <li><a href="signup.php"><span class="fa fa-caret-right"></span> Sign Up</a></li>
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
            
            <h1 class="page-title"><?php echo $projectname; ?></h1>
            
        </div>
        <div class="main-content">
            
<div class="row">
    <div class="col-sm-9 main-content">
        <h3>Advisor</h3>
        <p>
            <?php echo $advisor; ?>
            <?php
                $mail = "mailto:".$advisoremail;
                echo
                    '<a class="btn btn-info pull-right" target="_top" href="' . $mail . '">Send Mail</a>';
            ?>
<!--            <a class="btn btn-info pull-right" href="mailto:neha.kumar@cc.gatech.edu" target="_top">Send Mail</a>-->
        </p>

        <h3>Description</h3>
        <p>
            <?php echo $description; ?>
        </p>
<!--        href="#confirm" data-toggle="modal"-->
        <form role="form" method="get">
            <button class="btn btn-primary pull-right" type="submit" name="apply">Apply</button>
            <a class="btn btn-primary pull-right" href="/web/View-and-Apply.php" target="_top" style="margin-right: 10px">Cancel</a>
        </form>
    </div>

    <div class="col-sm-3 sidebar">
        <div class="widget">
            <h3>Estimated Number of Students</h3>
            <div class="widget-body number">
                <a><span class="large label tag label-danger"><?php echo $numofstudent; ?></span></a>
            </div>
        </div>
        <div class="widget">
            <h3>Requirements</h3>
            <div class="widget-body requirement">
                <?php
                    while($rs = $requirement->fetch_array(MYSQLI_ASSOC)) {
                        $require = $rs['PRequirement'];
                        echo "
                                <a><span class=\"large label tag label-warning\">$require</span></a>
                             ";
                    }
                ?>
<!--                <a><span class="large label tag label-warning">CS Students</span></a>-->
<!--                <a><span class="large label tag label-warning">Senior</span></a>-->
            </div>
        </div>
        <div class="widget">
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
<!--                <a ><span class="large label tag label-primary">Sustainable Communities</span></a>-->
<!--                <a><span class="large label tag label-primary">Crowd-Sourced</span></a>-->
                <!--<a><span class="large label tag label-primary">Computing for Good</span></a>
                <a><span class="large label tag label-primary">Doing Good for Your Neighborhood</span></a>
                <a><span class="large label tag label-primary">Reciprocal Teaching and Learning</span></a>
                <a><span class="large label tag label-primary">Urban Development</span></a>
                <a><span class="large label tag label-primary">Adaptive Learning</span></a>
                <a><span class="large label tag label-primary">Technology for Social Good</span></a>
                <a><span class="large label tag label-primary">Collaborative Action</span></a>-->
            </div>
        </div>
        <div class="widget">
            <h3>Designation</h3>
            <div class="widget-body designation">
                <a><span class="large label tag label-primary"><?php echo $designation; ?></span></a>
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
        function applyThisProject() {
            var students_num = 38;
            var requirements = [];
            $(".requirement>a").each(function(){
                requirements.push($(this).text());
            });
                
            if (true) { 
                d3.select(".modal-body")
                    .select("i")
                    .classed("fa-thumbs-up", false)
                    .classed("fa-warning", true);
                document.getElementById("info").innerHTML = "You don't meet the requirement. You CANNOT apply this project!";
            } else {
                d3.select(".modal-body")
                    .select("i")
                    .classed("fa-thumbs-up", true)
                    .classed("fa-warning", false);
                document.getElementById("info").innerHTML = "You have applied for this project successfully!";
                d3.select(".modal-footer")
                    .select("button")
                    .on("click", function() {
                        alert("test");
                    });
            }
        }
    </script>



    
</body></html>
