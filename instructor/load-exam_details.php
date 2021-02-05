<?php 

    include 'controller.exam_details.php';
    session_start();


        $sql ="SELECT * FROM exam_details WHERE exam_id=".$_SESSION['exam_id'];
        $conn = mysqli_connect("localhost", "root", "", "sad");
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }else{
           
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
?>
<menu>
    <button id="refresh">Refresh</button>
    <button><a href="dashboard.php">Back to dashboard</a></button>

    
</menu>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Tme Allotment</th>
            <th>Question</th>
            <th>answer</th>
            <th>choices</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
<?php
        while($row = mysqli_fetch_object($result)) {
            echo "<tr class=\"table-rows\" id=\"".$row->item_id."\">";
            echo "<td class=\"item_id\">".$row->item_id."</td>";
            echo "<td class=\"item_qtn_type\">".$row->item_qtn_type."</td>";
            echo "<td class=\"item_time_allotment\">".$row->item_time_allotment."</td>";
            echo "<td class=\"item_qtn\">".$row->item_qtn."</td>";
            echo "<td class=\"item_answer\">".$row->item_answer."</td>";
            echo "<td>";
            echo "<p class=\"item_choice1\">".$row->item_choice1."</p>";
            echo "<p class=\"item_choice2\">".$row->item_choice2."</p>";
            echo "<p class=\"item_choice3\">".$row->item_choice3."</p>";
            echo "</td>";
            echo "<td>";
            echo "<a class=\"update\" href=\"\">Update </a>";
            echo "<a class=\"delete\" href=\"\">| Delete</a>";
            echo "</td>";
            echo "</tr>";
                }
            } else {
                echo "<h2>Try to add questions to this exam and refresh the page!</h2>"."<br>";
                // echo "<button id=\"load_more\"><h5>Load Exam details</h5></button>";

            }

        }
    
?>       
    </tbody>
</table>
