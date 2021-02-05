<?php   
session_start();
    $sql ="SELECT * FROM exam_details WHERE exam_id=".$_SESSION['exam_id']." order by item_id desc";
            $conn = mysqli_connect("localhost", "root", "", "sad");
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }else{
               
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    ?>
                <?php
                while($row = mysqli_fetch_object($result)) {
                    ?>
                    


                    <div class="item-container " >
                       <div id="container" class="exam<?php echo $row->item_id;?>">
                            <div class="question_type hidden" ><?php echo $row->item_qtn_type;?></div>
                            <div class="time">
                                <span>Time Allotment: </span><span class="item_time_allotment"><?php echo $row->item_time_allotment ?></span>
                            </div>
                            <div class="question">
                                <span>Question: </span><span class="item_qtn"><?php echo $row->item_qtn;?></span>
                            </div>
                            <?php 

                            if ($row->item_qtn_type == "Multiple_choice") {
                               ?>
                               <div id="choices_container">
                                   <div class="item_answer correct"><?php echo $row->item_answer;?></div>
                                   <div class="item_choice1 wrong"><?php echo $row->item_choice1;?></div>
                                   <div class="item_choice2 wrong"><?php echo $row->item_choice2;?></div>
                                   <div class="item_choice3 wrong"><?php echo $row->item_choice3;?></div>
                               </div>
                               <?php
                            }else if($row->item_qtn_type == "True_or_false"){
                               ?>
                               <div id="choices_container">
                                   <div class="item_answer correct"><?php echo $row->item_answer;?></div>
                                   <div class="item_choice1 wrong"><?php echo $row->item_choice1;?></div>
                               </div>
                               <?php
                            }else{
                                ?>
                                <div id="choices_container">
                                   <div class="item_answer correct"><?php echo $row->item_answer;?></div>
                                </div>
                                <?php
                            }

                            ?>
                            <menu>
                                <button class="edit">Edit</button>
                                <button class="delete">Delete</button>
                            </menu>
                       </div>
                    </div>

    <?php 
                }
            } else {
                    echo "<h2>Try to add questions to this exam and refresh the page!</h2>"."<br>";
                 
                }

            }
        
    ?>       
    
    
