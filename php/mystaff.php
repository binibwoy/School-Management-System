
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no" />
<title>Admin</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../bootstrap/css/bootstrap-theme.min.css">
<style type="text/css">
		body {
			font-size: 15px;
			color: #343d44;
			font-family: "segoe-ui", "open-sans", tahoma, arial;
			padding: 0;
			margin: 0;
		}
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		h1 {
			margin: 25px auto 0;
			text-align: center;
			text-transform: uppercase;
			font-size: 17px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
</head>

<body>

<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
        	<a class="navbar-brand" href='../php/admin.php'>HOME &nbsp;&nbsp;&nbsp;&nbsp; </a>
            <a class="navbar-brand" href='../staff/staff.php'>STAFF PORTAL  &nbsp;&nbsp;&nbsp;&nbsp; </a>
            <a class="navbar-brand" href='../php/admin.php'>PASSWORD RECOVERY  &nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a class="navbar-brand" href='../php/logout.php'>LOGOUT</a>
        </div>
 
    </div>
</div>

<div class="container">

	<div class="page-header">
    	<h1 class="h2">ALL STAFF &nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-default" href="../php/staffreg.php"> <span class="glyphicon glyphicon-plus"></span> &nbsp; add new </a></h1> 
    </div>
    
<br />
<br/>

<div class="row">

<?php





?>

	

	<h1>STAFF</h1>
	<table class="data-table">
		<caption class="title">STAFF OF PERFECT SCHOOL</caption>
		<br/>
		<br/>
		<thead>
			<tr>
				<th>NO</th>
				<th>STAFF ID</th>
				<th>SURNAME</th>
				<th>OTHERNAME</th>
				<th>DATE</th>
				<th>POSTION</th>
				<th></th>
			</tr>
		</thead>
		<tbody>

	<?php
		require_once("database_config.php");
		$no 	= 1;
		$total 	= 0;	
		$connect = getDb();
		$sql = 'SELECT staffName, surname, othernames, dob, position FROM staff';
		$stmt = $connect->prepare($sql);
		$stmt -> execute();
		
		while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
		{
			
			echo '<tr>
					<td>'.$no.'</td>
					<td>'.$row['staffName'].'</td>
					<td>'.$row['surname'].'</td>
					<td>'.$row['othernames'].'</td>
					<td>'. date('F d, Y', strtotime($row['dob'])) . '</td>
					<td>'.$row['position'].'</td>
					<td><a href="../php/staffINFO.php?view_id='.$row['staffName'].' ">
						<button type="submit" name="btnview" class="btn btn-primary">
		        		<span class="glyphicon glyphicon-eye-open"></span> &nbsp; View Details
		        		</span>
		        		</button>
		        		</a>
		        	</td>
				</tr>';

				$no++;
			
		}?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="6">TOTAL STAFF</th>
				<th><?=number_format($total)?></th>
			</tr>
		</tfoot>
	</table>
</div>	

<br/>
<br/>
<br/>
<br/>
<br/>

<div class="alert alert-info">
    <strong>All rights reserved &copy Perfect Developers 2017</strong>
</div>

</div>


<!-- Latest compiled and minified JavaScript -->
<script src="../bootstrap/js/bootstrap.min.js"></script>


</body>
</html>