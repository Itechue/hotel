<?php
session_start();
 require("conn/connection.php");
 require("conn/function.php");
 
 $pdo = prepareConnection();

 $adult=$_POST['adult'];
 $child=$_POST['child'];
 $gender=$_POST['gender'];
 $sroom=$_POST['sroom'];
 $_SESSION['adult'] =$_POST['adult'];
 $_SESSION['child'] =$_POST['child'];
 $_SESSION['gender'] =$_POST['gender'];
 $_SESSION['sroom'] =$_POST['sroom'];
//  var_dump($adult);
//  var_dump($child);
//  var_dump($gender);
//   var_dump($sroom);

//  die();
if($gender==""){
  echo '<script>alert("gender must not be left empty!");
  window.location.href="checking.php";
  </script>';
}else if($adult==""){
  echo '<script>alert("Age must not be left empty!");
  window.location.href="checking.php";
  </script>';
}else if($child==""){
  echo '<script>alert("No of children must be selected or choose none!");
  window.location.href="checking.php";
  </script>';
}else if($child=="" || $gender=="" || $sroom=="" || $adult=="" ){
  echo '<script>alert("All filled must be selected!");
  window.location.href="checking.php";
  </script>';
}else if($adult=="younger" || $adult=="young"){
   echo '<script>alert("You are too young to book a room!");
   window.location.href="checking.php";
   </script>';
}else if($gender=="female"){
  echo '<script>alert("Only male are allowed!");
  window.location.href="checking.php";
  </script>';
}else if ($adult=="adult" && $child<=2 && $gender=="male"){
try{
if($sroom=='standard'){
  $sql="select rooms.room_type,payment.pstatus from rooms join payment where room_type='standard' and pstatus='paid';";
  $stmt =$pdo->prepare($sql);
  $stmt->execute();
  $rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
  $roomexit  = $stmt->rowCount();
  // var_dump($roomexit);
  // die();
      if($roomexit==100){
        echo '<script> 
          alert ("Booking failed. Standard rooms are unavailable try other rooms!");
            window.location.href="index.php";
          </script>';
      }else{
        
        $mgs = 'success';
        $mgsid = hash('sha512',$hashcode);
        header("Location:buyform.php?status=".$mgs."&&cid=".$mgsid);
      }

}elseif($sroom=='luxury'){
  $sql="select rooms.room_type,payment.pstatus from rooms join payment where room_type='luxury' and pstatus='paid';";
  $stmt =$pdo->prepare($sql);
  $stmt->execute();
  $rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
  $roomexit  = $stmt->rowCount();
      if($roomexit==32){
        echo '<script> 
          alert ("Booking failed. Luxury rooms are unavailable try other rooms!");
            window.location.href="index.php";
          </script>';
      }else{
        
        $mgs = 'success';
        $mgsid = hash('sha512',$hashcode);
        header("Location:buyform.php?status=".$mgs."&&cid=".$mgsid);
      }
}elseif($sroom=='business'){
  $sql="select rooms.room_type,payment.pstatus from rooms join payment where room_type='business' and pstatus='paid';";
  $stmt =$pdo->prepare($sql);
  $stmt->execute();
  $rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
  $roomexit  = $stmt->rowCount();
      if($roomexit>=6){
        echo '<script> 
        alert ("Booking failed. Business Suite rooms are unavailable try other rooms!");
            window.location.href="index.php";
            </script>';
      }else{
        $mgs = 'success';
        $mgsid = hash('sha512',$hashcode);
        header("Location:buyform.php?status=".$mgs."&&cid=".$mgsid);

      }

}else{

  echo '<script>alert("something else occur try again!");
    window.location.href="checking.php";
  </script>';
}
     

}catch(Exception $e){

  echo '<script>alert("something else occur try again!");
    window.location.href="index.php";
  </script>';
}
}else{

  echo '<script>alert("something else occur try again!");
    window.location.href="checking.php";
  </script>';
}



?>