<?php
require("conn/connection.php");
require("conn/function.php");

$pdo = prepareConnection();
$sql="select * from payment where pstatus='paid';";









?>