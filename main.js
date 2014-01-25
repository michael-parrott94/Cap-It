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
			Initialize();
		} else if (response.status === 'not_authorized') {
			FB.login();
		} else {
			FB.login();
		}
	});
};

function Initialize() {
	var userId, userName, profilePic;
	
	FB.api('/me', function(response) {
		userId = response.id;
		userName = response.name;
		$("#p0 #name").text(userName);
		
		FB.api('/me/picture', function(response) {
			profilePic = response.data.url;
			$("#p0 img").attr("src", profilePic);
			$("#p0 img").attr("height", "85px");
			$("#p0 img").attr("width", "85px");
			
			$.post("services.php",
			{
				user : "add",
				fb_id : userId,
				fb_name : userName,
				fb_pp : profilePic
			},function(response)
			{
				console.log("userId: " + userId);
				console.log("name: " + userName);
				console.log("profilePic: " + profilePic);
				console.log("-----------------------");
				console.log("AddUser Response: " + response);
			});
		});
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