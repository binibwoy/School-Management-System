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

    error_reporting( ~E_NOTICE );
    require_once("database_config.php");
    $connect=getDb();
    session_start();
    $user_id = $_SESSION["id"];
    $stmt = $connect->prepare('SELECT * FROM staff WHERE staffName = :uid');
    $stmt->execute(array(':uid' => $user_id));
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Peradam">

    <title>Admin</title>

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
                    <?php 
                        }   
                        }?>
                    <i class="fa fa-user"></i><?php echo "&nbsp&nbsp&nbsp".$user_id  ?><b class="caret"></b></a>
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
                            Admin <small>Dashboard</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <br/>
                

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-users fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Staff</div>
                                        <div>Portal</div>
                                    </div>
                                </div>
                            </div>
                            <a href="../staff/staff.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Go to page</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-plus-circle fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Add</div>
                                        <div>Staff</div>
                                    </div>
                                </div>
                            </div>
                            <a href="staffreg.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Go to page</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-search fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Search</div>
                                        <div>Staff</div>
                                    </div>
                                </div>
                            </div>
                            <a href="staffsearch.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Go to page</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-wrench fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Staff</div>
                                        <div>Password Recovery</div>
                                    </div>
                                </div>
                            </div>
                            <a href="verify_user.php">
                                <div class="panel-footer">
                                    <span class="pull-left">Go to page</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
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

<br>
<br>
<br>

<footer >
    <div>
        <strong>All rights reserved &copy Perfect Developers 2017</strong>
    </div>
 </footer>

</html>
