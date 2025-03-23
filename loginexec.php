<?php
	require("conn/connection.php");
	require("conn/function.php");
	
	$pdo = prepareConnection();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
   // var_dump($username);
    //var_dump($password);
   // die();
	
	$sql = "select * from rooms join bookings join role on rooms.id =bookings.room_id and rooms.roleid=role.id where rooms.username =:username and rooms.password =:password;";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":username", $username);
	$stmt->bindParam(":password", $password);
    // var_dump($stmt);
    // die();
	if($stmt->execute()){
		if($stmt->rowCount() == 1){
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//   var_dump($rows);
	    // die();
			session_start();
			$_SESSION['userid'] = $rows[0]['id'];
			$_SESSION['roomid'] = $rows[0]['room_id'];
			$_SESSION['username'] = $rows[0]['username'];
			$_SESSION['guest_name'] = $rows[0]['guest_name'];
			$_SESSION['password'] = $rows[0]['password'];
			//$_SESSION['adm_status'] = $rows[0]['adm_status'];
			$_SESSION['session'] = $rows[0]['session'];
			$_SESSION['loggedin'] = true;
			if($rows[0]['roleid'] == '1'){ // if admin
				header("location:Adminhome.php");
			}else if($rows[0]['roleid'] == '2'){ // if bidder
				header("location:recephome.php");
			}else if($rows[0]['roleid'] == '3'){ // if bidder
                $mgs = 'succ';
                $mgsid = hash('sha512',$hashcode);
                header("Location:chome.php?status=".$mgs."&&cid=".$mgsid."&&id=".$userid);
                
			}
		    }else{ 
			$mgs = 'err';
			header("Location: index.php?status=".$mgs."&&mid=".md5($username));
			//echo "<script>alert('Invalid Username/Password. Please Try Again'); location.href='index.php'; </script>";
		}
	}else{
		$mgs = 'err';
			header("Location: index.php?status=".$mgs."&&mid=".md5($username));
		//echo "<script>alert('Login Failed. Contact The Admin at admission@aichst.edu.ng'); location.href='index.php'; </script>";
	}
?>