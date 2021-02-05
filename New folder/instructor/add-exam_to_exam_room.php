<?php
include 'controller.rooms.php'; 
error_reporting(0);
if(isset($_POST['exam_id'])){
	$obj = new RoomController();

	 $sql ="SELECT exam_id FROM rooms where room_id = ". $_POST['room_id'] ;
		$conn = mysqli_connect("localhost", "root", "", "sad");
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}else{
		    $result = mysqli_query($conn, $sql);
		     $num_rows = mysqli_num_rows($result);
		    //$num_rows = mysqli_affected_rows($conn);
		    if ( $num_rows > 0){
		    	while($row = mysqli_fetch_object($result)) {
		    		$obj->addExamToRoom($_POST['room_id'] , $_POST['exam_id']);

		   //  		if($row->exam_id == NULL ){
		   //  			$obj->addExamToRoom($_POST['room_id'] , $_POST['exam_id']);
					// }else{
		   //  			echo "Sorry but the room you want to have an exam is no longer available.<br>Make another room instead.";	
					// }
		    	}

			
mysqli_close($conn);
	
		}
	}
}

