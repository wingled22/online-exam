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
    <style type="text/css">
    

    .item_answer{
        /*background: blue;*/
    }
    

    </style>
    <script>

        $(document).ready(function(){
            var question_type;
            var u_question_type;
            var ud_item_id;

            var ud_time_allotment;
            var ud_question_type;
            var ud_question;
            var ud_answer;
            var ud_choice1;
            var ud_choice2;
            var ud_choice3;


            $('select#add_question_type').click(function(){
                if ($("select#add_question_type").val() == 'multiple_choice') {
                    question_type = 'multiple_choice';
                    $('#choice1').show();
                    $('#choice2').show();
                    $('#choice3').show();
                }else if ($("select#add_question_type").val() == 'essay_or_enumeration') {
                    question_type = 'essay_or_enumeration';
                    $('#choice1').hide();
                    $('#choice2').hide();
                    $('#choice3').hide();
                }else if($("select#add_question_type").val() == 'identification'){
                    question_type = 'identification';
                    $('#choice1').hide();
                    $('#choice2').hide();
                    $('#choice3').hide();
                }else if($("select#add_question_type").val() == 'true_or_false'){
                    question_type = 'true_or_false';
                    $('#choice1').show();
                    $('#choice2').hide();
                    $('#choice3').hide();
                }


                // console.log('i was clicked');
            });


            function opendialog(event) {

            
                 $('#update_question').val(ud_question);
                 $('#update_time_allotment').val(ud_time_allotment);
                 $('#update_answer').val(ud_answer);
                 $('#update_choice1').val(ud_choice1);
                 $('#update_choice2').val(ud_choice2);
                 $('#update_choice3').val(ud_choice3);

                 if ( ud_question_type == 'Multiple_choice') {
                    u_question_type = 'multiple_choice';
                    document.querySelector("#update_question_type").selectedIndex = 0;
                    $('#update_choice1').show();
                    $('#update_choice2').show();
                    $('#update_choice3').show();
                }else if ( ud_question_type == 'Essay_or_enumeration') {
                    u_question_type = 'essay_or_enumeration';
                    document.querySelector("#update_question_type").selectedIndex = 3;
                    $('#update_choice1').hide();
                    $('#update_choice2').hide();
                    $('#update_choice3').hide();
                }else if( ud_question_type == 'Identification'){
                    u_question_type = 'identification';
                    document.querySelector("#update_question_type").selectedIndex = 2;
                    $('#update_choice1').hide();
                    $('#update_choice2').hide();
                    $('#update_choice3').hide();
                }else if( ud_question_type == 'True_or_false'){
                    u_question_type = 'true_or_false';
                    document.querySelector("#update_question_type").selectedIndex = 1;
                    $('#update_choice1').show();
                    $('#update_choice2').hide();
                    $('#update_choice3').hide();
                }

                 $('dialog#favDialog').show();


            }

            function edit_details(event){
                event.preventDefault();
                var str = $(this).closest("#container").attr("class");
                var str2 = str.split("exam");

                ud_item_id = str2[1];
                // console.log(ud_item_id);
                ud_time_allotment = $(this).closest("#container").find("span.item_time_allotment").text();
                ud_question_type = $(this).closest("#container").find("div.question_type").text();
                console.log(ud_question_type);
                ud_question = $(this).closest("#container").find("span.item_qtn").text();
                ud_answer = $(this).closest("#container").find("div#choices_container div.item_answer").text();
                ud_choice1 = $(this).closest("#container").find("div#choices_container div.item_choice1").text();
                ud_choice2 = $(this).closest("#container").find("div#choices_container div.item_choice2").text();
                ud_choice3 = $(this).closest("#container").find("div#choices_container div.item_choice3").text();

                opendialog();
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
                }else if($("select#update_question_type").val() == 'true_or_false'){
                    u_question_type = 'true_or_false';
                    console.log(u_question_type);
                    $('#update_choice1').show();
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
                    }else if (u_item_qtn_type == 'true_or_false') {
                         $.ajax({
                                url:    'update-exam_details.php',
                                method: 'post',
                                data: {
                                    item_id             :u_item_id, 
                                    item_qtn_type       :u_item_qtn_type, 
                                    item_qtn            :u_item_qtn, 
                                    item_answer         :u_item_answer, 
                                    choice1             :u_choice1,
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
                var str = $(this).closest("#container").attr("class");
                var str2 = str.split("exam");

                ud_item_id = str2[1];
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
                $('#exam_details_table div').load('load-exam_details.php');
                $('#info-message').html('');
            }

            // $("body").delegate( ".update", "click", opendialog);
            $("body").delegate( ".edit", "click", edit_details);

            $("body").delegate( ".delete", "click", delete_details);
            $("body").delegate( "#refresh", "click", refresh);

            $('button#add_submit').click(function(event) {
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

                 $('dialog#add_question').hide();
                 }
           }); 

            $('menu button#add_question_btn').click(function(){
                $('dialog#add_question').show();
            });

            $('button#add_cancel').click(function(event){
                event.preventDefault();
                $('#question').val('');
                $('#answer').val("");
                $('#choice1').val("");
                $('#choice2').val("");
                $('#choice3').val("");
                $('#time_allotment').val("");
                $('dialog#add_question').hide();
            });

            // $("#export").click(function(){

            // });

        });   

       

    </script>

    <dialog id="add_question" >
        <form id="add-exam" action="add-exam_details.php" method="post">
            <section>
                <h3>Add Question</h3>
            </section>
        <select id= "add_question_type"  name="question_type">
            <option id="multiple_choice" value="multiple_choice">Multiple Choice</option>
            <option id="true_or_false" value="true_or_false">True or false</option>
            <option id="identification" value="identification">Identification</option>
            <option id="essay_or_enumeration" value="essay_or_enumeration">Essay / Enumeration</option>
        </select><br>
        <input id="time_allotment" type="number" name="time_allotment" placeholder="Enter the number of seconds you want"><br>
        <textarea id="question" name="question" placeholder="Type your question here.."  autocapitalize="sentences" ></textarea><br>
        <textarea id="answer" name="answer" placeholder="type the answer here"></textarea><br>
        <textarea id="choice1" name="choice1" placeholder="type the choice1"></textarea><br>
        <textarea id="choice2" name="choice2" placeholder="type the choice2"></textarea><br>
        <textarea id="choice3" name="choice3" placeholder="type the choice3"></textarea><br>
        <button id="add_submit" name="submit">Add item to exam</button>
        <button id="add_cancel" name="submit">Cancel</button>
     </form>
    </dialog>


    <dialog id="favDialog"> 
        <form id="form-dialog" method="post" action="update-exam_details.php">
            <section>
                <h3>Update Question</h3>
            </section>
            <SECTION>
                 <select name="update_question_type" id="update_question_type">
                    <option id="multiple_choice" value="multiple_choice">Multiple Choice</option>
                    <option id="true_or_false" value="true_or_false">True or false</option>
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


         
        <menu>
            <button><a href="dashboard.php">Back to dashboard</a></button>
            <button id="add_question_btn">Add question</button>
            <button id="refresh">Refresh</button>
        </menu>
     <hr>
     <h3 id="info-message"></h3>
     <div id='exam_details_table'>
        <a href="export_exam.php?exam_id=<?php echo $_GET['exam_id']?>">Download questionaire</a>
        <div>
    <?php   
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
        </div>
     </div>
</body>
</html>