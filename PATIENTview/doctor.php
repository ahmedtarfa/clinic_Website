<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALEX CLINIC</title>
    <link rel="stylesheet" href="css/doctorstyles.css">
</head>
<body>
    <div class="menu">
        <a href="home.html">Home</a>
        <a class="active" href="doctor.php">Doctors</a>
        <a href="room.php">Rooms</a>
    </div>
    <table>
        <thead>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Specialization</td>
        </thead>
        
        <tbody>
            <?php
            include('inc/connections.php');

            $sql = "SELECT * FROM doctor";
            $result = $conn ->query($sql);
            if(! $result){
                die("Invalid query : ". $conn -> error);
            }
            while($row = $result -> fetch_assoc()){
                echo "<tr>
                <td>".$row["first_name"]."</td>
                <td>".$row["last_name"]."</td>
                <td>".$row["specialization"]."</td>
                <td>
                <a href='docID.php?doctor_id=" . $row["Doctor_ID"] . "'>BOOK</a>
                </td>    
                </tr>";
                $_SESSION['dr_ID']=$row["Doctor_ID"];
            }

            ?>
        </tbody>
    </table>
</body>
</html>
