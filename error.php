<?php 
session_start();
require("conn/connection.php");
$pdo =prepareConnection();
$username=$_SESSION['username'];
$userid=$_SESSION['password'];
// var_dump($username);
// var_dump($userid);
// die();
try{
    $sql="select * from rooms join role on rooms.id=role.id where role.role=:username and rooms.password=:userid;";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':userid', $userid);
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);

   if(!empty($username) || !empty($userid) ){
      
   }else{
    header("location:index.php");
   }


}catch(Exception $e){

header("location:index.php").$e;

}
$sql="select * from errorpage  ";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows);
// die();
?> 
<!DOCTYPE html>
<html lang="en">
    

<head>

        <meta charset="utf-8" />
        <title>Error 404 </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="image/log.png">

        <!-- App css -->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-primary-subtle bg-opacity-10">
    
             <?php require("conn/topbar.php");?>
           
            <?php require("conn/sideb.php");?>
      
        <div class="maintenance-pages">
            <div class="container-fluid p-0">
           
                <div class="row">
                    <div class="col-xl-12 align-self-center">
                        <div class="row">
                            <div class="col-md-5 mx-auto">
                                <div class="card p-3 mb-0">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="mb-4">
                                                <a class='auth-logo' href='#'>
                                                    <img src="image/log.png" alt="logo-dark" class="mx-auto" height="28" />
                                                </a>
                                            </div>

                                            <div class="maintenance-img">
                                                <img src="assets/images/svg/404-error.svg" class="img-fluid" alt="coming-soon">
                                            </div>
                                           
                
                                            <div class="">
                                                <h3 class="mt-5 fw-semibold text-dark text-capitalize">Oops!, Page Not Found</h3>
                                                <p class="text-dark">This pages you are trying to access does not exits or has been moved. <br> Try going back to our homepage.</p>
                                            </div>
                                            <a class="btn btn-primary" href="errorpage.php?<?php echo hash('sha512',$rows[0]['id']).hash('sha512',$rows[0]['error_status'])."&&aid=".$rows[0]['id']."&&nid=".$rows[0]['id']."&&pid=".$rows[0]['error_status'];?>"><?php echo $rows[0]['error_status'];?></a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>

        <!-- App js-->
        <script src="assets/js/app.js"></script>
        
    </body>

<!-- Mirrored from zoyothemes.com/silva/html/error-404 by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Sep 2024 19:15:34 GMT -->
</html>