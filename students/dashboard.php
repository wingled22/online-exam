<?php 
session_start();
// print_r($_SESSION);
if (!isset($_SESSION['student_id'])) {
    header('location:log-in.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>OES | Students</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
	
</head>
<body>

	<div id="banner">
		<b>OES - Online Examination System</b>
	</div>

	 <br>
	 <button class="log-out"><a href="log-out.php">Logout</a></button>
	 <hr>
	 <div id="center-div">
	 	 <div>
	 	 	<p>Instruction: </p>
	 	 	<ul>
	 	 		<li>Answer all the questions at a given time.</li>
	 	 		<li>Click finish when done taking the exam.</li>
	 	 		<li>Wait for the system to check your answer.</li>

	 	 	</ul></p>
			<form action="dashboard.php" method="POST">
			 	<input type="text" name="room_name" placeholder="Enter the room name given by your teacher"><br>
			 	<input type="submit" name="submit">	
			</form>
	 	 </div>
	 </div>
</body>
</html>

<?php 
include 'controller.rooms.php';
$_SESSION['student_room_id'] = null;
$_SESSION['student_room_name'] = null;
$_SESSION['student_exam_id'] = null;

if (isset($_POST['submit'])) {
	$obj = new RoomController();
	$obj->findRoom($_POST['room_name']);
}

?>