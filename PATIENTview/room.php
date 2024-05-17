<?php
include('inc/connections.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALEX CLINIC</title>
    <link rel="stylesheet" href="css/roomstyles.css">
</head>
<body>
    <div class="menu">
        <a href="home.html">Home</a>
        <a href="doctor.php">Doctors</a>
        <a class="active" href="room.php">Rooms</a>
    </div>
    <table>
        <thead>
            <td>Room Type</td>
            <td>Room Number</td>
            <td>Nurse Name</td>
            <td>Ward Boy Name</td>
        </thead>
        
        <tbody>
        <?php
        $sql = "SELECT Room.Room_type, Room.Room_number, Nurse.first_name AS Nurse_FirstName, Ward_Boy.first_name AS WardBoy_FirstName 
                FROM Room
                INNER JOIN Nurse ON Nurse.Nurse_ID = Room.Nurse_ID
                INNER JOIN Ward_Boy ON Ward_Boy.Ward_Boy_ID = Room.Ward_Boy_ID;";
        $result = $conn->query($sql);
        if (!$result) {
            die("Invalid query: " . $conn->error);
        }
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["Room_type"]."</td>
                    <td>".$row["Room_number"]."</td>
                    <td>".$row["Nurse_FirstName"]."</td>
                    <td>".$row["WardBoy_FirstName"]."</td>
                </tr>";
        }
        ?>
        </tbody>
    </table>
</body>
</html>
