<?php 
include 'classes/rooms.class.php';
/**
 * 
 */
class RoomController extends RoomDB
{
	private function cleandata($data) {
			$data = trim($data);
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
		if ($obj->createExamToRoom($this->cleandata($room_id),$this->cleandata($exam_id)))
		{
				echo 'Successfully added exam to the room. Refresh the page';
			}else{
				echo 'Error on adding exam room.';
			}
	}
}