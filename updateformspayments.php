<?php
session_start();

require("conn/connection.php");
require("conn/function.php");

$pdo = prepareConnection();

$invoice = $_REQUEST['nid'];
$status = $_REQUEST['pid'];
$type = 'Accommodation';

if ($status =='pending'){
    $status ='paid';
}else{
    $status ='pending';
}
$sql="update payment set pstatus = :status where invoice = :invoice and type = :type";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':invoice', $invoice);
$stmt->bindParam(':status', $status);
$stmt->bindParam(':type', $type);
$stmt->execute();

$mgs = 'paymentsucc';
header("location:updatepayments.php?status=".$mgs."&&mid=".md5($username));


?>