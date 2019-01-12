<?php
session_start();
$user_id = $_SESSION["id"];
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]=="ADMIN"){
    echo "Welcome ".$user_id;
    }
else{
    header("Location:index.php?err=2");
    }
?>
<?php

    error_reporting( ~E_NOTICE );
    require_once("database_config.php");
    $connect=getDb();
    session_start();
    $user_id = $_SESSION["id"];
    $stmt = $connect->prepare('SELECT * FROM staff WHERE staffName = :uid');
    $stmt->execute(array(':uid' => $user_id));  


    
    
    
    if(isset($_POST['btn_save_updates']))
    {   
        $surn = $_POST['surname'];
        $other = $_POST['othernames'];
        $dob = $_POST['dob'];
        $gen = $_POST['gender'];
        $we = $_POST['weight'];
        $he = $_POST['height'];
        $add = $_POST['address'];
        $pho = $_POST['phone'];
        $cit = $_POST['city'];
        $sta = $_POST['state'];
        $user = $_POST['userr'];// user name
        $mi_id = $_POST['userr'];// user name
        #$suname = $_POST['sname'];// user name
        $positi = $_POST['posit'];// user position
        $mystat = $_POST['status'];
        $mystat2 = $_POST['status'];
        $mypos = $_POST['posit'];
            
        
        
        // if no error occured, continue ....
        if(!isset($errMSG))
        {
            $connect = getDb();
            $stmt = $connect->prepare('UPDATE staff
                                         SET surname = :surn,         
                                             othernames = :other,
                                             dob = :dob,
                                             gender = :gen,
                                             weight = :we,
                                             height = :he,
                                             address = :add,
                                             phone = :pho,
                                             city = :cit,
                                             state = :sta,
                                             staffName =:use, 
                                             position =:pos, 
                                             status = :stat 
                                       WHERE staffName =:sn');

            $stmt2 = $connect->prepare('UPDATE login_info
                                         SET id=:idd,
                                             access_level=:npos,
                                             status =:statt 
                                       WHERE id=:ide');

            $stmt->bindParam(':surn',$surn);
            $stmt->bindParam(':other',$other);
            $stmt->bindParam(':dob',$dob);
            $stmt->bindParam(':gen',$gen);
            $stmt->bindParam(':we',$we);
            $stmt->bindParam(':he',$he);
            $stmt->bindParam(':add',$add);
            $stmt->bindParam(':pho',$pho);
            $stmt->bindParam(':cit',$cit);
            $stmt->bindParam(':sta',$sta);
            $stmt->bindParam(':use',$user);
            $stmt->bindParam(':pos',$positi);
            $stmt->bindParam(':sn',$id);
            $stmt->bindParam(':stat',$mystat);


            $stmt2->bindParam(':statt',$mystat2);
            $stmt2->bindParam(':idd',$mi_id);
            $stmt2->bindParam(':ide',$mi_id2);
            $stmt2->bindParam(':npos',$mypos);

            
                
            if($stmt->execute() && $stmt2->execute()){
                /*var_dump($mi_id);
                var_dump($user);
                var_dump($mi_id2);
                var_dump($id);*/
                ?>
                <script>
                alert('Successfully Updated ...');
                window.location.href='update.php';
                </script>
                <?php
            }
            else{
                $errMSG = "Sorry Data Could Not Updated !";
                
            }
        
        }
        
                        
    }
    
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Perfect Developers">

    <title>My Profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="../pdevng/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../pdevng/css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../pdevng/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!--Pdevng custom css :-) -->

    <link rel="stylesheet" type="text/css" href="../css/attach.css">
    <link rel="icon" type="image/png/ico" href="../page_images/favicon.png">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="admin.php">SCHOOL MANAGEMENT SYSTEM</a>
            </div>
            
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php
                            if($stmt->rowCount() > 0)
                            {
                                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                                {
                                    extract($row);
                                    ?>
                        <div class="col-xs-3 ">
                            <img src="../staff_images/<?php echo $row['staffPic']; ?>" class="img-circle" width="30px" height="30px" />
                        </div>
                    <i class="fa fa-user"></i><?php echo "&nbsp&nbsp&nbsp".$user_id;  ?> <b class="caret"></b></a>
                    
                    <ul class="dropdown-menu">
                        <li>
                            <a href="myprofile.php"><i class="fa fa-fw fa-user"></i>My Profile</a>
                        </li>
                        <li>
                            <a href="changepass.php?edit_id=<?php echo $user_id ?>"><i class="fa fa-fw fa-gear"></i>Password</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="admin.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="../staff/staff.php"><i class="fa fa-fw fa-users"></i> Staff Portal</a>
                    </li>
                    <li>
                        <a href="staffsearch.php"><i class="fa fa-fw fa-search"></i> Search Staff</a>
                    </li>
                    <li>
                        <a href="staffreg.php"><i class="fa fa-fw fa-plus-circle"></i> Create Staff</a>
                    </li>
                    <li>
                        <a href="verify_user.php"><i class="fa fa-fw fa-wrench"></i> Recover password</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            My <small>Profile</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-user"></i> My Profile
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <br/>
                
                <div class="clearfix"></div>

                        

                        
                                    <div class="col-xs-3 ">
                                        <div class="img-top">
                                        <p class="page-header"><?php echo $row['staffName']; ?>&nbsp/&nbsp<?php echo $row['position']; ?>
                                            &nbsp/&nbsp<?php echo $row['status']?>
                                        </p>
                                        <img src="../staff_images/<?php echo $row['staffPic']; ?>" class="img-rounded" width="150px" height="150px" />
                                        </div>
                                    </div>
                                    
                        <?php 
                                }
                            }    
                                ?>



                    
                        
                        
                        
                        
                        <table class="table table-bordered table-responsiv">

                        <tr>
                            <td><label class="control-label">Surname</label></td>
                            <td><input class="form-control" type="text" name="surname" placeholder="Enter Surname" value="<?php echo $surname; ?>"  readonly></input></td>

                            <td><label class="control-label">First Name</label></td>
                            <td><input class="form-control" type="text" name="othernames" value="<?php echo $othernames; ?>" readonly></input></td>
                       </tr>

                       <tr>
                            <td><label class="control-label">Date Of Birth</label></td>
                            <td><input class="form-control" type="date" name="dob" value="<?php echo $dob; ?>" readonly/></td>

                            <td><label class="control-label">Gender</label></td>
                            <td><input class="form-control" type="text" name="dob" value="<?php echo $gender; ?>" readonly /></td>
                        </tr>    
                        
                        <tr>
                            <td><label class="control-label">Weight (Pounds)</label></td>
                            <td><input class="form-control" type="text" name="weight" value="<?php echo $weight; ?>"  readonly></input></td>

                            <td><label class="control-label">Height (cm)</label></td>
                            <td><input class="form-control" type="text" name="height" value="<?php echo $height; ?>" readonly></input></td>
                        </tr>

                        <tr>
                            <td ><label class="control-label">Street Address</label></td>
                            <td><input  class="form-control" name="address" cols="30" value="<?php echo $address; ?>" readonly></input></td>

                          

                            <td><label class="control-label">Phone Number</label></td>
                            <td><input class="form-control" type="text" name="phone" value="<?php echo $phone ?>" readonly></input></td>
                          
                        </tr>

                        <tr>
                            <td><label class="control-label">City</label></td>
                            <td><input class="form-control" type="text" name="city" cols="30" value="<?php echo $city; ?>" readonly></textarea></td>

                            <td><label class="control-label">State</label></td>
                            <td><input class="form-control" type="text" name="state" value="<?php echo $state; ?>" readonly></input></td>
                        </tr>
                        
                        <tr>
                            <td><label class="control-label">Username</label></td>
                            <td><input class="form-control" type="text" name="userr" value="<?php echo $staffName; ?>" readonly /></td>
                        
                            <td><label class="control-label">Position</label></td>
                            <td><input class="form-control" type="text" name="posit" value="<?php echo $position; ?>"  readonly /></td>
                        </tr>
                        
                        <tr>
                            <td><label class="control-label">Status</label></td>
                            <td colspan="3"><input class="form-control" type="text" name="status" value="<?php echo $status; ?>" readonly /></td>
                        </tr>
                        
                        
                        <tr>
                            <td colspan="4">
                                <a href="../php/update.php?edit_id=<?php echo $staffName; ?>">
                                <button type="submit" name="btn_update" class="btn btn-primary">
                                <span class="glyphicon glyphicon-edit"></span> &nbsp; Update
                                </span>
                                </button>
                                </a>
                            </td>
                        </tr>
                        
                        </table>


                        
                    

               

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../pdevng/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../pdevng/js/bootstrap.min.js"></script>

   

</body>

<footer >
    <div>
        <strong>All rights reserved &copy Perfect Developers 2017</strong>
    </div>
 </footer>

</html>
