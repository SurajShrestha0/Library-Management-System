<?php
//load data for connection file
require('dbconn.php');
?>
<?php

ob_start();
//checks whether the $_SESSION['UserId'] variable is set 
$id = $_GET['id'];
if ($t11 = $_SESSION['UserId']) {
    ?>
    <!-- Html  declaration -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- title -->
        <title>LMS</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php"><img src="images/nn.png"
                            class="logo" /> LMS </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="images/user.png" class="nav-avatar" />
                                    <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php">Your Profile</a></li>
                                    <!--li><a href="#">Edit Profile</a></li>
                                    <li><a href="#">Account Settings</a></li-->
                                    <li class="divider"></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <div class="sidebar">
                            <ul class="widget widget-menu unstyled">
                                <li class="active"><a href="index.php"><i class="menu-icon icon-home"></i>Home
                                    </a></li>
                                <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Messages</a>
                                </li>
                                <li><a href="book.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                                <li><a href="history.php"><i class="menu-icon icon-tasks"></i>Previously Borrowed Books </a>
                                </li>
                                <li><a href="recommendations.php"><i class="menu-icon icon-list"></i>Recommend Books </a>
                                </li>
                                <li><a href="current.php"><i class="menu-icon icon-list"></i>Currently Issued Books </a>
                                </li>
                            </ul>
                            <ul class="widget widget-menu unstyled">
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>

                    <div class="modu">
                        <h3> Terms:</h3>
                    </div>
                    <style>
                        input[type="submit"] {
                            display: block;
                            margin: auto;
                            padding: 5px;
                            border-radius: 5px;
                            width: 15%;
                            font-size: 16px;
                        }
                    </style>
                    <!--/.span3-->

                    <?php
                    $t = $_GET['id'];
                    date_default_timezone_set('Asia/Kathmandu');
                    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
                        $startDate = $_POST['startDate'];
                        $endDate = $_POST['endDate'];

                        if (empty($startDate) || empty($endDate)) {
                            echo "<script>alert('Please select both start and end dates.');</script>";
                            echo "<script>window.location.href = 'time.php?id=$id';</script>";
                            exit;
                        }

                        $startTimestamp = strtotime($startDate);
                        $endTimestamp = strtotime($endDate);

                        if ($endTimestamp <= $startTimestamp) {
                            echo "<script>alert('End date should be greater than start date. Please try again.');</script>";
                            echo "<script>window.location.href = 'booking.php?id=$id';</script>";
                            exit;
                        }

                        $sql = "INSERT INTO LMS.record (UserId, BookId, D, D1, Time) 
                        VALUES ('$t11', '$t', '$startDate', '$endDate',curtime())";
                        try {
                            if ($conn->query($sql) === TRUE) {
                                echo "<script type='text/javascript'>alert('Request Sent to Admin.')</script>";
                                header("Refresh:0.01; url=book.php", true, 303);
                                ob_end_flush();
                            }
                        } catch (mysqli_sql_exception $e) {
                            if ($e->getCode() === 1062) { // Check if error code is for duplicate key
                                echo "<script type='text/javascript'>alert('Request Already Sent.')</script>";
                                header("Refresh:0.01; url=book.php", true, 303);
                                ob_end_flush();
                            } else {
                                echo "<p>Error sending request.</p>";
                                echo "Error: " . $e->getMessage();
                            }
                        }
                    } else {
                        // display form to enter start and end dates
                        $startDate = date('Y-m-d\TH:i:s');
                        echo '<form method="post" action="" class="D1">';
                        echo '<label for="startDate" class = "ca" >Enter start date and time:</label> <input type="datetime-local" id="startDate" name="startDate" value="' . $startDate . '" required>';
                        echo '<br>';
                        echo '<label for="endDate">Enter end date and time:</label> <input type="datetime-local" id="endDate" name="endDate" required>';
                        echo '<br>';
                        echo '<input type="submit"  class="btn" value="Submit">';
                        echo '</form>';

                        // add JavaScript to validate date range
                        echo '<script>
                         document.getElementById("endDate").addEventListener("change", function() {
                         var startDate = new Date(document.getElementById("startDate").value);
                         var endDate = new Date(this.value);
                         if (endDate < startDate) {
                          alert("End date cannot be earlier than start date. Please select a valid date range.");
                          this.value = "";
                          }
                          });
                          </script>';
                    }
                    ?>
                    <!--/.wrapper-->
                    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
                    <!-- jQuery library version 1.9.1 -->
                    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
                    <!-- jQuery UI library version 1.10.1 -->
                    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
                    <!-- Bootstrap library version 3.0.0 -->
                    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
                    <!-- Flot library version 0.8.1 -->
                    <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
                    <!-- Flot resize library -->
                    <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
                    <!-- DataTables library version 1.10.0 -->
                    <script src="scripts/common.js" type="text/javascript"></script>
                    <!-- Custom JavaScript code -->
    </body>

    </html>
    <?php
} else { //aleart box for acces denied message
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>
