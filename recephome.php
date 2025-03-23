<?php 
require("conn/connection.php");
session_start();
$pdo =prepareConnection();
$sql="select * from rooms join bookings join payment on rooms.id=bookings.room_id and rooms.username=payment.appid where rooms.id=room_id;";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($rows);
// die();

?>
<!DOCTYPE html>
<html lang="en">
    
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

        <meta charset="utf-8" />
        <title>Kamba Motel Ltd.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
         <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

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

        <!-- App favicon -->
       
    </head>
  
    <body class="bg-primary-subtle">
    <header class="header_area header_area navbar_fixed">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="image/Log.png" alt=""> </a>
                    <h4 style="color: black;">KAMBA <strong style="color: green;">MOTEL</strong> LTD.(ANNEX)</h4>
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
        </header><br><br><br>
                                
        
                                       
                                       
                                           
                                       
                       
                                   
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-primary mb-0">
                                                <thead>
                                                    <tr>
                                                      
                                                        <th scope="col">S/N</th>
                                                        <th scope="col">ROOM TYPE</th>
                                                        <th scope="col">CREATED AT</th>
                                                        <th scope="col">GUEST NAME</th>
                                                        <th scope="col">GENDER</th>
                                                        <th scope="col">ADDRESS</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                     $i=1;
                                                    foreach ($rows as $row){?>
                                                        <tr>
                                                            <td><?php echo $i;?></td>
                                                            <td><?php echo $row['room_type'];?></td>
                                                            <td><?php echo $row['created_at'];?></td>
                                                            <td><?php echo $row['guest_name'];?></td>
                                                            <td><?php echo $row['gender'];?></td>
                                                            <td><?php echo $row['address'];?></td>
                                                           
                                                            
                                                        </tr>
                                                        <?php $i++; }?>
                                            
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered border-primary mb-0">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">CHECK IN DATE</th>
                                                        <th scope="col">CHECK OUT DATE</th>
                                                        <th scope="col">TOTAL PRICE</th>
                                                        <th scope="col">PHONE</th>
                                                        <th scope="col">SESSION</th>
                                                        <th scope="col">ORDER ID</th>
                                                        <th scope="col">INVOICE</th>
                                                        <th scope="col">APPLICATION ID</th>
                                                        <th scope="col">TYPE</th>
                                                        <th scope="col">PSTATUS</th>
                                                        <th scope="col">DATE GENERATED</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    
                                                    foreach ($rows as $row){?>
                                                    <tr>
                                                        <td><?php echo $row['check_in_date'];?></td>
                                                        <td><?php echo $row['check_out_date'];?></td>
                                                        <td><?php echo $row['total_price'];?></td>
                                                        <td><?php echo $row['phone'];?></td>
                                                        <td><?php echo $row['session'];?></td>
                                                        <td><?php echo $row['orderid'];?></td>
                                                        <td><?php echo $row['invoice'];?></td>
                                                        <td><?php echo $row['appid'];?></td>
                                                        <td><?php echo $row['type'];?></td>
                                                        <td><?php echo $row['pstatus'];?></td>
                                                        <td><?php echo $row['dategenerated'];?></td>
                                                        
                                                        
                                                    </tr>
                                                    <?php }?>
                                            
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                              
                                               
                                                  
                            
        </div>
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

<!-- Mirrored from zoyothemes.com/silva/html/auth-register by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Sep 2024 19:15:34 GMT -->
</html>