<?php 
include 'classes/exam_result_details.class.php';


class ExamResultDetailController extends ExamResultDetailsDb 
{
	
	private function cleandata($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
	}

	public function addExamResultDetail($room_id, $item_id, $student_id, $answer){
		$ans = "";
		$qtn_type = "";
		$str = "Essay_or_enumeration";
		$score = NULL;
		$sql ="SELECT * FROM exam_details WHERE item_id = ".$item_id;
        $conn = mysqli_connect("localhost", "root", "", "sad");
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }else{
           
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_object($result)) {
                	$ans = $row->item_answer;
                	$qtn_type = $row->item_qtn_type;


						 $compared = strcmp($row->item_qtn_type, $str);

                	if ($compared == 0) {
                		
                		$obj = new ExamResultDetailsDb();
                		if($obj->createExamResultDetailNoScore($room_id ,$item_id ,$student_id ,$answer)){
							return true;
						}else{
							return false;
						}
                	}else{
                		if($row->item_answer == $answer){
							$score = 1;
						}else{
							$score = 0;
						}
						$obj = new ExamResultDetailsDb();

						if($obj->createExamResultDetailWithScore($room_id ,$item_id ,$student_id ,$answer, $score)){
							return true;
						}else{
							return false;
						}	

                	}



                }
            }
        }

	}

}

