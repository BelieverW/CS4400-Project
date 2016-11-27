<?php
$result1 = "";
$result2 = "";
$getResultCourse = FALSE;
$getResultProject = FALSE;
if (isset($_GET['filter'])) {
    include "dbinfo.php";
    if(isset($_GET['radio']))
    {
        $type = $_GET['radio'];
        $sql1 = "SELECT CName FROM COURSE";
        $sql2 = "SELECT PName FROM PROJECT";

        if ($type === "Course" || $type === "Both") {
            $result1 = $db->query($sql1);
            $getResultCourse = TRUE;
        }
        if ($type === "Project" || $type === "Both") {
            $result2 = $db->query($sql2);
            $getResultProject = TRUE;
        }

    }
    else{
        $sql1 = "SELECT CName FROM COURSE";
        $sql2 = "SELECT PName FROM PROJECT";

        $result1 = $db->query($sql1);
        $result2 = $db->query($sql2);

        $getResultCourse = TRUE;
        $getResultProject = TRUE;
    }
    $db->close();
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
            <li><a href="index.html"><span class="fa fa-caret-right"></span> Main</a></li>
            <li ><a href="users.html"><span class="fa fa-caret-right"></span> User List</a></li>
            <li ><a href="user.php"><span class="fa fa-caret-right"></span> User Profile</a></li>
            <li ><a href="media.html"><span class="fa fa-caret-right"></span> Media</a></li>
            <li ><a href="calendar.html"><span class="fa fa-caret-right"></span> Calendar</a></li>
    </ul></li>

    <li>
        <a href="#" data-target=".project-menu" class="nav-header collapsed" data-toggle="collapse">
            <i class="fa fa-fw fa-fighter-jet"></i> Project
            <i class="fa fa-collapse"></i>
        </a>
    </li>
        <li><ul class="project-menu nav nav-list collapse in">
                <li class="visible-xs visible-sm"><a href="#">Project</a></li>
            <li class="active"><a href="View-and-Apply.php"><span class="fa fa-caret-right"></span> Project List</a></li>
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
            <h1 class="page-title">Search</h1>
                <ul class="breadcrumb">
                    <li><a href="index.html">Home</a> </li>
                    <li class="active">Search</li>
                </ul>
        </div>
        
        <div class="main-content">
            
        <div class="row">
            <form class="col-xs-12 form-horizontal" roel="form" method="get">
                <div class="col-xs-12 col-sm-6">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Title</label>         
                        <div class="col-sm-10">
                            <input name="title" type="text" class="form-control" id="title" placeholder="Enter Project/Course Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="designation" class="col-sm-2 control-label">Designation</label>
                        <div class="col-sm-10">
                            <select name="designation" id="designation" class="form-control">
                                <option value="default">Default</option>
                                <option value="Sustainable Communities">Sustainable Communities</option>
                                <option value="Community">Community</option>
                            </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="major" class="col-sm-2 control-label">Major</label>
                        <div class="col-sm-10">
                            <select name="major" id="major" class="form-control">
                                <option value="default">Default</option>
                                <option value="CS">Computer Science</option>
                                <option value="ARCH">Architecture</option>
                                <option value="BMED">Biomedical Engineering</option>
                                <option value="PUBP">Policy and Government</option>
                                <option value="EAS">Earth and Atmospheric</option>
                                <option value="BIOL">Biological Science</option>
                            </select>
                        </div>
                    </div>
                     
                     <div class="form-group">
                        <label for="year" class="col-sm-2 control-label">Year</label>
                        <div class="col-sm-10">
                            <select name="year" id="year" class="form-control">
                                <option value="default">Default</option>
                                <option value="freshman">Freshman</option>
                                <option value="sophomore">Sophomore</option>
                                <option value="junior">Junior</option>
                                <option value="senior">Senior</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-xs-12 col-sm-6">
                 <div class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10">
                             <select multiple name="category" class="form-control category">
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
                         <div class="col-sm-push-2 col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="radio" id="inlineRadio1" value="Project"> Project
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="radio" id="inlineRadio2" value="Course"> Course
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="radio" id="inlineRadio3" value="Both"> Both
                                </label>
                         </div>
                    </div>
                </div>
            </div>
                <div class="col-sm-12">
                    <button class="btn btn-primary pull-right" onclick="reset()">Reset Filter</button>
                    <button type="submit" name="filter" class="btn btn-primary pull-right" style="margin-right: 10px">Apply Filter</button>
                </div>
            </form>
        </div>
         <div class="row">
            <div class="col-sm-12" style="padding:20px">
            </div>
        </div>
        </div>

       <div class="result-table">  <!-- style="display:none"-->
           <table id="application_table" class="table table-striped table-bordered" cellspacing="0" width="100%">
               <thead>
               <tr>
                   <th>Project Name</th>
                   <th>Type</th>
               </tr>
               </thead>
               <tbody>
               <?php
               if ($getResultCourse === TRUE) {
                   while($rs = $result1->fetch_array(MYSQLI_ASSOC)) {
                       $name = $rs['CName'];
                       echo "
                                        <tr>
                                            <td id='$name'>$name</td>
                                            <td>Course</td>
                                        </tr>
                                    ";
                   }
               }
               if ($getResultProject === TRUE) {
                   while($rs = $result2->fetch_array(MYSQLI_ASSOC)) {
                       $name = $rs['PName'];
                       echo "
                                        <tr>
                                            <td id='$name'>$name</td>
                                            <td>Project</td>
                                        </tr>
                                    ";
                   }
               }
               ?>
               </tbody>
           </table>
        </div>
        <footer>
            <hr>
            <p>© 2016 <a href="http://www.gatech.edu/" target="_blank">Georgia Tech</a></p>
        </footer>
    </div>
    </div>


    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script src="lib/angular/angular.min.js"></script>
    <script src="lib/d3.v3.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#application_table').DataTable();
        });
        
        function test(thisSection) {
            var obj = $(thisSection);
            var arrayContent = [];
            obj.closest('tr').find('td').each(function() {
                arrayContent.push($(this).text());
            })
            alert(arrayContent[0]);
        }
        function reset() {
            $('#designation').prop('selectedIndex',0);
            $('#major').prop('selectedIndex',0);
            $('#year').prop('selectedIndex',0);
            $('#inlineRadio1').prop('checked', false);
            $('#inlineRadio2').prop('checked', false);
            $('#inlineRadio3').prop('checked', false);
            $("#title").val('');
            $('.category option').prop('selected', false).trigger('chosen:updated');
            d3.select(".result-table")
                .style("display", "none");
        }
        function filter() {
            d3.select(".result-table")
                .style("display", "block");
        }
    </script>

</body>
</html>