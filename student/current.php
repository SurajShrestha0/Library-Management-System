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
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php"><img src="images/nn.png" class="logo" />  LMS </a>
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
                        <form class="form-horizontal row-fluid" action="current.php" method="post">
                                        <div class="control-group">
                                            <label class="control-label" for="Search"><b>Search:</b></label>
                                            <div class="controls">
                                                <input type="text" id="title" name="title" placeholder="Enter Book Name/Book Id." class="span8" required>
                                                <button type="submit" name="submit"class="btn">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                    <?php
                                    // Retrieve the User ID from the session and assign it to a variable
                                    $rollno = $_SESSION['UserId'];
                                    // Check if the form has been submitted and assign the title input value to a variable
                                    if(isset($_POST['submit']))
                                    // Construct an SQL query to retrieve records for books that have been issued to the user, but not yet returned
                                        {$s=$_POST['title'];
                                            // The query includes a search condition that matches either the book ID or the book title to the value of $s
                                            $sql="select * from LMS.record,LMS.book where UserId = '$rollno' and Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId and (record.BookId='$s' or Title like '%$s%')";
                                        }
                                            // If the form has not been submitted, construct an SQL query to retrieve all records for books that have been issued to the user, but not yet returned
                                        
                                    else
                                    
                                        $sql="select * from LMS.record,LMS.book where UserId = '$rollno' and Date_of_Issue is NOT NULL and Date_of_Return is NULL and book.Bookid = record.BookId";
                                    // Execute an SQL query on the database connection and assign the result to a variable
                                    $result=$conn->query($sql);
                                    // Count the number of rows in the result and assign the count to another variable
                                    $rowcount=mysqli_num_rows($result);
                                    // Check if $rowcount is falsey (i.e. zero or null). If it is, print a message indicating that there are no results to display.
                                    if(!($rowcount))
                                        echo "<br><center><h2><b><i>No Results</i></b></h2></center>";
                                    else
                                    // insert code to display results here
                                    {

                                
                                    ?>
                        <table class="table" id = "tables">
                                  <thead>
                                    <!--table value-->
                                    <tr>
                                      <th>Book id</th>
                                      <th>Book name</th>
                                      <th>Issue Date</th>
                                      <th>Due date</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                <?php

                            
                            //$result=$conn->query($sql);
                            while($row=$result->fetch_assoc())
                            {
                                //fetches the Book ID, Title, Issue date, Due date, and the number of renewals left for a book from a database table and assigns them to corresponding variables.
                                $bookid=$row['BookId'];
                                $name=$row['Title'];
                                $issuedate=$row['Date_of_Issue'];
                                $duedate=$row['Due_Date'];
                                $renewals=$row['Renewals_left'];
                            
                            ?>

                                    <tr>
                                        <!--table data-->
                                      <td><?php echo $bookid ?></td>
                                      <td><?php echo $name ?></td>
                                      <td><?php echo $issuedate ?></td>
                                      <td><?php echo $duedate ?></td>
                                        <td><center>
                                        <?php 
                                         if($renewals)
                                            echo "<a href=\"renew_request.php?id=".$bookid."\" class=\"btn btn-success\">Renew</a>";
                                        ?>
                                        <a href="return_request.php?id=<?php echo $bookid; ?>" class="btn btn-primary">Return</a>
                                        </center></td>
                                    </tr>
                            <?php }} ?>
                                    </tbody>
                                </table>
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
<div class="footer">
    <!--footer part-->
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

<?php }
else {
    echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>