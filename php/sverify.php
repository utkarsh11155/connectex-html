<!DOCTYPE html>
<html>
<head>
	<title>Verification status</title>
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
		.success-box {
  display: flex;
  justify-content: center;
  align-items: center;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 412px;
    height: 135px;
  background-color: green;
  color: white;
  font-size: 24px;
  text-align: center;
}
.image{
    position: absolute;left: 95%;top: 10%;
}

	</style>
</head>
<body>
	<div>


<?php
include_once 'sdb.php';
session_start();

$otp1 = $_POST['otp1'];
$otp2 = $_POST['otp2'];
$otp3 = $_POST['otp3'];
$otp4 = $_POST['otp4'];

$unique_id = $_SESSION['unique_id'];
$session_otp = $_SESSION['otp'];
$verification_status = 'Verified';

$otp = $otp1.$otp2.$otp3.$otp4;

if(!empty($otp)) {
    if($otp == $session_otp) {
        $sql = "SELECT * FROM student WHERE unique_id = ? AND otp = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $unique_id, $otp);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            $sql2 = "UPDATE student SET verification_status = ?, otp = ? WHERE unique_id = ?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("ssi", $verification_status, $null_otp, $unique_id);
            $stmt2->execute();
            $stmt2->close();
          
            $row = $result->fetch_assoc();
            $_SESSION['unique_id'] = $row['unique_id'];
            $_SESSION['verification_status'] = $row['verification_status'];
            echo "<div class='success-box'><img src='http://localhost/connectex/images/verified.gif' style='position: absolute;left: 87%;top: 4%;' ><h5>SUCCESS</h5>&nbsp<a href='http://localhost/connectex/html/student.html'>Click here to login</a></div>";

          } else {
            echo "<div class='box'>wrong otp!</div>";
        }
    } else {
        echo "<div class='box'>wrong otp!</div>";
    }
} else {
    echo "<div class='box'>Enter otp!</div>";
}

 ?>



</div>
</body>
</html>	