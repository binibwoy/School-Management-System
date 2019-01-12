<?php
require_once("database_config.php");

function check_input($r){
	
	$r=trim($r);
	$r=strip_tags($r);
	$r=stripslashes($r);
	$r=htmlentities($r);
	
	return $r;
	}
	#function create_salt($salted){
	#	$connect=getDb();
	#	$stmt=$connect -> prepare("SELECT salt FROM login_info WHERE id = ?" );
	#	$stmt -> execute(array($salted));
	#	$r=$stmt->fetch(PDO::FETCH_ASSOC);
	#	return $r['salt'];
	#	}

if (isset($_POST['username'],$_POST['pword'])){
	$connect=getDb();

	$u=check_input($_POST['username']);
	$p=check_input($_POST['pword']);

	
	//mysqli_real_escape_string($connect, $u);
	//mysqli_real_escape_string($connect, $p);
	//$saltpass=md5(create_salt($u).$p);
	//$hash = password_hash($p, PASSWORD_DEFAULT);
	$salt = "kbzbnkbnbgkskbbjn".$p."o0599569mzmb.....bhgtbh";
	$hash = hash('sha512',$salt);
	try{
	$connect=getDb();
	$stmt=$connect->prepare("SELECT * FROM login_info WHERE id=? && password=?");
	$stmt->execute(array($u,$hash));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	//$rp=$row['password'];    //hashed password in db
	// ($row['password']==$hash)
	if (!empty($u) && !empty($p)){
		if(($row['password']==$hash) && ($row)){

			session_start();
			$_SESSION['id']=$row['id'];
			$access_level=$row['access_level'];
			$status = $row['status'];
			$_SESSION['access_level']=$access_level;

			if ($status == "ACTIVE") {

				if ($access_level=="ACADEMIC STAFF"){

				header("Location: ../staff/staff.php");
				}
				else if($access_level=="ADMIN"){
					header("Location: admin.php");
					}
				//var_dump(password_verify($rp,$hash));
				#echo $u;
				#echo "<br/>";
				#echo $p;
				#echo "<br/>";
				//var_dump($row['password']);
				//var_dump($hash); 
				#echo "<br/>";
				#var_dump($row);
				#echo "<br/>";
				#var_dump($stmt);
				}
				
			else{
			header("Location:index.php?err=7");
			}
			}
		else{
			header("Location:index.php?err=1");
			}
	
	}
	else {
		header("location: ../php/index.php?err=3");
		}
	}
	catch(PDOException $e){
		die("Database error: ".$e->getMessage());
	}
}
else{
	header("Location: index.php");
	}
?>
