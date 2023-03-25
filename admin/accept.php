<?.php
require('dbconn.php');
//Retrieve the value of the "id1" parameter from the URL query string and assign variable 
$bookid=$_GET['id1'];
//Retrieve the value of the "id2" parameter from the URL query string and assign variable 
$rollno=$_GET['id2'];
//select category
$sql="select Category from LMS.user where RollNo='$rollno'";
// Execute the SQL query using the connection object and store the result
$result=$conn->query($sql);
//Fetch a single row of data from the query result as an associative array
$row=$result->fetch_assoc();
//Extract the value of the "Category" column from the fetched row and assign it to a variable named $category
$category=$row['Category'];
if($category == 'GEN' || $category == 'OBC' )
//update record id, rollno
{$sql1="update LMS.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 60 day),Renewals_left=1 where BookId='$bookid' and RollNo='$rollno'";
// condtion checking the aql query
if($conn->query($sql1) === TRUE)
//update book tables
{$sql3="update LMS.book set Availability=Availability-1 where BookId='$bookid'";
// Execute the SQL query using the connection object and store the result
 $result=$conn->query($sql3);
 //inset the value in message table
 $sql5="insert into LMS.message (RollNo,Msg,Date,Time) values ('$rollno','Your request for issue of BookId: $bookid  has been accepted',curdate(),curtime())";
 //database query connection
 $result=$conn->query($sql5);
echo "<script type='text/javascript'>alert('Success')</script>";
// Redirect the user to the "issue_requests.php" page after a 1-second delay
header( "Refresh:0.01; url=issue_requests.php", true, 303);
}
else
{
    //error message
	echo "<script type='text/javascript'>alert('Error')</script>";
    // Redirect the user to the "issue_requests.php" page after a 1-second delay
    header( "Refresh:1; url=issue_requests.php", true, 303);

}
}
else
//upadte the record table
{$sql2="update LMS.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 180 day),Renewals_left=1 where BookId='$bookid' and RollNo='$rollno'";
// condition conncetion 
if($conn->query($sql2) === TRUE)
//update the book table
{$sql4="update LMS.book set Availability=Availability-1 where BookId='$bookid'";
 $result=$conn->query($sql4);
 //inset the value in message table
 $sql6="insert into LMS.message (RollNo,Msg,Date,Time) values ('$rollno','Your request for issue of BookId: $bookid has been accepted',curdate(),curtime())";
 $result=$conn->query($sql6);
 // alert message box  for sucessful
echo "<script type='text/javascript'>alert('Success')</script>";
// Redirect the user to the "issue_requests.php" page after a 1-second delay
header( "Refresh:1; url=issue_requests.php", true, 303);
}
else
{
    //aleart message Fail (Error)
	echo "<script type='text/javascript'>alert('Error')</script>";
    // Redirect the user to the "issue_requests.php" page after a 1-second delay
    header( "Refresh:1; url=issue_requests.php", true, 303);
}
}
?>
