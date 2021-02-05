<?php

include 'controller.instructor.php';

if(isset($_POST['submit'])){
	echo $_POST['firstname'] . "</br>";
	echo $_POST['lastname'] . "</br>";
	echo $_POST['email'] . "</br>";
	echo $_POST['password'] . "</br>";

	$ins = new InstructorController();

	$ins->registerInstructor($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password']);
}



?>