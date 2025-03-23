<?php
//session_start();

require("conn/connection.php");
require("conn/function.php");

$pdo = prepareConnection();
$invoice = $_REQUEST['nid'];
$status = $_REQUEST['pid'];
$id = $_REQUEST['aid'];
        try{

            $sql="delete from rooms  where username=:id;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }catch(Exception $e){
        
            header("location:ahome.php").$e;
            
        }





    if(!empty($status)){
        
        try{
            $sql="delete from payment  where appid=:invoice ;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':invoice', $invoice);
            $stmt->execute();
           try{
                $sql="delete from bookings  where created_at=:status ;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':status', $status);
                $stmt->execute();
             
            }catch(Exception $e){
        
                header("location:ahome.php").$e;
                
            }
        
        
        }catch(Exception $e){
        
            header("location:ahome.php").$e;
            
        }
            

    }
     $mgs = 'deletesucc';
     header("location:remove.php?status=".$mgs."&&mid=".md5($username));

?>