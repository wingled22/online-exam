<?php session_start(); ?>


<!-- dialog box for adding room  -->
                <dialog id="room_dialog">
                <form method="dialog">
                  <section>
                    <input id="room_name" type="text" name="title" placeholder="Enter room name"><br>
                  </section>
                  <menu>
                    <button id="add_room_submit">Add</button>
                    <button id="add_room_cancel">Cancel</button>
                  </menu>
                </form>
              </dialog>

            <!-- dialog box for sending exam to a room -->
              <dialog id="add_exam_to_room_dialog">
                <form method="dialog">
                    <H5>Select an exam to be send on this room</H5>
                  <section>
                    <select id="add_exam_to_room_select">
                        
                    </select>
                  </section>
                  <menu>
                    <button id="room_submit">Add</button>
                    <button id="room_cancel">Cancel</button>
                  </menu>
                </form>
              </dialog>

             
                <?php 
                      
                            $sql ="SELECT * FROM rooms where instructor_id =".$_SESSION['instructor_id'];
                            $conn = mysqli_connect("localhost", "root", "", "sad");
                            // Check connection
                            if (!$conn) {
                                die("Connection failed: " . mysqli_connect_error());
                            }else{
                               
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                    ?>

                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Room Name</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_rooms">
                    <?php
                                    while($row = mysqli_fetch_object($result)) {
                                echo "<tr id=\"table-rows\">";
                                echo "<td class=\"room_id\">".$row->room_id."</td>";
                                echo "<td class=\"room_name\">".$row->room_name."</td>";
                                echo "<td>";
                                echo "<a href=\"show_room.php?room_id=".$row->room_id."\">Show Details</a>";
                                if($row->exam_id == NULL){
                                    echo "<a class=\"send_to_room\" href=\"\"> | Put exam here</a>";
                                }
                                // echo "<a class=\"delete\" href=\"\">delete</a>";
                                echo "</td>";
                                echo "</tr>";
                                    }
                                } else {
                                    echo "<h2>Try to add exam room and refresh the page!</h2>"."<br>";
                                    // echo "<button id=\"load_more_rooms\"><h5>Load Exam</h5></button>";

                                }

                            }
                        
                    ?>    
                    </tbody>
                    </table> 
                    <!-- <button style="bottom: -50px; float: right;">Refresh</button> -->