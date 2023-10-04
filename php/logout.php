<?php
session_start();
include 'db.php';

// Debugging statement: display the value of 'logout_id'
echo "Logout ID: " . $_GET['logout_id'];

if(isset($_SESSION['unique_id'])){
    // Clear session data and destroy session
    session_unset();
    session_destroy();

    // Redirect to the login page
    header("location: http://localhost/connectex/html/index.html");
    exit();
}
else{
    // User does not exist, redirect to the login page
    header("location: http://localhost/connectex/html/index.html");
    exit();
}
?>
