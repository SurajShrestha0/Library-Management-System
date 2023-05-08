<?php
//db connectin
require('dbconn.php');
//get the id
$id=$_GET['id'];
//userid from database
$roll=$_SESSION['UserId'];
//sql query insert
$sql="insert into LMS.return (UserId,BookId) values ('$roll','$id')";
//check the conn
if($conn->query($sql) === TRUE)
{
    //display success
echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
header( "Refresh:0.01; url=current.php", true, 303);
}
else
{
    //display already sent
	echo "<script type='text/javascript'>alert('Request Already Sent.')</script>";
    header( "Refresh:0.01; url=current.php", true, 303);
}
?>
