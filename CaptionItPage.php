
<!DOCTYPE html>
 <html>
 <head>
         <meta charset="utf-8">
         <title>CAP-IT</title>
         <link rel="stylesheet" href="http://flip.hr/css/bootstrap.min.css">
         
         <link rel="stylesheet" href="styles.css">
         

 </head>
 
 <body style="background:#4C4646">
 <div id="fb-root"></div>
 <script src="http://code.jquery.com/jquery-2.1.0.js"></script>
 <script src="main.js"></script>
 
          <script>
            // this is the id of the submit button
            $("#submitButton").click(function() {

                var url = "services.php"; // the script where you handle the form input.

                $.post(url,
                   $("#captionSubmit").serialize(), // serializes the form's elements.
                   function(data)
                   {
                   });

                return false; // avoid to execute the actual submit of the form.
            });
         </script>

 <h1 style="margin-left:355px; margin-top:100px; color:white"><big><big><big>JUST CAP-IT DOE</big></big></big></h1>
 <div class="nav-container horizontal" style="margin-left:360px; margin-top: 0px">
	<div class="link_link" id="menu_1" style="float:left">
		<a href="http://benhulse.com/filter/design" target="" name="benhulse"  style="color:white">Home</a>
	</div>
	<div class="link_link" id="menu_2" style="float:left;  margin-left: 10px">
		<a href="http://benhulse.com/filter/design" target="" name="benhulse" style="color:white">View Previous</a>
	</div>
	<div class="link_link" id="menu_3" style="float:left; margin-left: 10px">
		<a href="http://benhulse.com/filter/design" target="" name="benhulse"  style="color:white">About Cap-It</a>
	</div>
</div>
	<div class="container" 
		style="width:1200px;
				height:600px;
				position: relative;
				margin-left: 360px;
				margin-top: 40px;
				vertical-align: middle;
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
				display:table-cell;
				background:BLACK">
				<img id="bigPic" style="display:block; margin:auto; vertical-align:middle; horizontal-align:middle; height:100%; padding-left:0 auto; padding-right:0 auto">
		</div>
		<div class="container player" id="p0"
			style="width:385px;
					height:96px;
					position:relative;
					float:left;
					margin-left:800px;
					margin-top:-570px;">
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
						width:285px;
						height:50px;
						margin-left: 95px;
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
						margin-left: 330px;
						margin-top: -30px;
						background:yellow"><!--Points Count-->
				<p id="score"></p>
			</div>
		</div>
		<div class="container player" id="p1"
			style="width:385px;
					height:96px;
					position:relative;
					float:left;
					margin-left:800px;
					margin-top:-460px;">
			<div class="container"
				style="position:relative;
						width:85px;
						height:85px;
						margin-left: 5px;
						margin-top: 5px;
						background:WHITE"><!--PROFILE PICTURE HERE-->
				<img>
			</div>
			<div class="container" 
				style="position:relative;
						width:285px;
						height:50px;
						margin-left: 95px;
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
						margin-left: 330px;
						margin-top: -30px;
						background:yellow"><!--Points Count-->
				<p id="score"></p>
			</div>
		</div>
		<div class="container player" id="p2"
			style="width:385px;
					height:96px;
					position:relative;
					float:left;
					margin-left:800px;
					margin-top:-350px;">
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
						width:285px;
						height:50px;
						margin-left: 95px;
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
						margin-left: 330px;
						margin-top: -30px;
						background:yellow"><!--Points Count-->
				<p id="score"></p>
			</div>
		</div>
		<div class="container player" id="p3"
			style="width:385px;
					height:96px;
					position:relative;
					float:left;
					margin-left:800px;
					margin-top:-240px;">
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
						width:285px;
						height:50px;
						margin-left: 95px;
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
						margin-left: 330px;
						margin-top: -30px;
						background:yellow"><!--Points Count-->
				<p id="score"></p>
			</div>
		</div>
		<div class="container"
			style="width:385px;
					height:130px;
					position:relative;
					float:left;
					margin-left:800px;
					margin-top:-130px;
					background:#2B547E">
			 <form action="CaptionItPage.php" id="captionSubmit" method="post">
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
 </body>
 </html>
 
