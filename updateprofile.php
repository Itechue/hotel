<?php 
    @session_start();
    require("conn/connection.php");
	require("conn/functions.php");
	
	$pdo = prepareConnection();

    $userid = $_SESSION['userid'];
	$username = $_SESSION['username'];
	$status = "active";
	
	$sql="SELECT * from settings where status = 'active'";
	$stmt=$pdo->prepare($sql);
	$stmt->execute();
	$settings =$stmt->fetchAll(PDO::FETCH_ASSOC);
	$sessions =$settings[0]['session'];
	
	$sql = "SELECT * FROM profile join users join program join payments on profile.userid = users.id and profile.programid = program.id and payments.userid=profile.userid where profile.userid =:userid";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":userid", $userid);
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$rows = $rows[0];
	//var_dump($rows);
	//die();
    $pstatus ="";
    $sql = "select * from profile join payments on profile.userid = payments.userid where profile.userid = :userid and payments.type ='Application Form'";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':userid', $userid); 
	$stmt->execute();
	$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
	//$payments = $payments[0];
    $pstatus = $payments[0]['pstatus'];
	//var_dump($userid);
	//var_dump($pstatus);
	//die();
	
	if($pstatus == 'Pending'){
		$mgs = 'Admissionformfail';
		header("Location: home.php?status=".$mgs."&&mid=".md5($userid));
	}

    $sql = "SELECT * FROM country order by countryname asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$country = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$country_list='<option selected >--Select Country--</option>';
	foreach($country as $count){
		$country_list .= "<option value=".$count['countryid'].">".$count['countryname']."</option>";
	}
	
	$sql = "select * from states order by state asc";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$states = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$state_list='<option selected >--Select State--</option>';
	foreach($states as $state){
		$state_list .= "<option value=".$state['id'].">".$state['state']."</option>";
	}
	
	$valid_file = true;
	if(isset($_POST['upload'])){
	   
		//var_dump($_FILES);
		if(isset($_FILES['photo']['name'])) {
			//if no errors...
			if(!$_FILES['photo']['error']){
				//now is the time to modify the future file name and validate the file
				$new_file_name = date("YmdHis").strtolower($_FILES['photo']['name']); //rename file
				if($_FILES['photo']['size'] > (1024000)){ //can't be larger than 1 MB
					$valid_file = false;
					echo "<script> alert('Oops!  Your file\'s size is to large.'); </script>";
				}
				//if the file has passed the test
				if($valid_file){
					$foldername='passport';
					//move it to where we want it to be
					move_uploaded_file($_FILES['photo']['tmp_name'], $foldername.'/'.$new_file_name);
			        $sql = "update profile set passport = :filename where userid = :userid";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':userid', $userid);
					$stmt->bindParam(':filename', $new_file_name);
					$stmt->execute();
				} 
				//echo "<script> alert('Upload Completed'); </script>";
				$mgs = 'photosucc';
				header("Location: home.php?status=".$mgs."&&mid=".md5($userid));
			}else{//if there is an error... set that to be the returned message 
				echo "<script>alert(Ooops!  Your upload triggered the following error:".$_FILES['photo']['error'].");</script>";
			}
		}else{
			echo "<script> alert('No Image Selected'); </script>";
		}
	}


	if(!empty($_GET['status'])){
		switch($_GET['status']){
			case 'Admissionformfail':
				$statusType = 'alert-danger';
				$statusMsg = 'Admission form invoice is not paid...make payment to proceed.';
				break;
			case 'Aceptsucc':
				$statusType = 'alert-success';
				$statusMsg = 'Acceptance Letter invoice is Successfully Generated.';
				break;
			case 'Aceptrror':
				$statusType = 'alert-danger';
				$statusMsg = 'Some problem occurred, please try again.';
				break;
			case 'dup':
				$statusType = 'alert-warning';
				$statusMsg = 'Invalid Email Address.......This Email has been used in previous invoice generation.';
				break;
			case 'mis':
				$statusType = 'alert-danger';
				$statusMsg = 'Password mismatch Please Try Again.';
				break;
			default:
				$statusType = '';
				$statusMsg = '';
		}
	}
?>
<!doctype html>
<html lang="en">

<head>
    <title>:: UDUCONS :: Updatae Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Iconic Bootstrap 4.5.0 Admin Template">
    <meta name="author" content="WrapTheme, design by: ThemeMakker.com">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/vendor/charts-c3/plugin.css" />
    <link rel="stylesheet" href="assets/vendor/dropify/css/dropify.min.css">

    <!-- MAIN Project CSS file -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/blog.css">
    
    <script src="assets/js/jquery.js"></script>
    <script>
    $("#sorigin").live('change', function() {	
        // Display message "Please wait loading...." while server is busy	
        $("#lorigin").empty().html('<option value = "loading">Please Wait Loading...</option>');
        // Loads response from server as html into the list menu with id = lga_ctl
        $("#lorigin").load("showlga.php", {"stateid": $(this).val()});
            });
    </script>

    <script>
    // Show the toast automatically
    window.onload = function() {
        var toastEl = document.getElementById('borderedToast1');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    };
    </script>
