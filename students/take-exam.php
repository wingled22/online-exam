<?php 
session_start();
// print_r($_SESSION);
if (!isset($_SESSION['student_room_id'])&&!isset($_SESSION['student_room_name'])&&!isset($_SESSION['student_exam_id'])){
	header('location:dashboard.php');
}else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>OCES | Take Exam</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<div id="banner">
		<b>OCES - Online Classroom Examination System</b>
	</div>

	<script type="text/javascript" src="javascript/jquery-3.3.1.js"></script>
	<script type="text/javascript">	
		$('document').ready(function(){
			var items;
			var string_to_be_html = "";


			//this is a combination of javascript and php
			// the purpose of this method is to get the exam question and store it to a
			// javascript variable


///////////code for the getting exam ////////////////////////////////////////////////////////////////////
			function getExamItems(){

			// the php code will get the exam_details or the exam questions
	   		<?php 
			$sql ="SELECT * FROM exam_details WHERE exam_id=".$_SESSION['student_exam_id'];
            $conn = mysqli_connect("localhost", "root", "", "sad");
            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }else{
               
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $counter = 0;
                    //make a javascript variable using php and name it as items, type array of object
                    echo "items = [";
                    // loop so that we can store all the exam details to the items[{}]
                    while($row = mysqli_fetch_object($result)) {
                        echo "{";
                        echo "item_id : ".$row->item_id.", ";
                        echo "item_qtn_type : '".$row->item_qtn_type."', ";
                        echo "item_time_allotment : ".$row->item_time_allotment.", ";
                        echo "item_qtn : '".$row->item_qtn."', ";
                        echo " item_choices : [";
                            echo "'".$row->item_answer."', ";
                            echo "'".$row->item_choice1."', ";
                            echo "' ".$row->item_choice2."', ";
                            echo "'".$row->item_choice3."'";
                            echo "] ";
                        echo "} ,";
                        
                    }
                //when the loop end we need to specify the last element of items[] array as {end:end}
                echo "{end : 'end'}";
                echo "];";
                } else {
                	// if there is no value the items will be equal to no_val string
                    echo "no_val";

                }
            }
	   		?>}
///////////end of code for the getting exam ////////////////////////////////////////////////////////////////////


			//use the getExamItems method
	        getExamItems();
	        //after calling this method the items[{}] was created




///////////code for the shuffle //////////////////////////////////////////////////////////////////// 	        
	        function shuffle(array) {
				var currentIndex = array.length, temporaryValue, randomIndex;

				// While there remain elements to shuffle...
				while (0 !== currentIndex) {
					// Pick a remaining element...
					randomIndex = Math.floor(Math.random() * currentIndex);
					currentIndex -= 1;

					// And swap it with the current element.
					temporaryValue = array[currentIndex];
					array[currentIndex] = array[randomIndex];
					array[randomIndex] = temporaryValue;
				}

				return array;
			}
///////////end for the shuffle //////////////////////////////////////////////////////////////////// 

			//to make all the items shuffled call the shuffle() method and add items
			//as a parameter shuffle(items); and store it on the items[] and this time 
			//the items var was shuffled
			items = shuffle(items);

			//make all of the items[] elements print on the screeen!!!!!
			//first the gameplan is to make thme as a one string variable and then
			//print them to the screen using jQuery .html() method.

///////////////convert the element to be a string/////////////////////////////////////////////////////////////////////
			//so make a loop that read the items[] elements and store them on the string;
	        for(var i = 0; i< items.length; i++){
	        	if(items[i].end == "end"){

	        	}else{
	        		string_to_be_html = string_to_be_html + "<div class=\"question-div\"> <div class=\"item_id\" style=\"display:none\">"+items[i].item_id+"</div> <div id=\'timer\' class=\'timer "+items[i].item_qtn_type+"\'>"+items[i].item_time_allotment+"</div> <div class=\"question\"><h3>"+items[i].item_qtn+"</h3></div>";
	        		string_to_be_html = string_to_be_html + "";


		   			if(items[i].item_qtn_type == "multiple_choice"){
		   				var arr = [items[i].item_choices[0], items[i].item_choices[1], items[i].item_choices[2], items[i].item_choices[3]];

		   				arr = shuffle(arr);

		   				string_to_be_html = string_to_be_html + "<form class=\"form\">";
		   				
	  					string_to_be_html = string_to_be_html + "<div><input type=\'radio\' class=\'input\' name=\'" + items[i].item_id + "\' value=\'"+ arr[0] + "\'>" + arr[0] + "</div>";
						
						string_to_be_html = string_to_be_html + "<div><input type=\'radio\' class=\'input\' name=\'" + items[i].item_id + "\' value=\'"+ arr[1] + "\'>" + arr[1] + "</div>";
						
						 string_to_be_html = string_to_be_html + "<div><input type=\'radio\' class=\'input\' name=\'" + items[i].item_id + "\' value=\'"+ arr[2] + "\'>" + arr[2] + "</div>";
						
						 string_to_be_html = string_to_be_html + "<div><input type=\'radio\' class=\'input\' name=\'" + items[i].item_id + "\' value=\'"+ arr[3] + "\'>" + arr[3] + "</div>";
						string_to_be_html = string_to_be_html + "</form>";
		   			}else{
		   				string_to_be_html = string_to_be_html + "<form class=\"form\"> <textarea id = \'"+"textarea"+"\'name=\'\' placeholder=\'type your answer here\'></textarea>";
						string_to_be_html = string_to_be_html + "</form>";
		   			}
		   		string_to_be_html = string_to_be_html + "</div>";
	        	}

	        }
