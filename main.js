var currentFBUserId = 0;
var isFirstTimeLoop = true;
var gameStarted = false;
var admin;

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

function myLooper()
{
	$.post("services.php",
	{
		user : "all",
	},function(response)
	{
		console.log("Grabbing all the user data in the looper.");
		console.log(response);
		var parsedResponse = $.parseJSON(response);
		if (parsedResponse.length == 4 && !gameStarted)
		{
			startGame(parsedResponse);
			gameStarted = true;
		}		
		for (var i = 0; i < parsedResponse.length; i++)
		{
			$("#p" + i + " #name").text(parsedResponse[i].name); //name
			//profile pic
			$("#p" + i + " img").attr("src", parsedResponse[i].fb_pp);
			$("#p" + i + " img").attr("height", "85px");
			$("#p" + i + " img").attr("width", "85px");
			$("#p" + i + " p").text(parsedResponse[i].caption_text);//caption
			$("#p" + i + " #score").text(parsedResponse[i].scores);//score
		}
		if (isFirstTimeLoop)
		{
			isFirstTimeLoop = false;
			for (var i = 0; i < parsedResponse.length; i++)
			{
				$("#p" + i + " #name").hide().fadeIn(4000);
				$("#p" + i + " img").hide().fadeIn(4000);
			}
		}
	});
}

function startGame(parsedResponse)
{
	console.log("starting game...");
	admin = parsedResponse[0].user_fb_id;
	FB.api('/fql?q=SELECT%20src_big%20FROM%20photo%20WHERE%20pid%20IN%20%28SELECT%20pid%20FROM%20photo_tag%20WHERE%20subject%3D' + admin + '%20ORDER%20BY%20created%20ASC%29%20LIMIT%20100',  function(response) {
		var url = response.data[Math.floor((Math.random()*response.data.length - 1)+1)].src_big;
		$("#bigPic").attr("src", url);
	});
	$("#p0").addClass("adminPlayer");
}

function Initialize() {
	var userId, userName, profilePic;

	FB.api('/me', function(response) {
		userId = currentFBUserId = response.id;
		if(document.getElementById('fb_id'))
		    document.getElementById('fb_id').value = currentFBUserId
		userName = response.name;
		$("#p0 #name").text(userName);
		
		FB.api('/me/picture', function(response) {
			profilePic = response.data.url;
			
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
    
    var looper = setInterval(function(){myLooper()}, 5000);
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
