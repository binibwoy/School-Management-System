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
    require_once("../php/database_config.php");
    $connect=getDb();
    session_start();
    $user_id = $_SESSION["id"];
    $stmt = $connect->prepare('SELECT * FROM staff WHERE staffName = :uid');
    $stmt->execute(array(':uid' => $user_id));
?>

<?php 
    include("defineFees2.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Perfect Developers">

    <title>Define Fees</title>

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
                <a class="navbar-brand" href="staff.php">SCHOOL MANAGEMENT SYSTEM</a>
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
                    <i class="fa fa-user"></i><?php echo "&nbsp&nbsp&nbsp".$user_id;  ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../php/myprofile2.php"><i class="fa fa-fw fa-user"></i>My Profile</a>
                        </li>
                        <li>
                            <a href="../php/changepass.php?edit_id=<?php echo $user_id ?>"><i class="fa fa-fw fa-gear"></i>Password</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li>
                            <a href="../php/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="../staff/staff.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="../php/admin.php"><i class="fa fa-fw fa-users"></i> Admin Portal</a>
                    </li>
                    <li>
                        <a href="../staff/studentsearch.php"><i class="fa fa-fw fa-search"></i> Search Student</a>
                    </li>
                    <li>
                        <a href="../staff/studentreg.php"><i class="fa fa-fw fa-plus-circle"></i> Create Student</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-suitcase"></i> Transactions <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="../staff/transactions.php">Student Transactions</a>
                            </li>
                            <li>
                                <a href="../php/defineFees.php"> Define Fees</a>
                            </li>
                            <li>
                                <a href="../php/selectclass.php"> Update Fees</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="../staff/reports.php"><i class="fa fa-fw fa-info"></i> Report</a>
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
                            ADMIN <small>Define Fees</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-plus-circle"></i> Create fees for each class
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <br/>
    

                <?php
                    if(isset($errMSG)){
                            ?>
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
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

                <form method="post" enctype="multipart/form-data" class="form-horizontal">
                        
                    <table class="table table-hover table-responsive">



                   <tr>
                        <td><label class="control-label">Class <b class="important">*</b></label></td>
                        <td>
                          <select class="form-control" name="dclass">
                              <option value="KG1">KG1</option>
                              <option value="KG2">KG2</option>
                              <option value="KG3">KG3</option>
                              <option value="PRY1">PRY1</option>
                              <option value="PRY2">PRY2</option>
                              <option value="PRY3">PRY3</option>
                              <option value="PRY4">PRY4</option>
                              <option value="PRY5">PRY5</option>
                              <option value="JSS1">JSS1</option>
                              <option value="JSS2">JSS2</option>
                              <option value="JSS3">JSS3</option>
                              <option value="SSS1">SSS1</option>
                              <option value="SSS2">SSS2</option>
                              <option value="SSS3">SSS3</option>
                        </td>
                        <td><label class="control-label">Tuition Fees <b class="important">*</b></label></td>
                        <td><input class="form-control" type="number" name="dtuition" placeholder="Enter tuition fees" value="<?php echo $tuition; ?>"></input></td>
                   </tr>

                   <tr>
                        <td><label class="control-label">Development Levy <b class="important">*</b></label></td>
                        <td><input class="form-control" type="number" name="ddevelop" placeholder="Enter development levy" value="<?php echo $develop; ?>"/></td>

                        <td><label class="control-label">Sport Levy <b class="important">*</b></label></td>
                        <td><input class="form-control" type="number" name="dsport" placeholder="Enter sports levy" value="<?php echo $sport; ?>"></input></td>
                    </tr>    
                    
                    <tr>

                        <td><label class="control-label">Exam Fees <b class="important">*</b></label></td>
                        <td><input class="form-control" type="number" name="dexam" placeholder="Enter exam fees" value="<?php echo $exam; ?>"></input></td>

                        <td><label class="control-label">School Fees (First term) <b class="important">*</b></label></td>
                        <td><input class="form-control" type="number" name="dschoolfees" placeholder="First term School Fees is Automaticaly Computed" value="<?php echo $schoolfees; ?>" READONLY></input></td>

                    </tr>

                    <tr>

                        <td><label class="control-label">School Fees (Second term) <b class="important">*</b></label></td>
                        <td><input class="form-control" type="number" name="dschoolfees2" placeholder="Second term School Fees" value="<?php echo $schoolfees2; ?>" ></input></td>

                        <td><label class="control-label">School Fees (Third term) <b class="important">*</b></label></td>
                        <td><input class="form-control" type="number" name="dschoolfees3" placeholder="Third term School Fees" value="<?php echo $schoolfees3; ?>" ></input></td>

                    </tr>

                    
                    
                    <tr>
                        <td colspan="3" align="center"><button type="submit" name="save" class="btn btn-primary">
                        <span class="glyphicon glyphicon-save"></span> &nbsp; Save
                        </button>
                        </td>
                    </tr>
                    
                    </table>
                    
                </form>

                

                    
               

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
