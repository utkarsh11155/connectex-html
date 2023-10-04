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

    
    $currentYear = date("Y");
    $random_id=rand(time(),10000000);
    $otp = mt_rand(1111, 9999);
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $branch = $_POST['branch'];
    $number = $_POST['number'];
    $passingyear = $_POST['passingyear'];
    $company = $_POST['company'];
    $verification_status='0';

    // File upload handling
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    
    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // File uploaded successfully
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    }

   
        // Check if user already exists
        $existingUser = $conn->query("SELECT * FROM registration WHERE email='$email' OR number='$number'");
        if ($existingUser->num_rows > 0) {
            $_SESSION['status']= "User with this email or phone number already exists.<br> Please try again with a different email or phone number.<br>";
            echo "User with this email or phone number already exists.<br> Please try again with a different email or phone number.<br><a href='http://localhost/connectex/html/index.html'>Click here to go back to the homepage to login</a>";
        } else {
            
            // Check if passing year is less than or equal to the current year
           
            if ($passingyear <= $currentYear) {
                // Insert new user data into the database
                $stmt = $conn->prepare("INSERT INTO registration (unique_id, firstName, lastName, gender, email, password, branch, number, passingyear, company, photo, otp, verification_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("issssssisssss", $random_id, $firstName, $lastName, $gender, $email, $password, $branch, $number, $passingyear, $company, $target_file, $otp, $verification_status);
                $execval = $stmt->execute();
                $lastInsertedId = $stmt->insert_id;
                $stmt->close();
            
                if ($execval) {
                    // Registration successful
                    // Send verification email to user
                    $_SESSION['status'] = "Registration Success link sent to your email address";
                    echo "Registration Success link sent to your email address<br><a href='http://localhost/connectex/html/index.html'>Click here to go back to the homepage to login</a>";
            
                    $stmt1 = $conn->prepare("SELECT * FROM registration WHERE email = ?");
                    $stmt1->bind_param("s", $email);
                    $stmt1->execute();
                    $result = $stmt1->get_result();
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $_SESSION['unique_id'] = $row['unique_id'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['otp'] = $row['otp'];
                    }
                    $stmt1->close();
            
                    if ($otp) {
                        $to = $email;
                        $subject = "Verification Email";
                        $message = "Dear $firstName,\n\nThank you for registering with us.\n\nPlease click on the following verification link to verify your email:\n\nVerification link: http://localhost/connectex/html/verify.html\n\nOTP: $otp\n\nRegards,\nTeam Connect-Ex";
                        $headers = "From: connectex2023@gmail.com";
                        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                        mail($to, $subject, $message, $headers);
                    } else {
                        echo "Email problem";
                    }
                } else {
                    $_SESSION['status'] = "Registration Failed";
                    echo "Registration Failed<br><a href='http://localhost/connectex/html/index.html'>Click here to go back to the homepage to login</a>";
                }
            }
             else {
            // Passing year is not valid
            echo "Error: Passing year must be less than or equal to the current year.<br>";
            echo "<a href='http://localhost/connectex/html/index.html'>Click here to go back to the home page to try again</a>";
        }
    }




?> 

        </div>
</body>
</html>	
                
                
                
                
