<?php
session_start();
if (isset($_GET['err'])) {
	# code...
	echo "<h1>".$_GET['err']."</h1></br>";
	echo "<h2>".$_GET['err_desc']."</h2></br>";

}else{
	if (isset($_SESSION['instructor_id'])) {
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
		<b>OCES - Online Examination System</b>
	</div>
	
	<div class="center-div">
		<div id="reg_form">
			<form action="register.php" method="POST">
				<input type="text" name="firstname" placeholder="First name"></br>	
				<input type="text" name="lastname" placeholder="Last name"></br>
				<input type="email" name="email" placeholder="Email"></br>
				<input style="" type="password" name="password" placeholder="Password"></br>
				<input type="submit" name="submit" ></input>
			</form>
		</div>
		<div id="log-in">
			<button><a href="log-in.php">Already have an account</a></button>
		</div>
	</div>
	


</body>
</html>