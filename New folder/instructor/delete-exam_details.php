<?php 

include 'controller.exam_details.php';

	if(isset($_POST['item_id'])){
		$obj = new ExamDetailController();
		if ($obj->deleteExamDetails($_POST['item_id'])) {
			echo "<h2>delete was successful, kindly hit the refresh button</h2>";
		}else{
			echo "<h2>delete was unsuccessful</h2>";
		}
	}
?>