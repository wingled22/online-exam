<?php 
	include 'classes/exams.class.php';

	class ExamController extends ExamDb{


		private function cleandata($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		public function addExam($instructor_id, $title, $description)
		{
			$obj = new ExamDb();
			
			$title = $this->cleandata($title);
			$description = $this->cleandata($description);
			if($obj->createExam($instructor_id, $title, $description )){
				return true;
			}else{
				return false;
			}
		}

		public function updateExam($exam_id, $title, $description)
		{
			$obj = new ExamDb();
			
			$title = $this->cleandata($title);
			$description = $this->cleandata($description);
			if($obj->updateExam($exam_id, $title, $description )){
				return true;
			}else{
				return false;
			}
		}


		protected function getExams($instructor_id, $limit){
			 $obj = new ExamDb();
				 if ($result = $obj->selectExams($instructor_id, $limit)) {
				 	return $result;
				 	$result->free();
				 }else{
				 	return false;
				 }
		}

		public function deleteExam($exam_id){
			 $obj = new ExamDb();
				 if ($result = $obj->deleteExam($exam_id)) {
				 	return true;
				 	$result->free();
				 }else{
				 	return false;
				 }
		}

	}
	




 ?>