<?php
	require("conn/connection.php");
	require("conn/function.php");
	
	$pdo = prepareConnection();
	
	/*$sql="SELECT * from settings where status = 'active'";
	$stmt=$pdo->prepare($sql);
	$stmt->execute();
	$settings =$stmt->fetchAll(PDO::FETCH_ASSOC);
	$sessions =$settings[0]['session'];
	$sql="SELECT * FROM fees where session=:sessions and status = 'Active' and item='Application Form'";
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':sessions', $sessions);
	$stmt->execute();
	$amounts =$stmt->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($amounts);
	$amount =$amounts[0]['price'];*/
	 $sessions="2025/2026";
	 $is_available="1";
	 $roleid="3";
	// $pstatus="paid";
	 $amount="1";
	 $type="Accommodation";
	// $stateid="1";
	// $lgaid="1";
	// $countryid="1";
	
	//user details as posted
	$firstname = addslashes($_POST['fname']);
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$gender = $_POST['gender'];
	$address =addslashes($_POST['address']);
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
	$sroom = $_POST['sroom'];
	$arrival=$_POST['arrival'];
	$departure=$_POST['departure'];
	$noofroom=$_POST['noofroom'];
	$noofdays=$_POST['noofdays'];
	// var_dump($noofdays);
	// var_dump($noofroom);
	// die();
    
	if($sroom=="standard"){
	   $amount="22000";
	   $noofdays;
       $amount*=$noofroom;
	   $amount*=$noofdays;
	}else if ($sroom=="luxury"){
		$amount="27000";
		$noofdays;
		$amount*=$noofroom;
		$amount*=$noofdays;
	}else if ($sroom=="business"){
		$amount="35000";
		$noofdays;
		$amount*=$noofroom;
		$amount*=$noofdays;
	}else{
		echo "<script>alert('invalid room selection');<?script>";
        exit();
	}
	
    

	$kmotel= generatekml($roomid, $email, $amount);
	$username = $kmotel;
	$hashcode = sha1(md5($kmotel));
	$session = addslashes($sessions);
	/*var_dump($programeid);
	var_dump($allbrigtherkidsid);
	exit();*/
	
	if($password == $cpassword){
		//$userexit = 0;
		$sql="select rooms.room_type,payment.pstatus from rooms join payment on room_type='standard' or room_type='luxury' or room_type='business' where pstatus='paid';";
		$stmt=$pdo->prepare($sql);
	
		$stmt->execute();
		$rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($rows);
		//$userexit = $stmt->rowCount($rows);
		$roomexit  = $stmt->rowCount();
		 //var_dump($roomexit);
		// die();
		if($roomexit>=468){
		$mgs = 'dup';
			$mgsid = hash('sha512',$roomid);
			header("Location:index.php?status=".$mgs."&&cid=".$mgsid);
           // echo '<script>alert("room already occupied");</script>';
		}else{
			$sql = "insert into rooms(username,password,room_type,noofroom,noofdays,is_available,roleid) values (:username, :password,:sroom,:roomsno,:noofd,:isavailable,:roleid)";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':username',$kmotel);
			$stmt->bindParam(':password', $password);
			$stmt->bindParam(':sroom', $sroom);
			$stmt->bindParam(':roomsno',$noofroom);
			$stmt->bindParam(':noofd',$noofdays);
			$stmt->bindParam(':isavailable', $is_available);
			$stmt->bindParam(':roleid', $roleid);
			try{
				$stmt->execute();
				$roomid= $pdo->lastInsertID();
				$sql = "insert into bookings(room_id,guest_name,guest_email,gender,address,total_price,phone,session,check_in_date,check_out_date) values(:roomid,:fname,:phone,:gender,:address,:email,:countryid, :session,:arriv,:depart)";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(':roomid', $roomid);
				$stmt->bindParam(':fname', $firstname);
				$stmt->bindParam(':phone',$email);
				$stmt->bindParam(':gender',$gender);
				$stmt->bindParam(':address',$address);
				$stmt->bindParam(':email',$amount);
				$stmt->bindParam(':countryid',$phone);
				$stmt->bindParam(':session', $session);
				$stmt->bindParam(':arriv',$arrival);
				$stmt->bindParam(':depart', $departure);
				/*var_dump($userid);
				var_dump($firstname);
				var_dump($surname);
				var_dump($othername);
				var_dump($phone);
				var_dump($email);
				var_dump($programeid);
				var_dump($session);*/
				// die();
				try{
					$stmt->execute();
					$invoice = generateinvoice($roomid);
					$orderID = generateorderID($roomid, $username,$hashcode);
					$sql = "insert into payment (orderid,invoice,appid,amount,type,session) values (:orderid,:invoice,:appid,:amount,:type,:session)";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(':orderid', $orderID);
					$stmt->bindParam(':invoice', $invoice);
					$stmt->bindParam(':appid', $kmotel);
					$stmt->bindParam(':amount', $amount);
					$stmt->bindParam(':type', $type);
					$stmt->bindParam(':session', $session);
					$stmt->execute();
			    //  var_dump($orderID);
				//  var_dump($invoice);
				//  var_dump($amount);
				//  die();
				
					//$stmt->execute();
					//echo $url = $_SERVER['SERVER_NAME']."/resetpassword.php?token=".$hash;
					$from = "kambamotellimited@gmail.com";
					$to = $email;
					$subject = "Kamba Motel Invoice Generation";
					
					$message = '<html><body>';
					$message .= '<img src="#" alt="Website Change Request" />';
					$message .= "<p> Dear ". strip_tags($firstname)."</p>";
					$message .= '<p>You have successfully generated an invoice. Your Application ID is:".$kmotel." </p>';
					$message .= "<p>Your invoice number is:".$invoice." and your ReferenceID is :".$orderID.".......</p>";
					$message .= "<p><hr></p>";
					$message .= "<p>Your login details are as follows:</p>";
					$message .= "<table>";
					$message .= "<tr><td>Username:</td><td>".$kmotel."</td></tr>";
					$message .= "<tr><td>Password:</td><td>".$password."</td></tr>";
					$message .= "</table>";
					$message .= '<p>You have successfully generated an invoice.</p>';
					$message .= "</body></html>";
					$headers = "From: " . $from . "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
					mail($to,$subject,$message, $headers); 
					$mgs = 'succ';
					$mgsid = hash('sha512',$hashcode);
					header("Location:pages-invoice.php?status=".$mgs."&&cid=".$mgsid."&&id=".$roomid);
				}catch(Exception $e){
					//echo $e->getMessage();
					//die();
					$sql = "delete from rooms where username = :username";
					$stmt = $pdo->prepare($sql);
					$stmt->bindParam(":username", $username);
					$stmt->execute();
					$mgs = 'dupl';
					$mgsid = hash('sha512',$hashcode);
					header("Location:index.php?status=".$mgs."&&cid=".$mgsid);
				}
			}catch(Exception $e){
				//echo $e->getMessage();
				header("location:index.php");
			}
		}
	}else{
		$mgs = 'mismatchpassword';
		$mgsid = hash('sha512',$hashcode);
		header("Location:buyform.php?status=".$mgs."&&cid=".$mgsid);
		//echo "<script>alert('password does not match');  location.href='buyform.php';</script>";
	}
?>