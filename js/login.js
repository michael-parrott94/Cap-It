window.fbAsyncInit = function() {
	FB.init({
		appId      : '1401062393477841',
		channelUrl: '//http://cap-it.herokuapp.com/channel.html', // Channel File
		status     : true, // check login status
		cookie     : true, // enable cookies to allow the server to access the session
		xfbml      : true  // parse XFBML
	});

	// Facebook login 
	FB.Event.subscribe('auth.authResponseChange', function(response) {
		if (response.status === 'connected') {
			Initialize();
		} else if (response.status === 'not_authorized') {
			FB.login();
		} else {
			FB.login();
		}
	});
};
 
 // Animation to fade everything
 function Initialize() {	
	$("h1").hide().fadeIn(4000);
	$("#menu_0").hide().fadeIn(5000);
	$("#menu_1").hide().fadeIn(6000);
	$("#menu_2").hide().fadeIn(7000);
	$("#menu_3").hide().fadeIn(8000);
	$("p").hide().fadeIn(9000);
}

// When "New Game" button is pushed. Takes you to the main game screen
function loadGamePage() {
	$.post("services.php",
	{
		user : "all"
	},function(response)
	{
		console.log($.parseJSON(response).length);
		if ($.parseJSON(response).length == 4)
		{
			window.alert("OOPS. there are bare people in there.");
		} else {
			location.href = "CaptionItPage.php";
		}
	});
}

// Load the SDK asynchronously
(function(d){
var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
if (d.getElementById(id)) {return;}
js = d.createElement('script'); 
js.id = id; 
js.async = true;
js.src = "//connect.facebook.net/en_US/all.js";
ref.parentNode.insertBefore(js, ref);
}(document));
