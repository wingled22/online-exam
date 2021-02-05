<?php 
	session_start();

	if (isset($_GET['exam_id'])) {
		if(!isset($_SESSION['exam_id'])){
		// header('location:show_details.php?exam_id='.$_SESSION['exam_id']);
		$_SESSION['exam_id'] = $_GET['exam_id'];
        }
    }else{
        header('location:dashboard.php');
    }
 ?>

<!DOCTYPE html>
<html>
<head>
    <title>OES | add item to exam</title>
    <link rel="stylesheet" type="text/css" href="css/show_details.css">
</head>
<body>
    <div id="banner">
        <b>OES - Online Examination System</b>
    </div>
    <script type="text/javascript" src="javascript/jquery-3.3.1.js"></script>  
    <script type="text/javascript" src="javascript/jspdf.js"></script>
    <script type="text/javascript" src="javascript/pdfFromHTML.js"></script>

<script>
    try{
        function HTMLtoPDF(){
            var pdf = new jsPDF('p', 'pt', 'letter');
            source = $('#exam_details_table')[0];
            specialElementHandlers = {
                '#bypassme': function(element, renderer){
                    return true
                }
            }
            margins = {
                top: 50,
                left: 60,
                width: 545
              };
            pdf.fromHTML(
                source // HTML string or DOM elem ref.
                , margins.left // x coord
                , margins.top // y coord
                , {
                    'width': margins.width // max width of content on PDF
                    , 'elementHandlers': specialElementHandlers
                },
                function (dispose) {
                  // dispose: object with X, Y of the last line add to the PDF
                  //          this allow the insertion of new lines after html
                    pdf.save('<?php echo $_GET['exam_id']?>.pdf');
                  }
              )     
        }
   
    }catch( e ){
        console.log("error")
    }

</script>

<a href="#" onclick="HTMLtoPDF()">Download</a>
<div id='exam_details_table'>
<?php   
    $sql ="SELECT * FROM exam_details WHERE exam_id=".$_SESSION['exam_id']." order by item_qtn_type desc";
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
<!--                         <div class="question_type">
                           <span>Question type: </span><span class="item_qtn_type"><?php echo $row->item_qtn_type;?></span>
                        </div>
                        <div class="time">
                            <span>Time Allotment: </span><span class="item_time_allotment"><?php echo $row->item_time_allotment ?></span>
                        </div> -->
                        <div class="question">
                            <span class="item_qtn"><?php echo $row->item_qtn;?></span>
                        </div>
                        <div class="answer">
                            <span class="item_answer"><?php echo $row->item_answer;?></span>    
                        </div>
                        <?php 

                        if ($row->item_qtn_type == "Multiple_choice") {
                            echo "<div class=\"choices\">";
                            
                            echo "<ul>";
                            echo "<li class=\"item_choice1\">".$row->item_choice1."</li>";
                            echo "<li class=\"item_choice2\">".$row->item_choice2."</li>";
                            echo "<li class=\"item_choice3\">".$row->item_choice3."</li>";
                            echo "</ul>";
                            echo "</div>";
                        }else if($row->item_qtn_type == "True_or_false"){
                            echo "<div class=\"choices\">";
                            echo "<ul>";
                            echo "<li class=\"item_choice1\">".$row->item_choice1."</li>";
                            echo "</ul>";
                            echo "</div>";
                        }

                        ?>
                   </div>
                </div>
                <br>
                <br>
                <br>

<?php 
            }
        } else {
                echo "<h2>Try to add questions to this exam and refresh the page!</h2>"."<br>";
             
            }

        }
    
?>       

 </div>
</body>
</html>