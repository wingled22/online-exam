<?php 
include 'controller.exam_details.php';
session_start();
if (isset($_POST['submit'])) {
	// print_r($_POST);print_r($_SESSION);

	$obj = new ExamDetailController();
	if ($_POST['question_type'] == 'multiple_choice') {
		
		// $choices = $_POST['choice1'] . ' :another: ' . $_POST['choice2'] .' :another: '. $_POST['choice3'];

		$obj->addExamDetail($_SESSION['exam_id'], $_POST['question_type'], $_POST['question'], $_POST['answer'], $_POST['choice1'], $_POST['choice2'] , $_POST['choice3'], $_POST['time_allotment']);
	}else if ($_POST['question_type'] == 'identification') {
		
		$obj->addExamDetail($_SESSION['exam_id'], $_POST['question_type'], $_POST['question'], $_POST['answer'], '','','', $_POST['time_allotment']);
	
	}else if ($_POST['question_type'] == 'essay_or_enumeration') {
		
		$obj->addExamDetail($_SESSION['exam_id'], $_POST['question_type'], $_POST['question'], $_POST['answer'], '','','', $_POST['time_allotment']);
	}else if ($_POST['question_type'] == 'true_or_false') {
		
		$obj->addExamDetail($_SESSION['exam_id'], $_POST['question_type'], $_POST['question'], $_POST['answer'], $_POST['choice1'],'','', $_POST['time_allotment']);
	}
}



?>