<?php
session_start();
$user_id = $_SESSION["id"];
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]=="ADMIN"){
    echo "Welcome ".$user_id;
    }
else{
    header("Location:../staff/staff.php?err=2");
    }
?>

<?php

	error_reporting( ~E_NOTICE ); // avoid notice
	
	require_once ('../php/database_config.php');
	
	if(isset($_POST['save']))
	{
		$class = $_POST['dclass'];
		$tuition = $_POST['dtuition'];
		$exam = $_POST['dexam'];
		$develop = $_POST['ddevelop'];
		$sport = $_POST['dsport'];
		$schoolfees = $tuition + $exam + $develop + $sport;
		$total2 = $_POST['dschoolfees2'];
		$total3 = $_POST['dschoolfees3'];


		$stmt_select = $connect->prepare('SELECT * FROM fees WHERE class = :clas');
        $stmt_select -> execute(array(':clas' => $class));
        $classRow=$stmt_select->fetch(PDO::FETCH_ASSOC);
        extract(array($classRow));

		if ($class){
			$dbclass = $classRow['class'];
		    if ($class == $dbclass) {
		    	$errMSG = "Fees for ".$dbclass." has been defined.";
		    }
		}
	
		


		if(empty($class)){
			$errMSG = "Please Select class.";
		}
		if(empty($tuition)){
			$errMSG = "Please Enter Tuition fees.";
		}
		if(empty($exam )){
			$errMSG = "Please Enter Exam fees.";
		}
		
		if(empty($develop)){
			$errMSG = "Please Enter Development fees.";
		}
		
		if(empty($sport)){
			$errMSG = "Please Enter Sport levy.";
		}
		
		if(empty($total2)){
			$errMSG = "Please Enter Second term school fees.";
		}

		if(empty($total3)){
			$errMSG = "Please Enter Third term school fees.";
		}
		
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$connect= getDb();
			$stmt = $connect->prepare('INSERT INTO fees(class, tuition_fees, exam_fees, development_levy, sports_levy, total, total2, total3)
									   VALUES(:cla, :tuit, :exa, :dev, :sport, :tot, :t2, :t3)');
								   
									   
			
			$stmt->bindParam(':cla',$class);
			$stmt->bindParam(':tuit',$tuition);
			$stmt->bindParam(':exa',$exam);
			$stmt->bindParam(':dev',$develop);
			$stmt->bindParam(':sport',$sport);
			$stmt->bindParam(':tot',$schoolfees);
			$stmt->bindParam(':t2', $total2);
			$stmt->bindParam(':t3', $total3);

			
			if($stmt->execute())
			{
				$successMSG = "new record succesfully inserted ...";
				header("refresh:3;../staff/transactions.php"); // redirects transactions page after 5 seconds.
			}

			else
			{
				$errMSG = "error while inserting....";
			}
		}
	}
?>