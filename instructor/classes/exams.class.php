<?php

class ExamDb{

	private function connectDb(){
		$connection = new mysqli("127.0.0.1", "root", "", "sad");
		return $connection;
	}

	protected function createExam($instructor_id, $title, $description){
		$query_string ="INSERT INTO exams (instructor_id, exam_title, exam_description) VALUES ('".$instructor_id."', '".$title."', '".$description."')";
		 
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

	protected function updateExam($exam_id, $title, $description){
		$query_string = "UPDATE exams SET exam_title = '$title' , exam_description = '$description' WHERE exam_id = $exam_id";
		 
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


	protected function selectExams($instructor_id, $limit){
		$query_string ="SELECT * FROM exams WHERE instructor_id=".$instructor_id. " LIMIT ".$limit;
		 
		$conn = $this->connectDb();		 
		 if ($conn->connect_error) {
  		  die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
   				print_r($conn->error);   
   				return false;				 					
			} else{
				$result = $conn->query($query_string);
				if ($result->num_rows > 0 ) {
					return $result;
					$result->free();
				}else{
					return false;
				}
			}
		}
	}

	

	protected function deleteExam($id){
		$query_string ="DELETE FROM exams WHERE exam_id = ".$id;
		 
		 $conn = $this->connectDb();
		 
		 if ($conn->connect_error) {
  		  die("Connection failed: " . $conn->connect_error);
		}else{
			if(!$conn->query($query_string)){
   				// print_r($conn->error);
   				 					
			} else{
				if (!$conn->query($query_string)) {
					// header("location:dashboard.php");
	   				print_r($conn->error);
					return false;
				}else{
					return true;
				}
				
			}
		}
	}
	
}







?>

