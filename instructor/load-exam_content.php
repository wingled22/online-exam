<?php 
session_start();



 ?>

              
              <dialog id="add_Dialog">
                <form method="dialog">
                  <section>
                    <input id="exam_title" type="text" name="title" placeholder="Enter exam title"><br>
                    <textarea id="exam_description" name="description" placeholder="Enter exam description"></textarea>
                  </section>
                  <menu>
                    <button id="submit">Add</button>
                    <button id="cancel">Cancel</button>
                  </menu>
                </form>
              </dialog>
              
                <!-- dialog box for updating an exam -->
              <dialog id="update_Dialog">
                <form method="dialog">
                  <section>
                    <input id="update_exam_title" type="text" name="update_title"><br>
                    <textarea id="update_exam_description" name="update_description" ></textarea>
                  </section>
                  <menu>
                    <button id="update_submit">Update</button>
                    <button id="update_cancel">Cancel</button>
                  </menu>
                </form>
              </dialog>

             <h5 id="info-message"></h5>
               <menu>
                <button id="add-exam">Add Exam</button>
                <!-- <button><a style="text-decoration:none" href="log-out.php">Logout</a></button> -->
              </menu>

              <?php 
                        include 'controller.exams.php';
                            $sql ="SELECT * FROM exams WHERE instructor_id=".$_SESSION['instructor_id']." LIMIT 6";
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
                                <th>Title</th>
                                <th>Description</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody id="exams_tbody">
                    <?php
                                    while($row = mysqli_fetch_object($result)) {
                                      echo "<tr class=\"table-rows\">";
                                      echo "<td class=\"exam_id\">".$row->exam_id."</td>";
                                      echo "<td class=\"exam_title\">".$row->exam_title."</td>";
                                      echo "<td class=\"exam_description\">".$row->exam_description."</td>";
                                      echo "<td>";
                                      echo "<a href=\"show_details.php?exam_id=".$row->exam_id."\">Show Details</a> | ";
                                      echo "<a class=\"update\" href=\"\">update</a> | ";
                                      echo "<a class=\"delete\" href=\"\">delete</a>";
                                      echo "</td>";
                                      echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                    echo "<menu><button id=\"load_more\">Load more exam</button></menu>";
                                    } else {
                                        echo "<h2>Try to add exam and refresh the page!</h2>"."<br>";
                                    }

                                }
                            
                        ?>  
