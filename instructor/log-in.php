
<!DOCTYPE html>
<html>
<head>
	
	<title>OES</title>
	<link rel="stylesheet" type="text/css" href="css/log-in.css">

</head>
<body>
	<div id="banner">
		<b>OCES - Online Examination System</b>
	</div>

<?php
session_start();
if (isset($_GET['err'])) {
	echo "<h1>".$_GET['err']."</h1>";
	echo "<h2><a href=\"index.php\">".$_GET['err_desc']."</a></h2>";
}else{
	if (isset($_SESSION['instructor_id'])) {
	header('location:dashboard.php');
}
}
?>


	<div class="center-div">
		<h1 style="">Log in Now!</h1>
		<form action="log-in.php" method="POST">
			<input type="email" name="email" placeholder="Email"></br>
			<input type="password" name="password" placeholder="Password"></br>
			<input type="submit" name="submit" ></input>
		</form>
	</div>

</body>
</html>



<?php
include 'controller.instructor.php';


if(isset($_POST['submit'])){
	$inst = new InstructorController();
	$inst->findInstructor($_POST['email'],$_POST['password']);
}


