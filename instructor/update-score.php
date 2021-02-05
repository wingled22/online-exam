<?php 
    session_start();
    if (!isset($_SESSION['instructor_id'])) {
        header('location:log-in.php');
    }


     if (isset($_POST['submit'])) {
	     	$sql ="UPDATE exam_result_details SET score = " . $_POST['score'] . " WHERE exam_result_detail_id = " . $_POST['exam_result_id'] ;
			$conn = mysqli_connect("localhost", "root", "", "sad");
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}else{
			    $result = mysqli_query($conn, $sql);
			    if ($result) {
			    	echo "<h2>update was successful</h2>";
			    	echo "<button><a id='refresh_table'>Refresh</a></button>";
			    }else{
			    	echo "<h2>update was unsuccessful</h2>";
			    }
			}

     }

 ?>