<!DOCTYPE html>
<html>
<head>
	<title>TESTING</title>
</head>
<body>
	<div id="fb-root"></div>
    <script>
     window.fbAsyncInit = function() {
        FB.init({
          appId      : '1401062393477841',
          status     : true,
          xfbml      : true
        });
    };

	function facebookLogin() {
 
		FB.getLoginStatus(function(response) {
 
			if (response.status === 'connected') {
				// connected
				getProfileImage();
			} else if (response.status === 'not_authorized') {
				//app not_authorized
				FB.login(function(response) {
					if (response && response.status === 'connected') {
						getProfileImage();
					}
				});
			} else {
				// not_logged_in to Facebook
				FB.login(function(response) {
					if (response && response.status === 'connected') {
						getProfileImage();
					}
				});
			}
		}); 
	}	

	  
    (function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js";
        fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
<h1>My First Heading</h1>
<?php echo '<p>Hello World</p>'; ?>

</body>
</html>
    
	