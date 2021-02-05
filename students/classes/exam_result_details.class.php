<?php 

class ExamResultDetailsDb 
{
	private function connectDb(){
		$connection = new mysqli("127.0.0.1", "root", "", "sad");
		return $connection;
	}



	protected function createExamResultDetail( $room_id, $item_id, $student_id, $answer){
		$query_string ="INSERT INTO `exam_result_details` (`room_id`, `item_id`, `student_id`, `answer`) VALUES ('".$room_id."' , '".$item_id."' , '".$student_id."' , '".$answer."')";
		 
		 $conn = $this->connectDb();
		 
		 if ($conn->connect_error) {
  		  die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
   				print_r($conn->error);
   				return false;				
			}else{
				return true;
			}
		}
	}

		


	
}





 ?>