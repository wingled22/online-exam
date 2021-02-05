<?php 

include 'controller.exam_details.php';

	if(isset($_POST['submit'])){
		$obj = new ExamDetailController();

	// updateExamDetail($, $, $, $, $,$, $, $);
		if ($obj->updateExamDetail($_POST['item_id'],$_POST['item_qtn_type'],$_POST['item_qtn'],$_POST['item_answer'],$_POST['choice1'],$_POST['choice2'],$_POST['choice3'],$_POST['item_time_allotment'])) {
			echo "update was successful<br>click refresh";
		}else{
			echo "<h2>update was unsuccessful</h2>";
		}
	}
 ?>