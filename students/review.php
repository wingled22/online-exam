<!DOCTYPE html>
<html>
<head>
	<title>OES | Students-Check exam results</title>
	<link rel="stylesheet" type="text/css" href="css/review.css">
</head>
<body>
	<div id="banner">
		<b>OES - Online Examination System</b>
	</div>


	<div id="center-div">
		<?php 

echo "<button><a href=\"dashboard.php\">Go back to dashboard</a></button>";
		
session_start();
error_reporting(0);
// print_r($_SESSION);


$sql ="SELECT * FROM exam_result_details where room_id = ".$_SESSION['student_room_id']." and student_id = " .$_SESSION['student_id'];
$conn = mysqli_connect("localhost", "root", "", "sad");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
   
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_object($result)) {

		echo "<div class=\"item_container\">";

					$sql2 ="SELECT * FROM exam_details where item_id = ".$row->item_id;
					$conn2 = mysqli_connect("localhost", "root", "", "sad");
								   
				    $result2 = mysqli_query($conn2, $sql2);

				    if (mysqli_num_rows($result2) > 0) {
						while($row2 = mysqli_fetch_object($result2)) {
							echo "<h3>Question:  ".$row2->item_qtn."</h3>";
							echo "<h3>Answer:	 ".$row2->item_answer."</h3>";

					    }
					}
					// echo "<h3";
					if($row->score == null){
						echo "<h3 class=\"no_score\">";
					}else if($row->score >= 1){
						echo "<h3 class=\"correct\">";
					}else if($row->score == 0){
						echo "<h3 class=\"mistake\">";
					} 
					echo "Your Answer: ".$row->answer."</h3>";
		echo "</div><br>";

					
			    }
	}
}

?>

	</div>

</body>
</html>
