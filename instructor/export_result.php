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
    <style type="text/css">
        .td65{
            /*color: red;*/
        }
    </style>
    <div id="banner">
        <b>OES - Online Examination System</b>
    </div>
    <script type="text/javascript" src="javascript/jquery-3.3.1.js"></script>
    <script type="text/javascript">
        // function exportTableToExcel(tableID, filename = ''){
        //     var downloadLink;
        //     var dataType = 'application/vnd.ms-excel';
        //     var tableSelect = document.getElementById(tableID);
        //     var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        //     var tableHTML;
            
        //     // Specify file name
        //     filename = filename?filename+'.xls':'excel_data.xls';
            
        //     // Create download link element
        //     downloadLink = document.createElement("a");
            
        //     document.body.appendChild(downloadLink);
            
        //     if(navigator.msSaveOrOpenBlob){
        //         var blob = new Blob(['\ufeff', tableHTML], {
        //             type: dataType
        //         });
        //         navigator.msSaveOrOpenBlob( blob, filename);
        //     }else{
        //         // Create a link to the file
        //         downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
            
        //         // Setting the file name
        //         downloadLink.download = filename;
                
        //         //triggering the function
        //         downloadLink.click();
        //     }
        // }
        
        function fnExcelReport() {
         var tab_text = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
         tab_text = tab_text + '<head><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet>';
         tab_text = tab_text + '<x:Name>Test Sheet</x:Name>';
         tab_text = tab_text + '<x:WorksheetOptions><x:Panes></x:Panes></x:WorksheetOptions></x:ExcelWorksheet>';
         tab_text = tab_text + '</x:ExcelWorksheets></x:ExcelWorkbook></xml></head><body>';
         tab_text = tab_text + "<table border='1px'>";
         
        //get table HTML code
         tab_text = tab_text + $('#tblData').html();
         tab_text = tab_text + '</table></body></html>';


        var data_type = 'data:application/vnd.ms-excel';
        
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");
        
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
            if (window.navigator.msSaveBlob) {
                var blob = new Blob([tab_text], {
                    type: "application/csv;charset=utf-8;"
                });
                navigator.msSaveBlob(blob, 'Test file.xls');
            }
        } else {
            $('#test').attr('href', data_type + ', ' + encodeURIComponent(tab_text));
            $('#test').attr('download', 'Test file.xls');
        }

        }

        $(document).ready(function () {
            
            var u_result_detail_id ;
            var res;
            function loadresults() {
                res = <?php      
                        $sql ="SELECT DISTINCT s.firstname, s.lastname, e.room_id, e.student_id FROM students as s, exam_result_details as e where e.student_id = s.student_id AND e.room_id =". $_GET['room_id'] ;
                        $conn = mysqli_connect("localhost", "root", "", "sad");
                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }else{
                            $result = mysqli_query($conn, $sql);
                            echo "[";
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_object($result)) {

                                    echo "{ \"name\" : \"".$row->firstname. " ".$row->lastname."\" ,";
                                     $total_score = 0;

                                    $sql2 = "SELECT DISTINCT i.item_qtn_type, e.exam_result_detail_id,e.room_id,e.item_id, e.student_id, e.answer, e.score FROM exam_details as i , exam_result_details as e WHERE i.item_id = e.item_id and student_id = " . $row->student_id . " AND room_id = ". $_GET['room_id'] ." ORDER BY `item_id` ASC";
                                    //$sql2 ="SELECT * FROM `exam_result_details` WHERE student_id = " . $row->student_id . " AND room_id = ". $_GET['room_id'] ." ORDER BY `item_id` ASC" ;                                                               
                                    if (!$conn) {
                                        die("Connection failed: " . mysqli_connect_error());
                                    }else{
                                        $result2 = mysqli_query($conn, $sql2);
                                        if (mysqli_num_rows($result2) > 0) { 
                                            
                                                echo "\"answers\": [";
                                            while ($row2 = mysqli_fetch_object($result2)) {
                                                // echo $row2->item_id." ,";
                                                // echo "\"". $row2->item_qtn_type."\" ,";
                                                // echo "\"". $row2->answer."\" ,";
                                                // echo $row2->score."";

                                                echo "{\"exam_result_id\" : ". $row2->exam_result_detail_id." ,";
                                                echo "\"item_id\" : ". $row2->item_id." ,";
                                                echo "\"item_qtn_type\" : \"". $row2->item_qtn_type."\" ,";
                                                echo "\"answer\" : \"". htmlspecialchars($row2->answer)."\" ,";
                                                if ($row2->score == null ) {
                                                    echo "\"item_score\" : null },";
                                                }else{
                                                    echo "\"item_score\" : ". $row2->score."},";
                                                }
                                                
                                            }
                                                echo "{}]";
                                        }
                                    }
                                  echo "},";  
                                }
                            }
                            echo "{}];";
                        }                       
                    ?> 
                res.pop();
            }

            loadresults();
           

            function populateTbody(arr) {

                $("tbody tr").each(function(){
                    for (var i = 0; i <= res.length - 1; i++) {

                        if ($(this).find("td:first-child").text() == res[i].name) {

                            var score_tally = 0;
                            
                            for (var j = 0; j <= res[i].answers.length-2; j++) {
                                var node_class = res[i].answers[j].item_id.toString();
                                node_class = "td"+node_class;

                                // console.table(res[i].answers);

                                // console.log(res[i].answers[j].item_score);


                                if (res[i].answers[j].item_qtn_type == "Multiple_choice") {
                                    if (res[i].answers[j].item_score == 0) {
                                        $(this).find("td."+node_class).addClass("mistake");
                                        $(this).find("td."+node_class).addClass("result"+res[i].answers[j].exam_result_id);
                                        $(this).find("td."+node_class).removeClass("no_ans");
                                        $(this).find("td."+node_class).html("0");
                                    }else if (res[i].answers[j].item_score == 1){
                                        $(this).find("td."+node_class).addClass("correct");
                                        $(this).find("td."+node_class).addClass("result"+res[i].answers[j].exam_result_id);
                                        $(this).find("td."+node_class).removeClass("no_ans");
                                        $(this).find("td."+node_class).html("1");
                                    }
                                }else  if (res[i].answers[j].item_qtn_type == "True_or_false") {
                                    if (res[i].answers[j].item_score == 0) {
                                        $(this).find("td."+node_class).addClass("mistake");
                                        $(this).find("td."+node_class).addClass("result"+res[i].answers[j].exam_result_id);
                                        $(this).find("td."+node_class).removeClass("no_ans");
                                        $(this).find("td."+node_class).html("0");
                                    }else if (res[i].answers[j].item_score == 1){
                                        $(this).find("td."+node_class).addClass("correct");
                                        $(this).find("td."+node_class).addClass("result"+res[i].answers[j].exam_result_id);
                                        $(this).find("td."+node_class).removeClass("no_ans");
                                        $(this).find("td."+node_class).html("1");
                                    }
                                }else{
                                     if (res[i].answers[j].item_score == 0 ) {
                                        $(this).find("td."+node_class).addClass("mistake");
                                        $(this).find("td."+node_class).removeClass("no_ans");
                                        $(this).find("td."+node_class).addClass("result"+res[i].answers[j].exam_result_id);
                                        $(this).find("td."+node_class).html(res[i].answers[j].answer);

                                     }else if(res[i].answers[j].item_score < 0 ){
                                        $(this).find("td."+node_class).removeClass("mistake");
                                        $(this).find("td."+node_class).addClass("correct");
                                        $(this).find("td."+node_class).addClass("result"+res[i].answers[j].exam_result_id);
                                        $(this).find("td."+node_class).html(res[i].answers[j].answer);
                                     }else if(res[i].answers[j].item_score > 0 ){
                                        $(this).find("td."+node_class).removeClass("no_ans");
                                        $(this).find("td."+node_class).addClass("correct");
                                        $(this).find("td."+node_class).addClass("result"+res[i].answers[j].exam_result_id);
                                        $(this).find("td."+node_class).html(res[i].answers[j].answer);
                                     } else  if(res[i].answers[j].item_score == null ){
                                        $(this).find("td."+node_class).removeClass("no_ans");
                                        $(this).find("td."+node_class).addClass("no_score");
                                        $(this).find("td."+node_class).addClass("result"+res[i].answers[j].exam_result_id);
                                        $(this).find("td."+node_class).html(res[i].answers[j].answer);
                                     }
                                }
                                
                                score_tally = score_tally + res[i].answers[j].item_score;

                                console.log(score_tally);
                                $(this).find("td.total_score").text(score_tally);   
                            }    
                        }
                    }
                });

            }

            // $("tbody").find("tr").has("td."+66).innerHTML = "sdfsdfasdf"
            populateTbody(res);
        });

    
    </script>

    <menu>
        <button><a href="dashboard.php">Return to dashboard</a></button>
        <button><a href="log-out.php">Logout</a></button>
      </menu>
    <hr>


    <div id="main">

        <h5 id="info-message"></h5>


        <div id="result_table">
            <table id="tblData">
                <thead>
