<?php
//database file
require('dbconn.php');
?>

<?php
// Check if user ID is provided
if (!isset($_GET['id'])) {
    // Redirect back to the student page if user ID is not provided
    header("Location: student.php");
    exit();
}

// Get user ID from query parameter
$rno = $_GET['id'];

// Get user information from database
$sql = "SELECT * FROM LMS.user WHERE UserId='$rno'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Delete user from database
    $sql = "DELETE FROM LMS.user WHERE UserId='$rno'";
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the student page after successful deletion
        header("Location: student.php");
        exit();
    } else {
        // Display error message if deletion fails
        $error_msg = "Error deleting user: " . $conn->error;
        echo "<script type='text/javascript'>
              if (confirm('$error_msg')) {
                  window.location.href = 'student.php';
              }
              </script>";
    }
} else {
    // Display error message if user does not exist
    echo "<script type='text/javascript'>alert('User not found.')</script>";
    header("Refresh:0.001; url=student.php", true, 303);
}

// Close database connection
$conn->close();
?>
