<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>CAP-IT</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
  </head>
  
  <body>
    <div id="fb-root"></div>
    <script src="http://code.jquery.com/jquery-2.1.0.js"></script>
    <script src="js/main.js"></script>
    
    <div class="container">
        <header> 
            <h1 class="textColour">Just Cap It</h1>
            <ul class="list-inline">
                <li id="menu_1"><a href="index.php">Home</a></li>
                <li id="menu_3"><a href="about.php">About</a></li>
            </ul>
        </header>
        <div class="row" style="height: 700px; background-color: white">
            <div class="col-md-8" style="background-color: black; height: 680px; margin: 5px; box-sizing: border-box;">
                <img id="bigPic" style="display: block; margin: 0 auto"></img>
            </div>
            <div class="col-md-3">
            <?php for($i = 0; $i < 4; $i++) { ?>
                <div id="p<?php echo $i; ?>" style="background-color: #2B547E; height: 120px; clear:both; margin-bottom: 30px;" class="player">
                    <img style="float:left;"/> 
                    <font id="name" style="background-color: orange;"></font>
                    <p id="score" style="background-color: yellow"></p>
                    <p id="caption" style="height: 50px; background-color: white; margin: 0px 2px;">Content</p>
                </div>
            <?php } ?>
           <div class="container"
      		style="width:305px;
      				height:120px;
      				background:#2B547E">
      		<form id="captionSubmit" method="post">
      			<textarea rows="3" cols="50" id="user_caption" name="user_caption" placeholder="Caption..." align="top" maxlength="180"
      				style="height:110px;
      					width:360px"></textarea>
      		<input type="submit" id="submitButton" value="submit"/>
      		<input type="hidden" id="fb_id" name="fb_id" value="" />
      	</form>
      		
      </div>
    </div>

    <div class="console" 
          style="border:1px solid red;
                background:white;
                width:50%;
                height:100px;
                display:box;
                box-orient:horizontal;
                box-pack:center;
                box-align:center;
                overflow-y: scroll">
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
            </div>
        </div>
    </div>
  </body>
</html>
 
