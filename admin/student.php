<?php
//upload dbconn file
require('dbconn.php');
?>

<?php
if ($_SESSION['UserId']) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- title  -->
        <title>LMS</title>
        <!-- bootstrap file link -->
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!-- css file link -->
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <!-- font css file link -->
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

    <?php
    //user submit
    if (isset($_GET['submit'])) {
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

                echo "<script type='text/javascript'>alert('User deleted successfully') </script>";
                header("Refresh:0.001; url=student.php", true, 303);
            } else {
                throw new Exception("Error deleting user: " . $conn->error);
            }

            // Close database connection
            $conn->close();
        } catch (Exception $e) {
            echo "<script type='text/javascript'>alert('User is in use!!!')</script>";
            header("Refresh:0.01; url=student.php", true, 303);
        }
    }
    ?>

    <body>
        <!-- navbar -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="home.php"><img src="images/nn.png" class="logo" /> LMS </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="images/user.png" class="nav-avatar" />
                                    <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php">Your Profile</a></li>
                                    <li class="divider"></li>
                                    <li><a href="rep1.php">Generated report</a></li>
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
                                <li class="active"><a href="home.php"><i class="menu-icon icon-home"></i>Dashboard
                                    </a></li>
                                <li><a href="message.php"><i class="menu-icon icon-inbox"></i>Messages</a>
                                </li>
                                <li><a href="student.php"><i class="menu-icon icon-user"></i>Manage Students </a>
                                </li>
                                <li><a href="book.php"><i class="menu-icon icon-book"></i>All Books </a></li>
                                <li><a href="addbook.php"><i class="menu-icon icon-edit"></i>Add Books </a></li>
                                <li><a href="requests.php"><i class="menu-icon icon-tasks"></i>Issue/Return Requests </a></li>
                                <li><a href="recommendations.php"><i class="menu-icon icon-list"></i>Book Recommendations </a></li>
                                <li><a href="current.php"><i class="menu-icon icon-list"></i>Currently Issued Books </a></li>
                            </ul>
                            <ul class="widget widget-menu unstyled">
                                <li><a href="logout.php"><i class="menu-icon icon-signout"></i>Logout </a></li>
                            </ul>
                        </div>
                        <!--/.sidebar-->
                    </div>
                    <!--/.span3-->

                    <div class="span9">
                        <form class="form-horizontal row-fluid" action="student.php" method="post">
                            <div class="control-group">
                                <label class="control-label" for="Search"><b>Search:</b></label>
                                <div class="controls">
                                    <input type="text" id="title" name="title" placeholder="Enter Name/User Id of Student" class="span8" required>
                                    <button type="submit" name="submit" class="btn">Search</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <?php
                        //submit then sql
                        if (isset($_POST['submit'])) {
                            $s = $_POST['title'];
                            //sql query
                            $sql = "select * from LMS.user where (UserId='$s' or Name like '%$s%') and UserId<>'ADMIN'";
                        } else
                            $sql = "select * from LMS.user where UserId<>'ADMIN'";

                        $result = $conn->query($sql);
                        $rowcount = mysqli_num_rows($result);

                        if (!($rowcount))
                            //row count
                            echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                        else {
                        ?>
                            <table class="table" id="tables">
                                <thead>
                                    <tr>
                                        <!-- table -->
                                        <th>Name</th>
                                        <th>User id.</th>
                                        <th>Email id</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    //$result=$conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {

                                        $email = $row['EmailId'];
                                        $name = $row['Name'];
                                        $rollno = $row['UserId'];
                                    ?>
                                        <tr>
                                            <td><?php echo $name ?></td>
                                            <td><?php echo $rollno ?></td>
                                            <td><?php echo $email ?></td>
                                            <td>
                                                <center>
                                                    <form method="get">
                                                        <a href="studentdetails.php?id=<?php echo $rollno; ?>" class="btn btn-success">Details</a>

                                                        <input type="hidden" name="id" value="<?php echo $rollno; ?>">
                                                        <input type="submit" name="submit" value="Remove" class="btn btn-danger">
                                                    </form>
                                                </center>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
                                </tbody>
                            </table>
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!-- footer part -->
        <?php include("footer.php"); ?>
        <!--/.wrapper-->
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>


    </body>

    </html>


<?php } else {
    //echo denied
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>