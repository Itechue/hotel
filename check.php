<?php
session_start();
require("conn/connection.php");
require("conn/function.php");

$pdo = prepareConnection();

$adult = $_POST['adult'];
$child = $_POST['child'];
$gender = $_POST['gender'];
$sroom = $_POST['sroom'];

$_SESSION['adult'] = $adult;
$_SESSION['child'] = $child;
$_SESSION['gender'] = $gender;
$_SESSION['sroom'] = $sroom;

try {
    // Validate input fields
    if (empty($gender)) {
        throw new Exception("Gender must not be left empty!");
    }
    if (empty($adult)) {
        throw new Exception("Age must not be left empty!");
    }
    if (empty($child)) {
        throw new Exception("Number of children must be selected or choose none!");
    }
    if (empty($sroom)) {
        throw new Exception("Room type must be selected!");
    }
    if ($adult == "younger" || $adult == "young") {
        throw new Exception("You are too young to book a room!");
    }
    if ($gender == "female") {
        throw new Exception("Only males are allowed!");
    }

    // Process booking
    if ($adult == "adult" && $child <= 2 && $gender == "male") {
        if ($sroom == 'standard') {
            $sql = "SELECT rooms.room_type, payment.pstatus FROM rooms JOIN payment WHERE room_type='standard' AND pstatus='paid';";
        } elseif ($sroom == 'luxury') {
            $sql = "SELECT rooms.room_type, payment.pstatus FROM rooms JOIN payment WHERE room_type='luxury' AND pstatus='paid';";
        } elseif ($sroom == 'business') {
            $sql = "SELECT rooms.room_type, payment.pstatus FROM rooms JOIN payment WHERE room_type='business' AND pstatus='paid';";
        } else {
            throw new Exception("Invalid room type selected!");
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $roomexit = $stmt->rowCount();

        // Check room availability
        if (($sroom == 'standard' && $roomexit == 100) ||
            ($sroom == 'luxury' && $roomexit == 32) ||
            ($sroom == 'business' && $roomexit >= 6)) {
            throw new Exception("Booking failed. Selected room type is unavailable, try other rooms!");
        }

        // Generate success response
        $hashcode = uniqid(); // Generate a unique hash code
        $mgs = 'success';
        $mgsid = hash('sha512', $hashcode);
        header("Location:buyform.php?status=" . $mgs . "&&cid=" . $mgsid);
        exit;
    } else {
        throw new Exception("Invalid booking criteria!");
    }
} catch (Exception $e) {
    // Handle errors and redirect with an alert
    echo '<script>
        alert("' . $e->getMessage() . '");
        window.location.href="checking.php";
    </script>';
    exit;
}
?>