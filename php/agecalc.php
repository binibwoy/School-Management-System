<?php
		function age(){
    		#$dob = $_POST['dob'];
    		$age = date_diff(date_create('1995-02-07'), date_create('today'))->y;
    		return $age;
    	}

    	$myage = age();
    	echo $myage;
?>