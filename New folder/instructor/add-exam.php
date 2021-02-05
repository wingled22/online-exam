<?php
session_start();

include 'controller.exams.php';
// echo ."<br>";
// echo ."<br>";
// echo ."<br>";

$obj = new ExamController();
if($obj->addExam($_SESSION['instructor_id'], $_POST['exam_title'], $_POST['exam_description'])){
	echo "<br>Successfully added exam.<br>Refresh the page or click the load button if available.";
}else{
	echo "<br>Something unexpected happen, Try again later!<br>";
}


 ?>

