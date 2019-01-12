<?php
session_start();
$user_id = $_SESSION["id"];
if(isset($_SESSION["access_level"]) && $_SESSION["access_level"]==0){
    echo "Welcome ".$user_id;
    }
else{
    header("Location:index.php?err=2");
    }
?>
<?php

    error_reporting( ~E_NOTICE );
    require_once("database_config.php");
    $connect = getDb();

    if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
    {
        $id = $_GET['edit_id'];
        $mi_id2 = $_GET['edit_id'];
        $stmt_edit = $connect->prepare('SELECT * FROM login_info WHERE id =:sn');
        $stmt_edit->execute(array(':sn'=>$id));
        $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        extract($edit_row);
    }
    
    else
    {
        header("Location: myprofile.php");
    }
    
    
    
    if(isset($_POST['btn_change_password'])){

        $dbpass=$edit_row['password'];
        $pass = $_POST['pass'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];

        if (empty($pass) || empty($pass1) || empty($pass2)) {
            $errMSG = "One or more fields are empty";
        }

        $saltpass="kbzbnkbnbgkskbbjn".$pass."o0599569mzmb.....bhgtbh";
        $hashsalt=hash('sha512', $saltpass);

        $saltpass1="kbzbnkbnbgkskbbjn".$pass1."o0599569mzmb.....bhgtbh";
        $hashsalt1=hash('sha512', $saltpass1);

        $saltpass2="kbzbnkbnbgkskbbjn".$pass2."o0599569mzmb.....bhgtbh";
        $hashsalt2=hash('sha512', $saltpass2);
            
        // if no error occured, continue ....
        if (!isset($errMSG)){
            if ($dbpass == $hashsalt) {
                if($hashsalt1 == $hashsalt2){
                    $connect = getDb();
                    $stmt = $connect->prepare('UPDATE login_info
                                                 SET password=:pas
                                               WHERE id=:sn');

                    /*$stmt2 = $connect->prepare('UPDATE login_info
                                                 SET password=:pass 
                                               WHERE id=:ide');*/

                    $stmt->bindParam(':pas',$hashsalt1);
                    $stmt->bindParam(':sn',$id);

                    /*$stmt2->bindParam(':pass',$mi_id);
                    $stmt2->bindParam(':ide',$mi_id2);*/

                        
                            
                    if($stmt->execute()){
                        $successMSG = "Password Successfully Changed";
                    }

                    else{
                        $errMSG = "Sorry Data Could Not Updated !";
                        
                    }
                    
                }
                else {
                $errMSG ="New Passwords Do Not Match";
            }
                
            }
            else {
                $errMSG ="Old password is not correct";
                //var_dump($dbpass);
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

    <title>Change my password</title>

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
                            
                            
                            $stmt_prof = $connect->prepare('SELECT * FROM staff WHERE staffName = :uid');
                            $stmt_prof->execute(array(':uid' => $user_id));

                            if($stmt_prof->rowCount() > 0)
                            {
                                while($row=$stmt_prof->fetch(PDO::FETCH_ASSOC))
                                {
                                    extract($row);
                                    ?>
                        <div class="col-xs-3 ">
                            <img src="../staff_images/<?php echo $row['staffPic']; ?>" class="img-circle" width="30px" height="30px" />
                        </div>
                    <?php 
                        }   
                        }?>
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
                            Admin <small>Change Password</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-wrench"></i> Change my Password
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <br/>

                <div class="clearfix"></div>

                    <form method="post" enctype="multipart/form-data" class="form-horizontal">
                        
                        
                        <?php
                        if(isset($errMSG)){
                            ?>
                            <div class="alert alert-danger">
                              <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
                            </div>
                            <?php
                    }
                        else if(isset($successMSG)){
                        ?>
                        <div class="alert alert-success">
                              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
                        </div>
                        <?php
                        }
                        
                        ?>
                       
                        
                        <table class="table table-bordered table-responsive">
                        
                        <tr>
                            <td><label class="control-label">Old Password</label></td>
                            <td><input class="form-control" type="password" name="pass"  placeholder="Enter Old Password"/></td>
                        </tr>
                        
                        <tr>
                            <td><label class="control-label">New Password</label></td>
                            <td><input class="form-control" type="password" name="pass1" placeholder="Enter New Password" /></td>
                        </tr>
                        
                        <tr>
                            <td><label class="control-label">Confirm Password</label></td>
                            <td><input class="form-control" type="password" name="pass2" placeholder="Confirm New Password" /></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2"><button type="submit" name="btn_change_password" class="btn btn-primary">
                            <span class="glyphicon glyphicon-save"></span> Change Password
                            </button>
                            
                            <a class="btn btn-primary" href="myprofile.php?=<?php echo $id;?>"> <span class="glyphicon glyphicon-backward"></span> cancel </a>
                            
                            </td>
                        </tr>
                        
                        </table>
                        
                    </form>

                    </div>
                

                

               

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
