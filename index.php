<?php
//data connection file upload
require('dbconn.php');
?>

<!DOCTYPE html>
<html>

<!-- Head -->
<head>
      <!-- Title -->
	<title>Library Management System </title>

	<!-- Meta-Tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="Library Member Login Form Widget Responsive, Login Form Web Template, Flat Pricing Tables, Flat Drop-Downs, Sign-Up Web Templates, Flat Web Templates, Login Sign-up Responsive Web Template, Smartphone Compatible Web Template, Free Web Designs for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<!-- //Meta-Tags -->

	<!-- Style --> <link rel="stylesheet" href="css/style.css" type="text/css" media="all">

	<!-- Fonts -->
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<!-- //Fonts -->

</head>
<!-- //Head -->

<!-- Body -->
<body>
   <!-- Header 1 -->
	<h1>LIBRARY MANAGEMENT SYSTEM</h1>

	<div class="container">
      <!-- Login palce -->
		<div class="login">
			<h2>Sign In</h2>
			<form action="index.php" method="post">
				<input type="text" Name="UserId" placeholder="UserId" required="">
				<input type="password" Name="Password" placeholder="Password" required="">
			
			<!-- Send -->
			<div class="send-button">
				<!--<form>-->
					<input type="submit" name="signin"; value="Sign In">
				</form>
			</div>
			
			<div class="clear"></div>
		</div>

		<div class="register">
			<!-- Second Head -->
			<h2>Sign Up</h2>
			<form action="index.php" method="post">
				<!-- Text field in placeholder parts -->
				<input type="text" Name="Name" placeholder="Name" required>
				<input type="text" Name="Email" placeholder="Email" required>
				<input type="password" Name="Password" placeholder="Password" required>
				<input type="text" Name="PhoneNumber" placeholder="Phone Number" required>
				<input type="text" Name="UserId" placeholder="Roll Number" required="">
				
				<select name="Category" id="Category">
					<option value="GEN">General</option>
					<option value="OBC">BSc</option>
					<option value="SC"></option>
					<option value="ST"></option>
				</select>
				<br>
			
			
			<br>
			<div class="send-button">
			    <input type="submit" name="signup" value="Sign Up">
			    </form>
			</div>
			<!-- continuing term part -->
			
			<div class="clear"></div>
		</div>

		<div class="clear"></div>

	</div>
<!-- footer part -->
	<div class="footer ">
		<p> &copy; 2022 Library Member Teams, All Rights Reserved </a></p>
		
	</div>

<?php
/* place holder for signin*/
/*checking the validity*/
if(isset($_POST['signin']))
{$u=$_POST['UserId'];
 $p=$_POST['Password'];
 $c=$_POST['Category'];
 /*Select from user database query */
 $sql="select * from LMS.user where UserId='$u'";

 $result = $conn->query($sql);
$row = $result->fetch_assoc();
//retrieving user input
$x=$row['Password'];
$y=$row['Type'];
if(strcasecmp($x,$p)==0 && !empty($u) && !empty($p))
  {//echo "Login Successful";
   $_SESSION['UserId']=$u;
   
  /*redirect user to the appropriate index */
  if($y=='Admin')
   header('location:admin/index.php');
  else
  	header('location:student/index.php');  
  }
else 
/* wrong alert message*/
 { echo "<script type='text/javascript'>alert('Failed to Login! Incorrect UserId or Password')</script>";
}
}
/*checking the validity*/
if(isset($_POST['signup']))
{
	$name=$_POST['Name']; /* field name*/
	$email=$_POST['Email'];
	$password=$_POST['Password'];
	$mobno=$_POST['PhoneNumber'];
	$rollno=$_POST['UserId'];
	$category=$_POST['Category'];
	$type='Student';
   /* Insert data filed*/
	$sql="insert into LMS.user (Name,Type,Category,UserId,EmailId,MobNo,Password) values ('$name','$type','$category','$rollno','$email','$mobno','$password')";

	if ($conn->query($sql) === TRUE) {
		//Sucessful messsage
echo "<script type='text/javascript'>alert('Registration Successful')</script>";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
	/*alart message*/
echo "<script type='text/javascript'>alert('User Exists')</script>";
}
}

?>

</body>
<!-- //Body -->

</html>
