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
    <title>OCES | add item to exam</title>
    <link rel="stylesheet" type="text/css" href="css/show_details.css">
</head>
<body>
    <div id="banner">
        <b>OCES - Online Classroom Examination System</b>
    </div>
    <script type="text/javascript" src="javascript/jquery-3.3.1.js"></script>

<script>
    $(document).ready(function(){
        var question_type;
        var u_question_type;
        var ud_item_id;



        $('select#add_question_type').click(function(){
            if ($("select#add_question_type").val() == 'multiple_choice') {
                question_type = 'multiple_choice';
                console.log(question_type);
                $('#choice1').show();
                $('#choice2').show();
                $('#choice3').show();
            }else if ($("select#add_question_type").val() == 'essay_or_enumeration') {
                question_type = 'essay_or_enumeration';
                console.log(question_type);
                $('#choice1').hide();
                $('#choice2').hide();
                $('#choice3').hide();
            }else if($("select#add_question_type").val() == 'identification'){
                question_type = 'identification';
                console.log(question_type);
                $('#choice1').hide();
                $('#choice2').hide();
                $('#choice3').hide();
            }


            // console.log('i was clicked');
        });

        function opendialog(event) {
            event.preventDefault();            
                 ud_item_id = $(this).closest('tr.table-rows').find('td.item_id').text();
             var ud_time_allotment = $(this).closest('tr.table-rows').find('td.item_time_allotment').text();
             var ud_question = $(this).closest('tr.table-rows').find('td.item_qtn').text();
             var ud_answer = $(this).closest('tr.table-rows').find('td.item_answer').text();
             var ud_choice1 = $(this).closest('tr.table-rows').find('p.item_choice1').text();
             var ud_choice2 = $(this).closest('tr.table-rows').find('p.item_choice2').text();
             var ud_choice3 = $(this).closest('tr.table-rows').find('p.item_choice3').text();
        
             $('#update_question').val(ud_question)
             $('#update_time_allotment').val(ud_time_allotment)
             $('#update_answer').val(ud_answer)
             $('#update_choice1').val(ud_choice1)
             $('#update_choice2').val(ud_choice2)
             $('#update_choice3').val(ud_choice3)
             $('dialog').show();
        }
               
        $('#cancel').click(function(event){
            event.preventDefault();
            $('#update_question').val("")
            $('#update_time_allotment').val("")
            $('#update_answer').val("")
            $('#update_choice1').val("")
            $('#update_choice2').val("")
            $('#update_choice3').val("")
            $('dialog').hide();

        });

        $('select').click(function(){
            if ($("select#add_question_type").val() == 'multiple_choice') {
                question_type = 'multiple_choice';
                // console.log(question_type);
                $('#choice1').show();
                $('#choice2').show();
                $('#choice3').show();
            }else if ($("select#add_question_type").val() == 'essay_or_enumeration') {
                question_type = 'essay_or_enumeration';
                // console.log(question_type);
                $('#choice1').hide();
                $('#choice2').hide();
                $('#choice3').hide();
            }else if($("select#add_question_type").val() == 'identification'){
                question_type = 'identification';
                // console.log(question_type);
                $('#choice1').hide();
                $('#choice2').hide();
                $('#choice3').hide();
            }

        });

        $('select#update_question_type').click(function(){
            if ($("select#update_question_type").val() == 'multiple_choice') {
                u_question_type = 'multiple_choice';
                console.log('multiple_choice was clicked');
                $('#update_choice1').show();
                $('#update_choice2').show();
                $('#update_choice3').show();
            }else if ($("select#update_question_type").val() == 'essay_or_enumeration') {
                u_question_type = 'essay_or_enumeration';
                console.log('essay_or_enumeration was clicked');
                $('#update_choice1').hide();
                $('#update_choice2').hide();
                $('#update_choice3').hide();
            }else if($("select#update_question_type").val() == 'identification'){
                u_question_type = 'identification';
                console.log('identification was clicked');
                $('#update_choice1').hide();
                $('#update_choice2').hide();
                $('#update_choice3').hide();
            }
        });


        $('#update_submit').click(function(event){
            event.preventDefault();

            var u_item_id             = ud_item_id;
            var u_item_qtn_type       = $('#update_question_type').val();
            var u_item_qtn            = $('#update_question').val();
            var u_item_answer         = $('#update_answer').val();
            var u_choice1             = $('#update_choice1').val();
            var u_choice2             = $('#update_choice2').val();
            var u_choice3             = $('#update_choice3').val();
            var u_item_time_allotment = $('#update_time_allotment').val();

             if(u_item_qtn == ""){
            alert('Seems like the question was empty. Please input a proper question.');
            }else if(u_item_answer == ""){
            alert('Seems like the answer was empty. Please input a proper question.');
            }else if(u_item_time_allotment == ""){
            alert('Seems like the the time_allotment was empty. Please input a proper question.');
            }else{
                 if(u_item_qtn_type == 'multiple_choice'){
                     $.ajax({
                            url:    'update-exam_details.php',
                            method: 'post',
                            data: {
                                item_id             :u_item_id, 
                                item_qtn_type       :u_item_qtn_type, 
                                item_qtn            :u_item_qtn, 
                                item_answer         :u_item_answer, 
                                choice1             :u_choice1,
                                choice2             :u_choice2, 
                                choice3             :u_choice3,
                                item_time_allotment :u_item_time_allotment,
                                submit              :'submit'
                            },
                            datatype: 'text',
                            success: function(string){
                                $('#info-message').html(string);
                            }
                        });
                }else if (u_item_qtn_type == 'identification' || u_item_qtn_type == 'essay_or_enumeration') {
                     $.ajax({
                            url:    'update-exam_details.php',
                            method: 'post',
                            data: {
                                item_id             :u_item_id, 
                                item_qtn_type       :u_item_qtn_type, 
                                item_qtn            :u_item_qtn, 
                                item_answer         :u_item_answer, 
                                choice1             :'',
                                choice2             :'', 
                                choice3             :'',
                                item_time_allotment :u_item_time_allotment,
                                submit              :'submit'
                            },
                            datatype: 'text',
                            success: function(string){
                                $('#info-message').html(string);
                            }
                        });
                }
                $('#update_question').val("");
                $('#update_answer').val("");
                $('#update_choice1').val("");
                $('#update_choice2').val("");
                $('#update_choice3').val("");
                $('#update_time_allotment').val("");
                $('dialog').hide(); 
            }
               
        });

        function delete_details(event){
            event.preventDefault();
            ud_item_id = $(this).closest('tr.table-rows').find('td.item_id').text();
            console.log(ud_item_id);
             // $('#info-message').load('delete-exam_details.php',{item_id : ud_item_id});
             $.ajax({
                        url:    'delete-exam_details.php',
                        method: 'post',
                        data: {
                            item_id             :ud_item_id
                        },
                        datatype: 'text',
                        success: function(string){
                            $('#info-message').html(string);
                        }
                    });
        }

        
        function refresh(event){
            event.preventDefault();
            $('#exam_details_table').load('load-exam_details.php');
            $('#info-message').html('');
        }

        $("body").delegate( ".update", "click", opendialog);
        $("body").delegate( ".delete", "click", delete_details);
        $("body").delegate( "#refresh", "click", refresh);

        $('#add_submit').click(function(event) {
        event.preventDefault();
        console.log('add_submit was clicked');

         var a_item_qtn_type       = $('#add_question_type').val();
         var a_item_qtn            = $('#question').val();
         var a_item_answer         = $('#answer').val();
         var a_choice1             = $('#choice1').val();
         var a_choice2             = $('#choice2').val();
         var a_choice3             = $('#choice3').val();
         var a_item_time_allotment = $('#time_allotment').val();

         console.log(a_item_time_allotment);
         console.log(a_item_qtn_type);
         console.log(a_item_qtn);
         console.log(a_item_answer);
         console.log(a_choice1);
         console.log(a_choice2);
         console.log(a_choice3);

         if(a_item_qtn == ""){
            alert('Seems like the question was empty. Please input a proper question.');
         }else if(a_item_answer == ""){
            alert('Seems like the answer was empty. Please input a proper question.');
         }else if(a_item_time_allotment == ""){
            alert('Seems like the the time_allotment was empty. Please input a proper question.');
         }else{
             $.ajax({
                            url:    'add-exam_details.php',
                            method: 'post',
                            data: {
                                question_type       :a_item_qtn_type, 
                                question            :a_item_qtn, 
                                answer              :a_item_answer, 
                                choice1             :a_choice1,
                                choice2             :a_choice2, 
                                choice3             :a_choice3,
                                time_allotment      :a_item_time_allotment,
                                submit              :'submit'
                            },
                            datatype: 'text',
                            success: function(string){
                                $('#info-message').html(string);
                            }
                        });

                // $('#add_question_type').val();
                $('#question').val('');
                $('#answer').val("");
                $('#choice1').val("");
                $('#choice2').val("");
                $('#choice3').val("");
                $('#time_allotment').val("");

         }
       }); 

    });   

   

