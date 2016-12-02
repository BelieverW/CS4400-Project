<?php session_start() ?>
<?php
    include "dbinfo.php";
    include "checkuser.php";
    include "checkuser_admin.php";

    $getApplicationRecord = $db->query("SELECT COUNT(*) AS NUM FROM APPLY")->fetch_assoc()['NUM'];
    $approvedNum = $db->query("SELECT COUNT(*) AS NUM FROM APPLY WHERE Status = 'Approved'")->fetch_assoc()['NUM'];
    $createView = "CREATE VIEW ACCEPT (PName,ACNumber) AS
                    SELECT PName, COUNT(*) FROM APPLY WHERE Status = 'Approved' GROUP BY PName
                    UNION
                    SELECT DISTINCT PName, 0 FROM APPLY AS A1 WHERE NOT EXISTS (SELECT * FROM APPLY AS A2 WHERE A1.PName = A2.PName and A2.Status = 'Approved')";
    $reportResult = "SELECT APPLY.PName AS NAME, COUNT(*) AS NUM, ACNumber/COUNT(*) AS RATE
                     FROM APPLY,ACCEPT
                     WHERE APPLY.PName = ACCEPT.PName
                     GROUP BY APPLY.PName
                     ORDER BY ACNumber/COUNT(*) DESC";
    $dropView = "DROP VIEW ACCEPT";
    $db->query($createView);
    $result = $db->query($reportResult);
    $db->query($dropView);
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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="lib/font-awesome/css/font-awesome.css">

    <script src="lib/jquery-1.11.1.min.js" type="text/javascript"></script>
    <link rel="SHORTCUT ICON" href="images/GTYellowJacketSmall.png">
    

    <link rel="stylesheet" type="text/css" href="stylesheets/theme.css">
    

    <!-- Latest compiled and minified JavaScript -->
    <script src="http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <!-- Latest compiled and minified Locales -->
    <script src="http://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
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
                    <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> Admin
                    <i class="fa fa-caret-down"></i>
                </a>

              <ul class="dropdown-menu">
			    <li><a tabindex="-1" href="reset-password.html">Reset Password</a></li>
                <li><a tabindex="-1" href="login.html">Logout</a></li>
              </ul>
            </li>    
          </ul>
        </div>
      </div>
    
    

    <div class="sidebar-nav">
    <ul>
		<ul>
		<li><a href="#" data-target=".dashboard-menu" class="nav-header" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i> Dashboard<i class="fa fa-collapse"></i></a></li>
		<li><ul class="dashboard-menu nav nav-list collapse">
				<li><a href="index_admin.php"><span class="fa fa-caret-right"></span> Main</a></li>
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
            
            <h1 class="page-title">Application Report</h1>
                    <ul class="breadcrumb">
            <li><a href="index_admin.php">Home</a> </li>
            <li class="active">Application Report</li>
        </ul>

        </div>

		
		<form>
            <span class="label label-info"><?php echo $getApplicationRecord; ?></span> applications in total, accepted <span class="label label-success"><?php echo $approvedNum; ?></span> applications<br><br>
		</form>
		
		
        <table id="application_table" class="table table-striped table-bordered" cellspacing="0" width="100%">       
        <thead>
            <tr>
                <th>Project Name</th>
                <th># of Applicants</th>
				<th>Acceptance Rate</th>
				<th>Top 3 Major</th>
            </tr>
        </thead>
        <tbody>
            <?php
                include "dbinfo.php";
                while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
                    $name = $rs['NAME'];
                    $numOfApplication = $rs['NUM'];
                    $rate = $rs['RATE'] * 100 . '%';
                    $topMajor = $db->query("SELECT MName
                                            FROM APPLY, USER
                                            WHERE PName = '$name' and SName = UName
                                            GROUP BY MName
                                            ORDER BY COUNT(*) DESC
                                            LIMIT 3");
                    $major = "";
                    while($data = mysqli_fetch_array($topMajor)) {
                        if ($major == "") {
                            $major = $data['MName'];
                        } else {
                            $major = $major . '/' . $data['MName'];
                        }
                    }
                    echo "<tr><td>$name</td><td>$numOfApplication</td><td>$rate</td><td>$major</td></tr>";
                }
            ?>
        </tbody>
        </table>



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
    </script>

</body>
</html>
