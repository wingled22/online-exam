<?php 
    session_start();
    error_reporting(0);
    if (!isset($_SESSION['instructor_id'])) {
        header('location:log-in.php');
    }

    if (isset($_GET['room_id'])) {
      //code here
        // print_r($_SESSION);
        if(!isset($_GET['room_id'])){
            header('location:dashboard.php');
        }else{
                $_SESSION['room_id'] = $_GET['room_id'];
                $sql ="SELECT * FROM rooms where room_id = " . $_GET['room_id'] . " AND instructor_id = ".$_SESSION['instructor_id'];
                $conn = mysqli_connect("localhost", "root", "", "sad");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }else{
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 1) {
                        while ($row = mysqli_fetch_object($result)) {
                            if($row->exam_id == NULL){
                                echo "<h2>There was no exam in this room. Please try to add one.</h2>";
                            }else{
                                $_SESSION['exam_id'] = $row->exam_id;
                                // echo "<br>This is where the teacher review the answer of the students <br>";
                            }

                        }
                    }
                }
        mysqli_close($conn);
        }


    }else{
        header('location:dashboard.php');
    }
 ?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/show-room.css">
</head>
<body>
    <div id="banner">
        <b>OCES - Online Classroom Examination System</b>
    </div>
    <script type="text/javascript" src="javascript/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            
            var u_result_detail_id ;

            function no_class_click (event) {
                event.preventDefault();

                var class_string = ''
                var arr;

                $('dialog#score_dialog').show();

                class_string = $(this).attr('class');
                arr=class_string.split(' ');
                u_result_detail_id = arr[1];

                 $("#info-message").html(" ");
                
            }

            $('button#update_score_cancel').click(function(){
                $('dialog#score_dialog').hide();
            });

            $('button#update_score_submit').click(function(){
               
                var u_score = $('input#update_score').val();
                console.log(u_score);
                
                if (u_score < 0) {
                    $("#info-message").html('<h2>Sorry.Please don\'t enter a negative number.</h2>');
                }else{
                    $.ajax({
                        url:    'update-score.php',
                        method: 'post',
                        data: {
                            exam_result_id      : u_result_detail_id,
                            score               : u_score,
                            submit              : 'submit'
                        },
                        datatype: 'text',
                        success: function(string){
                            $("#info-message").html('<h2>update was successful! Refresh the page</h2>');
                        }
                    });
                    $('input#update_score').val('');
                }

                $('input#update_score').text('');
                $('dialog#score_dialog').hide();


            });

            $("table tbody tr").delegate( ".no_score ", "click", no_class_click);

            $("h5#info-message").delegate( "a#refresh_table", "click", function (event) {
                // body...
                event.preventDefault();
                $('div#result_table').load('load-exam_results.php');
                $("#info-message").html(" ");
            });

        });
    </script>

    <menu>
        <button><a href="dashboard.php">Return to dashboard</a></button>
        <button><a href="log-out.php">Logout</a></button>
      </menu>
    <hr>


    <div id="main">

        <h5 id="info-message"></h5>

        <!-- dialog box for adding room  -->
        <dialog id="score_dialog">
        <form method="dialog">
          <section>
            <input id="update_score" type="number" name="score" placeholder="Enter score for this item"><br>
          </section>
          <menu>
            <button id="update_score_cancel">Cancel</button>
            <button id="update_score_submit">Add</button>
          </menu>
        </form>
        </dialog>






        <div id="result_table">
<?php      
                $sql ="SELECT * FROM exam_details where exam_id = " . $_SESSION['exam_id'] . " ORDER BY item_id asc" ;
                //$sql ="SELECT * FROM exam_result_details where room_id = " . $_GET['room_id'] . " AND instructor_id = ".$_SESSION['instructor_id']. " AND exam_id = ".$_SESSION['instructor_id'];

                $conn = mysqli_connect("localhost", "root", "", "sad");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }else{
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
<?php 
                        while ($row = mysqli_fetch_object($result)) {
                            echo "<th>";
                            echo $row->item_qtn;
                            echo "</th>";
                        }
                        echo " <th>Total Score</th>";
                    }
                }
mysqli_close($conn);
?>                  
                       
                    </tr>
                </thead>

                <tbody>
<?php      
                        $sql ="SELECT DISTINCT s.firstname, s.lastname, e.room_id, e.student_id FROM students as s, exam_result_details as e where e.student_id = s.student_id AND e.room_id =". $_GET['room_id'] ;
                        $conn = mysqli_connect("localhost", "root", "", "sad");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }else{
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_object($result)) {
                                    echo "<tr>";
                                    echo "<td>".$row->firstname. " ".$row->lastname."</td>";
                                     $total_score = 0;

                                    $sql2 = "SELECT DISTINCT i.item_qtn_type, e.exam_result_detail_id,e.room_id,e.item_id, e.student_id, e.answer, e.score FROM exam_details as i , exam_result_details as e WHERE i.item_id = e.item_id and student_id = " . $row->student_id . " AND room_id = ". $_GET['room_id'] ." ORDER BY `item_id` ASC";
                                    //$sql2 ="SELECT * FROM `exam_result_details` WHERE student_id = " . $row->student_id . " AND room_id = ". $_GET['room_id'] ." ORDER BY `item_id` ASC" ;                                                               
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }else{
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) { 
                                            
                                            while ($row2 = mysqli_fetch_object($result2)) {
                                                
                                                if ($row2->item_qtn_type == 'essay_or_enumeration' || $row2->item_qtn_type == 'identification') {
                                                    if ($row2->score == NULL) {
                                                        echo "<td class=\"no_score ".$row2->exam_result_detail_id."\">";
                                                        echo $row2->answer;
                                                        echo "</td>";
                                                        $total_score = $total_score + 0;
                                                    }else if($row2->score == 0){
                                                        echo "<td class=\"mistake ".$row2->exam_result_detail_id."\">";
                                                        echo $row2->answer;
                                                        echo "</td>";
                                                        $total_score = $total_score + 0;

                                                    }else{
                                                        echo "<td class=\"correct ".$row2->exam_result_detail_id."\">";
                                                        echo $row2->answer;
                                                        echo "</td>";
                                                        $total_score = $total_score + $row2->score;
                                                        
                                                    }
                                                }else{
                                                    if($row2->score == 0){
                                                        echo "<td class=\"mistake ".$row2->exam_result_detail_id."\">";
                                                        echo $row2->answer;
                                                        echo "</td>";
                                                        $total_score = $total_score + 0;
                                                    }else{
                                                        echo "<td class=\"correct ".$row2->exam_result_detail_id."\">";
                                                        echo $row2->answer;
                                                        echo "</td>";
                                                         $total_score = $total_score + $row2->score;
                                                    }
                                                }

                                            }//end while loop
                                        }//end if
                                    }//end else
                                    echo "<td>";
                                    echo $total_score;
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                        }                       
?>    
                </tbody>





            </table>
        </div>
    </div>
</body>
</html>
