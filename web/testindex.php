<?php
if(isset($_POST['submit'])) {
$fullname = $_POST['fullname'];
echo $fullname;
}
?>
<html>
<head>
  <title>Undefined Index Example</title>
</head>
<body>
				
		<div style="margin: 100px auto 0;width: 300px;">
		<h3>HTML Form</h3>
			<form name="form1" id="form1" action="" method="POST">
                    <fieldset>
                      Enter Full Name <input type="text" name="fullname" placeholder="Full Name" />
                      <br />
					  <input type="submit" name="submit" value="submit" />
                    </fieldset>
            </form>
		</div>
					
</body>
</html>