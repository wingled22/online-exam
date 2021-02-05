<?php 
	// session_start();
	include 'classes/exam_details.class.php';
	class ExamDetailController extends ExamDetailsDb{
		
		private function cleandata($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}

		public function addExamDetail($exam_id, $item_qtn_type, $item_qtn, $item_answer, $item_choice1, $item_choice2, $item_choice3, $item_time_allotment){
			$obj = new ExamDetailsDb();
			if ($obj->createExamDetail($this->cleandata($exam_id),$this->cleandata($item_qtn_type),$this->cleandata($item_qtn),$this->cleandata($item_answer),$this->cleandata($item_choice1),$this->cleandata($item_choice2),$this->cleandata($item_choice3), $this->cleandata($item_time_allotment))) {
				// return true;
				echo "Exam detail was successfully added.<br>Click refresh";
			}else{
				// return false;
				echo "Error on adding exam detail";

			}
		}

		public function updateExamDetail($item_id, $item_qtn_type, $item_qtn, $item_answer, $item_choice1, $item_choice2, $item_choice3, $item_time_allotment){
			$obj = new ExamDetailsDb();
			
			if ($obj->updateExamDetails($this->cleandata($item_id),$this->cleandata($item_qtn_type),$this->cleandata($item_qtn),$this->cleandata($item_answer),$this->cleandata($item_choice1),$this->cleandata($item_choice2),$this->cleandata($item_choice3),$this->cleandata($item_time_allotment))) {
				return true;
			}else{
				return false;
			}
		}

		public function selectSpecificExamDetails($item_id){
			$obj = new ExamDetailsDb();
			$obj->selectDistinctExamDetails($this->cleandata($exam_id));
		}

		public function deleteExamDetails($item_id){
			$obj = new ExamDetailsDb();
			if($obj->deleteExamDetail($this->cleandata($item_id))){
				return true;
			}else{
				return false;
			}
		}

		public function deleteExamDetailsById($exam_id){
			$obj = new ExamDetailsDb();
			if($obj->deleteExamDetailsById($this->cleandata($exam_id))){
				return true;
			}else{
				return false;
			}
		}

		public function getExamDetails($exam_id, $limit){
			$obj = new ExamDetailsDb();
			$obj->selectExamDetails($this->cleandata($exam_id),$this->cleandata($limit));
			
		}
		
	}
 ?>