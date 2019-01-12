<?php

function getDb(){
	$dbn="myschool";
	$host="localhost";
	$username="root";
	$password="";
	$connect= new PDO("mysql:host=$host;dbname=$dbn;charset=utf8",$username,$password);
	return $connect;
	}
 ?>