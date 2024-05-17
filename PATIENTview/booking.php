<?php
include('inc/connections.php'); 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALEX CLINIC</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <a href = "home.html">Log out</a>
    <div>
        <h1>Doctor INFO</h1>
        
            <?php
            $row = $_SESSION['selected_doctor'];
            echo "
                <P>ID : ".$row["Doctor_ID"]."</P>
                <P>NAME : ".$row["first_name"]." ".$row["last_name"]."</P>
                <P>specialization : ".$row["specialization"]."</P>" ;
            ?>
    </div>


<?php
if (isset($_POST["submit"])){

    if($_POST["phone_number"]){}
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone_number = $_POST["phone_number"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];

    $err_s=0;
    $pattern = '/^0[0-9]+$/';
    if (!preg_match($pattern, $phone_number)) {
        $phone_error='<p id="error">Enter valid phone number</p>';
        $err_s=1;
    }
    if(filter_var($first_name, FILTER_VALIDATE_INT) || filter_var($last_name, FILTER_VALIDATE_INT)){
        $name_error = '<p id="error">Enter valid name</p>';
        $err_s=1;
    }
    $age_pattern = '/^(?:[1-9][0-9]?|0)$/' ;
    if (!preg_match($age_pattern, $age)) {
        $age_error='<p id="error">Enter valid age</p>';
        $err_s=1;
    }

    if($err_s == 0){
        $docID=$row["Doctor_ID"];
        $sql = "INSERT INTO `patient`(`last_name`, `first_name`, `gender`, `age`, `phone_number`, `disease`, `Doctor_ID`, `Medicine_ID`, `Room_number`) 
        VALUES ('$last_name', '$first_name', '$gender', '$age', '$phone_number', '', '$docID', 0, 0)";
        mysqli_real_query   ($conn,$sql);

        $newPatientID = mysqli_insert_id($conn);

        $_SESSION['Patient_ID'] = $newPatientID;
        header('location:payment.php');
    }
    
} 
?>
    

    <div>
    <h1>Your Personal INFO</h1>
    <form class="" action="" method="post" autocomplete="off">
        <?php if(isset($name_error)){echo $name_error;} 
        if(isset($phone_error)){echo $phone_error;}
        if(isset($age_error)){echo $age_error;}?>

        <label for="">First Name</label>
        <input type="text" name="first_name" required value="">
        <label for="">Last Name</label>
        <input type="text" name="last_name" required value="">
        <label for="">Phone Number</label>
        <input type="text" name="phone_number" required value="">
        <label for="">Age</label>
        <input type="text" name="age" required value="">
        <select class="" name="gender" required>
            <option value="" select hidden>Your Gender</option>
            <option value="male">Male</option>
            <option value="female">female</option>
        </select>
        <button type="submit" name="submit">Submit</button>
    </form>
    </div>
</body>
</html>