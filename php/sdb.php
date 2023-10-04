<?php

// Create connection
$conn = new mysqli("localhost", "root", "","test2" );

// Check connection
if (!$conn) {
 echo "connection denied". mysqli_connect_error();
}
?>
