<?php 
session_start();

include 'controller.rooms.php';
if (isset($_POST['room_name'])) {
	$obj = new RoomController();
	if ($obj->addRoom($_POST['room_name'],$_SESSION['instructor_id'])) {
		header('location:dashboard.php');
	}
	
}