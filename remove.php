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
$sql="select * from rooms join bookings join payment on rooms.id=bookings.room_id and rooms.username=payment.appid where rooms.id=room_id;";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
//   var_dump($rows);
//   die();




?>

<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from zoyothemes.com/silva/html/tables-datatables by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Sep 2024 19:23:38 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

    <meta charset="utf-8" />
    <title>payment Table | kamba motel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  
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

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout">


              <!-- Topbar Start -->
              <?php require("conn/topbar.php");?>
            <!-- end Topbar -->

            <!-- Left Sidebar Start -->
            <?php require("conn/sideb.php");?>
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                      
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Customer Information</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                                            <thead>
                                                <tr> 
                                                    <th>S/N</th>
                                                    <th>Name</th>
                                                    <th>Room type</th>
                                                    <th>Check_IN</th>
                                                    <th>Check_OUT</th>
                                                    <th>Email</th>
                                                    <th>Invoice</th>
                                                    <th>ORDER ID</th>
                                                    <th>No of Rooms</th>
                                                    <th>No of Days</th>
                                                    <th>Amount</th>
                                                    <th>Address</th>
                                                    <th>Payment Status</th>
                                                    <th>DATE GENERATED</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                    $i=1;
                                                    foreach ($rows as $row){?>
                                                        <tr>
                                                           <td><?php echo $i;?></td>
                                                            <td><?php echo $row['guest_name'];?>&nbsp; &nbsp; &nbsp;<a class="btn btn-danger rounded-pill" href="delete.php?<?php echo hash('sha512',$row['id']).hash('sha512',$row['invoice'])."&&aid=".$row['username']."&&nid=".$row['appid']."&&pid=".$row['created_at'];?>"><?php $delete='Delete'; echo $delete;?></a></td>
                                                            <td><?php echo $row['room_type'];?></td>
                                                            <td><?php echo $row['check_in_date'];?></td>
                                                            <td><?php echo $row['check_out_date'];?></td>
                                                            <td><?php echo $row['guest_email'];?></td>
                                                            <td><?php echo $row['invoice'];?></td>
                                                            <td><?php echo $row['orderid'];?></td>
                                                            <td><?php echo $row['noofroom'];?></td>
                                                            <td><?php echo $row['noofdays'];?></td>
                                                            <td>&#8358;<?php echo $row['amount'];?></td>
                                                            <td><?php echo $row['address'];?></td>
                                                            <td><?php echo $row['pstatus'];?></td>
                                                            <td><?php echo $row['dategenerated'];?></td>
                                                           
                                                        </tr>
                                                        <?php $i++; }?>
                                              
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">ABUTECH IT HUB (2024)</a> 
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


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


</html>