<!-- controller.rooms.php -->
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

	public function findRoom($room_name)
	{
		$obj = new RoomDb();
		$obj->findRoom($this->cleandata($room_name));
	}


}




 ?>