<?php 
include 'controller.students.php';
if(isset($_POST['submit'])){
	$obj = new StudentController();
	$obj->addStudent($_POST['firstname'],$_POST['lastname'], $_POST['email'] , $_POST['password'] );
}
 
 ?>