///////////////end convert the element to be a string//////////////////////////////////////////////////////////

	        //once the loop was done make print them on the 
	        $('#main').html(string_to_be_html+"<a class=\"next\" >&#10095;</a>");
///////////code for the slide show of exam //////////////////////////////////////////////////////////////////// 
	        var slideIndex = 1;
	        var timer;

			showSlides(slideIndex);
			$('.next').click(function () {
				clearInterval(timer);
				send_answer();
				showSlides(slideIndex += 1);
			});
			
			function currentSlide(n) {
			  showSlides(slideIndex = n);
			}

			function showSlides(n) {
			  var i;
			  var slides = document.getElementsByClassName("question-div");

			  if (n == slides.length) {
			  	$('.next').html('<button id=\'finish_exam\'><a href=\'check_exam_results.php\'>Finish!</a></button>');
			  } 

			  if(n > slides.length){
			  	$('.next').hide();	
			  }

			  if (n < 1) {slideIndex = slides.length}
			  for (i = 0; i < slides.length; i++) {
			    slides[i].style.display = "none"; 
			  }
			 
			  if(slideIndex > slides.length){

			  }else{
			  	slides[slideIndex-1].style.display = "block";

			  	// console.log(slides[slideIndex-1]);
			///////////code for timer  //////////////////////////////////////////////////////////////////// 
			 	function starttimer(seconds){
		        var time = 0;
		 		time = seconds;
		 		//use setInterval method for countdown 
		 		timer = setInterval(function(){		 			
		 			//get the value of the timer in seconds that was stored on .timer class
		 			$(slides[slideIndex-1]).find( ".timer" ).text(time);
		 			//time -= 1;
		 			--time;


		 			//need to check if the timer hits zero there will be no answer to be get from the students
		 			if(time == -1){
		 				//use clearinterval to stop the timer
		 				clearInterval(timer);  

		 				if($(slides[slideIndex-1]).find("#timer").hasClass('multiple_choice') == true){
		 					$(slides[slideIndex-1]).find("form").remove();
		 				}else{
		 					$(slides[slideIndex-1]).find("form").remove();
		 				}
		 			}else{

		 			}
		 		},900);
		 		}
		 		var parsed_sec = parseInt($(slides[slideIndex-1]).find( ".timer" ).text());

		 		starttimer(parsed_sec);
			////////////end of timer  //////////////////////////////////////////////////////////////
			  } 

			}
////////////end of the slideshow of the exam//////////////////////////////////////////////////////////////



			function send_answer() {
				console.log('send_answer');


				var questions = $('.question-div');

				var item_id = parseInt($(questions[slideIndex-1]).find('.item_id').text());;
				var ans;
				if($(questions[slideIndex-1]).find('form').length ){

					if($(questions[slideIndex-1]).find('form.form').has('div').length ) {
						
						ans = $(questions[slideIndex-1]).find('div input.input:checked').val();
						if(ans == undefined){
							ans=""
						}	
					}else{
						ans = $(questions[slideIndex-1]).find('textarea').val();					
					}
				}else{
					ans = '';
				}

				console.log(item_id +' : '+ ans);

				$.ajax({
                        url:    'send_answer.php',
                        method: 'post',
                        data: {
                            student_id 		:<?php echo $_SESSION['student_id'];?>,
                            room_id 		:<?php echo $_SESSION['student_room_id'];?>,
                            item_id 		:item_id,
                            answer 			:ans
                        },
                        datatype: 'text',
                        success: function(string){
                        }
                });

				
			}






/////////code for finish exam  ////////////////////////////////////////////////////////////////////
		// $('a.next').delegate('#finish_exam','click', function(){
		// 		$.ajax({
  //                       url:    'check_exam_results.php',
  //                       method: 'post',
  //                       datatype: 'text',
  //                       success: function(string){
  //                       	$.ajax({
		// 	                        url:    'check_exam_results.php',
		// 	                        method: 'post',
		// 	                        datatype: 'text',
		// 	                        success: function(string){
		// 	                        $('#info-message').html(string);    
		// 	                        }
		// 	                })
                            
  //                       }
  //               });		
		// });
/////////code for finish exam////////////////////////////////////////////////////////////////////





		});
	</script>
	
	<h5 id="info-message"></h5>
	<div id="main" class="slideshow-container">
		
	</div>
 
</body>
</html>
























<?php 
}
?>


