<?php  
session_start();    
                $sql ="SELECT * FROM exam_details where exam_id = " . $_SESSION['exam_id'] . " ORDER BY item_id asc" ;

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
                    }
                }
mysqli_close($conn);
?>                  
                        <th>Total Score</th>
                    </tr>
                </thead>

                <tbody>
<?php      
                        $sql ="SELECT DISTINCT s.firstname, s.lastname, e.room_id, e.student_id FROM students as s, exam_result_details as e where e.student_id = s.student_id AND e.room_id =". $_SESSION['room_id'] ;
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

                                    $sql2 = "SELECT DISTINCT i.item_qtn_type, e.exam_result_detail_id,e.room_id,e.item_id, e.student_id, e.answer, e.score FROM exam_details as i , exam_result_details as e WHERE i.item_id = e.item_id and student_id = " . $row->student_id . " AND room_id = ". $_SESSION['room_id'] ." ORDER BY `item_id` ASC";
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }else{
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) { 
                                            
                                            while ($row2 = mysqli_fetch_object($result2)) {
                                                
                                                if ($row2->item_qtn_type == 'essay_or_enumeration') {
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