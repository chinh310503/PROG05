<?php
session_start();
include('../includes/dbconnection.php');
if (strlen($_SESSION['id'])==0){
    header("Location: logout.php");
} else {
    if(isset($_POST['submit'])) {
        $challenge=$_FILES["challenge"]["name"];
        $extension = substr($challenge,strlen($challenge)-4,strlen($challenge));
        $allowed_extensions = ".txt";
        if($extension!==$allowed_extensions) {
            echo "<script>alert('Invalid format. Only txt format allowed');</script>";
        } else { 
            move_uploaded_file($_FILES["challenge"]["tmp_name"],"../challenge/".$challenge);
            $hint=$_POST['hint'];
            $sql="insert into challenge(cname,hint) values(:filename,:hint)";
            $query=$dbh->prepare($sql);
            $query->bindParam(':filename',$challenge,PDO::PARAM_STR);
            $query->bindParam(':hint',$hint,PDO::PARAM_STR);
            $query->execute();
            $LastInsertId=$dbh->lastInsertId();
            if ($LastInsertId>0) {
                echo '<script>alert("Challenge has been added.")</script>';
                echo "<script>window.location.href ='add-challenge.php'</script>";
            } else {
                echo '<script>alert("Something Went Wrong. Please try again")</script>';
            }
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Them Challenge</title>
        <!--plugins:css-->
        <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
        <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">


        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <div class="container-scroller">
            <?php include_once('includes/header.php'); ?>
            <div class="container-fluid page-body-wrapper">
                <?php include_once('includes/sidebar.php');?>
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title" style="text-align: center;">Them challenge</h4>
                                    <form class="forms-sample" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Them challenge moi</label>
                                            <input type="file" name="challenge" class="form-control" required='true'>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Nhap goi y</label>
                                            <input type="text" name="hint" value="" class="form-control" required='true'>
                                        </div>
                                        <button type="submit" class="btn btn-primary mr-2" name="submit">Create</button>

                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>

        <script src="./vendors/chart.js/Chart.min.js"></script>
        <script src="./vendors/moment/moment.min.js"></script>
        <script src="./vendors/daterangepicker/daterangepicker.js"></script>
        <script src="./vendors/chartist/chartist.min.js"></script>

        <script src="js/off-canvas.js"></script>
        <script src="js/misc.js"></script>
        

    </body>
</html>
<?php } ?>
