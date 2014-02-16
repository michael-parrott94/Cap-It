var currentFBUserId = 0;
var isFirstTimeLoop = true;
var gameStarted = false;
var admin;
var FBId;
var playerFBIds = {};
var numCaptions;
var numPlayers;
var looper;

$(document).ready(function() {
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

	$('.container.player').click(function (){
		var id = $(this).attr('id');
		var score = parseInt($('#' + id + ' #score').text()) + 10;
		window.alert($('#' + id + ' #name').text() + ' gets 10 points! \n He now has ' 
			+ score + ' points!');
		/*
		$.post("services.php",
		{
			'score': score,
			'fb_id': 
		} */
	});

	// Main looper for every second
	function myLooper()
	{
		$.post("services.php",
		{
			user : "all",
		},function(response)
		{
			var parsedResponse = $.parseJSON(response);
			var newNumPlayers = parsedResponse.length;
			if (isFirstTimeLoop) // Fade in all if it's first time
			{
				isFirstTimeLoop = false;
				numPlayers =  newNumPlayers;
				for (var i = 0; i < newNumPlayers; i++)
				{
					$('#p' + i + ' #name').text(parsedResponse[i].name); //name
					$('#p' + i + ' img').attr('src', parsedResponse[i].fb_pp); // profile pic
					$('#p' + i + ' img').attr('height', '85px');
					$('#p' + i + ' img').attr('width', '85px');
					if (i == 0) 
					{
						$('#p' + i + ' p').text('======ADMIN======'); //caption for the admin
					}
					$('#p' + i + ' #score').text(parsedResponse[i].scores);//score

					// Fade in 
					$('#p' + i + ' #name').hide().fadeIn(4000);
					$('#p' + i + ' img').hide().fadeIn(4000);
					$('#p' + i + ' #score').hide().fadeIn(4000);
				}
			} 
			else 
			{
				if (newNumPlayers == 4 && !gameStarted) // when 4 players have joined (start game)
				{
					startGame(parsedResponse);
					gameStarted = true;
				}		
				if (newNumPlayers < 4 && gameStarted) // remove name/pic/etc when there are less players
				{
					gameStarted = false;
					for (var i = 3; i >= newNumPlayers; i--)
					{
						$('#p' + i + ' #name').hide();
						$('#p' + i + ' img').hide();
						$('#p' + i + ' p').hide();
						$('#p' + i + ' #score').hide();
					}
				}
				if (newNumPlayers > numPlayers) // if there are newly joined players
				{
					for (var i = numPlayers; i < newNumPlayers; i++)
					{
						// Fade in
						$('#p' + i + ' #name').hide().fadeIn(4000);
						$('#p' + i + ' img').hide().fadeIn(4000);
					}
				}
				for (var i = 0; i < newNumPlayers; i++)
				{
					$('#p' + i + ' #name').text(parsedResponse[i].name).show(); //name
					//profile pic
					$('#p' + i + ' img').attr('src', parsedResponse[i].fb_pp).show();
					$('#p' + i + ' img').attr('height', '85px');
					$('#p' + i + ' img').attr('width', '85px');
					if (i == 0) 
					{
						$('#p' + i + ' p').text('======ADMIN======').show(); //caption for the admin
					} else {
						$('#p' + i + ' p').text(parsedResponse[i].caption_text).show();//caption
						if (parsedResponse[i].caption_text != "") numCaptions++;
					}
					$('#p' + i + ' #score').text(parsedResponse[i].scores).show();//score
				}

				if (numCaptions == 3) // When all 3 captions are submitted
				{
					adminPickWinner();
				}

				numCaptions = 0; // reset number of captions
				numPlayers = newNumPlayers;
			}
		});
	}

	function adminPickWinner()
	{
		clearInterval(looper);
		if (admin == FBId)
		{
			window.alert("Admin, click on the person you think has the best caption!");
				$('.container.player').click(function (){
					var id = $(this).attr('id');
					window.alert($('#' + id + ' #name').text() + ' gets 10 points!');
					//TO DO : update score 
					looper = setInterval(function(){myLooper()}, 1000);
				});
		}
		else
		{
			window.alert("It's time for admin to pick who the winner is!");
		}
	}

	function Initialize() {
		var userName, profilePic;

		FB.api('/me', function(response) {
			FBId = currentFBUserId = response.id;
			if(document.getElementById('fb_id'))
			    document.getElementById('fb_id').value = currentFBUserId
			userName = response.name;
			// $("#p0 #name").text(userName);
			
			FB.api('/me/picture', function(response) {
				profilePic = response.data.url;
				
				$.post("services.php",
				{
					user : "add",
					fb_id : FBId,
					fb_name : userName,
					fb_pp : profilePic
				},function(response)
				{
					console.log("userId: " + FBId);
					console.log("name: " + userName);
					console.log("profilePic: " + profilePic);
					console.log("-----------------------");
					console.log("AddUser Response: " + response);
				});
			});
	    });
	    
	    looper = setInterval(function(){myLooper()}, 1000);
	}

	function startGame(parsedResponse)
	{
		console.log("starting game...");
		admin = parsedResponse[0].user_fb_id;
		for (var i = 1; i < 4; i++)
		{
			var id = 'p' + i;
			playerFBIds[id] = parsedResponse[i].user_fb_id;
		}
		window.alert("p1 = " + playerFBIds['p1'] "/n" + 
					 "p2 = " + playerFBIds['p2'] "/n" +
					 "p3 = " + playerFBIds['p3'] "/n" +  )

		//TO DO: Check if there's already a BIG picture on database
		FB.api('/fql?q=SELECT%20src_big%20FROM%20photo%20WHERE%20pid%20IN%20%28SELECT%20pid%20FROM%20photo_tag%20WHERE%20subject%3D' + admin + '%20ORDER%20BY%20created%20ASC%29%20LIMIT%20100',  function(response) {
			var url = response.data[Math.floor((Math.random()*response.data.length - 1)+1)].src_big;
			console.log(url);
			$('#bigPic').attr('src', url);
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
});