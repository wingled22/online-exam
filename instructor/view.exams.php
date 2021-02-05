<?php 
include 'controller.exams.php';
class ExamView extends ExamController
{
	
	public function viewExams($instructor_id, $limit)
	{
		$obj = new ExamController();
		if ($result = $obj->getExams($instructor_id, $limit)) {
			if ($count = $result->num_rows > 0) {
				$list= 0;
				$arr;
				while ($row = $result->fetch_object()) {
		            $arr[$list] = array("exam_id" => $row->exam_id,"exam_title" => $row->exam_title,  "exam_description" => $row->exam_description);
		            $list++;
				}
/* while loop ni brad
				while ($row = $result->fetch_object()) {
					echo "<tr>";
		            echo "<td>".$row->exam_id."</td>";
        		    echo "<td>".$row->exam_title."</td>";
        		    echo "<td>".$row->exam_description."</td>";
        		    echo "</tr>";
				}*/
				return $arr;
			}
		}else{
			return false;
		}
	}

}
 ?>