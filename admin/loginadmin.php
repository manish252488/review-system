<?php session_start(); ?>
<?php
$servername=$_SERVER["SERVER_NAME"];
 $username="manish25";
 $pass="1997";
 $dbname="reviewsystem";
 $conn=mysqli_connect($servername,$username,$pass,$dbname);
 if(!$conn)
 	echo "<script>window.location='errors/error.html';</script>";
 $_SESSION["userid"]="";
$_SESSION["pass"]="";
if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
$id=$_POST["id"];
$psw=$_POST["psw"];
mysqli_real_escape_string($conn,$id);
	$sql="SELECT password FROM pdsadminstrator WHERE id='$id'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		$pass=$row[0];
		if ($pass==$psw) 
		{
			$_SESSION["userid"]=$id;
			$_SESSION["pass"]=$pass;
			$script="<script>window.location='adminpanel.php'</script>";
			echo $script;

		}
		else
{
	$script="<script>alert('wrong password')</script>";
	echo $script;
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<style>
	body
	{
		background:linear-gradient(to right, lightgrey, burlywood, darkgrey);
		background-size: contain;
		background-blend-mode: hard-light;
	}
	header
{
	width: 100% auto;
	background: linear-gradient(to right, #000046, #1cb5e0);
    position: relative;
	top: 0;
	left: 0;
	box-shadow: 0.1vw 0.2vw 0.3vw white;
	padding-top: 2vw;
	padding-bottom: 2vw;
	padding-right: 1vw;
	padding-left: 0.5vw;
}

	#logform
	{  
    background:linear-gradient(180deg,darkorange,white,green);
    width: 40%;
	font-size: 1vw;
	color: black;
	font-family: title;
	font-weight: bold;
	position: relative;
	left:27%;
	top:0vw;
	padding: 4vw;
	border:0.2vw white opacity:0.5;
	box-shadow: 0.5vw 0.5vw 0.5vw white;
	opacity: 0.7;
}
	@font-face
{
	font-family: title;
	src:url('fonts/Aclonica.ttf');

}
@font-face
{
	font-family: title1;
	src:url('fonts/Damion.ttf');

}
@font-face
{
	font-family: iceberg;
	src:url('fonts/Iceberg.ttf');
}

#block1
{
	font-family: title;
	font-size: 4vw;
	color: mediumseagreen;
	text-shadow: 0.1vw 0.2vw 0.1vw #333;
	padding: 0.5vw;
	position: relative;
	top: 0;
	left: 0;
	display: inline-block;
}
#a001
{
font-size: 1.7vw;
font-family: title1;
color: #ddd;
text-shadow: none;
text-decoration: underline white;
margin-left: 14vw;
position: relative;
top: 0;
}
#home
{
	width: 3vw;
	cursor: pointer;
	position: relative;
	left: 45%;
	top: 1vw;
	margin-right: 1vw;
}
#home:hover
{
	transform: scale(1.1);
	border:0.2vw solid white;
	box-shadow: 0.2vw 0.2vw 0.5vw black;
	border-radius: 50%;
}
#icon1
{
	
	width: 7vw;
	height: 7vw;
	background-color: white;
	position: relative;
	top: 0.5vw;
	left: 0.5vw;
	display: inline-block;
	border-radius: 50%;
}

#block1
{
	font-family: title;
	font-size: 4vw;
	color: mediumseagreen;
	text-shadow: 0.1vw 0.2vw 0.1vw #333;
	padding: 0.5vw;
	position: relative;
	top: 0;
	left: 0;
	display: inline-block;
}
#a001
{
font-size: 1.7vw;
font-family: title1;
color: #ddd;
text-shadow: none;
text-decoration: underline white;
margin-left: 14vw;
position: relative;
top: 0;
}
#icon
{
	width: 15vw;
	height: 15vw;
	overflow: hidden;
	border-radius: 50%;
	border: 0.2vw solid black;
    position: relative;
    top: 0;
    left:42%;
    margin-top: 1vw; 
    box-shadow: 0.1vw 0.1vw 0.5vw black;
}
input[type=text],input[type=password]
{
	width: 20vw;
	height: 2vw;
	border-radius: 0.3vw;
	border: 0.2vw solid tomato;
	margin-bottom: 2vw;
	font-size: 1.7vw;
}

#load
{
	width: 100%;
	height: 100%;
	background: white;
	position: fixed;
	top: 0;
	left: 0;
	cursor: not-allowed;
		z-index: 1;
		display: none;
		overflow: hidden;
}
#loading
{
	width: 30%;
	position: fixed;
	top: 17%;
	left: 34%;

}
#sid001
{
	position: relative;
	left: 53%;
	color: white;
	font-size: 1.2vw;
	font-family:iceberg;
}
#btt121
{
	position: relative;
	left: 54%;
}
input[type=submit],#btt121
{
	padding: 0.5vw;
	color: white;
	background: mediumseagreen;
	border: 0.2vw solid white;
	font-weight: bold;
	cursor: pointer;
}


</style>
</head>
<header><img id="icon1" src="ico/mainpg.png">
    <div id="block1">AWARE INDIA<span style="color:tomato">!</span><div id="a001">A vision of corruption free India.</div></div>
</header>

	<body onload="show_loading()">
  <div id="load"><img src="onload/loading.gif" id="loading"></div>
		<img id="icon" src="images/8.png"><br> <span id="sid001">Not registered??</span><button id="btt121" onclick="window.location='registerpage.html';">Register</button>
	<div id="logform">
	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
		Id<br><input type="text" name="id"><br><br>
		Password<br><input type="password" name="psw"><br><br>
		<input type="submit" value="LOG IN">
	</form>
</div>
</body>
<script>function show_loading()
{
	document.getElementById('load').style.display='block';
	setTimeout(hide_loading,1000);
    
}
function hide_loading() {
		document.getElementById('load').style.display='none';
}</script>
</html>