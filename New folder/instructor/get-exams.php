<?php 
	session_start();
	include 'view.exams.php';

	$obj = new ExamView();

	//$result = $obj->viewExams(33, 6);
	/*echo $result[4][0];
	echo "<br>";
	print_r($result[4]);*/
	
	if ($result = $obj->viewExams($_SESSION['instructor_id'], $_POST['count'])) {
		foreach ($result as $key => $value) {
/*			echo $result[$key]["exam_title"].'<br>';*/
		echo "<tr>";
		$id = $result[$key]["exam_id"];
		echo "<td class=\"exam_id\">".$result[$key]["exam_id"]."</td>";
		echo "<td class=\"exam_title\">".$result[$key]["exam_title"]."</td>";
        echo "<td class=\"exam_description\">".$result[$key]["exam_description"]."</td>";
        echo "<td>";
        echo "<a href=\"show_details.php?exam_id=".$id."\">Show Details</a> | ";
        echo "<a class=\"update\" href=\"\">update</a> | ";
        echo "<a class=\"delete\" href=\"\">delete</a>";
        echo "</td>";
        echo "</tr>";
    }
	
	}else{
		echo "Something unexpected happen!! Try again later.";
	}
 ?>