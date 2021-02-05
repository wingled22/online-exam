<?php 
/**
 * 
 */
class RoomDb 
{
	
	private function connectDb(){
		$connection = new mysqli("127.0.0.1", "root", "", "sad");
		return $connection;
	}

	protected function findRoom($room_name){
		 
		$query_string ="SELECT * FROM rooms  WHERE room_name = '".$room_name."' AND active = 1";
		$conn = $this->connectDb();
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
				print_r($conn->error);
				$err = $conn->error;
			} else{
				$result = $conn->query($query_string);
				if($result->num_rows == 1){
					$row_cnt = $result->num_rows;
					session_start();
					while ($row = $result->fetch_assoc()) {
				        if($row["exam_id"] == null){

				        }else{
				        	$_SESSION["student_room_id"]	=	$row["room_id"];
				       	 	$_SESSION["student_room_name"]	=	$row["room_name"];
				        	$_SESSION["student_exam_id"]	=	$row["exam_id"];
				        }
 				    }

					header('location:take-exam.php');
				}else{
					// header('location:log-in.php?err=User cannot be found&err_desc=Try signing up');
				}   				 
			}
		}

	}

}