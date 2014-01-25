<html>
<head>
	<title>Test123</title>
</head>
<body>
<div id="fb-root"></div>
<script src="http://code.jquery.com/jquery-2.1.0.js"></script>
<script>
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1401062393477841',
	channelUrl: '//http://cap-it.herokuapp.com/channel.html', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });

  FB.Event.subscribe('auth.authResponseChange', function(response) {
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
  };
  
  function getProfileImage() {
    var $photo = $('.photo'),
        $btn = $('.btn-fb'),
        $fbPhoto = $('img.fb-photo');
		
    //uploading
    $btn.text('Uploading...');
 
    FB.api("/me/picture?width=180&height=180",  function(response) {
        var profileImage = response.data.url.split('https://')[1], //remove https to avoid any cert issues
            randomNumber = Math.floor(Math.random()*256);
        //remove if there and add image element to dom to show without refresh
        if( $fbPhoto.length ){
            $fbPhoto.remove();
        }
        //add random number to reduce the frequency of cached images showing
        $photo.append('<img class=\"fb-photo img-polaroid\" src=\"http://' + profileImage + '?' + randomNumber + '\">');
        $btn.addClass('hide');
    }); 
}


  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); 
   js.id = id; 
   js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));
</script>
</body>
</html>