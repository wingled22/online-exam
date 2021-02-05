<?php


/**
 * 
 */
class ExamDetailsDb 
{
	private function connectDb(){
		$connection = new mysqli("127.0.0.1", "root", "", "sad");
		return $connection;
	}

	protected function createExamDetail( $exam_id, $item_qtn_type, $item_qtn, $item_answer, $item_choice1, $item_choice2, $item_choice3, $item_time_allotment){
		$query_string ="INSERT INTO `exam_details` (`exam_id`, `item_qtn_type`, `item_qtn`, `item_answer`, `item_choice1`,`item_choice2`,`item_choice3`, `item_time_allotment`) VALUES ('".$exam_id."' , '".$item_qtn_type."' , '".$item_qtn."' , '".$item_answer."' , '".$item_choice1."' , '".$item_choice2."' , '".$item_choice3."' , '".$item_time_allotment."')";
		 
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

		

	protected function updateExamDetails($item_id, $item_qtn_type, $item_qtn, $item_answer, $item_choice1, $item_choice2, $item_choice3, $item_time_allotment){
		// $query_string = "UPDATE exam_details SET item_qtn_type = \"".$item_qtn_type."\"  , item_qtn =  \"".$item_qtn ."\" , item_answer =  \"".$item_answer."\" , item_choice1 =  \"".$choice1."\" , item_choice2 =  \"" . $choice2 . "\" , item_choice3 =  \"".$choice3."\" , item_time_allotment = " . $item_time_allotment . " WHERE item_id = " . $item_id ;

		$query_string = "UPDATE exam_details SET item_qtn_type = '$item_qtn_type' , item_qtn = '$item_qtn'  , item_answer = '$item_answer'  , item_choice1 = '$item_choice1'  , item_choice2 =  '$item_choice2' , item_choice3 = '$item_choice3' , item_time_allotment = $item_time_allotment WHERE item_id = " . $item_id ;
	
		 
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

	protected function selectDistinctExamDetail($id){
		$query_string ="SELECT FROM exam_details WHERE item_id = ".$id;
		 
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


	protected function deleteExamDetail($id){
		$query_string ="DELETE FROM exam_details WHERE item_id = ".$id;		 
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






