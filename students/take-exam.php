<?php 
session_start();
error_reporting(-1);
// print_r($_SESSION);
if (!isset($_SESSION['student_room_id'])&&!isset($_SESSION['student_room_name'])&&!isset($_SESSION['student_exam_id'])){
	header('location:dashboard.php');
}else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>OES | Take Exam</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<div id="banner">
		<b>OES - Online Examination System</b>
	</div>

	<script type="text/javascript" src="javascript/jquery-3.3.1.js"></script>
	<script type="text/javascript">	
		$('document').ready(function(){
			var items;
			var answered_items;
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
	                            echo "'".$row->item_choice2."', ";
	                            echo "'".$row->item_choice3."'";
	                            echo "] ";
	                        echo "} ,";
	                        
	                    }
	                //when the loop end we need to specify the last element of items[] array as {end:end}
	                echo "{end : 'end'}";
	                echo "];\n";
	                } else {
	                	// if there is no value the items will be equal to no_val string
	                    echo "no_val";

	                }
	            }
		   		?>


		   	}
///////////end of code for the getting exam ////////////////////////////////////////////////////////////////////


	        getExamItems();


			function getExamItemsAnswered(){
				// the php code will get the exam_details or the exam questions
		   		<?php 
				$sql = "SELECT * FROM `exam_result_details` WHERE room_id = ". $_SESSION['student_room_id'] ." AND student_id=". $_SESSION['student_id'] ;
	            $conn = mysqli_connect("localhost", "root", "", "sad");
	            // Check connection
	            if (!$conn) {
	                die("Connection failed: " . mysqli_connect_error());
	            }else{
	               
	                $result = mysqli_query($conn, $sql);

	                if (mysqli_num_rows($result) > 0) {
	                    $counter = 0;
	                    echo "answered_items = [";
	                    while($row = mysqli_fetch_object($result)) {
	                        echo "{";
	                        echo "item_id : ".$row->item_id."";
	                        echo "} ,";
	                        
	                    }
	                echo "{end : 'end'}";
	                echo "];\n";
	                } else {
	                    echo "answered_items = null;";

	                }
	            }
		   		?>
		   	}

		   	getExamItemsAnswered();

		   	function removeAnsweredItems(argument) {
		   		var counter= 0;
	   			items.forEach(function(item){
		   			for (var i = 0; i < answered_items.length-1; i++) {
		   				if(item.item_id === answered_items[i].item_id){
		   					console.log(item.item_id);
		   					items.splice(counter,1);
		   				}
		   			}


	   				counter++;
	   			});
	   			
		   	}

		   	
	   		if (answered_items == null){}else{
	   			for (var i = 0; i < answered_items.length; i++) {
		   			removeAnsweredItems();
		   		}
	   		}

	   		


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

			items = shuffle(items);


	        for(var i = 0; i< items.length; i++){
	        	if(items[i].end == "end"){

	        	}else{
	        		string_to_be_html = string_to_be_html + "<div class=\"question-div\"> <div class=\"item_id\" style=\"display:none\">"+items[i].item_id+"</div> <div id=\'timer\' class=\'timer "+items[i].item_qtn_type+"\'>"+items[i].item_time_allotment+"</div> <div class=\"question\"><h3>"+items[i].item_qtn+"</h3></div>";
	        		string_to_be_html = string_to_be_html + "";


		   			if(items[i].item_qtn_type == "Multiple_choice"){
		   				var arr = [items[i].item_choices[0], items[i].item_choices[1], items[i].item_choices[2], items[i].item_choices[3]];

		   				arr = shuffle(arr);

		   				string_to_be_html = string_to_be_html + "<form class=\"form\">";
		   				
	  					string_to_be_html = string_to_be_html + "<div><button class=\"" + items[i].item_id + "\">"+ arr[0] + "</button></div>";
						
						string_to_be_html = string_to_be_html + "<div><button class=\"" + items[i].item_id + "\">"+ arr[1] + "</button></div>";
						
						 string_to_be_html = string_to_be_html + "<div><button class=\"" + items[i].item_id + "\">"+ arr[2] + "</button></div>";
						
						 string_to_be_html = string_to_be_html + "<div><button class=\"" + items[i].item_id + "\">"+ arr[3] + "</button></div>";
						string_to_be_html = string_to_be_html + "</form>";
		   			}else if(items[i].item_qtn_type == "True_or_false"){
		   				string_to_be_html = string_to_be_html + "<form class=\"form\">";
		   				
	  					string_to_be_html = string_to_be_html + "<div> <button class=\"\">True</button></div>";
						
						string_to_be_html = string_to_be_html + "<div> <button class=\"\">False</button></div>";
						
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

				var questions = $('.question-div');

				var item_id = parseInt($(questions[slideIndex-1]).find('.item_id').text());;
				var ans;

				if($(questions[slideIndex-1]).find('form').length ){

					if($(questions[slideIndex-1]).find('form.form').has('div').length ) {
						
						ans = $(questions[slideIndex-1]).find('div.selected button').html();

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

			$('form div button').click(function(event){
				event.preventDefault();

				var buttons = $(this).closest("form");

				buttons.children('div').removeClass('selected');
				$(this).closest('div').addClass('selected');
			});


	   		if(items.length == 1){
	   			$(".center").show();
	   		}else{
	   			$(".center").hide();
	   		}

		});
	</script>
	<h5 id="info-message"></h5>
	<div id="main" class="slideshow-container"></div>
<?php 
}

 $sql ="SELECT * FROM rooms where room_id =".$_SESSION['student_room_id'];
$conn = mysqli_connect("localhost", "root", "", "sad");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}else{
   
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_object($result)) {
  		if($row->reviewable == 1){
			echo "<div style=\"display: none;\" class=\"center\">";
 			echo	"<button style=\" margin:auto;\" class=\"review\"><a href=\"review.php\">Review</a></button>";
 			echo "</div>";
  		}

    }
}
}






?>


</body>
</html>







