<?php
session_start();
require("conn/connection.php");
require("conn/function.php");
$pdo =prepareConnection();
$roomid=$_SESSION['username'];
$sql="select * from rooms join bookings join payment on rooms.id=bookings.room_id and rooms.username=payment.appid where rooms.username=:roomid";
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':roomid',$roomid);
$stmt->execute();
$rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
$rows =$rows[0];
//    var_dump($rows);
//   die();
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
    <link rel="shortcut icon" href="assets/images/favicon.ico">

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

<header class="header_area ">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="image/Log.png" alt=""> </a>
                    <h4 style="color: white;">KAMBA <strong style="color: green;">MOTEL</strong> LTD.(ANNEX)</h4>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                            <li class="nav-item active"><a class="nav-link " href="ourgallary.php">Our gallary</a></li>
                            <li class="nav-item active" for="contact"><a class="nav-link" href="contact.php">Contact Us</a></li>
                            <li class="nav-item active"> <a href="logout.php" class="btn theme_btn button_hover my-3" style="color: white;">Logout</a></li>
                        </ul>
                    </div>
                    
                </nav>
            </div>
    </header><br><br><br><br>
            <div class="row">
           
     <div class="col-md-12">
        <div class="card-body">
            
            <table class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr> 
                            <th scope="col">ROOM TYPE</th>
                            <th scope="col">YOUR NAME</th>
                            <th scope="col">YOUR EMAIL</th>
                            <th scope="col">GENDER</th>
                            <th scope="col">CHECK IN DATE</th>
                            <th scope="col">CHECK OUT DATE</th>
                            <th scope="col">TOTAL PRICE</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">INVOICE</th>
                            <th scope="col">TYPE</th>
                            <th scope="col">PSTATUS</th>
                            <th scope="col">DATE GENERATED</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        
                        <tr>
                            <td><?php echo $rows['room_type'];?></td>
                            <td><?php echo $rows['guest_name'];?></td>
                            <td><?php echo $rows['guest_email'];?></td>
                            <td><?php echo $rows['gender'];?></td>
                            <td><?php echo $rows['check_in_date'];?></td>
                            <td><?php echo $rows['check_out_date'];?></td>
                            <td><?php echo $rows['total_price'];?></td>
                            <td><?php echo $rows['phone'];?></td>
                            <td><?php echo $rows['invoice'];?></td>
                            <td><?php echo $rows['type'];?></td>
                            <td><?php echo $rows['pstatus'];?></td>
                            <td><?php echo $rows['dategenerated'];?></td>
                            
                            
                        </tr>
                    
                    </tbody>
                   

                </table>
            
        </div>
                </div>
               
            </div>
            <a href="javascript:window.print()" class="btn btn-primary" style="background-color: white; color: black; border-color: black;"><i class="mdi mdi-printer"></i>Print</a>
          
       

        

        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.js"></script>
        <script src="js/mail-script.js"></script>
        <script src="js/stellar.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="js/custom.js"></script>
</body>



</html>