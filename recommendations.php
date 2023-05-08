<?php
// upload database connection file
require('dbconn.php');
?>

<?php
//userid
if ($_SESSION['UserId']) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <!-- /* These lines of code are defining the basic structure and styling of the HTML page. */ -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Title -->
        <title>LMS</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <!-- css file link -->
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    </head>

    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <!-- header icone and image -->
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php"><img src="images/nn.png" class="logo" /> LMS </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="images/user.png" class="nav-avatar" />
                                    <b class="caret"></b></a>
                                <!-- dropdown menu -->
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
                                <li><a href="history.php"><i class="menu-icon icon-tasks"></i>Previously Borrowed Books </a></li>
                                <li><a href="recommendations.php"><i class="menu-icon icon-list"></i>Recommend Books </a></li>
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
                        <div class="content">

                            <div class="module">
                                <div class="module-head">
                                    <h3>Reccomend a Book</h3>
                                </div>
                                <div class="module-body">

                                    <br>

                                    <form class="form-horizontal row-fluid" action="recommendations.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="Title"><b>Book Title</b></label>
                                            <div class="controls">
                                                <input type="text" id="title" name="title" placeholder="Title" class="span8" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label class="control-label" for="Description"><b>Description</b></label>
                                            <div class="controls">
                                                <input type="text" id="Description" name="Description" placeholder="Description" class="span8" required>
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <div class="controls">
                                                <button type="submit" name="submit" class="btn">Submit Recommendation</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



                        </div><!--/.content-->
                    </div>

                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!-- footer part -->
        <?php include('footer.php') ?>

        <!-- /* The code block is including several JavaScript files that are required for the proper 
       functioning of the web page. These files include jQuery, jQuery UI, Bootstrap, Flot,
       DataTables, and a custom JavaScript file called "common.js". These files provide
       functionality such as user interface elements, data visualization, and data manipulation. */-->
        <!--/.wrapper-->
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>

        <?php

        /* `if(isset(['submit']))` is checking if the form has been submitted by checking if the 'submit'
button has been clicked. If it has been clicked, the code inside the if statement will be executed. */
        if (isset($_POST['submit'])) {
            /* These lines of code are retrieving the values entered by the user in the form fields with the
   names "title" and "Description" using the  superglobal array and storing them in the
   variables  and  respectively. The value of the currently logged in user's user
   ID is also being retrieved from the  superglobal array and stored in the variable
   . These variables are then used to insert a new record into the "recommendations" table in
   the database. */
            $title = $_POST['title'];
            $Description = $_POST['Description'];
            $rollno = $_SESSION['UserId'];

            $sql1 = "insert into LMS.recommendations (Book_Name,Description,UserId) values ('$title','$Description','$rollno')";



            /* `if(->query() === TRUE){` is checking if the SQL query stored in the variable `` was
executed successfully by the database connection object ``. If the query was executed
successfully, the code inside the if statement will be executed, which in this case is displaying a
success message using JavaScript. If the query was not executed successfully, the code inside the
else statement will be executed, which in this case is displaying an error message using JavaScript. */
            if ($conn->query($sql1) === TRUE) {

                //echo sucess
                echo "<script type='text/javascript'>alert('Success')</script>";
            } else { //echo $conn->error;
                echo "<script type='text/javascript'>alert('Error')</script>";
            }
        }
        ?>

    </body>

    </html>

<?php } else {
    //echo denied
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>