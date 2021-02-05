<?php 
include 'controller.exams.php';
include 'controller.exam_details.php';
if (isset($_POST['exam_id'])) {

	$obj1 = new ExamController();
	$obj2 = new ExamDetailController();

	if($obj2->deleteExamDetailsById($_POST['exam_id'])){
		if ($obj1->deleteExam($_POST['exam_id'])) {
			echo "delete was successful!<br> click load now";
		}else{
		echo "<h2>delete was unsuccessful/h2>";
		}
	}else{
		echo "<h2>delete was unsuccessful/h2>";

	}
}


 ?>