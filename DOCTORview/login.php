<?php
session_start();
include('inc/connections.php'); 

if (isset($_POST["submit"])){
    $dr_id=$_POST['DR_id'];
    $err_s=0;
    $pattern = '/^[1-9][0-9]*$/';
    if (!preg_match($pattern, $dr_id)) {
        $id_error='<p id="error">Enter valid ID</p>';
        $err_s=1;
    }
    if($err_s == 0){
        $sql = "SELECT * FROM doctor WHERE Doctor_ID = $dr_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($result && mysqli_num_rows($result) > 0) {
            $_SESSION['dr_id'] = $row['Doctor_ID'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['specialization'] = $row['specialization'];
            header('Location: patiant.php');
            exit();
        }else{
            $id_error='<p id="error">WRONG ID</p>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DR View</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <label for="">ENTER YOUR ID</label>
    <form class="" action="" method="post" autocomplete="off">
    <?php if(isset($id_error)){echo $id_error;} ?>
    <input type="text" name="DR_id" required value="">
    <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>