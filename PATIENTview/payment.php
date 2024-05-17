<?php
include('inc/connections.php'); 
session_start();
$patient_id = $_SESSION['Patient_ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALEX CLINEC PAY</title>
    <link rel="stylesheet" href="css/payStyles.css">
</head>
<body>
<form class="" action="" method="post" autocomplete="off">
    <?php
        $sql = "SELECT * FROM patient WHERE Patient_ID = $patient_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        echo "<p>Name : ".$row["first_name"]." ".$row["last_name"]."</p>
             <p>Phone Number : ".$row["phone_number"]."</p>";

        if($row["Medicine_ID"] == 0){
            echo "<p>Pay after vist doctor</p>";
        }else{
            $med_id = $row["Medicine_ID"];
            $sql_medcine = "SELECT * FROM medicine WHERE Medicine_ID = $med_id";
            $result_medcine = mysqli_query($conn, $sql_medcine);
            $row_medcine = mysqli_fetch_assoc($result_medcine);
            echo "<p>Medcine Name : ".$row_medcine["name"]."</p>
            <p> Disease Name : ".$row["disease"]."</p>";
            
            $new_quantity = $row_medcine['quantity'] - 1 ;
            $new_sql = "UPDATE `medicine` SET `medicine`.`quantity`='$new_quantity' WHERE `medicine`.`Medicine_ID` = '$med_id' ; ";
            mysqli_real_query ($conn,$new_sql);

            $room_price=0.0;
            $doc_price= 15.0;
            if($row["Room_number"] != 0){
                $room_price = 50.0;
            }
            $total_price = ($row_medcine["price"] +$room_price+$doc_price)*1.14 ;
            echo "<h1> YOUR INVOICE </h1>
            <p>Medcine price : ".$row_medcine["price"]." $</p>
            <p>Room price : ".$room_price." $</p>
            <p>Doctor fees : ".$doc_price."</p>
            <p>Tax : 14%</p>
            <p>Total : ".$total_price." $</p>";
            echo "<button type=\"submit\" name=\"pay\">PAY</button>";

            $bill_sql = "INSERT INTO `bill`(`Bill_ID`, `Room_Charges`, `Medicine_Charges`, `Doc_Charges`, `Patient_ID`, `payed`) 
            VALUES ('', '$room_price', '$row_medcine', '$doc_price', '$patient_id', '')";
            mysqli_real_query   ($conn,$bill_sql);
        }
    ?>
    </form>
    <?php
    if(isset($_POST["pay"])){
        if($row["Room_number"] > 0){
            $room_number = $row["Room_number"] ;
            $sql = "UPDATE `room` SET `room`.`able` = 0 WHERE `room`.`Room_number` = '$room_number' ;";
            mysqli_real_query($conn, $sql);

            $update_bill = "UPDATE `bill` SET `bill`.`payed` = 1 WHERE `bill`.`Patient_ID` = $patient_id";
            mysqli_real_query   ($conn,$update_bill);
        }

        

        header('Location: home.html');
        exit();
    }
    ?>
</body>
</html>