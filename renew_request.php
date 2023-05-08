<?php
/* This PHP code is handling a renew request for a book in a library management system. */
//upload dbconn file
require('dbconn.php');

// get the id
$id = $_GET['id'];
$roll = $_SESSION['UserId'];

// check if the user has already sent a renew request for this book

if (isset($_SESSION['renew_requests'][$id])) {
    echo "<script type='text/javascript'>alert('Request Already Sent.')</script>";
    header("Refresh:0.01; url=current.php", true, 303);
    exit(); // terminate script execution
}

// insert renew request into database

/* This code is inserting a renew request for a book into the "renew" table of a library management
system's database. The SQL query is inserting the user ID and book ID into the "renew" table. If the
query is successful, the book ID is stored in the session to mark it as requested and a success
message is displayed. If the query fails, an error message is displayed. Finally, the page is
refreshed to the "current.php" page. */
$sql = "INSERT INTO LMS.renew (UserId,BookId) VALUES ('$roll','$id')";
if ($conn->query($sql) === TRUE) {
    // store book id in session to mark it as requested
    $_SESSION['renew_requests'][$id] = true;

    echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
    header("Refresh:0.01; url=current.php", true, 303);
} else {
    echo "<script type='text/javascript'>alert('Error: " . $conn->error . "')</script>";
    header("Refresh:0.01; url=current.php", true, 303);
}
