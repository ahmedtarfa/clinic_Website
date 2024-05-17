<?php
session_start();

$dr_id = $_SESSION['dr_id'] ;
$dr_Fname = $_SESSION['first_name'] ;
$dr_Lname = $_SESSION['last_name'] ;
$dr_spec = $_SESSION['specialization'] ;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DR View</title>
    <link rel="stylesheet" href="css/patiant.css">
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
    <table>
        <thead>
            <td>Patient_ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>gender</td>
            <td>age</td>
            <td>phone_number</td>
        </thead>
                
        <tbody>
        <?php
include('inc/connections.php');

$sql = "SELECT * FROM patient WHERE Doctor_ID = $dr_id";
$result = $conn->query($sql);

if (!$result) {
    die("Invalid query: " . $conn->error);
}

if ($result->num_rows <= 0) {
    echo "THERE IS NO PATIENT";
} else {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Patient_ID"] . "</td>
                <td>" . $row["first_name"] . "</td>
                <td>" . $row["last_name"] . "</td>
                <td>" . $row["gender"] . "</td>
                <td>" . $row["age"] . "</td>
                <td>" . $row["phone_number"] . "</td>";

        if ($row["Medicine_ID"] == 0) {
            echo "<td>
                    <a href='pationt_treat.php?Patient_ID=" . $row["Patient_ID"] . "'>Check</a>
                  </td>";
        } else {
            echo "<td>DONE</td>";
        }

        echo "</tr>";
        $_SESSION['Patient_ID'] = $row["Patient_ID"];
    }
}
?>

        </tbody>
    </table> 
    <button type="button" onclick="redirectToOtherPage()">EXIT</button>

<script>
    function redirectToOtherPage() {
        window.location.href = "login.php";
    }
</script>
</body>
</html>