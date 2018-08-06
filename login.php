<?php
session_start(); 

// if ((isset($_SESSION['auth']) && $_SESSION['auth'] === true)) {
// 	header("Location: admin.php");
// 	exit();
// }

// 	if (isset($_GET['access'])) {
// 		$alert_user = true;
// 	}


require 'includes/db-inc.php';


// Error check

// 					echo"<br>";
// 					echo mysqli_errno($conn);

if(isset($_POST['submit'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$sql_admin = "SELECT * from admin where username = '$username' and  password = '$password' ";
	$query = mysqli_query($conn, $sql_admin);
	// echo mysqli_error($conn);
	if(mysqli_num_rows($query) > 0){
			
				while($row = mysqli_fetch_assoc($query)){
					$_SESSION['auth'] = true;
					$_SESSION['admin'] = $row['username'];		
					}
					if ($_SESSION['auth'] === true) {
				header("Location: admin.php");
				exit();
					}
	}
		
		else{
			$sql_stud = "SELECT * from studrecord where username='$username' and password = '$password'";
				$query = mysqli_query($conn, $sql_stud);
				$row = mysqli_fetch_assoc($query);
				if($row['username'] == $username && $row['password'] == $password){
					$_SESSION['student-username'] = $row['username'];
					$_SESSION['student-name'] = $row['fname'];
					
						header("Location:index2.html");		
					}
					else {
						$sql_stud = "SELECT * from teacher where username='$username' and password = '$password'";
				        $query = mysqli_query($conn, $sql_stud);
				        $row = mysqli_fetch_assoc($query);
				        if($row['username'] == $username && $row['password'] == $password){
					    $_SESSION['teacher-username'] = $row['username'];
					    $_SESSION['teacher-name'] = $row['fname'];
					    
						header("Location:index2.php");		
					}
					else {
						$sql_stud = "SELECT * from parent where username='$username' and password = '$password'";
				        $query = mysqli_query($conn, $sql_stud);
				        $row = mysqli_fetch_assoc($query);
				        if($row['username'] == $username && $row['password'] == $password){
					    $_SESSION['student-username'] = $row['username'];
					    $_SESSION['student-name'] = $row['name'];
					    $_SESSION['student-matric'] = $row['matric_no'];
						header("Location:parent.php");
						}
					
					
					else {
						echo"<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong style='text-align: center'> Wrong Username and Password.</strong>
				  </div>";
					}
					}		
					
						

					}
			}
			
					

}


?>


<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<!--<script src="JavaScript/main_slider.js" type="text/javascript"></script> -->
	<link rel="stylesheet" type="text/css" href="style.css"/>
	
</head>

<body>
    
 <div class="page-frame test-border">
    <!-- Head of the page -->
        <header id="" class="header test-border">
        	<div class="logo">
				<a href="index.html" >
					<img src="Assets/Images/Logo.png" alt="Logo">
				</a>
			</div>
			<div class="title test-border">
				<h1 style="font-size: 3vw"><center>School Management System</center></h1>
			</div>
			<div class="log ">
				<a href="login.php" class="button ">Login</a>
				</a>
			</div>
        </header>

    <div class="nav test-border">
			<nav>
				<ul class="navbar">
					<li><a href="index.html"  class="navblock">Home</a></li>
					<li><a href="about_us_page.html"  class="navblock">About Us</a></li>
					<li><a href="academic_page.html"  class="navblock">Academic</a></li>
					<li><a href="extracurricular_activities_page.html"  class="navblock">Extracurricular Activities</a></li>
					<li><a href="gallery_page.html"  class="navblock">Gallery</a></li>
					<li><a href="contact_us_page.html"  class="navblock">Contact Us</a></li>
				</ul>
			</nav>
	</div>
<div id="bottomboxesleft" class="bottom-boxes" >		
			<h1 style="text-align: center">LOGIN</h1>
				<form  role="form" method="post" action="login.php" enctype="multipart/form-data">
						<label for="Username" >Username</label>
						<input type="text"  name="username" placeholder="Enter Username" id="username" required>
						<label for="Password" >Password</label>
						<input type="password"  name="password" placeholder="Enter Password" id="password" required>

      					<input type="submit"  name="submit" value="Sign In">
				</form>
			</div>


</div>

	<?php if (isset($alert_user)) { ?>
	
	<?php } ?>

</body>
</html>