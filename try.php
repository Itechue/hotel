<?php
session_start();
require("conn/connection.php");
require("conn/function.php");

$pdo = prepareConnection();
$sql="select * from errorpage";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
$_SESSION['error_status'] = $rows[0]['error_status'];
if($rows[0]['error_status']=='inactive'){
    $mgs = 'success';
    $mgsid = hash('sha512',$hashcode);
    header("Location:checking.php?status=".$mgs."&&cid=".$mgsid);
}else if($rows[0]['error_status']=='active'){
    $mgs = 'ooops';
    $mgsid = hash('sha512',$hashcode);
    header("Location:errorpge.php?status=".$mgs."&&cid=".$mgsid);
}else{
    $mgs = 'error';
    $mgsid = hash('sha512',$hashcode);
    header("Location:index.php?status=".$mgs."&&cid=".$mgsid);
}
?>