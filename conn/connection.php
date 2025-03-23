<?php
	function prepareConnection(){
		//varibale definitions
		$host = "127.0.0.1";
		$username = "root";
		$password = "";
		$db = "hotel_booking";
		try{
			$pdo = new PDO('mysql:host='.$host.';dbname='.$db , $username , $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connection successful";
		}catch(Exception $e){
			echo "<h2>Ooops! Something is wrong with the Connection<br>Please Contact the System Adminstrator</h2>";
			
		}
		return $pdo;
	}
?>