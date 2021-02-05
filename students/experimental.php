<script type="text/javascript" src="javascript/jquery-3.3.1.js"></script>
<script type="text/javascript">
	 $(document).ready(function(){
	 	
	 	var time = 0;
	 	function starttimer(seconds){
	 		time = seconds;
	 		var timer = setInterval(function(){
	 			$('#timer').text(time);
	 			time -= 1;
	 			if(time == -1){
	 				clearInterval(timer);  
	 				$('#timer').text('time\'s up!!');
	 			}
	 		},1000);

		    	
	 	}

	 	starttimer(5);
	 });




	
</script>

<p id="timer"></p>
<div>
	
</div>

