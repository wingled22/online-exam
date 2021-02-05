// 	$(document).ready(function(){
// 		var question_type;
//         var u_question_type;
//         var ud_item_id;



//         function opendialog(event) {
//             event.preventDefault();            
//                  ud_item_id = $(this).closest('tr.table-rows').find('td.item_id').text();
//              var ud_time_allotment = $(this).closest('tr.table-rows').find('td.item_time_allotment').text();
//              var ud_question = $(this).closest('tr.table-rows').find('td.item_qtn').text();
//              var ud_answer = $(this).closest('tr.table-rows').find('td.item_answer').text();
//              var ud_choice1 = $(this).closest('tr.table-rows').find('p.item_choice1').text();
//              var ud_choice2 = $(this).closest('tr.table-rows').find('p.item_choice2').text();
//              var ud_choice3 = $(this).closest('tr.table-rows').find('p.item_choice3').text();
        
//              $('#update_question').val(ud_question)
//              $('#update_time_allotment').val(ud_time_allotment)
//              $('#update_answer').val(ud_answer)
//              $('#update_choice1').val(ud_choice1)
//              $('#update_choice2').val(ud_choice2)
//              $('#update_choice3').val(ud_choice3)
//              $('dialog').show();
//         }
        
//          $('.update').click(opendialog);

//         $('.delete').click(function(event){
//             event.preventDefault();
//             ud_item_id = $(this).closest('tr.table-rows').find('td.item_id').text();
//             console.log(ud_item_id);
//             console.log("delete was clicked");
//             $.ajax({
//                         url:    'delete-exam_details.php',
//                         method: 'post',
//                         data: {
//                             item_id : ud_item_id
//                         },
//                         datatype: 'text',
//                         success: function(string){
//                             $('#info-message').html(string);
//                         }
//                     });

//         });

       
//         $('#cancel').click(function(event){
//             event.preventDefault();
//             $('#update_question').val("")
//             $('#update_time_allotment').val("")
//             $('#update_answer').val("")
//             $('#update_choice1').val("")
//             $('#update_choice2').val("")
//             $('#update_choice3').val("")
//             $('dialog').hide();

//         });

//         $('select').click(function(){
//             if ($("select#add_question_type").val() == 'multiple_choice') {
//                 question_type = 'multiple_choice';
//                 console.log(question_type);
//                 $('#choice1').show();
//                 $('#choice2').show();
//                 $('#choice3').show();
//             }else if ($("select#add_question_type").val() == 'essay_or_enumeration') {
//                 question_type = 'essay_or_enumeration';
//                 console.log(question_type);
//                 $('#choice1').hide();
//                 $('#choice2').hide();
//                 $('#choice3').hide();
//             }else if($("select#add_question_type").val() == 'identification'){
//                 question_type = 'identification';
//                 console.log(question_type);
//                 $('#choice1').hide();
//                 $('#choice2').hide();
//                 $('#choice3').hide();
//             }

//         });

//         $('select#update_question_type').click(function(){
//             if ($("select#update_question_type").val() == 'multiple_choice') {
//                 u_question_type = 'multiple_choice';
//                 console.log('multiple_choice was clicked');
//                 $('#update_choice1').show();
//                 $('#update_choice2').show();
//                 $('#update_choice3').show();
//             }else if ($("select#update_question_type").val() == 'essay_or_enumeration') {
//                 u_question_type = 'essay_or_enumeration';
//                 console.log('essay_or_enumeration was clicked');
//                 $('#update_choice1').hide();
//                 $('#update_choice2').hide();
//                 $('#update_choice3').hide();
//             }else if($("select#update_question_type").val() == 'identification'){
//                 u_question_type = 'identification';
//                 console.log('identification was clicked');
//                 $('#update_choice1').hide();
//                 $('#update_choice2').hide();
//                 $('#update_choice3').hide();
//             }
//         });


//         $('#update_submit').click(function(event){
//             event.preventDefault();

//             var u_item_id             = ud_item_id;
//             var u_item_qtn_type       = $('#update_question_type').val();
//             var u_item_qtn            = $('#update_question').val();
//             var u_item_answer         = $('#update_answer').val();
//             var u_choice1             = $('#update_choice1').val();
//             var u_choice2             = $('#update_choice2').val();
//             var u_choice3             = $('#update_choice3').val();
//             var u_item_time_allotment = $('#update_time_allotment').val();

//             if(u_item_qtn_type == 'multiple_choice'){
//                  $.ajax({
//                         url:    'update-exam_details.php',
//                         method: 'post',
//                         data: {
//                             item_id             :u_item_id, 
//                             item_qtn_type       :u_item_qtn_type, 
//                             item_qtn            :u_item_qtn, 
//                             item_answer         :u_item_answer, 
//                             choice1             :u_choice1,
//                             choice2             :u_choice2, 
//                             choice3             :u_choice3,
//                             item_time_allotment :u_item_time_allotment,
//                             submit              :'submit'
//                         },
//                         datatype: 'text'/*,
//                         success: function(string){
//                             $('#info-message').html(string);
//                         }*/
//                     });
//             }else if (u_item_qtn_type == 'identification' || u_item_qtn_type == 'essay_or_enumeration') {
//                  $.ajax({
//                         url:    'update-exam_details.php',
//                         method: 'post',
//                         data: {
//                             item_id             :u_item_id, 
//                             item_qtn_type       :u_item_qtn_type, 
//                             item_qtn            :u_item_qtn, 
//                             item_answer         :u_item_answer, 
//                             choice1             :'',
//                             choice2             :'', 
//                             choice3             :'',
//                             item_time_allotment :u_item_time_allotment,
//                             submit              :'submit'
//                         },
//                         datatype: 'text'/*,
//                         success: function(string){
//                             $('#info-message').html(string);
//                         }*/
//                     });
//             }
//             $('dialog').hide(); 
//              $('#exam_details_table').load('load-exam_details.php',{loadnow: true});
//         });

// });
