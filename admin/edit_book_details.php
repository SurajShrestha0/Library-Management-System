<?php
//strat
ob_start();
//db file upload
require('dbconn.php');
?>

<?php
if ($_SESSION['UserId']) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- /* These are HTML tags that define the structure and styling of a webpage. */ -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- title -->
        <title>LMS</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!-- link css file -->
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="home.php">LMS </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <!-- This code is creating a navigation bar with a dropdown menu for the user's
                      profile. The navigation bar is aligned to the right side of the page. The
                      dropdown menu contains links to the user's profile page, an option to edit
                      their profile, account settings, and a logout button. The `data-toggle` and
                      `data-target` attributes are used to enable the dropdown functionality using
                      JavaScript. The `img` tag is used to display the user's avatar image. */ -->
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
                    <!--/.span3-->

                    <div class="span9">
                        <div class="module">
                            <div class="module-head">
                                <h3>Update Book Details</h3>
                            </div>
                            <div class="module-body">

                                <?php
                                /* This code is retrieving the details of a specific book from the
                                  database based on the book ID passed through the URL using the GET
                                  method. The book ID is stored in the variable ``. The SQL
                                  query selects all columns from the `book` table where the `Bookid`
                                  column matches the `` variable. The query result is stored
                                  in the `` variable and the first row of the result is
                                  fetched as an associative array using the `fetch_assoc()` method
                                  and stored in the `` variable. The book details such as title,
                                  publisher, year, and availability are then extracted from the
                                  `` variable and stored in their respective variables ``,
                                  ``, ``, and ``. These details are then used
                                  to pre-fill the form fields for updating the book details. */
                                $bookid = $_GET['id'];
                                $sql = "select * from LMS.book where Bookid='$bookid'";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                $name = $row['Title'];
                                $publisher = $row['Publisher'];
                                $year = $row['Year'];
                                $avail = $row['Availability'];


                                ?>

                                <br>
                                <form class="form-horizontal row-fluid" action="edit_book_details.php?id=<?php echo $bookid ?>" method="post">
                                    <div class="control-group">
                                        <b>
                                            <label class="control-label" for="Title">Book Title:</label></b>
                                        <div class="controls">
                                            <input type="text" id="Title" name="Title" value="<?php echo $name ?>" class="span8" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <b>
                                            <label class="control-label" for="Publisher">Publisher:</label></b>
                                        <div class="controls">
                                            <input type="text" id="Publisher" name="Publisher" value="<?php echo $publisher ?>" class="span8" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <b>
                                            <label class="control-label" for="Year">Year:</label></b>
                                        <div class="controls">
                                            <input type="text" id="Year" name="Year" value="<?php echo $year ?>" class="span8" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <b>
                                            <label class="control-label" for="Availability">Availability:</label></b>
                                        <div class="controls">
                                            <input type="text" id="Availability" name="Availability" value="<?php echo $avail ?>" class="span8" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" name="submit" class="btn">Update Details</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

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

        <?php
        if (isset($_POST['submit'])) {
           /* These lines of code are retrieving the values of the book details (title, publisher,
           year, and availability) from the form submitted using the POST method and storing them in
           variables. The `` variable is retrieving the book ID from the URL using the GET
           method. These variables are then used to update the book details in the database using an
           SQL query in the `if (isset(['submit']))` block of code. */
            $bookid = $_GET['id'];
            $name = $_POST['Title'];
            $publisher = $_POST['Publisher'];
            $year = $_POST['Year'];
            $avail = $_POST['Availability'];

            $sql1 = "update LMS.book set Title='$name', Publisher='$publisher', Year='$year', Availability='$avail' where BookId='$bookid'";



            if ($conn->query($sql1) === TRUE) {
                echo "<script type='text/javascript'>alert('Success')</script>";
                header("Refresh:0.01; url=book.php", true, 303);
            } else { //echo $conn->error;
                echo "<script type='text/javascript'>alert('Error')</script>";
            }
        }
        ?>

    </body>

    </html>

<?php } else {
    //
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>