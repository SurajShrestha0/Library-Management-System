<?php
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
        <!-- title -->
        <title>LMS</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!-- css file link -->
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <!-- link font css file  -->
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

    <body>
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
                    <div class="span9">
                        <center>
                            <a href="issue_requests.php" class="btn btn-info">Issue Requests</a>
                            <a href="renew_requests.php" class="btn btn-info">Renew Request</a>
                            <a href="return_requests.php" class="btn btn-info">Return Requests</a>
                        </center>
                        <h1><i>Renew Requests</i></h1>
                        <table class="table" id="tables">
                            <thead>
                                <tr>
                                    <th>User Id Number</th>
                                    <th>Book Id</th>
                                    <th>Book Name</th>
                                    <th>Renewals Left</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "select * from LMS.record,LMS.book,LMS.renew where renew.BookId=book.BookId and renew.UserId=record.UserId and renew.BookId=record.BookId";
                                /* This code is querying the database using the SQL statement stored in
                                the `` variable and storing the result in the ``
                                variable. It then loops through each row of the result using a
                                `while` loop and assigns the values of the `BookId`, `UserId`,
                                `Title`, and `Renewals_left` columns to the variables ``,
                                ``, ``, and ``, respectively. These variables
                                are then used to display the data in an HTML table. */
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $bookid = $row['BookId'];
                                    $rollno = $row['UserId'];
                                    $name = $row['Title'];
                                    $renewals = $row['Renewals_left'];


                                ?>
                                    <tr>
                                        <td><?php echo strtoupper($rollno) ?></td>
                                        <td><?php echo $bookid ?></td>
                                        <td><b><?php echo $name ?></b></td>
                                        <td><?php echo $renewals ?></td>
                                        <td>
                                            <center>
                                                <?php
                                                if ($renewals > 0) {
                                                    echo "<a href=\"acceptrenewal.php?id1=" . $bookid . "&id2=" . $rollno . "\" class=\"btn btn-success\">Accept</a>";
                                                }
                                                ?>
                                                <!--a href="rejectrenewal.php?id1=<?php echo $bookid; ?>&id2=<?php echo $rollno; ?>" class="btn btn-danger">Reject</a-->
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!--/.span3-->
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!-- footer -->
        <?php include('footer.php') ?>

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
    //echo access denied
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>