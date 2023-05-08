<?php
//dbconn file upload
require('dbconn.php');

try {
    // Check if user ID is provided
    if (!isset($_GET['id'])) {
        throw new Exception("User ID is not provided.");
    }

    // Get user ID from query parameter
    $rno = $_GET['id'];

    // Delete user from database
    $sql = "DELETE FROM LMS.user WHERE UserId='$rno'";
    if ($conn->query($sql) === TRUE) {
    
        echo "<script type='text/javascript'>alert('User deleted successfully')</script>";
    } else {
        throw new Exception("Error deleting user: " . $conn->error);
    }

    // Close database connection
    $conn->close();
} catch (Exception $e) {
    echo "User is in use" ;
}
?>
