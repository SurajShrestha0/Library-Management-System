<?php
// db conn file
require('dbconn.php');

$bookid=$_GET['id1'];

$rollno=$_GET['id2'];
//sql query for delete
$sql="delete from LMS.record where UserId='$rollno' and BookId='$bookid'";
//check the connection
if($conn->query($sql) === TRUE)
{
	//insert the data sql query
	$sql1="insert into LMS.message (UserId,Msg,Date,Time) values ('$rollno','Your request for issue of BookId: $bookid  has been rejected',curdate(),curtime())";
 $result=$conn->query($sql1);
echo "<script type='text/javascript'>alert('Success')</script>";
header( "Refresh:0.01; url=issue_requests.php", true, 303);
}
else
{
	//echo error and refresh page
	echo "<script type='text/javascript'>alert('Error')</script>";
    header( "Refresh:0.01; url=issue_requests.php", true, 303);
}
?>