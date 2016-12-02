<?php session_start() ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nameAlreadyExist = FALSE;
    $success = FALSE;
    $refresh = FALSE;
    if (isset($_GET['submit'])) {
        include "dbinfo.php";

        $newcoursenumber = $_GET['cursenumber'];
        $newcoursename = $_GET['coursename'];
        $newinstructor = $_GET['instructorname'];
        $category = $_GET['category'];
        $designation = $_GET['designation'];
        $numofstudent = $_GET['numofstudent'];

        $sql = "INSERT INTO COURSE VALUES ('$newcoursename','$newcoursenumber','$newinstructor','$numofstudent','$designation')";
        if (mysqli_query($db, $sql)) {
            foreach ($category as $ca) {
                $sqlca = "INSERT INTO COURSE_CATEGORY VALUES ('$newcoursenumber','$ca')";
                mysqli_query($db, $sqlca);
            }
            echo "
                   <script src='lib/jquery-1.11.1.min.js' type='text/javascript'></script>
                   <script>
                        $(document).ready(function(){
                            $('#myAdvert').modal('show');
                        })
                   </script>";
        } else {
            $nameAlreadyExist = TRUE;
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
          <a class="" href="index.html"><span class="navbar-brand"><img src="images/GTYellowJacket3.png" height="30"></span> <span class="navbar-brand">Georgia Tech SLS</span></a></div>

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
            <li><a href="index.html"><span class="fa fa-caret-right"></span> Main</a></li>
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
            <li><a href="index.html"><span class="fa fa-caret-right"></span> Main</a></li>
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
            
            <h1 class="page-title">Add a Course</h1>
            
        </div>
        <div class="main-content">
            
        <div class="row">
            <div class="col-xs-12 col-sm-10">
                 <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="coursenumber" class="col-sm-3 control-label">Course Number</label>         
                        <div class="col-sm-9">
                            <input type="text" name="coursenumber" class="form-control" id="coursenumber" placeholder="Enter Course Number" oninput="check_if_can_submit()">
                            <?php
                                if ($nameAlreadyExist === TRUE) {
                                    echo '<p class="text-danger" id="insert-fail">
                                            <strong>Course number already exists.</strong>
                                           </p>';
                                    echo '<script>
                                            window.setTimeout("hideMsg()", 6000);
                                        </script>';
                                }
                            ?>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="coursename" class="col-sm-3 control-label">Course Name</label>         
                        <div class="col-sm-9">
                            <input type="text" name="coursename" class="form-control" id="coursename" placeholder="Enter Course Name" oninput="check_if_can_submit()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="instructorname" class="col-sm-3 control-label">Instructor</label>
                        <div class="col-sm-9">
                            <input type="text" name="instructorname" class="form-control" id="instructorname" placeholder="Enter Instructor's Name" oninput="check_if_can_submit()">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <select multiple class="form-control category" name="category[]" onchange="check_if_can_submit()">
                                <option value="Adaptive Learning" >Adaptive Learning</option>
                                <option value="Crowd-Sourced">Crowd-Sourced</option>
                                <option value="Computing for Good">Computing for Good</option>
                                <option value="Collaborative Action">Collaborative Action</option>
                                <option value="Doing Good for Your Neighborhood">Doing Good for Your Neighborhood</option>
                                <option value="Reciprocal Teaching and Learning">Reciprocal Teaching and Learning</option>
                                <option value="Sustainable Communities">Sustainable Communities</option>
                                <option value="Technology for Social Good">Technology for Social Good</option>
                                <option value="Urban Development">Urban Development</option>
                            </select>
                         </div>
                    </div>
                     
                     <div class="form-group">
                        <label for="designation" class="col-sm-3 control-label">Designation</label>
                        <div class="col-sm-4">
                            <select name="designation" id="designation" class="form-control">
                                <option value="sc">Sustainable Communities</option>
                                <option value="community">Community</option>
                            </select>
                        </div>
                         <label for="numofstudent" class="col-sm-3 control-label">Estimated # of Students</label>
                        <div class="col-sm-2">
                            <input type="numofstudent" name="numofstudent" class="form-control" id="numofstudent" oninput="check_if_can_submit()">
                        </div>
                    </div>
                     
                    
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button type="submit" class="btn btn-primary" href="index.php">Back</button>
                            <button type="submit" name="submit" class="btn btn-primary submit-report" disabled="disabled">Submit</button>
                        </div>
                    </div>
                </form>

                <div class="modal small fade" id="myAdvert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 id="myModalLabel">Confirmation</h3>
                            </div>
                            <div class="modal-body">
                                <p class="text"><i class="fa fa-thumbs-up modal-icon"></i><span id="info">Record Added Successfully!</span></p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Confirm</button>
                            </div>
                        </div>
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
        $(document).ready(function() {
            check_if_can_submit();
        });
        function check_if_can_submit() {
            var emptyNum = 0;
            if ($("#coursenumber").val() == "") {
                emptyNum++;
            }
            if ($("#coursename").val() == "") {
                emptyNum++;
            }
            if ($("#instructor").val() == "") {
                emptyNum++;
            }
            if ($("#numofstudent").val() == "") {
                emptyNum++;
            }
            var count = 0;
            $('.category option').each(function() {
                if($(this).is(':selected')) {
                    count++;
                }
            });
            if (count == 0) {
                emptyNum++;
            }
            
            if (emptyNum != 0) {
                d3.select(".submit-report")
                    .attr("disabled", "disabled");
            } else {
                d3.select(".submit-report")
                    .attr("disabled", null);
            }
        }
        function hideMsg() {
            d3.select("#insert-fail").remove();
        }


    </script>



    
</body></html>