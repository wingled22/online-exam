    $(document).ready(function() {
        var entryCount = 6;
        var itemId;
        var roomId = [];

        function loadMore() {
            entryCount = entryCount+3;
            $('tbody#exams_tbody').load('get-exams.php',{count: entryCount});
            $('#info-message').html('');
        }

        function addExam(){
            $('dialog#add_Dialog').show();
        }
        
        function cancel(event){
                            event.preventDefault();
                            $('dialog').hide();
        }

        
        function submit(event) {
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
        }


        function delete_exam(event){
            event.preventDefault(); 
            itemId = $(this).closest('tr').find('.exam_id').text();          
            // console.log(itemId);
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
        
        function updateCancel(event){
            event.preventDefault();
            $('#update_Dialog').hide();
        }

        function updateSubmit(event){
            event.preventDefault();

            
            var u_title =  $('#update_exam_title').val();
            var u_description =  $('#update_exam_description').val();
            // console.log(itemId);
            // console.log(u_title);
            // console.log(u_description);

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
        }

        $(document).delegate('.delete' , 'click', delete_exam);
        $(document).delegate('#submit' , 'click', submit );
        $(document).delegate('#cancel' , 'click', cancel );
        $(document).delegate('#add-exam' , 'click', addExam );
        $(document).delegate('#load_more' , 'click', loadMore );
        $(document).delegate('.update' , 'click', update_exam);
        $(document).delegate('#update_cancel' , 'click', updateCancel );
        $(document).delegate('#update_submit' , 'click', updateSubmit );

        function addExamRoom(){
            $('#room_dialog').show();
        }


        function addRoomCancel(){
            $('dialog#room_dialog').hide();
        }



        function addRoomSubmit(event) {
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
        }

        function sendToRoom(event) {
            event.preventDefault();
            roomId = $(this).closest('tr').find('.room_id').text();
            // console.log(roomId);
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
        }



        function activateRoom(event) {
            event.preventDefault();
            roomId = $(this).closest('tr').find('.room_id').text();
            // console.log(roomId);

            $.ajax({
                        url:    'activate_room.php',
                        method: 'post',
                        data: {
                            room_id : roomId
                        },
                        datatype: 'text',
                        success: function(string){
                           $("#info-message").html(string);
                        }
                    })
        }


        function deactivateRoom(event) {
            event.preventDefault();
            roomId = $(this).closest('tr').find('.room_id').text();
            // console.log(roomId);

            $.ajax({
                        url:    'deactivate_room.php',
                        method: 'post',
                        data: {
                            room_id : roomId
                        },
                        datatype: 'text',
                        success: function(string){
                           $("#info-message").html(string);
                        }
                    })
        }

        

        function roomCancel(){
             $('dialog#add_exam_to_room_dialog').hide();
        }

        function roomSubmit(){
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
            
        }

       
        function reviewable_on(event) {
            event.preventDefault();
            roomId = $(this).closest('tr').find('.room_id').text();
            console.log(roomId);

            $.ajax({
                        url:    'reviewable_on.php',
                        method: 'post',
                        data: {
                            room_id : roomId
                        },
                        datatype: 'text',
                        success: function(string){
                           $("#info-message").html(string);
                        }
                    })
        }


        function reviewable_off(event) {
            event.preventDefault();
            roomId = $(this).closest('tr').find('.room_id').text();
            console.log(roomId);

            $.ajax({
                        url:    'reviewable_off.php',
                        method: 'post',
                        data: {
                            room_id : roomId
                        },
                        datatype: 'text',
                        success: function(string){
                           $("#info-message").html(string);
                        }
                    })
        }


        $(document).delegate('#add_exam_room' , 'click', addExamRoom);
        $(document).delegate('#add_room_cancel' , 'click', addRoomCancel);
        $(document).delegate('#add_room_submit' , 'click', addRoomSubmit);
        $(document).delegate('.send_to_room' , 'click', sendToRoom);
        $(document).delegate('.activate_room' , 'click', activateRoom);
        $(document).delegate('.deactivate_room' , 'click', deactivateRoom);
        $(document).delegate('button#room_cancel' , 'click', roomCancel);
        $(document).delegate('button#room_submit' , 'click', roomSubmit);

        $(document).delegate('.reviewable_on' , 'click', reviewable_on);
        $(document).delegate('.reviewable_off' , 'click', reviewable_off);
        

        function hideFirstTD(){
            // console.log($("div.tabs-content div:visible table thead tr th:first"));
            $("div.tabs-content div:visible table thead tr th:first").addClass("hidden");
            $("div.tabs-content div:visible table tbody tr").each(function () {
                // console.log();
                $(this).find("td.exam_id").addClass("hidden");
            });
        }

        //events when the tab is click
        function loadExams(){
             $('#exam-content').load('load-exam_content.php');
             $('#info-message').html('');
             hideFirstTD();
        }

        $('.tabs button#exam-tab').click(loadExams);


        function loadRooms(){
             $('#room-content').load('load-room_content.php');
             $('#info-message').html('');
             hideFirstTD();

        }

         $('.tabs button#room-tab').click(loadRooms);

        function loadResults(){
             $('#result-content').load('load-result_content.php');
             $('#info-message').html('');
             hideFirstTD();

        }

        $('.tabs button#result-tab').click(loadResults);






    });