<?php      

        $heads = array();
                $sql ="SELECT * FROM exam_details where exam_id = " . $_SESSION['exam_id'] . " ORDER BY item_id asc" ;
                //$sql ="SELECT * FROM exam_result_details where room_id = " . $_GET['room_id'] . " AND instructor_id = ".$_SESSION['instructor_id']. " AND exam_id = ".$_SESSION['instructor_id'];

                $conn = mysqli_connect("localhost", "root", "", "sad");
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }else{
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) { ?>
                    <tr>
                        <th>Student Name</th>
                <?php 
                        while ($row = mysqli_fetch_object($result)) {
                            echo "<th id=\"". $row->item_id ."\">";
                            echo $row->item_qtn;
                            echo "</th>";
                            array_push($heads,  $row->item_id);
                        }
                        echo " <th id=\"total_score\">Total Score</th>";
                        echo "</tr>";
                    }
                }
mysqli_close($conn);
?>                  
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
                                    echo "<td class=\"stud_name\">".$row->firstname. " ".$row->lastname."</td>";
                                    foreach ($heads as $value) {
                                    echo "<td class=\"no_ans td".$value."\" id=\"".$value."\"><span></td>"; 
                                    }
                                    echo " <td class=\"total_score\"></td>";
                                    echo "</tr>";
                                }
                            }
                        }                       
?> 

                </tbody>
            </table>
            <menu>
                <a href="#" id="test" onClick="javascript:fnExcelReport();">download</a>
            </menu>
        </div>
    </div>
   
</body>
</html>