<?php 
include 'controller.rooms.php'; 
error_reporting(1);

if(isset($_POST['room_id'])){
	$sql ="UPDATE rooms SET active = 1 WHERE room_id = ".$_POST['room_id'] ;
	$conn = mysqli_connect("localhost", "root", "", "sad");
	if (!$conn) {
	    echo 'Room status unsuccessfully updated';
	    die("Connection failed: " . mysqli_connect_error());
	}else{
	    $result = mysqli_query($conn, $sql);
	    $num_rows = mysqli_num_rows($result);
	    echo 'Room status successfully updated';
	}
}
