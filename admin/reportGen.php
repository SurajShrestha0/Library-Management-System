<!DOCTYPE html>
<html>

<head>
  <title>User Report</title>
  <style>
    .bill-container {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      font-family: Arial, sans-serif;
      font-size: 14px;
      line-height: 1.5;
      background-color: #f9f9f9;
      box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
    }

    input[type=text] {
      padding: 10px;
      margin: 5px 0;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
    }

    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

   

    .search-container {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .search-container form {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .search-container label {
      margin-right: 10px;
    }

    h2 {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
    }

    table.bill-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table.bill-table th {
      text-align: left;
      background-color: #74bf44;
      color: white;
      padding: 10px;
    }

    table.bill-table td {
      border: 1px solid #ddd;
      padding: 10px;
    }

    table.bill-table tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <?php

  require('dbconn.php');

  // Get the user ID from the search form
  if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];

    // SQL query to join the record and user tables and filter by user ID
    $sql = "SELECT user.UserId, user.Name, user.EmailId, record.Date_of_issue, record.Due_Date FROM LMS.user JOIN LMS.record ON user.UserId = record.UserId WHERE user.UserId = '$userid'";
    $result = $conn->query($sql);

    // Display the query results only if the user ID is set in the query string
    if (isset($_GET['userid'])) {
      $userid = $_GET['userid'];

      // SQL query to join the record and user tables, using the input user ID
      $sql = "SELECT user.UserId, user.Name, user.EmailId, record.Date_of_issue, record.Due_Date FROM LMS.user JOIN LMS.record ON user.UserId = record.UserId WHERE user.UserId = $userid";
      $result = $conn->query($sql);

      // Get user information
      $user_sql = "SELECT Name, EmailId FROM LMS.user WHERE UserId = $userid";
      $user_result = $conn->query($user_sql);
      $user_row = $user_result->fetch_assoc();

      // Display the query results
      if ($result->num_rows > 0) {
        echo "<div class='bill-container'>";
        echo "<h2>Library User Report</h2>";
        echo "<p><strong>User:</strong> " . $user_row["Name"] . "</p>";
        echo "<p><strong>Email:</strong> " . $user_row["EmailId"] . "</p>";
        echo "<table class='bill-table'>";
        echo "<tr><th>Date of Issue</th><th>Due Date</th><th>Days Overdue</th><th>Fine Amount</th></tr>";
        while ($row = $result->fetch_assoc()) {
          $date_of_issue = new DateTime($row["Date_of_issue"]);
          $due_date = new DateTime($row["Due_Date"]);
          $today = new DateTime();
          $days_overdue = $due_date->diff($today)->format('%r%a');

          echo "<tr>";
          echo "<td>" . $date_of_issue->format('m/d/Y') . "</td>";
          echo "<td>" . $due_date->format('m/d/Y') . "</td>";
          if ($days_overdue > 0) {
            echo "<td>" . $days_overdue . "</td>";
            // calculate and display the fine amount
            $fine_amount = $days_overdue * 2; // Assuming a $2 fine per day overdue
              echo "<td>$" . $fine_amount . "</td>";
         } else {
          echo "<td>$"  . "</td>";
         }
          
          




         // echo "<td>$" . $fine_amount . "</td>";
          echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
      } else {
        echo "No records found for user ID $userid.";
      }
    }
  }
  ?>

  <style>
    /* Styles for the invoice container */

    /* Styles for error messages */
    .error {
      color: red;
    }

    .no-print {
      margin-top: 30px;
      background-color: #6d6e70;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      position: fixed;
      left: 50%;
    }

    .no-print:hover {
      color: #FFF;
      background-color: #74bf44;
      text-decoration: none
    }
  </style>

  <!-- HTML for the print button -->
  <button onclick="printInvoice()" class="no-print">Print</button>

  <style>
    @media print {
      .no-print {
        display: none;
      }
    }
  </style>


  <script>
    function printInvoice() {
      window.print(); // Opens the print dialog box
    }
  </script>
</body>

</html>