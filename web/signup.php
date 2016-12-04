<?php session_start() ?>
<?php
$userAlreadyExist = FALSE;
$emailNotExist = FALSE;
$emailNotValid = FALSE;
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['signup'])) {
        include "dbinfo.php";

        $myusername = mysqli_real_escape_string($db, $_GET['username']);
        $mygtemail = mysqli_real_escape_string($db, $_GET['gtemail']);
        $mypassword = mysqli_real_escape_string($db, $_GET['password']);

        $emailSuffix = explode("@",$mygtemail)[1];
        if (strpos($emailSuffix, 'gatech.edu') !== false) {
            $sql1 = "SELECT UName FROM USER WHERE UName = '$myusername'";
            $result1 = mysqli_query($db, $sql1);
            $row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
            //$active = $row['active'];

            $count = mysqli_num_rows($result1);

            // If result matched $myusername and $mypassword, table row must be 1 row

            if ($count == 1) {
                $userAlreadyExist = TRUE;
            } else {
                $sql2 = "SELECT GTEmail FROM USER WHERE GTEmail = '$mygtemail'";
                $result2 = mysqli_query($db, $sql2);
                $count2 = mysqli_num_rows($result2);
                if ($count2 == 1) {
                    $emailNotExist = TRUE;
                } else {
                    $sql3 = "INSERT INTO USER VALUES ('$myusername','$mypassword','student', '$mygtemail', 'Freshman', NULL)";
                    if (mysqli_query($db, $sql3)) {
                        $_SESSION['login_user'] = $myusername;
                        $_SESSION['user_type'] = 'student';
                        header("location: index_user.php");
                    } else {
                        echo "Error: " . $sql3 . "<br>" . mysqli_error($db);
                    }
                }
            }
        } else {
            $emailNotValid = TRUE;
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
            <a class="" href="index.php"><span class="navbar-brand"><img src="images/GTYellowJacket3.png" height="30"></span> <span class="navbar-brand">Georgia Tech SLS</span></a></div>

        <div class="navbar-collapse collapse" style="height: 1px;">

        </div>
      </div>
    </div>
    


        <div class="dialog">
    <div class="panel panel-default">
        <p class="panel-heading no-collapse">Sign Up</p>
        <div class="panel-body">
            <form role="form" action="" method="get">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control span12" id="sign_up_username" name="username" oninput="check_if_can_signup()"/>
                    <?php
                    if ($userAlreadyExist === TRUE) {
                        echo '<p class="text-danger" id="msg">
                                <strong>Your Username is invalid.</strong>
                            </p>';
                        echo '<script>
                                 window.setTimeout("hideMsg()", 10000);
                              </script>';
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label>GT Email Address</label>
                    <input type="text" class="form-control span12" id="sign_up_email" name="gtemail" oninput="check_if_can_signup()"/>
                    <?php
                    if ($emailNotExist === TRUE) {
                        echo '<p class="text-danger" id="msg">
                                <strong>Your GT Email already exists.</strong>
                            </p>';
                        echo '<script>
                                 window.setTimeout("hideMsg()", 10000);
                              </script>';
                    }
                    if ($emailNotValid === TRUE) {
                        echo '<p class="text-danger" id="msg">
                                <strong>Your GT Email is invalid.</strong>
                            </p>';
                        echo '<script>
                                 window.setTimeout("hideMsg()", 10000);
                              </script>';
                    }
                    ?>
                </div>
                <div class="form-group has-feedback" id="pw_group">
                    <label>Password</label>
                    <input type="password" class="form-control span12" id="sign_up_pw" name="password" oninput="check_if_can_signup()"/>
                    <span class="glyphicon form-control-feedback" style="visibility:hidden"></span>
                </div>
                <div class="form-group has-feedback" id="pw_check_group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control span12" id="sign_up_pw_check"  name="repassword" oninput="check_if_can_signup()"/>
                    <span class="glyphicon form-control-feedback" style="visibility:hidden" id="pw_check"></span>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-sm-12">
                        <div class="alert alert-warning alert-dismissible" role="alert" style="visibility:hidden" id="warning">
                            <strong>Warning::</strong> Please <strong>check</strong> your password.
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <a href="login.php" class="btn btn-primary col-md-offset-6 col-sm-offset-6 col-xs-offset-5">Sign In!</a>
                    <button type="submit" class="sign-up-btn btn btn-primary pull-right" disabled="disabled" name="signup">Sign Up!</button>
                    <!--<label class="remember-me"><input type="checkbox"> I agree with the <a href="terms-and-conditions.html">Terms and Conditions</a></label>-->
                </div>
                    <div class="clearfix"></div>
            </form>
        </div>
    </div>
    <!--<p><a href="privacy-policy.html" style="font-size: .75em; margin-top: .25em;">Privacy Policy</a></p>--> 

</div>



    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <script src="lib/d3.v3.min.js"></script>
    <script type="text/javascript">
        function hideMsg() {
            d3.select("#msg").remove();
        }
        function check(){
	       if(document.getElementById("sign_up_pw").value!=
		          document.getElementById("sign_up_pw_check").value)
	           {
		          $("#warning").css("visibility", "visible");
                  $("#pw_check").css("visibility", "visible");
                  $("#pw_check").removeClass("glyphicon-ok");
                  $("#pw_check").addClass("glyphicon-remove");
                  $("#pw_check_group").removeClass("has-success");
                  $("#pw_check_group").addClass("has-error");
	           }else{
		          $("#warning").css("visibility", "hidden");
                  $("#pw_check").removeClass("glyphicon-remove");
                  $("#pw_check").addClass("glyphicon-ok");
                  $("#pw_check_group").removeClass("has-error");
                  $("#pw_check_group").addClass("has-success");
	           }
        }
        function check_if_can_signup() {
            var emptyNum = 0;
            if ($("#sign_up_username").val() == "") {
                emptyNum++;
            }
            if ($("#sign_up_email").val() == "") {
                emptyNum++;
            }
            if ($("#sign_up_pw").val() == "") {
                emptyNum++;
            }
            if ($("#sign_up_pw_check").val() == "") {
                emptyNum++;
            }
            if (document.getElementById("sign_up_pw").value!=
                    document.getElementById("sign_up_pw_check").value) {
                emptyNum++;
                $("#warning").css("visibility", "visible");
                $("#pw_check").css("visibility", "visible");
                $("#pw_check").removeClass("glyphicon-ok");
                $("#pw_check").addClass("glyphicon-remove");
                $("#pw_check_group").removeClass("has-success");
                $("#pw_check_group").addClass("has-error");
            } else {
                $("#warning").css("visibility", "hidden");
                $("#pw_check").removeClass("glyphicon-remove");
                $("#pw_check").addClass("glyphicon-ok");
                $("#pw_check_group").removeClass("has-error");
                $("#pw_check_group").addClass("has-success");
            }
            if (emptyNum != 0) {
                d3.select(".sign-up-btn")
                        .attr("disabled", "disabled");
            } else {
                d3.select(".sign-up-btn")
                        .attr("disabled", null);
            }
        }
    </script>
    
  
</body></html>
