<?php 
/**
 * 
 */
class RoomDB
{
	private function connectDb(){
		$connection = new mysqli("127.0.0.1", "root", "", "sad");
		return $connection;
	}
	protected function createRoom($room_name, $instructor_id){
		$query_string ="INSERT INTO rooms (room_name, instructor_id) VALUES ('".$room_name."' , '".$instructor_id."')";
		 
		 $conn = $this->connectDb();
		 
		 if ($conn->connect_error) {
  		  die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
   				// print_r($conn->error);
   				$err = $conn->error;
   				if(strpos($err, "uc_room_name")){
   					// echo "The room name: ".$room_name." was no longer available. Try another room name." ;
   					return 'unique';
   				}
   				return false;

			} else{
				return true;				
			}
		}
	}


		protected function createExamToRoom($room_id, $exam_id){
		$query_string ="UPDATE rooms SET exam_id = \"".$exam_id."\" WHERE room_id = ".$room_id ;
		 
		 $conn = $this->connectDb();
		 
		 if ($conn->connect_error) {
  		  die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
   				print_r($conn->error);
   				 return false;		
			} else{
				return true;				
			}
		}
	}
}