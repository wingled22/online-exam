<!DOCTYPE html>
<html>
<head>
	<title>OES | Student-Sign Up</title>
	<link rel="stylesheet" type="text/css" href="css/sign-up.css">
</head>
<body>
	<div id="banner">
		<b>OES - Online Examination System</b>
	</div>
	
	<div id="center-box">
		<div id="reg_form">
			<form action="register.php" method="POST">
				<input type="text" name="firstname" placeholder="First name"></br>	
				<input type="text" name="lastname" placeholder="Last name"></br>
				<input type="email" name="email" placeholder="Email"></br>
				<input type="password" name="password" placeholder="Password"></br>
				<input type="submit" name="submit" ></input>
			</form>
		</div>
		<div id="log-in">
			<button><a href="log-in.php">Already have an account</a></button>
		</div>
	</div>
	


</body>
</html>