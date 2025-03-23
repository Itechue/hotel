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
// var_dump($rows);
// die();



?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from zoyothemes.com/silva/html/tables-datatables by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Feb 2025 13:48:04 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

        <meta charset="utf-8" />
        <title>Kamba | Motel</title>
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

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout">


            <!-- Topbar Start -->
            <?php require("conn/topbar.php");?>
            <!-- end Topbar -->

            <?php require("conn/sideb.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
        
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
                            </div>
            
                            
                        </div>

                       
                        <div class="row">
                            <div class="col-md-12 col-xl-6">
                                <div class="row g-3">
                                    
                                    <div class="col-md-6 col-xl-6">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="widget-first">
        
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="p-2 border border-primary border-opacity-10 bg-primary-subtle rounded-pill me-2">
                                                            <div class="bg-primary rounded-circle widget-size text-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#ffffff" d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4"/></svg>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Total Customers</p>
                                                    </div>
       
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h3 class="mb-0 fs-22 text-black me-3">3,456</h3>
                                                        <div class="text-center">
                                                            <span class="text-primary fs-14"><i class="mdi mdi-trending-up fs-14"></i> 12.5%</span>
                                                            <p class="text-dark fs-13 mb-0">Last 7 days</p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-md-6 col-xl-6">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="widget-first">
        
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="p-2 border border-secondary border-opacity-10 bg-secondary-subtle rounded-pill me-2">
                                                            <div class="bg-secondary rounded-circle widget-size text-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 512"><path fill="#ffffff" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m32 32h-64c-17.6 0-33.5 7.1-45.1 18.6c40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64m-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32S208 82.1 208 144s50.1 112 112 112m76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2m-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4"/></svg>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Active Customers</p>
                                                    </div>
        
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h3 class="mb-0 fs-22 text-black me-3">2,839</h3>
                                                        <div class="text-center">
                                                            <span class="text-danger fs-14 me-2"><i class="mdi mdi-trending-down fs-14"></i> 1.5%</span>
                                                            <p class="text-dark fs-13 mb-0">Last 7 days</p>
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-md-6 col-xl-6">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="widget-first">
        
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="p-2 border border-danger border-opacity-10 bg-danger-subtle rounded-pill me-2">
                                                            <div class="bg-danger rounded-circle widget-size text-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#ffffff" d="M7 15h2c0 1.08 1.37 2 3 2s3-.92 3-2c0-1.1-1.04-1.5-3.24-2.03C9.64 12.44 7 11.78 7 9c0-1.79 1.47-3.31 3.5-3.82V3h3v2.18C15.53 5.69 17 7.21 17 9h-2c0-1.08-1.37-2-3-2s-3 .92-3 2c0 1.1 1.04 1.5 3.24 2.03C14.36 11.56 17 12.22 17 15c0 1.79-1.47 3.31-3.5 3.82V21h-3v-2.18C8.47 18.31 7 16.79 7 15"/></svg>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Profit Total</p>   
                                                    </div>
        
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h3 class="mb-0 fs-22 text-black me-3">&#8358;7,254</h3>
                                                        <div class="text-center">
                                                            <span class="text-primary fs-14 me-2"><i class="mdi mdi-trending-up fs-14"></i> 12.8%</span>
                                                            <p class="text-dark fs-13 mb-0">Last 7 days</p>
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-6">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="widget-first">
        
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="p-2 border border-warning border-opacity-10 bg-warning-subtle rounded-pill me-2">
                                                            <div class="bg-warning rounded-circle widget-size text-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#ffffff" d="M5.574 4.691c-.833.692-1.052 1.862-1.491 4.203l-.75 4c-.617 3.292-.926 4.938-.026 6.022C4.207 20 5.88 20 9.23 20h5.54c3.35 0 5.025 0 5.924-1.084c.9-1.084.591-2.73-.026-6.022l-.75-4c-.439-2.34-.658-3.511-1.491-4.203C17.593 4 16.403 4 14.02 4H9.98c-2.382 0-3.572 0-4.406.691" opacity="0.5"/><path fill="#988D4D" d="M12 9.25a2.251 2.251 0 0 1-2.122-1.5a.75.75 0 1 0-1.414.5a3.751 3.751 0 0 0 7.073 0a.75.75 0 1 0-1.414-.5A2.251 2.251 0 0 1 12 9.25"/></svg>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Expense Total</p>
                                                    </div>
                                                    
        
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h3 class="mb-0 fs-22 text-black me-3">&#8358;4,578</h3>
        
                                                        <div class="text-muted">
                                                            <span class="text-danger fs-14 me-2"><i class="mdi mdi-trending-down fs-14"></i> 18%</span>
                                                            <p class="text-dark fs-13 mb-0">Last 7 days</p>
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="col-md-6 col-xl-6">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="widget-first">
        
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="p-2 border border-success border-opacity-10 bg-success-subtle rounded-pill me-2">
                                                            <div class="bg-success rounded-circle widget-size text-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M5 19L19 5"/><circle cx="7" cy="7" r="3"/><circle cx="17" cy="17" r="3"/></g></svg>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Conversion Rate</p>
                                                    </div>
                                                    
        
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h3 class="mb-0 fs-22 text-black me-3">14.57%</h3>
        
                                                        <div class="text-muted">
                                                            <span class="text-primary fs-14 me-2"><i class="mdi mdi-trending-up fs-14"></i> 5.8%</span>
                                                            <p class="text-dark fs-13 mb-0">Last 7 days</p>
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xl-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="widget-first">
        
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="p-2 border border-dark border-opacity-10 bg-dark-subtle rounded-pill me-2">
                                                            <div class="bg-dark rounded-circle widget-size text-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 9H6.659c-1.006 0-1.51 0-1.634-.309c-.125-.308.23-.672.941-1.398L8.211 5M5 15h12.341c1.006 0 1.51 0 1.634.309c.125.308-.23.672-.941 1.398L15.789 19" color="#ffffff"/></svg>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 text-dark fs-15">Total Deals</p>
                                                    </div>
                                                    
        
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h3 class="mb-0 fs-22 text-black me-3">8,754</h3>
        
                                                        <div class="text-muted">
                                                            <span class="text-primary fs-14 me-2"><i class="mdi mdi-trending-up fs-14"></i> 4.5%</span>
                                                            <p class="text-dark fs-13 mb-0">Last 7 days</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-12 col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h5 class="card-title text-black mb-0">Latest transactions</h5>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <ul class="list-group list-group-flush list-group-no-gutters">

                                            <!-- List Item -->
                                            <li class="list-group-item">
                                                <div class="d-flex">

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <!-- Avatar -->
                                                        <div class="align-content-center text-center border border-dashed rounded-circle p-1">
                                                            <img src="assets/images/users/user-12.jpg" class="avatar avatar-sm rounded-circle">
                                                        </div>
                                                        <!-- End Avatar -->
                                                    </div>
                            
                                                    <div class="flex-grow-1 ms-3 align-content-center">
                                                        <div class="row">
                                                            <div class="col-7 col-md-5 order-md-1">
                                                                <h6 class="mb-1 text-black fs-15">Bob Dean</h6>
                                                                <span class="fs-14 text-muted">Transfer to bank account</span>
                                                            </div>
                                    
                                                            <div class="col-5 col-md-4 order-md-3 text-end mt-2 mt-md-0">
                                                                <h6 class="mb-1 text-black fs-14">$158.00 USD</h6>
                                                                <span class="fs-13 text-muted">24 Jan, 2024</span>
                                                            </div>
                                    
                                                            <div class="col-auto col-md-3 order-md-2 align-self-center">
                                                                <span class="badge bg-warning-subtle text-warning fw-semibold rounded-pill">Pending</span>
                                                            </div>
                                                        </div>
                                                        <!-- End Row -->
                                                    </div>

                                                </div>
                                            </li>
                                            <!-- End List Item -->

                                            <!-- List Item -->
                                            <li class="list-group-item">
                                                <div class="d-flex">

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <!-- Avatar -->
                                                        <div class="avatar border border-dashed rounded-circle align-content-center text-center p-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24">
                                                                <path fill="#2786f1" d="M15.194 7.57c.487-.163 1.047-.307 1.534-.451c-1.408-.596-3.176-1.227-4.764-1.625c-.253.073-1.01.271-1.534.434c.541.162 2.328.577 4.764 1.642m-8.896 6.785c.577.343 1.19.812 1.786 1.209c3.952-3.068 7.85-5.432 12.127-6.767c-.596-.307-1.119-.578-1.787-.902c-2.562.65-6.947 2.4-12.126 6.46m-.758-6.46c-2.112.974-4.331 2.31-5.54 3.085c.433.199.866.361 1.461.65c2.671-1.805 4.764-2.905 5.594-3.266c-.595-.217-1.154-.361-1.515-.47zm8.066.234c-.686-.379-3.068-1.263-4.71-1.642c-.487.18-1.173.451-1.642.65c.595.162 2.815.758 4.71 1.714c.487-.235 1.173-.523 1.642-.722m-3.374 1.552c-.56-.27-1.173-.523-1.643-.74c-1.425.704-3.284 1.769-5.63 3.447c.505.27 1.047.595 1.624.92c1.805-1.335 3.627-2.598 5.649-3.627m1.732 8.825c3.79-3.249 9.113-6.407 12.036-7.544a48 48 0 0 0-1.949-1.155c-3.771 1.246-8.174 4.007-12.108 7.129c.667.505 1.371 1.028 2.02 1.57zm2.851-.235h-.108l-.18-.27h-.109v.27h-.072v-.596h.27c.055 0 .109 0 .145.036c.054.019.072.073.072.127c0 .108-.09.162-.198.162zm-.289-.343c.09 0 .199.018.199-.09c0-.072-.072-.09-.144-.09h-.163v.18zm-.523.036c0-.289.235-.523.541-.523s.542.234.542.523a.543.543 0 0 1-.542.542a.53.53 0 0 1-.54-.542m.107 0c0 .235.199.433.451.433a.424.424 0 1 0 0-.848c-.27 0-.45.199-.45.415"/>
                                                            </svg>
                                                        </div>
                                                        <!-- End Avatar -->
                                                    </div>
                            
                                                    <div class="flex-grow-1 ms-3 align-content-center">
                                                        <div class="row">
                                                            <div class="col-7 col-md-5 order-md-1">
                                                                <h6 class="mb-1 text-black fs-15">Bank of America</h6>
                                                                <span class="fs-14 text-muted">Withdrawal to account</span>
                                                            </div>
                                    
                                                            <div class="col-5 col-md-4 order-md-3 text-end mt-2 mt-md-0">
                                                                <h6 class="mb-1 text-success fs-14">$258.00 USD</h6>
                                                                <span class="fs-13 text-muted">26 June, 2024</span>
                                                            </div>
                                    
                                                            <div class="col-auto col-md-3 order-md-2 align-self-center">
                                                                <span class="badge bg-success-subtle text-success fw-semibold rounded-pill">Completed</span>
                                                            </div>
                                                        </div>
                                                        <!-- End Row -->
                                                    </div>

                                                </div>
                                            </li>
                                            <!-- End List Item -->

                                            <!-- List Item -->
                                            <li class="list-group-item">
                                                <div class="d-flex">

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <!-- Avatar -->
                                                        <div class="avatar border border-dashed rounded-circle align-content-center text-center p-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                                                                <path fill="#e01e5a" d="M53.841 161.32c0 14.832-11.987 26.82-26.819 26.82S.203 176.152.203 161.32c0-14.831 11.987-26.818 26.82-26.818H53.84zm13.41 0c0-14.831 11.987-26.818 26.819-26.818s26.819 11.987 26.819 26.819v67.047c0 14.832-11.987 26.82-26.82 26.82c-14.83 0-26.818-11.988-26.818-26.82z"/><path fill="#36c5f0" d="M94.07 53.638c-14.832 0-26.82-11.987-26.82-26.819S79.239 0 94.07 0s26.819 11.987 26.819 26.819v26.82zm0 13.613c14.832 0 26.819 11.987 26.819 26.819s-11.987 26.819-26.82 26.819H26.82C11.987 120.889 0 108.902 0 94.069c0-14.83 11.987-26.818 26.819-26.818z"/><path fill="#2eb67d" d="M201.55 94.07c0-14.832 11.987-26.82 26.818-26.82s26.82 11.988 26.82 26.82s-11.988 26.819-26.82 26.819H201.55zm-13.41 0c0 14.832-11.988 26.819-26.82 26.819c-14.831 0-26.818-11.987-26.818-26.82V26.82C134.502 11.987 146.489 0 161.32 0s26.819 11.987 26.819 26.819z"/><path fill="#ecb22e" d="M161.32 201.55c14.832 0 26.82 11.987 26.82 26.818s-11.988 26.82-26.82 26.82c-14.831 0-26.818-11.988-26.818-26.82V201.55zm0-13.41c-14.831 0-26.818-11.988-26.818-26.82c0-14.831 11.987-26.818 26.819-26.818h67.25c14.832 0 26.82 11.987 26.82 26.819s-11.988 26.819-26.82 26.819z"/>
                                                            </svg>
                                                        </div>
                                                        <!-- End Avatar -->
                                                    </div>
                            
                                                    <div class="flex-grow-1 ms-3 align-content-center">
                                                        <div class="row">
                                                            <div class="col-7 col-md-5 order-md-1">
                                                                <h6 class="mb-1 text-black fs-15">Slack</h6>
                                                                <span class="fs-14 text-muted">Subscription to plan</span>
                                                            </div>
                                    
                                                            <div class="col-5 col-md-4 order-md-3 text-end mt-2 mt-md-0">
                                                                <h6 class="mb-1 text-black fs-14">-$154.00 USD</h6>
                                                                <span class="fs-13 text-muted">12 May, 2024</span>
                                                            </div>
                                    
                                                            <div class="col-auto col-md-3 order-md-2 align-self-center">
                                                                <span class="badge bg-danger-subtle text-danger fw-semibold rounded-pill">Failed</span>
                                                            </div>
                                                        </div>
                                                        <!-- End Row -->
                                                    </div>

                                                </div>
                                            </li>
                                            <!-- End List Item -->

                                            <!-- List Item -->
                                            <li class="list-group-item">
                                                <div class="d-flex">

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <!-- Avatar -->
                                                        <div class="avatar border border-dashed rounded-circle align-content-center text-center p-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"><path fill="#f06a6a" d="M18.78 12.653a5.22 5.22 0 1 0 0 10.44a5.22 5.22 0 0 0 0-10.44m-13.56 0a5.22 5.22 0 1 0 .001 10.439a5.22 5.22 0 0 0-.001-10.439m12-6.525a5.22 5.22 0 1 1-10.44 0a5.22 5.22 0 0 1 10.44 0"/></svg>
                                                        </div>
                                                        <!-- End Avatar -->
                                                    </div>
                            
                                                    <div class="flex-grow-1 ms-3 align-content-center">
                                                        <div class="row">
                                                            <div class="col-7 col-md-5 order-md-1">
                                                                <h6 class="mb-1 text-black fs-15">Asana</h6>
                                                                <span class="fs-14 text-muted">Subscription payment</span>
                                                            </div>
                                    
                                                            <div class="col-5 col-md-4 order-md-3 text-end mt-2 mt-md-0">
                                                                <h6 class="mb-1 text-success fs-14">$258.00 USD</h6>
                                                                <span class="fs-13 text-muted">15 Fab, 2024</span>
                                                            </div>
                                    
                                                            <div class="col-auto col-md-3 order-md-2 align-self-center">
                                                                <span class="badge bg-success-subtle text-success fw-semibold rounded-pill">Completed</span>
                                                            </div>
                                                        </div>
                                                        <!-- End Row -->
                                                    </div>

                                                </div>
                                            </li>
                                            <!-- End List Item -->

                                            <!-- List Item -->
                                            <li class="list-group-item">
                                                <div class="d-flex">

                                                    <div class="flex-shrink-0 align-self-center">
                                                        <!-- Avatar -->
                                                        <div class="avatar border border-dashed rounded-circle align-content-center text-center p-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 256 208">
                                                                <path d="M205.28 31.36c14.096 14.88 20.016 35.2 22.512 63.68c6.626 0 12.805 1.47 16.976 7.152l7.792 10.56A17.55 17.55 0 0 1 256 123.2v28.688c-.008 3.704-1.843 7.315-4.832 9.504C215.885 187.222 172.35 208 128 208c-49.066 0-98.19-28.273-123.168-46.608c-2.989-2.189-4.825-5.8-4.832-9.504V123.2c0-3.776 1.2-7.424 3.424-10.464l7.792-10.544c4.173-5.657 10.38-7.152 16.992-7.152c2.496-28.48 8.4-48.8 22.512-63.68C77.331 3.165 112.567.06 127.552 0H128c14.72 0 50.4 2.88 77.28 31.36m-77.264 47.376c-3.04 0-6.544.176-10.272.544c-1.312 4.896-3.248 9.312-6.08 12.128c-11.2 11.2-24.704 12.928-31.936 12.928c-6.802 0-13.927-1.42-19.744-5.088c-5.502 1.808-10.786 4.415-11.136 10.912c-.586 12.28-.637 24.55-.688 36.824c-.026 6.16-.05 12.322-.144 18.488c.024 3.579 2.182 6.903 5.44 8.384C79.936 185.92 104.976 192 128.016 192c23.008 0 48.048-6.08 74.512-18.144c3.258-1.48 5.415-4.805 5.44-8.384c.317-18.418.062-36.912-.816-55.312h.016c-.342-6.534-5.648-9.098-11.168-10.912c-5.82 3.652-12.927 5.088-19.728 5.088c-7.232 0-20.72-1.728-31.936-12.928c-2.832-2.816-4.768-7.232-6.08-12.128a106 106 0 0 0-10.24-.544m-26.941 43.93c5.748 0 10.408 4.66 10.408 10.409v19.183c0 5.749-4.66 10.409-10.408 10.409s-10.408-4.66-10.408-10.409v-19.183c0-5.748 4.66-10.408 10.408-10.408m53.333 0c5.749 0 10.409 4.66 10.409 10.409v19.183c0 5.749-4.66 10.409-10.409 10.409c-5.748 0-10.408-4.66-10.408-10.409v-19.183c0-5.748 4.66-10.408 10.408-10.408M81.44 28.32c-11.2 1.12-20.64 4.8-25.44 9.92c-10.4 11.36-8.16 40.16-2.24 46.24c4.32 4.32 12.48 7.2 21.28 7.2c6.72 0 19.52-1.44 30.08-12.16c4.64-4.48 7.52-15.68 7.2-27.04c-.32-9.12-2.88-16.64-6.72-19.84c-4.16-3.68-13.6-5.28-24.16-4.32m68.96 4.32c-3.84 3.2-6.4 10.72-6.72 19.84c-.32 11.36 2.56 22.56 7.2 27.04c10.56 10.72 23.36 12.16 30.08 12.16c8.8 0 16.96-2.88 21.28-7.2c5.92-6.08 8.16-34.88-2.24-46.24c-4.8-5.12-14.24-8.8-25.44-9.92c-10.56-.96-20 .64-24.16 4.32M128 56c-2.56 0-5.6.16-8.96.48c.32 1.76.48 3.68.64 5.76c0 1.44 0 2.88-.16 4.48c3.2-.32 5.92-.32 8.48-.32s5.28 0 8.48.32c-.16-1.6-.16-3.04-.16-4.48c.16-2.08.32-4 .64-5.76c-3.36-.32-6.4-.48-8.96-.48"/>
                                                            </svg>
                                                        </div>
                                                        <!-- End Avatar -->
                                                    </div>
                            
                                                    <div class="flex-grow-1 ms-3 align-content-center">
                                                        <div class="row">
                                                            <div class="col-7 col-md-5 order-md-1">
                                                                <h6 class="mb-1 text-black fs-15">Github Copilot</h6>
                                                                <span class="fs-14 text-muted">Renew A Plan</span>
                                                            </div>
                                    
                                                            <div class="col-5 col-md-4 order-md-3 text-end mt-2 mt-md-0">
                                                                <h6 class="mb-1 text-black fs-14">$89.00 USD</h6>
                                                                <span class="fs-13 text-muted">25 April, 2024</span>
                                                            </div>
                                    
                                                            <div class="col-auto col-md-3 order-md-2 align-self-center">
                                                                <span class="badge bg-primary-subtle text-primary fw-semibold rounded-pill">Completed</span>
                                                            </div>
                                                        </div>
                                                        <!-- End Row -->
                                                    </div>

                                                </div>
                                            </li>
                                            <!-- End List Item -->

                                          </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Button Datatable -->
                       

                       
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col fs-13 text-muted text-center">
                                &copy; <script>document.write(new Date().getFullYear())</script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a href="#!" class="text-reset fw-semibold">ITech AbuTech IT Hub(2024)</a> 
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

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

<!-- Mirrored from zoyothemes.com/silva/html/tables-datatables by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 20 Feb 2025 13:48:36 GMT -->
</html>