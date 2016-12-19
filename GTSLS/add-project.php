<?php session_start() ?>
<?php
include "dbinfo.php";
include "checkuser.php";
include "checkuser_admin.php";

$username = $_SESSION['login_user'];
$allMajor = $db->query("SELECT MName FROM MAJOR");
$allDepartment =  $db->query("SELECT DName FROM DEPARTMENT");
$db->close();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nameAlreadyExist = FALSE;
    $success = FALSE;
    $refresh = FALSE;
    if (isset($_POST['submit'])) {
        include "dbinfo.php";

        $newprojectname = $_POST['projectname'];
        $newadvisor = $_POST['advisorname'];
        $newadvisoremail = $_POST['advisoremail'];
        $category = $_POST['category'];
        $designation = $_POST['designation'];
        $majorrequirement = $_POST['majorrequirement'];
        $yearrequirement = $_POST['yearrequirement'];
        $departmentrequirement = $_POST['departmentrequirement'];
        $description = $_POST['description'];
        $numofstudent = $_POST['numofstudent'];

        $sql = "INSERT INTO PROJECT VALUES ('$newprojectname', '$numofstudent','$description','$newadvisor','$newadvisoremail','$designation')";
        if (mysqli_query($db, $sql)) {
            foreach ($category as $ca) {
                $sqlca = "INSERT INTO PROJECT_CATEGORY VALUES ('$newprojectname','$ca')";
                mysqli_query($db, $sqlca);
            }
            $sqlmajor = "INSERT INTO PROJECT_REQUIREMENT VALUES ('$newprojectname','$majorrequirement')";
            $sqlyear = "INSERT INTO PROJECT_REQUIREMENT VALUES ('$newprojectname','$yearrequirement')";
            $sqldep = "INSERT INTO PROJECT_REQUIREMENT VALUES ('$newprojectname','$departmentrequirement')";
            mysqli_query($db, $sqlmajor);
            mysqli_query($db, $sqlyear);
            mysqli_query($db, $sqldep);
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
        <li><ul class="dashboard-menu nav nav-list collapse">
                <li><a href="index_admin.php"><span class="fa fa-caret-right"></span> Main</a></li>
                <li><a href="admin-view-application.php"><span class="fa fa-caret-right"></span> View Applications</a></li>
                <li><a href="admin-popular-project.php"><span class="fa fa-caret-right"></span> Popular Project</a></li>
                <li><a href="admin-application-report.php"><span class="fa fa-caret-right"></span> Application Report</a></li>
            </ul></li>

        <li><a href="#" data-target=".legal-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-legal"></i> Add Project/Course<i class="fa fa-collapse"></i></a></li>
        <li><ul class="legal-menu nav nav-list collapse in">
                <li><a href="add-project.php"><span class="fa fa-caret-right"></span> Add a Project</a></li>
                <li class="active"><a href="add-course.php"><span class="fa fa-caret-right"></span> Add a Course</a></li>
            </ul></li>

    </ul>
</div>
	
	<div class="content">
        <div class="header">
            <h1 class="page-title">Add a Project</h1>
			<ul class="breadcrumb">
                    <li><a href="index_admin.php">Home</a> </li>
                    <li class="active">Add a Project</li>
            </ul>
        </div>

    
        <div class="main-content">
            
        <div class="row">
            <div class="col-xs-12 col-sm-10">
                 <form class="form-horizontal" role="form" method="post">
                    <div class="form-group">
                        <label for="projectname" class="col-sm-3 control-label">Project Name</label>         
                        <div class="col-sm-9">
                            <input type="text" name="projectname" class="form-control" id="projectname" placeholder="Enter Project Name" oninput="check_if_can_submit()">
                            <?php
                            if ($nameAlreadyExist === TRUE) {
                                echo '<p class="text-danger" id="insert-fail">
                                <strong>Project name already exists.</strong>
                            </p>';
                                echo '<script>
                                           window.setTimeout("hideMsg()", 6000);
                                      </script>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="advisorname" class="col-sm-3 control-label">Advisor</label>
                        <div class="col-sm-9">
                            <input type="text" name="advisorname" class="form-control" id="advisorname" placeholder="Enter Advisor's Name" oninput="check_if_can_submit()">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="advisoremail" class="col-sm-3 control-label">Adivsor Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="advisoremail" class="form-control" id="advisorname" placeholder="email@gatech.edu" oninput="check_if_can_submit()">
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="category" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <select multiple name="category[]" class="form-control category" onchange="check_if_can_submit()">
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
                                <option value="Sustainable Communities">Sustainable Communities</option>
                                <option value="Community">Community</option>
                            </select>
                        </div>
                         <label for="numofstudent" class="col-sm-3 control-label">Estimated # of Students</label>
                        <div class="col-sm-2">
                            <input name="numofstudent" type="number" class="form-control" id="numofstudent" oninput="check_if_can_submit()">
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label for="majorrequirement" class="col-sm-3 control-label">Major Requirement</label>
                        <div class="col-sm-9">
                            <select name="majorrequirement" id="majorrequirement" class="form-control">
                                <option value="NoMajRequirement">No Requirement</option>
                                <?php
                                    while($rs = $allMajor->fetch_array(MYSQLI_ASSOC)) {
                                        $name = $rs['MName'];
                                        echo "<option value='$name'>$name</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                     
                    <div class="form-group">
                        <label for="yearrequirement" class="col-sm-3 control-label">Year Requirement</label>
                        <div class="col-sm-9">
                            <select name="yearrequirement" id="yearrequirement" class="form-control">
                                <option value="NoYearRequirement">No Requirement</option>
                                <option value="freshman">Only Freshman Students</option>
                                <option value="sophomore">Only Sophomore Students</option>
                                <option value="junior">Only Junior Students</option>
                                <option value="senior">Only Senior Students</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="departmentrequirement" class="col-sm-3 control-label">Department Requirement</label>
                        <div class="col-sm-9">
                            <select name="departmentrequirement" id="departmentrequirement" class="form-control">
                                <option value="NoDepRequirement">No Requirement</option>
                                <?php
                                while($rs = $allDepartment->fetch_array(MYSQLI_ASSOC)) {
                                    $name = $rs['DName'];
                                    echo "<option value='$name'>$name</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="feedback" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea name="description" class="form-control" id="description" rows="12" oninput="check_if_can_submit()"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-10">
                            <button class="btn btn-primary" href="index_admin.html">Back</button>
                            <button type="submit" class="btn btn-primary submit-report" disabled="disabled" name="submit">Submit</button>
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
                                <button class="btn btn-default" onclick="jump()">Confirm</button>
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
    <script src="lib/d3.v3.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            check_if_can_submit();
        });
        function check_if_can_submit() {
            var emptyNum = 0;
            if ($("#projectname").val() == "") {
                emptyNum++;
            }
            if ($("#advisorname").val() == "") {
                emptyNum++;
            }
            if ($("#advisorname").val() == "") {
                emptyNum++;
            }
            if ($("#numofstudent").val() == "") {
                emptyNum++;
            }
            if ($("#description").val() == "") {
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
        function jump() {
            document.location.href = "add-project.php";
        }

    </script>



    
</body></html>
