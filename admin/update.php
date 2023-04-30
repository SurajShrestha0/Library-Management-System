<?php
//database
require('dbconn.php');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query records
$sql = "SELECT * FROM LMS.record";
$result = $conn->query($sql);

// Update dues column for each record
while ($row = $result->fetch_assoc()) {
  $due_date = new DateTime($row["Due_Date"]);
  $today = new DateTime();//today date-time
  $days_overdue = $today->diff($due_date)->format('%r%a');
  $id = $row["BookId"];
  
  // Update dues column for the record with the given BookId
  $sql_update = "UPDATE LMS.record SET Dues = $days_overdue WHERE BookId = $id";
  $conn->query($sql_update);
}

// Close database connection
$conn->close();
