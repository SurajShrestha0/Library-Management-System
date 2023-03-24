<?php
session_start();
// sql database information
$dbservername = "localhost";//sql port number
$dbusername = "root";//sql port name
$dbpassword = "";//sql port password
// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword);
// Check connection
if (!$conn) {
    echo "Connected unsuccessfully";
    die("Connection failed: " . mysqli_connect_error());
}
?>
