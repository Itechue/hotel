<?php
session_start();
require("conn/connection.php");

$pdo =prepareConnection();
$adult=$_SESSION['adult'];
if ($adult=='adult'){
    echo '<script>alert("fill the form  to book a room")</script>';
}else{
    header("location:index.php");
}
?>



<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from zoyothemes.com/silva/html/auth-register by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Sep 2024 19:15:34 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

        <meta charset="utf-8" />
        <title>kamba motel ltd.  </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
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
        <link href="assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">

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
                    </ul>
                </div> 
            </nav>
        </div>
    </header>
        <br>
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
                                                
                                                <p class="text-dark text-capitalize fs-14 mb-0">Fill in the form to book a room.</p>
                                            </div>

                                           
                                            
                                         <!--   <div class="saprator my-4"><span>or continue with email</span></div>-->
            
                                            <div class="pt-0">
                                                <form action="geninvoice.php"  method="post" >
                                                                        <div class="row" >
                                                                            <div class="col-xl-6">
                                                                        <div class="form-group mb-3">
                                                                            <label for="username" class="form-label">Fullname</label>
                                                                            <input class="form-control" name="fname" type="text" id="username" required="" placeholder="Enter your Fullname">
                                                                        </div>
                                                                        </div>
                                                                    
                            
                                                                    
                                                                    <div class="col-xl-6">
                                                                        <div class="form-group mb-3">
                                                                            <label for="password" class="form-label">Phone Number</label>
                                                                            <input class="form-control phone1" MaxLength="11" MinLength="11" type="number"  pattern="\{11}" id=phone1 name="phone" required="" placeholder="Enter your Phone Number"/>


                                                                        </div>


                                                                    </div>
                                                                    </div>
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="form-group mb-3">
                                                                        <label for="emailaddress" class="form-label">Email</label>
                                                                        <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email">
                                                                    </div>
                                                                    </div>
                                                                    <div class="col-xl-3">
                        
                                                                    <div class="form-group mb-3">
                                                                        <label for="Gender" class="form-label">Gender</label>
                                                                        <select name="gender" id="Gender" class="form-control">
                                                                            <option value="">{select Gender}</option>
                                                                            <option value="male">male </option>
                                                                            <option value="Female">Female </option>
                                                                        </select>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3">
                        
                                                                    <div class="form-group mb-3">
                                                                        <label for="Gender" class="form-label">Number of Rooms</label>
                                                                        <select name="noofroom" id="Gender" class="form-control">
                                                                            <option value="">{select No Of Rooms}</option>
                                                                            <option value="1">1 </option>
                                                                            <option value="2">2 </option>
                                                                            <option value="3">3 </option>
                                                                            <option value="4"> 4</option>
                                                                            <option value="5">5 </option>
                                                                            <option value="6">6 </option>
                                                                            <option value="7">7 </option>
                                                                            <option value="8">8 </option>
                                                                            <option value="9"> 9</option>
                                                                            <option value="10"> 10</option>
                                                                        </select>
                                                                        
                                                                    </div>
                                                                </div>
                                                                    <div class="col-xl-3">
                        
                                                                        <div class="form-group mb-3">
                                                                            <label for="Department" class="form-label">select room type</label>
                                                                            <select name="sroom" required="" id="Department" class="form-control">
                                                                                <option value="">{select Room}</option>
                                                                                <option value="standard">Standard Double</option>
                                                                                <option value="luxury">Luxury Suite </option>
                                                                                <option value="business">Business Suite </option>
                                                                            </select>
                                                                            
                                                                        </div>
                                                                        </div>
                                                
                                                                    <div class="col-xl-3">
                                                                            
                                                                            <div class="form-group mb-3">
                                                                                <label for="Department" class="form-label">select No of Days</label>
                                                                                <select name="noofdays" required="" id="Department" class="form-control">
                                                                                    <option value="">{select No of Days}</option>
                                                                                    <option value="1">1</option>
                                                                                    <option value="2">2 </option>
                                                                                    <option value="3">3 </option>
                                                                                    <option value="4">4 </option>
                                                                                    <option value="5">5 </option>
                                                                                    <option value="6">6 </option>
                                                                                    <option value="7">7 </option>

                                                                                    
                                                                                </select>
                                                                                
                                                                            </div>
                                                                    </div>
                                                                 <div class="col-xl-12">
                                                                    <div class="form-group mb-3">
                                                                        <label for="emailaddress" class="form-label">Address</label>
                                                                        <input class="form-control" name="address" type="text" id="emailaddress" required="" placeholder="Enter your Address">
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                
                                                                </div>
                                                                <div class="row">
                                                                <div class="col-xl-6">
                                                                        <div class=" mb-3">
                                                                            <label  class="form-label">Arrival Date</label>
                                                                            <input class="form-control" name="arrival"  type="text" id="basic-datepicker" required="" placeholder="select arrival date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-6">
                                                                    <div class=" mb-3">
                                                                            <label  class="form-label">Departure Date</label>
                                                                            <input class="form-control" name="departure"  type="text" id="basic-datepicker" required="" placeholder="select Departure date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-6">
                                                                        <div class="form-group mb-3">
                                                                            <label for="password" class="form-label">password</label>
                                                                            <input class="form-control" name="password" type="password" id="password" required="" placeholder="Enter your password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-6">
                                                                        <div class="form-group mb-3">
                                                                            <label for="confirm password" class="form-label">confirm password</label>
                                                                            <input class="form-control" name="cpassword" type="password" id="password" required="" placeholder="confirm password"/>
                                                                        </div>
                                                                    </div>
                                                               
                                                                </div>
                                                                
                                            
                                                                        <div class="form-group mb-0 row">
                                                                            <div class="col-6">
                                                                                <div class="d-grid">
                                                                                    <button class="btn btn-primary" type="submit" style="background-color:black;"> Register to book a room</button>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                </form>

                                                <div class="text-center text-muted mb-4"  >
                                                    <p class="float-end">Already book a room ?<a class='text-primary ms-2 fw-medium' href='login.php'>Track your process here</a></p>
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
        </div>
        <!-- END wrapper -->

        <!-- Vendor -->
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
        <script src="assets/libs/flatpickr/flatpickr.min.js"></script>
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>

        <script src="assets/js/pages/form-picker.js"></script>
        
    </body>

<!-- Mirrored from zoyothemes.com/silva/html/auth-register by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Sep 2024 19:15:34 GMT -->
</html>