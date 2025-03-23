<?php
	function checkLogin(){
		if($_SESSION['loggedin'] != true){
			unset($_SESSION);
			session_destroy();
			header("location:index.php");
		}
	}
	//FXN
	function scramble($number) {//http://stackoverflow.com/questions/18356324/how-to-generate-card-number-so-the-users-cannot-follow-how-much-is-sold
		return (305914000*($number-10)+1516478) % 196983;
	}
	function unscramble($number) {//http://stackoverflow.com/questions/18356324/how-to-generate-card-number-so-the-users-cannot-follow-how-much-is-sold
		return (605673000*($number-1516478)+10) % 196983 ;
	}
	
	function generateinvoice($userid){
		$date = strtotime(date('Y-m-d H:i:s')); 
	    $newdate = substr($date, 6);
		$uniq= uniqid("", true);
		$uniq= substr($uniq, 17)*$userid;
		$uniq .= $newdate; 
		return $uniq;
	}
	function generatekml($roomid, $email, $amount){
		$alphabets = array("A","B","C","D","E","F","G","H","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
		$kmotel = "KML".date("y");
		$kmotel .= $amount*rand(0,9);
		$kmotel .= $alphabets[rand(0,23)];
		$kmotel .= scramble($roomid*rand(0,9));
		$kmotel .= scramble($amount)*rand(0,9);
		$kmotel = str_replace("-", "",$kmotel);
		$kmotel = substr($kmotel, 0, strlen($kmotel)-2).date("YMDHms");
		$kmotel = substr($kmotel, 0, 16);
		
		return $kmotel;
	}
	
	function generateorderID($userid, $username, $hashcode){
		$date = strtotime(date('Y-m-d H:i:s')); 
	    $newdate = substr($date, 8);
		$orderID = 0;
		$data = strtoupper(hash('sha512', hash('sha512',$hashcode).hash('sha512',$username)));
		for($i = 0; $i < strlen($data); $i++){
			$orderID += ord(substr($data, $i, 1))*$userid;
		}
		while(strlen($orderID) < 6) $orderID.=$userid;
		$orderID .= $newdate;
		return $orderID;
	}
	
	function get_mime_type($file) {
		$mtype = false;
		if (function_exists('finfo_open')) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mtype = finfo_file($finfo, $file);
			finfo_close($finfo);
		} elseif (function_exists('mime_content_type')) {
			$mtype = mime_content_type($file);
		} 
		return $mtype;
	}
	
	function writeLogs($filename, $message){
		$status = false;
		try{
			$fp = fopen("Access_Logs/".$filename, "a");
			$fw = fwrite($fp, $message);
			$status = true;
		}catch(Exception $e){
			echo $e->getMessage();
		}
		fclose($fp);
		return $status;
	}
	function calculateStatus($total){
		$status = "Fail";
		if($total >=40){
			$status = "Pass";
		}elseif($total == '-'){
			$status = "-";
		}
		return $status;
	}
	function calculateTotal($ca1,$ca2,$exams,$mod){
		$status = "-";
		if($ca1 != '-' and $ca2 != '-' and $exams != '-' and $mod != '-'){
			$status = $ca1+$ca2+$exams+$mod;
		}
		return $status;
	}
	
	function getIPAddress() {
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}
	
	
	
	
	function marksum($add){
		$sum = array_sum($add);
		return $sum;
	}
	
	function gradestudent($m,$program){
		$status = "Fail";
		if($program==1){
			if( array_sum($m)>=180){
				if($m[0]>=20 && $m[1]>=40 && $m[2]>=40 && $m[3]>=40 && $m[4]>=40){
					$status='pass';
				}elseif($m[0] >=40 && $m[1]>=20 && $m[2]>=40 && $m[3]>=40 && $m[4]>=40){
					$status='pass';
				}elseif($m[0] >=40 && $m[1]>=40 && $m[2]>=20 && $m[3]>=40 && $m[4]>=40){
					$status='pass';
				}elseif($m[0] >=40 && $m[1]>=40 && $m[2]>=40 && $m[3]>=20 && $m[4]>=40){
					$status='Pass';
				}elseif($m[0] >=40 && $m[1]>=40 && $m[2]>=40 && $m[3]>=40 && $m[4]>=20){
					$status='Pass';
				}
					
			}
			
		}elseif($program==2){
			if( array_sum($m)>=140){
				if($m[0]>=20 && $m[1]>=40 && $m[2]>=40 && $m[3]>=35 && $m[4]>=35){
					 $status='Pass';
				}elseif($m[0] >=35 && $m[1]>=20 && $m[2]>=35 && $m[3]>=35 && $m[4]>=35){
					 $status='Pass';
				}elseif($m[0] >=35 && $m[1]>=35 && $m[2]>=20 && $m[3]>=35 && $m[4]>=35){
					 $status='Pass';
				}elseif($m[0] >=35 && $m[1]>=35 && $m[2]>=35 && $m[3]>=20 && $m[4]>=35){
					 $status='Pass';
				}elseif($m[0] >=35 && $m[1]>=35 && $m[2]>=35 && $m[3]>=35 && $m[4]>=20){
					 $status='Pass';
				}elseif( array_sum($m)>=180){
					 $status='Pass';
				}
			}
		}
		return ucwords($status);
	}
	/*function gradestudent2($m,$program){
		$status = "Fail";
		if($program==1){
			if( array_sum($m)>=180){
				//var_dump($m);
				if($m[0]>=20 && $m[1]>=20 && $m[2]>=40 && $m[3]>=40 && $m[4]>=40){
					$status='pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=40 && $m[3]>=40 && $m[4]>=40){
					$status='pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					$status='pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					$status='Pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					$status='Pass';
				}
					
			}
			
		}elseif($program==2){
			if( array_sum($m)>=140){
				var_dump($m);
				if($m[0]>=20 && $m[1]>=40 && $m[2]>=40 && $m[3]>=35 && $m[4]>=35){
					 $status='Pass';
				}elseif($m[0] >=35 && $m[1]>=20 && $m[2]>=35 && $m[3]>=35 && $m[4]>=35){
					 $status='Pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					 $status='Pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					 $status='Pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					 $status='Pass';
				}elseif( array_sum($m)>=140){
					 $status='Pass';
				}
			}
		}
		return ucwords($status);
	}*/
	function gradestudent2($m,$program){
		$status = "Fail";
		if($program==1){
			if( array_sum($m)>=180){
				//var_dump($m);
				if($m[0]>=20 || $m[1]>=20 || $m[2]>=40 || $m[3]>=40 || $m[4]>=40){
					$status='pass';
				}elseif($m[0] >=20 || $m[1]>=20 || $m[2]>=40 || $m[3]>=40 || $m[4]>=40){
					$status='pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					$status='pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					$status='Pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					$status='Pass';
				}	
			}
		}elseif($program==2){
			if( array_sum($m)>=140){
				//var_dump($m);
				if($m[0]>=20 || $m[1]>=40 || $m[2]>=40 || $m[3]>=35 || $m[4]>=35){
					 $status='Pass';
				}elseif($m[0] >=35 || $m[1]>=20 || $m[2]>=35 || $m[3]>=35 || $m[4]>=35){
					 $status='Pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					 $status='Pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					 $status='Pass';
				}elseif($m[0] >=20 && $m[1]>=20 && $m[2]>=20 && $m[3]>=20 && $m[4]>=20){
					 $status='Pass';
				}elseif( array_sum($m)>=140){
					 $status='Pass';
				}
			}
		}
		//var_dump($status);
		return ucwords($status);
	}
	/*function gradestudent($marks){
		$status = "Fail";
		if($marks[0] >=40 || $marks[0] >=20){//passed English
		$status= "Pass";
			if($marks[1] >=40 || $marks[1] >=20){//passed Maths
			$status= "Pass";
				if($marks[2] >=40 || $marks[2] >=20){
					$status= "Pass";
					if($marks[3]>=40 || $marks[3]>=20){
						$status= "Pass";
						if($marks[4] >=40 || $marks[4] >=20){
							$status= "Pass";
						}
				
					}
				}
			}
		}
		
		return $status;
	}*/
?>