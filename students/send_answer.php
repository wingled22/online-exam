<?php 
include 'controller.exam_result_details.php';
print_r($_POST);

$obj = new ExamResultDetailController();

if($obj->addExamResultDetail($_POST['room_id'], $_POST['item_id'], $_POST['student_id'], $_POST['answer'])){
	echo "Answer added successfully";
}else{
	echo "Error on adding exam";
}
