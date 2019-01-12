<?php
session_start();
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]=="ADMIN"){
	echo "Hello Admin ".$_SESSION["id"];
	}
else{
	header("Location:login.php?err=2");
	}
?>

<?php

	require_once 'database_config.php';
	
	if(isset($_GET['delete_id']))
	{
		$connect=getDb();
		// select image from db to delete
		$stmt_select = $connect->prepare('SELECT staffPic FROM staff WHERE staffName = :sid');
		$stmt_select->execute(array(':sid'=>$_GET['delete_id']));
		$imgRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
		unlink("../staff_images/".$imgRow['staffPic']);
		
		// it will delete an actual record from db
		$stmt_delete = $connect->prepare('DELETE FROM staff WHERE staffName = :sid');
		$stmt_delete->bindParam(':sid',$_GET['delete_id']);
		$stmt_delete->execute();
		
		header("Location: ../php/admin.php");
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>Admin</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
</head>

<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
            <a class="navbar-brand" href='../php/staff.php'>STAFF DASHBOARD                </a>
            <a class="navbar-brand" href='../php/admin.php'>PASSWORD RECOVERY                </a>
            <a class="navbar-brand" href='../php/logout.php'>LOGOUT</a>
        </div>
 
    </div>
</div>

<div class="container">

	<div class="page-header">
    	<h1 class="h2">ALL STAFF &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default" href="../php/staffreg.php"> <span class="glyphicon glyphicon-plus"></span> &nbsp; add new </a></h1> 
    </div>
    
<br />

<div class="row">
<?php
	
	$connect=getDb();
	$stmt = $connect->prepare('SELECT staffName, staffPic FROM staff ORDER BY staffName DESC');
	$stmt->execute();

	
	
	if($stmt->rowCount() > 0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			extract($row);
			?>
			<div class="col-xs-3">
				<p class="page-header"><?php echo $staffName ?></p>
				<img src="../staff_images/<?php echo $row['staffPic']; ?>" class="img-rounded" width="250px" height="250px" />
				<p class="page-header">
				<span>
				<a class="btn btn-info" href="editform.php?edit_id=<?php echo $row['staffName']; ?>" title="click for edit" onclick="return confirm('sure to edit ?')"><span class="glyphicon glyphicon-edit"></span> Edit</a> 
				<a class="btn btn-danger" href="?delete_id=<?php echo $row['staffName']; ?>" title="click for delete" onclick="return confirm('sure to delete ?')"><span class="glyphicon glyphicon-remove-circle"></span> Delete</a>
				</span>
				</p>
			</div>       
			<?php
		}
	}
	else
	{
		?>
        <div class="col-xs-12">
        	<div class="alert alert-warning">
            	<span class="glyphicon glyphicon-info-sign"></span> &nbsp; No Data Found ...
            </div>
        </div>
        <?php
	}
	
?>
</div>	



<div class="alert alert-info">
    <strong>All rights reserved @ Perfect Developers 2017</strong>
</div>

</div>


<!-- Latest compiled and minified JavaScript -->
<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>
</html>