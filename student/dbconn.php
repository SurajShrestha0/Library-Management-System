<?php
//start
session_start();
//sql information
$dbservername = "localhost";//port number
$dbusername = "root";// database username
$dbpassword = "";// data base password
// Create connection
$conn = mysqli_connect($dbservername, $dbusername, $dbpassword);
// Check connection
if (!$conn) {
    echo "Connected unsuccessfully";
    die("Connection failed: " . mysqli_connect_error());
}
?>
