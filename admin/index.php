<?php session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title> pds adminstrator PAGE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<style type="text/css">
		body{
			background: radial-gradient(#fd746c,#ff9068);
			background-size: contain;
		}
		button
		{
			width: 20%;
			padding: 1vw;
			background: mediumseagreen;
			border-radius: 1vw;
			border:0.3vw solid white;
			font-size: 1vw;
			font-weight: bold;
			position: relative;
			top: 10vw;
			left: 35%;
			cursor: pointer;
			transition: 0.3s;
			margin-top: 2vw;
		}
		button:hover
		{
			transform: scale(1.1);
		}
		#title
		{
			font-size: 3vw;
			color: white;
			position: relative;
			top: 1vw;
			left: 24%;
			font-family: ac;	
		}
		@font-face
		{
			font-family: ac;
			src:url(fonts/Aclonica.ttf);
		}
	</style>
</head>
<body>
	<span id="title">STATE GOVERNMENT OFFICER</span><br>
<button onclick="window.location='loginadmin.php'">LOGIN</button><br>
<button onclick="window.location='adminregister.php'">REGISTER</button>
</body>
</html>