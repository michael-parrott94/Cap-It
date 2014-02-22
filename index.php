<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CAP-IT</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">

    <script src="http://code.jquery.com/jquery-2.1.0.js"></script>
    <script src="js/login.js"></script>
</head>

<body style="background:#4C4646">
    <div id="fb-root"></div>
    <div class="container" style="text-align: center">
        <h1 class="textColour" style="display: none;">JUST CAP-IT DOE</h1>
        <h2 class="textColour" style="display:none;">
            Words with friends, draw my thing, and cards against humanity just had a baby.
        </h2>
        <div class="nav-container horizontal" style="position:relative;">
            <ul> 
                <li id="menu_0">
                    <a href="" onclick="loadGamePage(); return false;" class="textColour">New Game</a>
                </li>
                <li id="menu_1">
                    <a href="index.php" class="textColour">Home</a>
                </li>
                <li id="menu_2">
                    <a href="about.php" class="textColour">About Cap-It</a>
                </li>
            </ul>
        </div>
        <fb:login-button show-faces="true" width="200" max-rows="1" scope="user_photos"></fb:login-button>
    </div>
</body>
</html>
