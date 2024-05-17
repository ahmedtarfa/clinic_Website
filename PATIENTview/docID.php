<?php
session_start();


if (isset($_GET['doctor_id'])) {
    $selected_doctor_id = $_GET['doctor_id'];
    include('inc/connections.php');
    $sql = "SELECT * FROM doctor WHERE Doctor_ID = $selected_doctor_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if(! $result){
            die("invalide query : ". $conn -> error);
        }
    
        $_SESSION['selected_doctor'] = $row;
        
        header('location:booking.php'); 
        exit;
}

?>