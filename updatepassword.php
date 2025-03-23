<?php 
session_start();
require("conn/connection.php");

$pdo =prepareConnection();
$username=$_SESSION['username'];
$userid=$_SESSION['password'];
// var_dump($username);
// var_dump($userid);
//   die();
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
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from zoyothemes.com/silva/html/auth-register by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Sep 2024 19:15:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <head>

        <meta charset="utf-8" />
        <title>Kamba | Motel Ltd.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Datatables css -->
        <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    </head>

    <body class="bg-primary-subtle">
    
           <?php require("conn/topbar.php");?>
           
           <?php require("conn/sideb.php");?>
        <div class="account-page">
            <div class="container-fluid p-0">        
                <div class="row align-items-center g-0">
                    
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-md-8 mx-auto">
                                <div class="card p-3" >
                                    <div class="card-body" >

                                        <div class="mb-0 border-0 p-md-5 p-lg-0 p-4">
                                           

                                            <div class="auth-title-section mb-3 text-center"> 
                                                
                                                <p class="text-dark text-capitalize fs-14 mb-0">change password</p>
                                            </div>

                                           
                                            
                                         <!--   <div class="saprator my-4"><span>or continue with email</span></div>-->
            
                                            <div class="pt-0">
                                                <form action="updatepass.php"  method="post" >
                                                        <div class="row" >
                                                                <div class="col-xl-6">
                                                                        <div class="form-group mb-3">
                                                                            <label for="username" class="form-label">Username</label>
                                                                            <input class="form-control" name="username" type="text" id="username" required="" placeholder="Enter your Old Password">
                                                                        </div>
                                                                </div>
                                                                <div class="col-xl-6">
                                                                        <div class="form-group mb-3">
                                                                            <label for="username" class="form-label">Old Password</label>
                                                                            <input class="form-control" name="password" type="password" id="username" required="" placeholder="Enter your Old Password">
                                                                        </div>
                                                                </div>
                                                                    
                            
                                                                    
                                                                <div class="col-xl-6">
                                                                    <div class="form-group mb-3">
                                                                        <label for="password" class="form-label">New password</label>
                                                                        <input class="form-control" name="newpass" type="password" id="username" required="" placeholder="Enter your New Password">


                                                                    </div>


                                                                </div>
                                                                  
                                                            
                                                              
                                            
                                                               
                                                                    <div class="col-xl-3 my-4">
                                                                        <div class="d-grid">
                                                                            <button class="btn btn-primary" type="submit" style="background-color:black;"> Reset Password</button>
                                                                        </div>
                                                                    </div>
                                                                    
                                                               
                                                        </div>
                                                </form>

                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                   

                </div>
            </div>
        </div>
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>        

        <!-- Datatables js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>

        <!-- dataTables.bootstrap5 -->
        <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

        <!-- buttons.colVis -->
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>

        <!-- buttons.bootstrap5 -->
        <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>

        <!-- dataTables.keyTable -->
        <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables.net-keytable-bs5/js/keyTable.bootstrap5.min.js"></script>

        <!-- dataTable.responsive -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

        <!-- dataTables.select -->
        <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>

        <!-- Datatable Demo App Js -->
        <script src="assets/js/pages/datatable.init.js"></script>

        <!-- App js-->
        <script src="assets/js/app.js"></script>

        
    </body>

<!-- Mirrored from zoyothemes.com/silva/html/auth-register by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Sep 2024 19:15:34 GMT -->
</html>