</head>

<body data-theme="light" class="font-nunito">
    <div id="wrapper" class="theme-cyan">

        <!-- Page Loader -->
        <?php //include('panels/loader.php');?>

        <!-- Top navbar div start -->
        <?php include('panels/navbar.php');?>

        <!-- main left menu -->
        <?php include('panels/sidelinks.php');?>

        <!-- rightbar icon div -->
        <?php include('panels/rightbar.php');?>

        <!-- mani page content body part -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <h2>Student</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a>
                                </li>
                                <li class="breadcrumb-item">Update</li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                        <?php if(!empty($statusMsg)){ ?>
                        <div id="borderedToast1"
                            class="toast toast-border-<?php echo $statusType;?> overflow-hidden mt-3" role="alert"
                            aria-live="assertive" aria-atomic="true">
                            <div class="toast-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <i class="ri-notification-4-line align-middle"></i>
                                    </div>
                                    <div class="flex-grow-1">

                                        <h6 class="mb-0"><?php echo $statusMsg;?></h6>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="d-flex flex-row-reverse">
                                <div class="page_action">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-download"></i>
                                        <?php echo strtoupper($rows['uduconsid']);?></button>
                                </div>
                                <div class="p-2 d-flex">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix">

                    <div class="col-lg-3 col-md-12">
                        <div class="card profile-header">
                            <div class="body">
                                
                                <div class="profile-image"> <img src="passport/<?php echo $rows['passport'];?>"
                                        class="rounded-circle" alt="" height="200px"> </div>
                                <div>
                                </div>
                                <div class="m-t-15">
                                <p>Upload your photo.
                                <br> <em>Image should be at least 140px x 140px</em></p>
                                    <div class="row">
                                    <form action="updateprofile.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="file" class="dropify" name="photo">
                                        </div>
                                        <div class="form-group">
                                        <button class="btn btn-outline-secondary" name="upload" id="submit" type="submit"><i class="icon-paper-clip"></i> Upload File </button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card single_post">
                            <div class="body">
                                <h5 class="center">Program of Application</h5>
                                <div class="img-post">
                                    <img class="d-block img-fluid" src="assets/images/blog/blog-page-2.jpg" alt="">
                                </div>
                                <h3 style="text-align:center;"><a href="#"><?php echo strtoupper($rows['program']);?></a></h3>
                                <p style="text-align:justify;">Over the duration of this course, you'll gain essential skills Through a combination of lectures, hands-on projects, and interactive discussions, you'll have the opportunity to apply what you learn in <?php echo $rows['program'];?> in real-world scenarios.</p>
                            </div>
                            <div class="footer">
                                <div class="actions">
                                    <a href="javascript:void(0);" class="btn btn-outline-secondary">Continue Reading</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-9 col-md-12">
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="body">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                    href="#Settings">Personal Information</a></li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">

                                        <div class="tab-pane active" id="Settings">
                    
                                            <?php $sql="SELECT status_updated FROM profile where session_admitted=:sessions and userid = :userid";
				$stmt=$pdo->prepare($sql);
				$stmt->bindParam(':sessions', $sessions);
				$stmt->bindParam(':userid', $userid);
				$stmt->execute();
				$admstatus =$stmt->fetchAll(PDO::FETCH_ASSOC);
				$status_updated =$admstatus[0]['status_updated'];
				//var_dump($status_updated);
				//die();
				if($status_updated =='pending'){
				?>
					<div class="body">
						<form action="updatebiodata.php" method="post" enctype="multipart/form-data">
						<div class="row clearfix">
							<div class="col-lg-4 col-md-12">
								<div class="form-group">
								<label for="firstname" class="control-label">Firstname</label>
									<input type="text" class="form-control" name="firstname" value="<?php echo strtoupper($rows['firstname']);?>" disabled>
								</div>
								<div class="form-group">
								<label for="email" class="control-label">Email</label>
									<input type="text" class="form-control" name="email" value="<?php echo $rows['email'];?>" disabled>
								</div>
								<div class="form-group">
								<label for="Birthdate" class="control-label">Date of Birth</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar"></i></span>
										</div>
										<input data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Birthdate">
										<input type="text" class="form-control" name="dob" value="<?php echo $rows['dob'];?>">
									</div>
								</div>
								<div class="form-group">
								<label for="Country" class="control-label">Country</label>
									<select class="form-control" name="countryid" required>
										<?php echo $country_list;?>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-12">
								<div class="form-group">
								<label for="surname" class="control-label">Surname</label>
									<input type="text" class="form-control" name="surname" value="<?php echo strtoupper($rows['surname']);?>" disabled>
								</div>
								<div class="form-group">
									<label for="phone" class="control-label">Phone</label>
									<input type="text" class="form-control" name="phone" value="<?php echo $rows['phone'];?>" disabled>
								</div>
								<div class="form-group">
								<label for="Gender" class="control-label">Gender</label>
									<div class="form-group">
										<label class="fancy-radio">
											<input class="form-control" name="gender" value="Male" type="radio" <?php if($rows['gender'] == "Male"){ echo "checked";}?>>
											<span><i></i>Male</span>
										</label>
										<label class="fancy-radio">
											<input class="form-control" name="gender" value="Female" type="radio" <?php if($rows['gender'] == "Female"){ echo "checked";}?>>
											<span><i></i>Female</span>
										</label>
									</div>
								</div>
								<div class="form-group">
								<label for="State" class="control-label">State</label>
									<select class="form-control" name="sorigin" id="sorigin" required>
										<?php echo $state_list;?>
									</select>
								</div>
							</div>
							<div class="col-lg-4 col-md-12">
								<div class="form-group">
								<label for="othername" class="control-label">Othername</label>
									<input type="text" class="form-control" name="othername" value="<?php echo strtoupper($rows['othername']);?>" disabled>
								</div>
								<div class="form-group">
								<label for="phone" class="control-label">UDUCONSID</label>
									<input type="text" class="form-control" name="uduconsid" value="<?php echo strtoupper($rows['uduconsid']);?>" disabled>
								</div>
								<div class="form-group">
								<label for="phone" class="control-label">Session</label>
									<input type="text" class="form-control" name="session" value="<?php echo strtoupper($rows['session']);?>" disabled>
								</div>
								<div class="form-group">
								<label for="lga" class="control-label">L.G.A</label>
									<select class="form-control" name="lorigin" id="lorigin" required>
										<option>-- Select L.G.A --</option>
									</select>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group"><label for="Program" class="control-label">Contact Address (20 chars min, 100 max)</label>
								<textarea required="required" class="form-control" name="address" placeholder="Enter your Address"></textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<h5>Next of Kin's Information</h5>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
								<label for="firstname" class="control-label">Full Name</label>
									<input type="text" name="kenfname" class="form-control" placeholder="Enter Next of Kin's Full Name" required>
								</div>
								<div class="form-group">
								<label for="email" class="control-label">Email</label>
								<div class="input-group mb-3">
									<input type="text" name="kenemail" class="form-control" placeholder="Enter Next of Kin's Email" aria-label="Enter Next of Kin's Email" aria-describedby="basic-addon2" required>
									<div class="input-group-append">
										<span class="input-group-text" id="basic-addon2">@gmail.com</span>
									</div>
								</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
								<label for="lga" class="control-label">Relationship</label>
									<select class="form-control" name="kenrel" required>
										<option>-- Select Relationship --</option>
										<option value="Father">Father</option>		
										<option value="Brother">Brother</option>
										<option value="Mother">Mother</option>		
										<option  value="Sister">Sister</option>		
										<option value="Uncle">Uncle</option>		
										<option value="Aunt">Aunt</option>	
										<option value="Niece">Niece</option>	
										<option value="Nephew">Nephew</option>
									</select>
								</div>
								<div class="form-group">
									<label for="phone" class="control-label">Phone</label>
									<input type="text" name="kenphone" class="form-control" placeholder="Enter Next of Kin's Phone" required>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group"><label for="Program" class="control-label">Contact Address (20 chars min, 100 max)</label>
								<textarea required="required" class="form-control" name="kenaddress"placeholder="Enter your Next of Kin's Address"></textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
								<input type="hidden" name="userid" value="<?php echo $rows['userid'];?>">
									<button class="btn btn-outline-secondary" name="updatebiodata" id="submit" type="submit"><i class="icon-refresh"></i> Update Profile</button>
								</div>
							</div>
						</div>
						</form>
						<hr>
						<p><i class="icon-info"></i>
							<span style="color:red">Note:</span> Ensure to enter the correct information because You cannot make any changes any more. 
						</p>
						<hr>
					</div>
			<?php }elseif($status_updated =='updated'){
                $sql="SELECT * FROM profile join users JOIN states JOIN lgas JOIN country join kininfo on profile.userid = users.id and profile.stateid = states.id and profile.lgaid = lgas.id and profile.countryid = country.countryid and profile.userid=kininfo.userid where profile.userid = :userid";
				$stmt=$pdo->prepare($sql);
				$stmt->bindParam(':userid', $userid);
				$stmt->execute();
				$profiles =$stmt->fetchAll(PDO::FETCH_ASSOC);
				$profile = $profiles[0];
				?>
					<div class="body">
						<form action="" method="post" enctype="multipart/form-data">
						<div class="row clearfix">
							<div class="col-lg-4 col-md-12">
								<div class="form-group">
								<label for="firstname" class="control-label">Firstname</label>
									<input type="text" class="form-control" name="firstname" value="<?php echo strtoupper($profile['firstname']);?>" disabled>
								</div>
								<div class="form-group">
								<label for="email" class="control-label">Email</label>
									<input type="text" class="form-control" name="email" value="<?php echo $profile['email'];?>" disabled>
								</div>
								<div class="form-group">
								<label for="Birthdate" class="control-label">Date of Birth</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="icon-calendar"></i></span>
										</div>
										<input type="text" class="form-control" name="dob" value="<?php echo $profile['dob'];?>" disabled>
									</div>
								</div>
								<div class="form-group">
								<label for="Country" class="control-label">Country</label>
									<input type="text" class="form-control" value="<?php echo $profile['countryname'];?>" disabled>
								</div>
							</div>
							<div class="col-lg-4 col-md-12">
								<div class="form-group">
								<label for="surname" class="control-label">Surname</label>
									<input type="text" class="form-control" name="surname" value="<?php echo strtoupper($profile['surname']);?>" disabled>
								</div>
								<div class="form-group">
									<label for="phone" class="control-label">Phone</label>
									<input type="text" class="form-control" name="phone" value="<?php echo $profile['phone'];?>" disabled>
								</div>
								<div class="form-group">
								<label for="Gender" class="control-label">Gender</label>
									<div class="form-group">
										<input type="text" class="form-control" value="<?php echo $profile['gender'];?>" disabled>
									</div>
								</div>
								<div class="form-group">
								<label for="State" class="control-label">State</label>
									<input type="text" class="form-control" value="<?php echo $profile['state'];?>" disabled>
								</div>
							</div>
							<div class="col-lg-4 col-md-12">
								<div class="form-group">
								<label for="othername" class="control-label">Othername</label>
									<input type="text" class="form-control" name="othername" value="<?php echo strtoupper($profile['othername']);?>" disabled>
								</div>
								<div class="form-group">
								<label for="phone" class="control-label">UDUCONSID</label>
									<input type="text" class="form-control" name="uduconsid" value="<?php echo strtoupper($profile['uduconsid']);?>" disabled>
								</div>
								<div class="form-group">
								<label for="phone" class="control-label">Session</label>
									<input type="text" class="form-control" name="session" value="<?php echo strtoupper($profile['session_admitted']);?>" disabled>
								</div>
								<div class="form-group">
								<label for="lga" class="control-label">L.G.A</label>
									<input type="text" class="form-control" value="<?php echo $profile['lga'];?>" disabled>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group"><label for="Program" class="control-label">Contact Address</label>
								<textarea required="required" class="form-control" name="address" disabled> <?php echo $profile['address'];?></textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<h5>Next of Kin's Information</h5>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
								<label for="firstname" class="control-label">Full Name</label>
									<input type="text" name="kenfname" class="form-control" value="<?php echo $profile['kinfullname'];?>" disabled>
								</div>
								<div class="form-group">
								<label for="email" class="control-label">Email</label>
								<div class="input-group mb-3">
									<input type="text" name="kenemail" class="form-control" value="<?php echo $profile['kinemail'];?>" disabled>
								</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
								<label for="lga" class="control-label">Relationship</label>
									<input type="text" name="kenfname" class="form-control" value="<?php echo $profile['kinrel'];?>" disabled>
								</div>
								<div class="form-group">
									<label for="phone" class="control-label">Phone</label>
									<input type="text" name="kenphone" class="form-control" value="<?php echo $profile['kinphone'];?>" disabled>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group"><label for="Program" class="control-label">Contact Address</label>
								<textarea required="required" class="form-control" name="kenaddress" disabled><?php echo $profile['kinaddress'];?>"</textarea>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
								<span style="float:right; color:red; font-weight:bold; text-decoration:blink"><a class="btn btn-outline-primary" href="olevels.php">Procced</a></span>
								</div>
							</div>
						</div>
						</form>
					</div>
				<?php }?>

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
    <!-- Javascript -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/bundles/vendorscripts.bundle.js"></script>
    <script src="assets/vendor/dropify/js/dropify.min.js"></script>
    <!-- page vendor js file -->
    
    <script src="assets/bundles/c3.bundle.js"></script>

    <!-- page js file -->
    <script src="assets/bundles/mainscripts.bundle.js"></script>
    <script src="assets/js/index.js"></script>
</body>

</html>