<!DOCTYPE html>
<html>
<head>
	<title>Registration Result</title>
	<style>
		.box {
			width: 50%;
			margin: 0 auto;
			background-color: pink;
			padding: 20px;
			box-shadow: 5px 5px 10px #888888;
			text-align: center;
			position: absolute;
    top: 38%;
    left: 24%;
    font-size: 129%;
		}
	</style>
</head>
<body>
	<div class="box">

<?php
session_start();
include_once 'db.php';

$Email = $_POST['email'];
$Password = md5($_POST['password']);
if(!empty($Email) && !empty($Password)) {
    $sql = "SELECT * FROM registration WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $Email, $Password);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if($row) {
            $_SESSION['unique_id'] = $row['unique_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['otp'] = $row['otp'];
            $_SESSION['verification_status'] = $row['verification_status'];
            if($row['verification_status']=='Verified'){
            
            header("Location: http://localhost/connectex/php/apg.php"); // Redirect to the new page
            exit(); // Terminate the current script
            }
            else{
                echo "'Please Get Verified First'";
            }
        }
        
    }
    else {
        echo "'Email or Password' incorrect or 'Not registered'";
    }
    
}

?>
 </div>
</body>
</html>	