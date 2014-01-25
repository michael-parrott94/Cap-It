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
	var profilePic;
	
    FB.api('/me/picture?width=140&height=110', function(response) {
		$(document).ready(function(){
			$(".btn1").click(function(){
				location.href = "CaptionItPage.html";
				for (var i=0; i<4; i++) { 
					$("#pp0 img")[0].src = response.data.url;
				}
			});
		});
    });

	// FB.api('/fql?q=SELECT%20src_big%20FROM%20photo%20WHERE%20pid%20IN%20%28SELECT%20pid%20FROM%20photo_tag%20WHERE%20subject%3Dme%28%29%20ORDER%20BY%20created%20ASC%29%20LIMIT%2010',  function(response) {
		// $.each(response.data, function(idx, obj) {
			// console.log(obj.src_big);
			// window.alert(obj.src_big);
			// showImage(obj.src_big, 300, 300, 'You look so cool!');
		// });  
		
	// });
}
 
function showImage(src, width, height, alt) {
    var img = document.createElement("img");
    img.src = src;
    img.width = width;
    img.height = height;
    img.alt = alt;
	img.style.display = "none";

    // This next line will just add it to the <body> tag
    document.body.appendChild(img);
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