<!DOCTYPE html>
<html>
 <head>
	 <meta charset="utf-8">
	 <title>What's CAP-IT?</title>
	 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
     <link rel="stylesheet" type="text/css" href="css/styles.css"/>
 </head>

 <body>
    <div style="padding-left:300px" class="siteBackground">
        <?php include 'Templates/header.php'; ?>
	    <dl>
            <dt style="width:580px;" class="textColor">What's Cap-It?</dt>
	        <dd class="textColor" >Cap-It is the product of an epic morphism between Cards Against Humanity, Draw Something, and Words with Friends.</dd>

	        <dt style="width:580px; " class="textColor">How Do You Play?</dt>
	        <dd class="textColor" >Start by finding 3 other friends that all have stupid and jokes pictures on Facebook. Then start a new game of CAP-IT!</dd>
	        <dd class="textColor" >Each round, a random silly picture will appear (with atleast one of you in it), 3 of you will need to come up with a snappy caption</dd>
	        <dd class="textColor" >and the "judge" will pick the best one. Just think cards against humanity, except people will be laughing at how stupid you looked all those years ago...</dd>
	        <dt style="width:580px; " class="textColor">Implementation!</dt>
	        <dd class="textColor" >The user interface was built with HTML incorporated with CSS and Twitter Bootstrap along with javascript and Jquery to make the UI dynamic.</dd>
	        <dd class="textColor" >The back was built with php and javascript on top of a postgres sever to host data. Furthermore there was use of the facebook graph API as well as the </dd>
	        <dd class="textColor" >javascript sdk. All of this lead to an app hosted by heroku to bring friends closer together!</dd>
	        <dt style="width:580px; " class="textColor">The Team.</dt>
	        <dd class="textColor" >Michael J. "The Answer" Parrott</dd>
	        <dd class="textColor" >Andy "Piggy" Au</dd>
	        <dd class="textColor" >Samuel "Wing Man" Yuen</dd>
	        <dd class="textColor" >Si Te "King of the Crisp" Feng</dd>
        </dl>
        <?php echo include 'Templates/footer.php'; ?>
    </div>
 </body>
 </html>
