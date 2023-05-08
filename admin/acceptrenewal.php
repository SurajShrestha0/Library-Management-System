<?php
//include database connection  file
require('dbconn.php');
// Retrieve the values of the "id1" and "id2" parameters from the URL query string and assign them to variables
$bookid = $_GET['id1'];
$bookid=$_GET['id1'];
$rollno=$_GET['id2'];
// Retrieve the user's category from the database
$sql="select Category from LMS.user where UserId='$rollno'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$category=$row['Category'];
//Extract the value of the "Category" column from the fetched row and assign it to a variable named $category
$category=$row['Category'];
if($category == 'BSc' || $category == 'BIBM' )
//update record id, rollno
{$sql1="update LMS.record set Date_of_Issue=D,Due_Date=D1,Renewals_left=1 where BookId='$bookid' and UserId='$rollno'";
 
if($conn->query($sql1) === TRUE)
{
 // Delete the renewal request from the database
 $sql3="delete from LMS.renew where BookId='$bookid' and UserId='$rollno'";
 // Execute the SQL query using the connection object and store the result
 $result=$conn->query($sql3);
 //sql query for insert the value in data
 $sql5="insert into LMS.message (UserId,Msg,Date,Time) values ('$rollno','Your request for renewal of BookId: $bookid  has been accepted',curdate(),curtime())";
//Execute the SQL query
 $result=$conn->query($sql5);
 // Display the error message
echo "<script type='text/javascript'>alert('Success')</script>";
//refresh page after 0.01 seconds and redirect to renew_requests.php         
header( "Refresh:0.01; url=renew_requests.php", true, 303);
}
else//pritn error message
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    header( "Refresh:0.01; url=renew_requests.php", true, 303);
}
}
else
//sql query for update record database table
{$sql2="update LMS.record set Due_Date=date_add(Due_Date,interval 180 day),Renewals_left=0 where BookId='$bookid' and UserId='$rollno'";
//Execute the SQL query and check if it was successful
if($conn->query($sql2) === TRUE)
//SQL query to delete record from database table
{$sql4="delete from LMS.renew where BookId='$bookid' and UserId='$rollno'";
// Execute the SQL query using the connection object and store the result
 $result=$conn->query($sql4);
//insert the data value into message databse table
 $sql6="insert into LMS.message (UserId,Msg,Date,Time) values ('$rollno','Your request for renewal of BookId: $bookid has been accepted',curdate(),curtime())";
// Execute the SQL query using the connection object and store the result
 $result=$conn->query($sql6);
 //display the  success message 
echo "<script type='text/javascript'>alert('Success')</script>";
// Redirect the user to the "renew_requests.php" page after a 1-second delay
header( "Refresh:0.01; url=renew_requests.php", true, 303);
}
else
{ 
    //display the error message (alart box)
	echo "<script type='text/javascript'>alert('Error')</script>";
    // Redirect the user to the "renew_requests.php" page after a 1-second delay
    header( "Refresh:0.01; url=renew_requests.php", true, 303);
}
}
?>
