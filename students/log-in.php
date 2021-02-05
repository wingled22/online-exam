<!DOCTYPE html>
<html>
<head>

	<title>OCES</title>
	<link rel="stylesheet" type="text/css" href="css/log-in.css">

</head>
<body>
	<div id="banner">
		<b>OCES - Online Classroom Examination System</b>
	</div>

	<?php

include 'controller.students.php'; 
session_start();


 if (isset($_GET['err'])) {
	echo "<h1>".$_GET['err']."</h1>";
	echo "<h2><a href=\"index.php\">".$_GET['err_desc']."</a></h2></br>";
}else{

	if (isset($_SESSION['student_id'])) {
	 		header('location:dashboard.php');
	 }	
}


?>

<div class="center-div">
	<h1>Log in Now!!</h1>
	<form action="log-in.php" method="POST">
		<input type="email" name="email" placeholder="Email"></br>
		<input type="password" name="password" placeholder="Password"></br>
		<input type="submit" name="submit" ></input>
	</form>

</div>

<?php 

if(isset($_POST['submit'])){
		$obj = new StudentController();
		$obj->findStudent($_POST['email'], $_POST['password']);
	}

 ?>

</body>
</html>