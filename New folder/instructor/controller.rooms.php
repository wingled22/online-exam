<?php 
include 'classes/rooms.class.php';
/**
 * 
 */
class RoomController extends RoomDB
{
	private function cleandata($data) {
			$data = trim($data);
			$data = ucfirst($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}

	public function addRoom($room_name, $instructor_id)
	{
		$obj = new RoomDB();
		if ($obj->createRoom($this->cleandata($room_name),$this->cleandata($instructor_id))){
			echo 'Exam room was created. <br>Refresh the page';
		}else{
			echo 'Error on creating exam room.';
			echo "Either the room name: ".$room_name." was no longer available. Try another room name." ;
		}
	}

	public function addExamToRoom($room_id, $exam_id){
		$obj = new RoomDB();
		
		$sql ="DELETE FROM exam_result_details WHERE room_id = ". $room_id ;
		$conn = mysqli_connect("localhost", "root", "", "sad");
		if (!$conn) {
		    echo 'Room status unsuccessfully updated';
		    die("Connection failed: " . mysqli_connect_error());
		}else{
		    $result = mysqli_query($conn, $sql);
		    $num_rows = mysqli_num_rows($result);
		    echo 'Room status successfully updated';
		}


		if ($obj->createExamToRoom($this->cleandata($room_id),$this->cleandata($exam_id)))
		{
				echo 'Successfully added exam to the room. Refresh the page';
			}else{
				echo 'Error on adding exam room.';
			}
	}


	public function activateRoom($room_id){
		$obj = new RoomDB();
		if ($obj->activateRoom($this->cleandata($room_id)))
		{
				echo 'Room status successfully updated';
				echo $room_id;
			}else{
				echo 'Room status unsuccessfully updated';
			}
	}

	public function deactivateRoom($room_id){
		$obj = new RoomDB();
		if ($obj->activateRoom($this->cleandata($room_id)))
		{
				echo 'Room status successfully updated';
				echo $room_id;
			}else{
				echo 'Room status unsuccessfully updated';
			}
	}
}