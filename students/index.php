<?php
session_start();
if (isset($_GET['err'])) {
	# code...
	echo "<h1>".$_GET['err']."</h1></br>";
	echo "<h2>".$_GET['err_desc']."</h2></br>";

}else{
	if (isset($_SESSION['student_id'])) {
 		header('location:dashboard.php');
 	} 
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>OES</title>
	<link rel="stylesheet" type="text/css" href="css/index.css">

</head>
<body>
	<div id="banner">
		<b>OES - Online Examination System</b>
	</div>
	
	<div class="center-div">
		<menu>
			<button><a href="sign_up.php">Sign Up</a></button>
			<button><a href="log-in.php">Log In</a></button>
		</menu>
	</div>
</body>
</html>