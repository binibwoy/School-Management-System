<html>
<div id="bodybg">
<head>
<title>Login Page</title>
<link rel="stylesheet" type="text/css" href="../css/login_style.css">
<div id="divheader">
  <h1>LOGIN</h1>
  <ul id = "ul">
	<li id="li"><a id = "lia"href="../php/index.php">HOME</a></li>
  </ul>
</div>
</head>
<body>
		
	   <div id="divmain">
       <p><h3 color="white">"Enter login details"</h3></p>
		<form action="checker.php" method="post">
		<div id="divlogin">
		  
			<table >
				<tr>
					<th colspan="2" align="center" id="header"><h3>LOGIN</h3></th>
				</tr>
				<tr id="btw">
					<td id="btw">Username</td>
				</tr>
				<tr>
					<td id="btw"><input type="text" name="username"></td>
				</tr>
				<tr>
					<td id="btw">Password</td>
				</tr>
				<tr>
					<td id="btw"><input type="password" name="pword"></td>
				</tr>
                <tr>
					<td style="color:#FFF">
						
                        <?php // To display Error messages
						
						if(isset($_GET['err'])){
						if ($_GET['err']==1){
						echo "Invalid Credentials.Try again!";}
						else if($_GET['err']==5){
						echo "Successfully Logged out...";}
						else if ($_GET['err']==2){
						echo "Access Denied!!!. Please login first";
						}
						}
						?>
						
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" ><input type="submit" name="btnlog" value="Login" id="btninput"></td>
				</tr>
				
				
				
			</table>
		  </div>
        </form>

		  <div id="divimg">
		  	<img src="../images/pdevlogo3.png" width="200%" height="70%">
		  </div>
		</div>
	</body>
    <footer >


	<div id="divfooter">
	   
	   <p><h4>All rights reserved &copy Perfect Developers 2017</h4></p>
		
	</div>
 </footer>
</div>
    

</html>