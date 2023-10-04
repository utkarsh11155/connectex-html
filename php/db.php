<?php

// Create connection
$conn = new mysqli("localhost", "root", "","test" );

// Check connection
if (!$conn) {
 echo "connection denied". mysqli_connect_error();
}
?>
