<!DOCTYPE html>
<html>
<head>
	<title>OCES | Students-Check exam results</title>
	<link rel="stylesheet" type="text/css" href="css/check-exam-results.css">
</head>
<body>
	<div id="banner">
		<b>OCES - Online Classroom Examination System</b>
	</div>


	<div id="center-div">
		<?php 
session_start();
error_reporting(0);

// Create connection
$conn = mysqli_connect('localhost', 'root', '','sad');
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$partial_score;

//query for getting the answer of the student
$sql = "SELECT * FROM exam_result_details where room_id = ".$_SESSION['student_room_id']." AND student_id = ".$_SESSION['student_id'];
$result = mysqli_query($conn, $sql);

// if the result is greater that zero
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_object($result)) {

        // echo "result id: " . $row->exam_result_detail_id.  "   id: " . $row->item_id. " - answer: " . $row->answer . " - room_id: " . $row->room_id . "<br>";

        //query to get the correct answer of the items that have multiple choice
        $sql2 = "SELECT  item_id , item_answer FROM exam_details where item_qtn_type = 'multiple_choice' AND item_id =".$row->item_id;
		$result2 = mysqli_query($conn, $sql2);

		if (mysqli_num_rows($result2) > 0) {
		    // output data of each row
		    while($row2 = mysqli_fetch_object($result2)) {
		        if($row2->item_id){
		        	// echo "id: " . $row2->item_id. " - Correct answer: " . $row2->item_answer . "<br>";

		        	//check if the item is students answer is correct
		        	if($row->answer == $row2->item_answer ){
		        		$sql3 = "UPDATE exam_result_details SET score = 1 WHERE exam_result_detail_id = ".$row->exam_result_detail_id;
						if (mysqli_query($conn, $sql3)) {
						    // echo "Record updated successfully<br>";
						} else {
						    // echo "Error updating record: " . mysqli_error($conn);
						}
			        	$partial_score = $partial_score + 1;
			        }else{

			        	$sql3 = "UPDATE exam_result_details SET score = 0 WHERE exam_result_detail_id = ".$row->exam_result_detail_id;
						if (mysqli_query($conn, $sql3)) {
						    // echo "Record updated successfully<br>";
						} else {
						    // echo "Error updating record: " . mysqli_error($conn);
						}
			        	// echo "0 point<br>";
			        	$partial_score = $partial_score + 0;
			        }
		        }

		    }
		}


    }


} else {
    echo "0 results";
}
echo "<h1>Partial score : ".$partial_score."</h1> The teacher is checking the answer of the questions that have question type of enumeration. identification and essay.<br>";
echo "<button><a href=\"dashboard.php\">Go back to dashboard</a></button>";

mysqli_close($conn);

?>

	</div>

</body>
</html>