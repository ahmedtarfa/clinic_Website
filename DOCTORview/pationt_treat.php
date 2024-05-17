<?php
session_start();
$dr_id = $_SESSION['dr_id'] ;
$dr_Fname = $_SESSION['first_name'] ;
$dr_Lname = $_SESSION['last_name'] ;
$dr_spec = $_SESSION['specialization'] ;
$patient_id = $_SESSION['Patient_ID'] ; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DR View</title>
    <link rel="stylesheet" href="css/styles.css">
    <h1>MY INFO</h1>
    <div>
        <?php
        echo "<p>ID :" .$dr_id."</p>
        <p>Name :" .$dr_Fname." ".$dr_Lname."</p>
        <p>specialization :" .$dr_spec."</p>";
        ?>
    </div>
</head>
<body>
    <h1>PATIENT INFO</h1>
    <form class="" action="" method="post" autocomplete="off">
    <table>
        <thead>
            <td>Patient_ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>gender</td>
            <td>age</td>
            <td>phone_number</td>
            <td>disease</td>
            <td>Medcicine ID</td>
            <td>Need Room</td>
        </thead>
                
        <tbody>
            <?php
            include('inc/connections.php');

            $sql = "SELECT * FROM patient WHERE Patient_ID = $patient_id ";
            $result = $conn ->query($sql);
            if(! $result){
                die("invalide query : ". $conn -> error);
            }
            while($row = $result -> fetch_assoc()){
                echo "<tr>
                <td>".$row["Patient_ID"]."</td>
                <td>".$row["first_name"]."</td>
                <td>".$row["last_name"]."</td>
                <td>".$row["gender"]."</td>
                <td>".$row["age"]."</td>
                <td>".$row["phone_number"]."</td>
                <td><input type=\"text\" name=\"disease\" required value=\"\"></td>
                <td><input type=\"text\" name=\"Medcicine_ID\" required value=\"\"></td>
                <td><input type=\"checkbox\" name=\"need_room\" value=\"\"></td>   
                </tr>";
                
            }

            ?>
        </tbody>
    </table> 
    <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>

<?php
if(isset($_POST["submit"])){
    $disease = $_POST["disease"];
    $medcicine_ID= $_POST["Medcicine_ID"];

    $sql_checkMED = "SELECT quantity FROM medicine WHERE Medicine_ID = $medcicine_ID";
    $result_checkMED = mysqli_query($conn, $sql_checkMED);
    $row_checkMED = mysqli_fetch_assoc($result_checkMED);
    if($row_checkMED["quantity"] > 0){

        if(isset($_POST["need_room"])){
            $sql_room = "SELECT * FROM room WHERE able = 0 ORDER BY RAND() LIMIT 1;";
            $result = mysqli_query($conn, $sql_room);
            $row = mysqli_fetch_assoc($result);

            $room_number=$row["Room_number"];
            $sql="UPDATE `patient` SET `patient`.`disease` = '$disease', `patient`.`Medicine_ID` = '$medcicine_ID', `patient`.`Room_number` = '$room_number'  WHERE `patient`.`Patient_ID` = $patient_id";
            mysqli_real_query   ($conn,$sql);
            $sql="UPDATE room SET able = 1 WHERE Room_number = $room_number ";
            mysqli_real_query   ($conn,$sql);
        }else{
            $sql = "UPDATE `patient` SET `patient`.`disease` = '$disease', `patient`.`Medicine_ID` = '$medcicine_ID' WHERE `patient`.`Patient_ID` = $patient_id";
            mysqli_real_query($conn, $sql);

        }
        header('location:patiant.php'); 
    }else{
        echo "<p>THERE IS NO MEDCINE QUANTITY</p>";
    }
}
?>