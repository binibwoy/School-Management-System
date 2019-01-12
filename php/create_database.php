<?php
$dbn="myschool";
$host="localhost";
$username="root";
$password="";
$createTab1 = "CREATE TABLE IF NOT EXISTS login_info(
				   id VARCHAR(15) NOT NULL,
				   password VARCHAR(255) NOT NULL,
				   access_level VARCHAR(30) NOT NULL,
				   last_updated TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				   PRIMARY KEY(id))";

$createtab2 = "CREATE TABLE IF NOT EXISTS staff(
				  surname VARCHAR(20) NOT NULL,
				  othernames CHAR(50) NOT NULL,
				  dob DATE NOT NULL,
				  gender CHAR(6) NOT NULL,
				  weight FLOAT(10) NOT NULL,
				  height INT(10) NOT NULL,
				  address VARCHAR(20) NOT NULL,
				  phone VARCHAR(11) NOT NULL,
				  city VARCHAR(20) NOT NULL,
				  state VARCHAR(20) NOT NULL,
				  staffName VARCHAR(20) NOT NULL,
				  staffPassword VARCHAR(255) NOT NULL,
				  staffPic VARCHAR(200) NOT NULL,
				  position VARCHAR(30) NOT NULL,
				  status VARCHAR(30) NOT NULL,
				  doe DATE NOT NULL,
				  dot DATE NOT NULL,
				  sch_position VARCHAR(30) NOT NULL,
				  email VARCHAR(50) NOT NULL,
				  last_updated TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  UNIQUE (phone),
				  PRIMARY KEY (staffName))";

$createtab3 = "CREATE TABLE IF NOT EXISTS student(
				  surname VARCHAR(20) NOT NULL,
				  othernames CHAR(50) NOT NULL,
				  dob DATE NOT NULL,
				  gender CHAR(6) NOT NULL,
				  weight FLOAT(10) NOT NULL,
				  height INT(10) NOT NULL,
				  address VARCHAR(20) NOT NULL,
				  phone VARCHAR(11) NOT NULL,
				  city VARCHAR(20) NOT NULL,
				  state VARCHAR(20) NOT NULL,
				  studentID VARCHAR(20) NOT NULL,
				  studentPic VARCHAR(200) NOT NULL,
				  class VARCHAR(4) NOT NULL,
				  status VARCHAR(30) NOT NULL,
				  tuition_fees INT(10) NOT NULL,
				  exam_fees INT(10) NOT NULL,
				  development_levy INT(10) NOT NULL,
				  sports_levy INT(10) NOT NULL,
				  total INT(10) NOT NULL,
				  Title1 VARCHAR(10) NOT NULL,
				  Surname1 VARCHAR(30) NOT NULL,
				  Firstname1 VARCHAR(30) NOT NULL,
				  Relate1 VARCHAR(15) NOT NULL,
				  Email1 VARCHAR(30) NOT NULL,
				  Phone1 VARCHAR(11) NOT NULL,
				  Photo1 VARCHAR(200) NOT NULL,
				  Occupation1 VARCHAR(15) NOT NULL,
				  Title2 VARCHAR(10) NOT NULL,
				  Surname2 VARCHAR(30) NOT NULL,
				  Firstname2 VARCHAR(30) NOT NULL,
				  Relate2 VARCHAR(15) NOT NULL,
				  Email2 VARCHAR(30) NOT NULL,
				  Phone2 VARCHAR(11) NOT NULL,
				  Photo2 VARCHAR(200) NOT NULL,
				  Occupation2 VARCHAR(15) NOT NULL,
				  last_updated TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  UNIQUE (phone),
				  PRIMARY KEY (studentID))";

$createtab4 = "CREATE TABLE IF NOT EXISTS fees(
				  class VARCHAR(4) NOT NULL,
				  tuition_fees INT(10) NOT NULL,
				  exam_fees INT(10) NOT NULL,
				  development_levy INT(10) NOT NULL,
				  sports_levy INT(10) NOT NULL,
				  total INT(10) NOT NULL,
				  total2 INT(10) NOT NULL,
				  total3 INT(10) NOT NULL,
				  last_updated TIMESTAMP on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				  PRIMARY KEY (class))";
                   
				  /*ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51";*/


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


try{
	$connect = new PDO("mysql:host=$host", $username,$password);
	$connect -> exec("CREATE DATABASE $dbn");
	echo "Database successfully created";
	$connect -> query("USE $dbn");
	$connect -> query($createTab1);
	$connect -> query($createtab2);
	$connect -> query($createtab3);
	$connect -> query($createtab4);

}
catch (PDOException $error){
	die("Failed to connect to Database: ".$error->getMessage());
	}

?>