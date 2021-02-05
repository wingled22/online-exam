<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/dummy-dashboard.css">
</head>
<body>

<script type="text/javascript">

        document.getElementById('room-tab').click(function(){
            document.getElementById('exam-content').setAttribute("style", "display: hidden;");
            document.getElementById('result-content').setAttribute("style", "display: hidden;");
            document.getElementById('room-content').setAttribute("style", "display: block;");
        });

</script>



    <div id="banner">
        <b >OCES - Online Classroom Examination System</b>
    </div>
<hr>
<h5 id="info-message"></h5>

<div class="center container">
    <div class="tabs">
        <div id="exam-tab">   Exam</div>
        <div id="room-tab">   Room</div>
        <div id="result-tab"> Result</div>
    </div>
    <div class="tabs-content">
        <div id="exam-content" >
        //content for exam tab
            
        </div>

        <div id="room-content" style="display: none">
        //content for room tab
            
        </div>
        
        <div id="result-content" style="display: none">
        //content for result tab
            
        </div>
    </div>
</div>

</body>
</html>