		$('document').ready(function(){
			var items;
			var string_to_be_html = "";

			function getExamItems(){
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
                    echo "items = [";
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
                echo "{'end' : 'end'}";
                echo "];";
                } else {
                    echo "no_val";
                    // echo "<button id=\"load_more\"><h5>Load Exam details</h5></button>";

                }

            }
	   		?>
		}

	        getExamItems();

	        console.log(items);

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

			// Used like so
			//var arr = [items[0].item_choices[0], items[0].item_choices[1], items[0].item_choices[2], items[0].item_choices[3]];
			// arr = shuffle(arr);
			// console.log(arr);

	        for(var i = 0; i< items.length -1; i++){
	        	string_to_be_html = string_to_be_html + "<div class=\"question\"><h3>"+items[i].item_qtn+"</h3>";
		   			if(items[i].item_qtn_type == "multiple_choice"){
		   				var arr = [items[i].item_choices[0], items[i].item_choices[1], items[i].item_choices[2], items[i].item_choices[3]];
		   				arr = shuffle(arr);
		   				string_to_be_html = string_to_be_html + "<form>";
		   				
	  					string_to_be_html = string_to_be_html + "<div><input type=\'radio\' name=\'" + items[i].item_id + "\' value=\'"+ arr[0] + "\'>" + arr[0] + "</div>";
						
						string_to_be_html = string_to_be_html + "<div><input type=\'radio\' name=\'" + items[i].item_id + "\' value=\'"+ arr[1] + "\'>" + arr[1] + "</div>";
						
						 string_to_be_html = string_to_be_html + "<div><input type=\'radio\' name=\'" + items[i].item_id + "\' value=\'"+ arr[2] + "\'>" + arr[2] + "</div>";
						
						 string_to_be_html = string_to_be_html + "<div><input type=\'radio\' name=\'" + items[i].item_id + "\' value=\'"+ arr[3] + "\'>" + arr[3] + "</div>";
						string_to_be_html = string_to_be_html + "</form>";
		   			}else{
		   				string_to_be_html = string_to_be_html + "<form action=\"\">";
		   				string_to_be_html = string_to_be_html + "<textarea name=\"item[i].item_id\"></textarea>";
						string_to_be_html = string_to_be_html + "</form>";
		   			}
		   		string_to_be_html = string_to_be_html + "</div>";

	        }

	        $('#main').html(string_to_be_html+"<a class=\"next\" onclick=\"plusSlides(1)\">&#10095;</a>");
	        // console.log(items.length-1);

		});