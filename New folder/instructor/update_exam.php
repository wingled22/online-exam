<?php 
include 'controller.exams.php';
if(isset($_POST['exam_id'])){
	$obj = new ExamController();
	if($obj->updateExam($_POST['exam_id'], $_POST['title'], $_POST['description'])){
		echo "update was successful!<br> click load now";
	}else{
		echo "update was unsuccessful";

	}
}else{
	echo "error";
}



?>