<?php 
session_start();
require("conn/connection.php");
$pdo =prepareConnection();
$username=$_SESSION['error_status'];
// var_dump($username);
// var_dump($userid);
// die();
try{
    $sql="select * from errorpage where error_status=:username ";
    $stmt=$pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
   if(!empty($username) ){
      
   }else{
    header("location:index.php");
   }


}catch(Exception $e){

header("location:index.php").$e;

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kamba Motel Ltd.</title>
      <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="image/Log.png" type="image/png">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <link rel="stylesheet" href="vendors/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
</head>
<body style="background-color:black;">
<header class="header_area">
            <div class="">
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
        </header><br><br><br>
    <form action="check.php" method="post">
            <div class="hotel_booking_area position" >
                <div class="">
                    <div class="hotel_booking_table">
                        <div class="col-md-3">
                            <h2>Answer this to continue.</h2>
                        </div>
                        <div class="col-md-9">
                            <div class="boking_table">
                                <div class="row">
                                   
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="input-group">
                                                <select class="wide" name="adult" >
                                                    <option data-display="{Choose Age}">~{Choose Age}~</option>
                                                    <option value="adult">Above ~18~</option>
                                                    <option value="young">Below ~18~</option>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <select class="wide" name="child" required="">
                                                    <option data-display="{No Of Children}">~{Choose}~</option>
                                                    <option value="1">{NONE}</option>
                                                    <option value="1">~1~</option>
                                                    <option value="2">~2~</option>
                                                    <option value="3">~3-5~</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="input-group">
                                                <select class="wide" name="gender" required="">
                                                    <option data-display="{Gender}">~{Gender}~</option>
                                                    <option value="male">-Male-</option>
                                                    <option value="female">-Female-</option>
                                                    <option value="male">-Prefer Not Say-</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <div class="book_tabel_item">
                                            <div class="input-group">
                                                <select class="wide" name="sroom" required="">
                                                    <option data-display="{select Room Suite}">~{select Room Suite}~</option>
                                                    <option value="standard">{Standard Double}.</option>
                                                    <option value="luxury">{Luxury Suite}.</option>
                                                    <option value="business">{Business Suite}.</option>
                                                </select>
                                            </div>
                                            <input type="submit" class="book_now_btn button_hover"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </form>
       
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