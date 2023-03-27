<?php
//need data connection file
require('dbconn.php');
?>
<?php
//checks whether the $_SESSION['UserId'] variable is set 
if ($_SESSION['UserId']) {
    ?>
<!-- Html  declaration --> 
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--title -->
        <title>LMS</title>
        <!--link bootstrap css file -->
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
         <!--link  anotehr bootstrap css file -->
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <!-- navbar -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">LMS </a>
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
                                <!--menu part-->
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
                                <h3>Book Details</h3>
                            </div>
                            <div class="module-body">
                        <?php
                            // Retrieve the book ID from the URL parameter and assign it to a variable
                            $x=$_GET['id'];
                            // Construct an SQL query to retrieve book information for the book with the matching Book 
                            $sql="select * from LMS.book where BookId='$x'";
                            // Execute the query and retrieve the first row of results as an associative array
                            $result=$conn->query($sql);
                            $row=$result->fetch_assoc();    
                            // Assign the book information to variables for use in the HTML code that follows
                             // Note that these variables will be used to display book information in a form for editing
                              // It's assumed that the form fields will have the same name attributes as the database columns
                                $bookid=$row['BookId'];
                                $name=$row['Title'];
                                $publisher=$row['Publisher'];
                                $year=$row['Year'];
                                $avail=$row['Availability'];
                                echo "<b>Book ID:</b> ".$bookid."<br><br>";
                                echo "<b>Title:</b> ".$name."<br><br>";
                                $sql1="select * from LMS.author where BookId='$bookid'";
                                $result=$conn->query($sql1);
                                // Insert a label and loop through the results of the query to display the book's author(s)
                                echo "<b>Author:</b> ";
                                while($row1=$result->fetch_assoc())
                                {
                                    echo $row1['Author']."&nbsp;";
                                }
                                // Insert labels and display the book's publisher, year, and availability
                                echo "<br><br>";
                                echo "<b>Publisher:</b> ".$publisher."<br><br>";
                                echo "<b>Year:</b> ".$year."<br><br>";
                                echo "<b>Availability:</b> ".$avail."<br><br>";

                                // Note that the variables $publisher, $year, and $avail are assumed to have been set earlier in the code, and are not shown here.
                        
                           
                            ?>
                            
                        <a href="book.php" class="btn btn-primary">Go Back</a>                             
                               </div>
                           </div>
                            </div>
                    <!--/.span3-->
                    <!--/.span9-->
                
                    <!--/.span3-->
                    <!--/.span9-->
                </div>
                    
                    <!--/.span9-->
                </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
<div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2023 Library Management System </b>All rights reserved.
            </div>
        </div>
        
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
<!-- end 
<?php }
else {
    //alert messagae box
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>