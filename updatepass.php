<?php
session_start();
require("conn/connection.php");
require("conn/function.php");
$pdo = prepareConnection();
$username=$_POST['username'];
$password=$_POST['password'];
$newpass=$_POST['newpass'];
// var_dump($username);
// var_dump($password);
// var_dump($newpass);
//die();
       $sql="select * from rooms where username=:user;";
	   $stmt = $pdo->prepare($sql);
       $stmt->bindParam(':user', $username);
       $stmt->execute();
       $rows =$stmt->fetchAll(PDO::FETCH_ASSOC);
	   $roomexit  = $stmt->rowCount();
		
         if($roomexit == 1){
            try{
                if($password != $newpass){
                    try{
            
            
                        $sql="UPDATE rooms SET password = :newpass WHERE rooms.password = :pass and rooms.username=:id;";
                    
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':pass', $password);
                        $stmt->bindParam(':newpass', $newpass);
                        $stmt->bindParam(':id', $username);
                        $stmt->execute();
                        $mgs = 'successful';
                        $mgsid = hash('sha512',$status);
                        header("Location:updatepassword.php?status=".$mgs."&&cid=".$mgsid);
                    
                    
                    
                    }catch(Exception $e){
                    
                        $mgs = 'error';
                        $mgsid = hash('sha512',$status);
                        header("Location:updatepassword.php?status=".$mgs."&&cid=".$mgsid);
                    
                        }
            
                  }else{
                    echo '<script>alert("Password Match with old!");
                    window.location.href="updatepassword.php";
                   </script>'; 
                  }
              

            }catch(Exception $e){

            }
         




         }else{
            echo '<script>alert("Username does not exist !");
            window.location.href="updatepassword.php";
           </script>'; 
          }

  
?>