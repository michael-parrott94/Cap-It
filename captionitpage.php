<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CAP-IT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
  </head>
  
  <body style="background:#4C4646">
    <div id="fb-root"></div>
    <script src="http://code.jquery.com/jquery-2.1.0.js"></script>
    <script src="js/main.js"></script>
    
 
    <h1 style="margin-left:355px; color:white"><big><big><big>JUST CAP-IT DOE</big></big></big></h1>
    <div class="nav-container horizontal" style="clear:both; height: 50px;">
      <div class="link_link" id="menu_1" style="float:left">
        <a href="index.php" style="color:white">Home</a>
      </div>
      <div class="link_link" id="menu_3" style="float:left; margin-left: 10px">
      	<a href="about.php" style="color:white">About Cap-It</a>
      </div>
    </div>
    <div class="container" 
      	style="width:1200px;
      			height:600px;
      			position: relative;
      			border:1px solid #000;
      			background:white">
      	
      <div class="container"
      		style="width:770px;
      			height:570px;
      			position: relative;
      			margin-left: 15px;
      			margin-top: 15px;
      			vertical-align: middle;
      			border:1px solid #000;
      			background:BLACK">
        <img id="bigPic" style="display:block; position:relative; margin:auto; vertical-align:middle; horizontal-align:middle; height:100%;">
      </div>
      <?php
        for($i = 0; $i < 4; $i++) {
      ?>
      <div class="container player" id="p<?php echo $i; ?>"
      		style="width:355px;
      				height:96px;
      				position:relative;
      				float:left;
      				margin-left:800px;
      				margin-top:<?php echo (-570 + $i * 110);  ?>px;">
        <div class="container" 
      	  style="position:relative;
      					 width:85px;
      					 height:85px;
      					 margin-left: 5px;
      					 margin-top: 5px;
      					 background:WHITE">
      	  <img><!--PROFILE PICTURE HERE-->
      	</div>
      	<div class="container" 
      		style="position:relative;
      					 width:225px;
      					 height:50px;
      					 margin-left: 105px;
      					 margin-top: -50px;
      					 background:WHITE"><!--Most recent caption-->
      	  <p id="caption"></p>
      	</div>
      	<div class="container" 
      		style="position:relative;
      					 width:200px;
      					 height:30px;
      					 margin-left: 95px;
      					 margin-top: -85px;"><!--Player Name-->
      	  <font face="century gothic" size="3" id="name"></font>
      	</div>
      	<div class="container" 
      		style="position:relative;
      					 width:50px;
      					 height:30px;
      					 margin-left: 280px;
      					 margin-top: -30px;
      					 background:yellow"><!--Points Count-->
      	  <p id="score"></p>
      	</div>
      </div>
      <? } // For loop ?>
      <div class="container"
      		style="width:385px;
      				height:130px;
      				position:relative;
      				float:left;
      				margin-left:800px;
      				margin-top:-130px;
      				background:#2B547E">
      		<form id="captionSubmit" method="post">
      			<textarea rows="3" cols="50" id="user_caption" name="user_caption" placeholder="Caption..." align="top" maxlength="180"
      				style="position:relative;
      					margin-left:5px;
      					margin-top:5px;
      					height:110px;
      					width:360px"></textarea>
      		<input type="submit" id="submitButton" value="submit"/>
      		<input type="hidden" id="fb_id" name="fb_id" value="" />
      	</form>
      		
      </div>
    </div>
    <script>
      // this is the id of the submit button
      $("#submitButton").click(function(e) {
 
        var url = "services.php"; // the script where you handle the form input.
 
        $.post(url,
        $("#captionSubmit").serialize(), // serializes the form's elements.
        function(data)
        {
        });
                  		
        e.preventDefault(); // avoid to execute the actual submit of the form.
      });
 
    </script>
  </body>
</html>
 
