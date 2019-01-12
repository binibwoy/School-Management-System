<?php // To display Error messages
						
	if(isset($_GET['err'])){
		if ($_GET['err']==1){
			$errMSG = "Invalid Credentials!!!. Try again!";
		}
		else if($_GET['err']==5){
			$errMSG = "Successfully Logged out...";
		}
		else if ($_GET['err']==2){
			$errMSG = "Access Denied!!!. You are not authorized to access this page";
		}
		else if ($_GET['err']==7) {
			$errMSG = "Access Denied!!!. You are no longer an active staff";
		}
		else if($_GET['err']==3){
			$errMSG = "Please enter your username and password to proceed!!!";
		}
	}
?>

<html> 
<head>
<title>School Management System</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap-theme.css">
<link rel="stylesheet" type="text/css" href="../css/attach.css">
<link rel="icon" type="image/png/ico" href="../page_images/favicon.png">
<div id="divheader">
  
  <div class="nav-container navbar navbar-default navbar-static-top " role="navigation">
    
 			<img src="../page_images/combinedlogo1.png">
 		
        <div class="navbar-header">
        	<h1 class="mynavbar">SCHOOL MANAGEMENT SYSTEM</h1>
        </div>
 
    
</div>
</head>

<body>


<?php
	if(isset($errMSG)){
		?>
        <div class="loginerr">
          <span class=" glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
<div class="container">

<div >
		<form action="checker.php" method="post" enctype="multipart/form-data" class="form-horizontal">
		<div id="divlogin">
		  
			<table class="table-log table-responsive">
				
            <tr>
		    	<td><label class="control-label userp">Username</label></td>
		    </tr>
		    <tr>
		        <td><input class="form-control" type="text" name="username"  placeholder="Enter Username" /></td>
		    </tr>
		    
		    <tr>
		    	<td><label class="control-label userp">Password</label></td>
		    </tr>

		    <tr>
		        <td><input class="form-control" type="password" name="pword" placeholder="Enter Password" /></td>
		    </tr>

		    <tr>
		        <td><a href="forgotpassword.php"><h5> Forgot your password? </h5></a></td>
		    </tr>

		    <tr>
					<td style="color:#d33">
						
                        
						
					</td>
				</tr>
		    
		    <tr>
		        <td colspan="2" align="center"><button type="submit" name="btnlog" class="btn btn-primary">
		        <span class="glyphicon glyphicon-log-in"></span> &nbsp; Login
		        </button>
		        </td>
		    </tr>
				
				
				
				
			</table>
		  </div>
        </form>
	
</div>
</div>
</div>

</body>
	
<footer class="login-footer">
	<div>
    	<strong>All rights reserved &copy Perfect Developers 2017</strong>
	</div>
 </footer>

</html>