</script>

 <form id="add-exam" action="add-exam_details.php" method="post">
    <select id= "add_question_type"  name="question_type">
        <option id="multiple_choice" value="multiple_choice">Multiple Choice</option>
        <option id="identification" value="identification">Identification</option>
        <option id="essay_or_enumeration" value="essay_or_enumeration">Essay / Enumeration</option>
    </select><br>
    <input id="time_allotment" type="number" name="time_allotment" placeholder="Enter the number of seconds you want"><br>
    <textarea id="question" name="question" placeholder="Type your question here.."></textarea><br>
    <textarea id="answer" name="answer" placeholder="type the answer here"></textarea><br>
    <textarea id="choice1" name="choice1" placeholder="type the choice1"></textarea><br>
    <textarea id="choice2" name="choice2" placeholder="type the choice2"></textarea><br>
    <textarea id="choice3" name="choice3" placeholder="type the choice3"></textarea><br>
    <button id="add_submit" name="submit">Add item to exam</button>
 </form>


 <dialog id="favDialog"> 
    <form id="form-dialog" method="post" action="update-exam_details.php">
        <section>
            <h3>Update Exam Detail</h3>
        </section>
        <SECTION>
             <select name="update_question_type" id="update_question_type">
                <option id="multiple_choice" value="multiple_choice">Multiple Choice</option>
                <option id="identification" value="identification">Identification</option>
                <option id="essay_or_enumeration" value="essay_or_enumeration">Essay / Enumeration</option>
            </select><br>
            <input id="update_time_allotment" type="number" name="time_allotment" placeholder="Enter the number of seconds you want"><br>
            <textarea id="update_question" name="question" placeholder="Type your question here.."></textarea><br>
            <textarea id="update_answer" name="answer" placeholder="type the answer here"></textarea><br>
            <textarea id="update_choice1" name="choice1" placeholder="type the choice1"></textarea><br>
            <textarea id="update_choice2" name="choice2" placeholder="type the choice2"></textarea><br>
            <textarea id="update_choice3" name="choice3" placeholder="type the choice3"></textarea><br>
        </SECTION>
        <menu>
            <button id="update_submit" name="submit">Update</button>
            <button id="cancel">Cancel</button>
        </menu>
    </form>
  </dialog>


 <hr>
 <h3 id="info-message"></h3>
 <div id='exam_details_table'>
<?php   
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

 </div>
</body>
</html>