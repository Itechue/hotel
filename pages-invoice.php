<?php
require("conn/connection.php");
$pdo =prepareConnection();
$roomid=$_REQUEST["id"];
$sql="select * from rooms join bookings join payment on rooms.id=bookings.room_id and rooms.username=payment.appid where rooms.id=:roomid";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':roomid',$roomid);
$stmt->execute();
$rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
$rows =$rows[0];
//  var_dump($rows);
//  die();
?>



<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from zoyothemes.com/silva/html/pages-invoice by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Sep 2024 19:15:35 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

    <meta charset="utf-8" />
    <title>Kamba Motel Ltd.</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="image/log.png">

    <!-- App css -->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="vendors/linericon/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lato:400,700,400italic%7CPoppins:300,400,500,700">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- main css -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">

</head>

<!-- body start -->
<body data-menu-color="light" data-sidebar="default">

<!-- Begin page -->
<div id="app-layout">
        <div class="content">
            <div>
            <!-- Start Content-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        
                        <div class="card">
                            <div class="card-body">
                                <div class="panel-body">
                                    <div class="clearfix">
                                        <div class="row">
                                            <div class="col-md-4">
                                            <div class="float-start">
                                            <img src="image/Log.png" style="height: 70px; width: 100px;"><br>
                                            </div>
                                            </div>
                                            <div class="col-md-8">
                                                <address>
                                                    <p style="font-size: x-large;"> Invoice No:<strong><?php echo $rows['invoice'];?></strong></p>
                                                </address>
                                            </div>
                                        </div>    
                                    </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="float-end">
                                                         
                                                        <strong class="fs-15 fw-normal">PAYMENT STATUS:</strong>
                                                        <button style="background-color: darkorange;" class="btn btn-primary" type="submit"><?php echo $rows ['pstatus'];?>
                                                        </button>

                                                    </div>


                                                </div>
                                                <div class="col-md-12">
                                                    <div class="float-end">
                                                         
                                                    <strong>ORDER DATE: </strong><?php echo $rows['dategenerated'];?><br>

                                                    </div>


                                                </div>
                                                <div class="col-md-12">
                                                    <div class="float-end">
                                                         
                                                    <strong>ORDER ID:</strong><?php echo $rows['orderid'];?>

                                                    </div>


                                                </div>
                                                <div class="col-md-12">
                                                    <div class="float-start">
                                                         
                                                        
                                                        <address>
                                                        
                                                            <strong>KAMBA MOTEL ACCOUNT DETAILS</strong><br>
                                                            <strong>ACCOUNT NAME:</strong>KAMBA MOTEL LTD.<br>
                                                            <strong>BANK NAME:</strong>FIRST BANK<br>
                                                            <strong>ACCOUNT NO:</strong><a href="#" class="btn btn-secondary" style="background-color: #fdfcfc; color: black;" >2033765468</a><br>
                                                        </address>
                                                    </div>


                                                </div>



                                            </div>         
                                    <hr>
                                    <div class="row">
                                        
                                        </div>
                                        <div class="col-md-12">
                                            <div>
                                                <table class="table mt-4 mb-4 ">
                                                    <thead style="background-color: black;">
                                                        <tr style="background-color: black;">
                                                            <th style="background-color: black; color: white;">Full Name</th>
                                                            <th style="background-color: black; color: white;">Username</th>
                                                            <th style="background-color: black; color: white;">Services</th>
                                                            <th style="background-color: black; color: white;">Phone Number</th>
                                                            <th style="background-color: black; color: white;">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo $rows['guest_name'];?></td>
                                                            <td><?php echo $rows['appid']; ?></td>
                                                            <td><?php echo $rows['type'];?></td>
                                                            <td><?php echo $rows['phone'];?></td>
                                                            <td>&#8358;<?php echo $rows['amount'];?></td>
                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                           
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <address>
                                                <b style="color: red; font-size: 15px;">Note:</b><br>
                                                <p style="color: red;"><strong>Username</strong> above is used to track your booking process.<br>If you click on the pay button and you are not on the popup
                                                page to make the payment you can make the payment using our account number above after making the payment 
                                                save your <strong>invoice</strong> or <strong>OrderId</strong> number.</p>
                                            </address>
                                       </div>
                                        <div class="col-md-7" >
                                            <address style="text-align: end;">
                                                <p style="text-align: right; color: black; font-size: large;">Total:&#8358;<?php echo $rows['amount'];?></p>
                                              <form id="paymentForm">
                                                    <input type="hidden" id="amount" name="amount" value="<?php echo $rows['amount'];?>"/>
                                                    <input type="hidden" id="email" name="email" value="<?php echo $rows['guest_email'];?>"/>
                                                    <input type="hidden" id="orderid" name="orderid" value="<?php echo $rows['orderid'];?>"/>
                                                    <button class="btn btn-primary" type="submit" onclick="payWithPaystack()" style="background-color: white; color: rgb(43, 236, 101); border-color: rgb(43, 236, 101);">Pay
                                                    
                                                    </button>
                                                    <img src="image/paystack.png" style="width: 200px;">
                                              </form>  
                                           
                                        </address>
                                        </div>
                                    </div>
                                   
                                    <hr>
                                    <div class="d-print-none">
                                        <div class="float-end">
                                           </div>
                                           <a href="javascript:window.print()" class="btn btn-primary" style="background-color: white; color: black; border-color: black;"><i class="mdi mdi-printer"></i>Print</a>
                                            <!--<a href="javascript:window.print()" class="print-button"><i class="mdi mdi-printer me-1">Print<a>-->
                                                <a href="login.php" class="btn btn-primary" style="background-color: white; color: black; border-color: black;"><i class="mdi-arrow-right"></i>Finish</a>
                                        </div>
                                        <div class="clearfix"></div>
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
<script src="assets/js/app.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>
<script src="payment.js"></script>
</body>
</html>