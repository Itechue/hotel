<?php
session_start();

require("conn/connection.php");
require("conn/function.php");

$pdo = prepareConnection();


$status = $_REQUEST['pid'];
// var_dump($invoice);
// var_dump($status);
//   die();

if ($status =='inactive'){
    $status ='active';
    $sql="update errorpage set error_status=:status";
    $stmt = $pdo->prepare($sql);
  
    $stmt->bindParam(':status', $status);
    $stmt->execute();
    $mgs = 'successful';
    $mgsid = hash('sha512',$status);
    header("Location:error.php?status=".$mgs."&&cid=".$mgsid);

}else if($status =='active'){
    $status ='inactive';
    $sql="update errorpage set error_status=:status";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    $mgs = 'deactivated';
    $mgsid = hash('sha512',$status);
    header("Location:error.php?status=".$mgs."&&cid=".$mgsid);
}else{
    $status ='inactive';
$mgs = 'oops!unknownerror';
header("location:error.php?status=".$mgs);
}

?>