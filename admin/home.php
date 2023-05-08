<?php
// session_start();
require('dbconn.php');
?>

<?php
if ($_SESSION['UserId']) {
?>

  <!DOCTYPE html>
  <html lang="en">
  <!-- header -->
  <?php include 'header.php'; ?>

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--tag specifies the title of the page-->
    <title>LMS</title>
    <!--tags that reference external CSS files-->
    <!--CSS files are from the Bootstrap framework-->
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap.min1.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <!--tag references a Google Fonts stylesheet-->
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">



  </head>

  <body>
    <style>
      body {
        overflow: hidden;
      }
    </style>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
            <i class="icon-reorder shaded"></i></a><a class="brand" href="home.
            php"><img src="images/nn.png" class="logo" /> LMS</a>

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
          <!--/.span3-->

          <div class="span9">
            <div class="content">

              <div class="module">
                <div class="module-head">

                  <h1>Dashboard</h1>

                </div>


                <div class="module-body">
                  <section class="content">
                    <?php
                    if (isset($_SESSION['error'])) {
                      echo "
  <div class='alert alert-danger alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4><i class='icon fa fa-warning'></i> Error!</h4>
    " . $_SESSION['error'] . "
  </div>
  ";
                      unset($_SESSION['error']);
                    }
                    if (isset($_SESSION['success'])) {
                      echo "
  <div class='alert alert-success alert-dismissible'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4><i class='icon fa fa-check'></i> Success!</h4>
    " . $_SESSION['success'] . "
  </div>
  ";
                      unset($_SESSION['success']);





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
                        $today = new DateTime();
                        $days_overdue = $today->diff($due_date)->format('%r%a');
                        $sql_update = "UPDATE record SET Dues = $days_overdue WHERE ID = " . $row["ID"];
                        $conn->query($sql_update);
                      }
                    }
                    ?>
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                      <div class="col-lg-4 col-md-6">
                        <!-- small box -->
                        <div class="card card-primary">


                          <div class="card-body">
                            <?php
                            $sql2 = "select * from LMS.book";
                            $result = $conn->query($sql2);

                            echo "<h2>" . $result->num_rows . "</h2>";
                            ?>

                            <p class="card-text"><i class="fas fa-book"></i> Total Books</p>
                          </div>

                          <div class="card-footer">
                            <a href="book.php" class="card-link">More info <i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-4 col-md-6">
                        <!-- small box -->
                        <div class="card card-success">
                          <div class="card-body">
                            <?php
                            $sql2 = "select * from LMS.user";
                            $result = $conn->query($sql2);

                            echo "<h2>" . $result->num_rows . "</h2>";
                            ?>

                            <p class="card-text"><i class="fas fa-user"></i>Total Students</p>
                          </div>
                          <div class="card-footer">
                            <a href="student.php" class="card-link">More info <i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                      </div>
                      <!-- ./col -->
                      <div class="col-lg-4 col-md-6">
                        <!-- small box -->
                        <div class="card card-warning">
                          <div class="card-body">
                            <?php
                            $sql2 = "select return.BookId,return.UserId,Title,datediff(curdate(),Due_Date) as x from LMS.return,LMS.book,LMS.record where return.BookId=book.BookId and return.BookId=record.BookId and return.UserId=record.UserId";
                            $result = $conn->query($sql2);

                            echo "<h2>" . $result->num_rows . "</h2>";
                            ?>


                            <p class="card-text"><i class="fas fa-undo"></i>Returned Today</p>
                          </div>
                          <style>
                            .card {
                              border: 1px solid #ccc;
                              border-radius: 5px;
                              padding: 10px;
                              width: 200px;
                              margin: 10px;
                              display: inline-block;
                            }

                            .card-body {
                              text-align: center;
                            }

                            .card h2 {
                              font-size: 36px;
                              margin-top: 0;
                            }

                            .card p {
                              margin-bottom: 0;
                            }
                          </style>
                          <div class="card-footer">
                            <a href="return_requests.php" class="card-link">More info <i class="fa fa-arrow-circle-right"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>

              </div><!--/.content-->
            </div>

          </div>


        </div>
      </div>

      <!--/.span9-->
    </div>
    </div>
    <!--/.container-->
    <!-- update due date and time -->
    <?php include('update.php') ?>

    <div class="wrapper">
      <!-- footer -->
      <?php include('footer.php') ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <!-- Main content -->


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
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

      </div>

    </div>
    </div>

  </body>

  </html>
<?php } else {
  // access denied
  echo "<script type='text/javascript'>alert('Access Denied!!!')</script>";
} ?>
