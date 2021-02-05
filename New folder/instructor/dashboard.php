<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
    <div id="banner">
        <b >OES - Online Examination System</b>
    </div>
    <?php
session_start();
 // print_r($_SESSION);
if (!isset($_SESSION['instructor_id'])) {
    header('location:log-in.php');
}
    /*$_SESSION['exam_id'] = NULL;
    echo $_SESSION['exam_id'];*/
$_SESSION['exam_id'] = NULL;
?>
<script type="text/javascript" src="javascript/jquery-3.3.1.js"></script>
<script type="text/javascript" src="javascript/dashboard.js"></script>

<h5 id="info-message"></h5>
<div class="center container">
    <menu>
        <button><a href="log-out.php">Logout</a></button>
    </menu>
    <div class="tabs">
        <button id="exam-tab"   onclick="showTabs(0)">Exam</button>
        <button id="room-tab"   onclick="showTabs(1)">Room</button>
        <button id="result-tab" onclick="showTabs(2)">Result</button>
    </div>

    <div class="tabs-content">


        <div id="exam-content" >
              
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
                                echo "<td class=\"exam_title"." ".$row->exam_id."\">".$row->exam_title."</td>";
                                echo "<td class=\"exam_description"." ".$row->exam_id."\">".$row->exam_description."</td>";
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
                                    // echo "<button id=\"load_more\"><h5>Load Exam</h5></button>";

                                }

                            }
                        
                    ?>  


        </div>

        <div id="room-content" style="display: none">

            
        </div>

        
        <div id="result-content" style="display: none">
              
        </div>
    </div>
</div>


<script type="text/javascript">


    var showTabs = function(node){
    var tab_buttons = document.querySelectorAll('.tabs button');
    var tab_contents = document.querySelectorAll('.tabs-content div');


    for (var i = tab_contents.length - 1; i >= 0; i--) {
        tab_buttons[i].setAttribute("style", "background-color: #92e0ec;");
        tab_contents[i].style.display="none";
    }

    tab_buttons[node].setAttribute("style", "background-color: #cacaca;");
    tab_contents[node].style.display = "block";

    // console.log(tab_buttons);
    // console.log(tab_contents);
    }

    showTabs(0);
</script>
</body>
</html>