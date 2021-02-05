 <?php 
            session_start();
            include 'controller.exams.php';
                $sql ="SELECT * FROM exams WHERE instructor_id=".$_SESSION['instructor_id'];
                $conn = mysqli_connect("localhost", "root", "", "sad");
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }else{
                 
                        $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {  

                        while($row = mysqli_fetch_object($result)) {
                        echo "<option  value=\"".$row->exam_id."\">".$row->exam_title."</option>";
                        }
                    }else {
                            echo "<option value=\"none\">You have no exam created!</option>";
                            // echo "<button id=\"load_more\"><h5>Load Exam</h5></button>";

                        }

                }
            
        ?>