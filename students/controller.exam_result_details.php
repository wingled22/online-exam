<?php 
include 'classes/exam_result_details.class.php';

/**
 * 
 */
class ExamResultDetailController extends ExamResultDetailsDb 
{
	
	private function cleandata($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}

	public function addExamResultDetail($room_id, $item_id, $student_id, $answer)
	{
		$obj = new ExamResultDetailsDb();
		
		if($obj->createExamResultDetail($room_id ,$item_id ,$student_id ,$answer)){
			return true;
		}else{
			return false;
		}

	}




}