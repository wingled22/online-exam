<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
</head>
<body>
    <div id="banner">
        <b >OCES - Online Classroom Examination System</b>
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
<script>
    $(document).ready(function() {
        var entryCount = 6;
        var itemId;
        var roomId = [];

        $('#load_more').click(function() {
            entryCount = entryCount+3;
            $('tbody#exams_tbody').load('get-exams.php',{count: entryCount});
            $('#info-message').html('');
        });


        $("#add-exam").click(function(){
            $('dialog#add_Dialog').show();
        });

        $("#cancel").click(function(event){
                    event.preventDefault();
                    $('dialog').hide();
                });

        $("#submit").click(function(event) {
            var title       = $('#exam_title').val();
            var description = $('#exam_description').val();

                    event.preventDefault();
                    $.ajax({
                        url:    'add-exam.php',
                        method: 'post',
                        data: {
                            exam_title      :title,
                            exam_description:description
                        },
                        datatype: 'text',
                        success: function(string){
                            $("#info-message").html(string);
                        }
                    })
            $('dialog#add_Dialog').hide();
        }); 
        
        $('#update_cancel').click(function(event){
            event.preventDefault();
            $('#update_Dialog').hide();
        });

        $('#update_submit').click(function(event){
            event.preventDefault();

            
            var u_title =  $('#update_exam_title').val();
            var u_description =  $('#update_exam_description').val();
            console.log(itemId);
            console.log(u_title);
            console.log(u_description);

            $.ajax({
                        url:    'update_exam.php',
                        method: 'post',
                        data: {
                            exam_id         : itemId,
                            title           : u_title,
                            description     : u_description
                        },
                        datatype: 'text',
                        success: function(string){
                            $("#info-message").html(string);
                        }
                    })
            $('#update_Dialog').hide();

        });

     
        function delete_exam(event){
            event.preventDefault(); 
            itemId = $(this).closest('tr').find('.exam_id').text();          
            console.log(itemId);
            $.ajax({
                url:    'delete-exam.php',
                method: 'post',
                data: {
                    exam_id         : itemId
                },
                datatype: 'text',
                success: function(string){
                    $("#info-message").html(string);
                }
            })
        }

        function update_exam(event) {
            event.preventDefault();
            itemId = $(this).closest('tr').find('.exam_id').text();
            $('#update_Dialog').show();
            $('#update_exam_title').val($(this).closest('tr').find('.exam_title').text());
            $('#update_exam_description').val($(this).closest('tr').find('.exam_description').text());

        }
        $(document).delegate('.delete' , 'click', delete_exam);
        $(document).delegate('.update' , 'click', update_exam);

        $('#add_exam_room').click(function(){
            $('#room_dialog').show();
        });

        $('#add_room_cancel').click(function(){
            $('dialog#room_dialog').hide();
            console.log('sadfasdf');
        });

        $('#add_room_submit').click(function(event) {
            event.preventDefault();
            var r_name;
            r_name = $('#room_name').val();
            if(r_name == ''){
                $("#info-message").html("Ooops! You've enter an empty string please input a proper one.");

            }else{
                $.ajax({
                        url:    'add-exam_room.php',
                        method: 'post',
                        data: {
                            room_name       : r_name
                        },
                        datatype: 'text',
                        success: function(string){
                            $("#info-message").html(string);
                        }
                    })
            
            }

            $('dialog#room_dialog').hide();

        });

        $('.send_to_room').click(function (event) {
            event.preventDefault();
            roomId = $(this).closest('tr').find('.room_id').text();
            console.log(roomId);
            $('#add_exam_to_room_dialog').show();

            $.ajax({
                        url:    'select_populate_exams.php',
                        method: 'post',
                        data: {
                            room_name       : 1
                        },
                        datatype: 'text',
                        success: function(string){
                            $("select#add_exam_to_room_select").html(string);
                        }
                    })
        });

        $('button#room_cancel').click(function(){
             $('dialog#add_exam_to_room_dialog').hide();
        });
        
        $('button#room_submit').click(function(){
            var exam_id_to_room = $('select#add_exam_to_room_select').val();
            if (exam_id_to_room == 'none'){
                alert('The system sense that you don\'t have exams created try to make one and go back to this option when done. Thank you.');
            }else{

                // console.log(exam_id_to_room);
                // console.log(roomId);
                 $.ajax({
                        url:    'add-exam_to_exam_room.php',
                        method: 'post',
                        data: {
                            room_id     : roomId,
                            exam_id     : exam_id_to_room
                        },
                        datatype: 'text',
                        success: function(string){
                            $("#info-message").html(string);
                        }
                    })
                $('#add_exam_to_room_dialog').hide();
            }
            
        });

    });
</script>


<!-- <h1>This is the dashboard</h1> -->
<!-- Simple pop-up dialog box, containing a form -->
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


   <menu>
    <button id="add-exam">Add Exam</button>
    <button><a style="text-decoration:none" href="log-out.php">Logout</a></button>
  </menu>

<hr>
<h5 id="info-message"></h5>

<div id="examsidebar">
    <h5>Exam rooms you created</h5>
    <button id="add_exam_room">Add exam room</button>
    <hr>
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
</div>


<div id="examdiv">
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
                    echo "<button id=\"load_more\"><h3 >Load more exam...</h3></button>";
                    } else {
                        echo "<h2>Try to add exam and refresh the page!</h2>"."<br>";
                        // echo "<button id=\"load_more\"><h5>Load Exam</h5></button>";

                    }

                }
            
        ?>  
            </tbody>
        </table>

</div>



</body>
</html>