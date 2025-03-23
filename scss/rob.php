<?php
	   require("conn/connection.php");
	
	   $pdo = prepareConnection();
	
      $arrival = $_POST['arrival'];
      //$avroom= $_POST['avroom'];
      $adult = $_POST['adult'];
      $nchild = $_POST['nchild'];
      $depart = $_POST['depart'];
      // var_dump($arrival);
      // var_dump($adult);
      // var_dump($nchild);
      // var_dump($depart);
      // die();
      if ($adult==1&&$nchild<=2){
         $sql="select rooms.room_number,rooms.room_type,rooms.is_available, from rooms where is_available='';";
         $stmt =$pdo->prepare($sql);
         $stmt->execute();
		   $rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
         if ($stmt->rowCount()==1){
            header("location:buyform.php")
         }else if($avroom==1){
         header("location:index.php");
         }else if($adult==2){
            header("location:index.php");
         }else if($nchild>3){
            header("location:index.php");
         }else{
            header("location:index.php");
            echo "<script>alert('Invalid Parameters. Please Try Again'); location.href='index.php'; </script>";
         }





      }
    
         //  $sql="select rooms.room_number,rooms.room_type,rooms.is_available, from rooms where is_available='';";
         //  $stmt =$pdo->prepare($sql);
         //  if ($stmt->execute()){
         //     if ($stmt->rowCount()==1){
         //        $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
         //     global $arrival;
         //     global $avroom;
         //     global $adult;
         //     global $nchild;
         //     global $depart;
         //     $avroom=$rows
         //     if ($avroom==""||$adult==1||$nchild<=2||){
         //        header("location:buyform.php");
         //     }elseif($avroom==1){
         //        header("location:index.php");
         //     }elseif($adult==2){
         //        header("location:index.php");
         //     }elseif($nchild>3){
         //        header("location:index.php");
         //     }else{
         //        header("location:index.php");
         //        echo "<script>alert('Invalid Parameters. Please Try Again'); location.href='index.php'; </script>";
         //     }
             

            
            
            
            
            
         //    }


         //  }else{
         //    $mgs = 'err';
         //    		header("Location: index.php?status=".$mgs."&&mid=".md5($avroom));
         //  }
	         
//?> -->