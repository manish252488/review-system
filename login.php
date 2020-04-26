<?php session_start();?>
<?php
 $servername=$_SERVER["SERVER_NAME"];
 $username="manish25";
 $pass="1997";
 $dbname="reviewsystem";
 $conn=mysqli_connect($servername,$username,$pass,$dbname);
 if(!$conn)
 	echo "<script>window.location='errors/error.html';</script>";
 if ($_SERVER["REQUEST_METHOD"]=="POST") 
 {
 	$user=$pass="";
 	$user=$_POST["user"];
 	$pass=$_POST["psw"];
    $sql="SELECT id FROM users";
    $result=mysqli_query($conn,$sql);
    if ($result) 
    { 
    	$counter=0;
    	while($row=mysqli_fetch_row($result))
    	{
          if ($user==$row[0]) 
          {
          	$counter=1;
          }
    	}
    	if ($counter == 1) 
    	{
    	mysqli_real_escape_string($conn,$user);
    	$sql2="SELECT password FROM users WHERE id='$user'";
    	if ($result=mysqli_query($conn,$sql2)) 
    	{
    		$row=mysqli_fetch_row($result);
    		if ($pass==$row[0]) 
    		{
    		echo "<script>window.location='main_page.php'</script>";
    		$_SESSION["user"]=$user;
    		$_SESSION["pass"]=$pass;
    	    }
    	    else
    	    	echo "<script>window.alert('invalid password!')</script>";
		}
	}
	else
		echo "<script>alert('invalid user id');</script>";
	}
else
echo "<script>window.location='errors/error.html'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>login</title>
	<link rel="icon" type="jpg/png/gif" href="icons/main.ico">
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width,initial-scale=1.0">
 	<link rel="stylesheet" type="text/css" href="css1/admincss.css">
    <link rel="icon" type="jpg/png/gif" href="icons/main.png">
</head>
<div id="help"><a id="cross" onclick="closepanel()">&#x2716</a><div id="helpcont"></div></div>
<header><img id="icon1" src="icons/mainpg.png">
    <div id="block1">AWARE INDIA<span style="color:tomato">!</span><div id="a001">A vision of corruption free India.</div></div>
    <img id="home" src="icons/home.ico" alt="HOME" onclick="window.location='index.php'"><img id="home" src="icons/help.ico" alt="HELP?" onclick="openpanel()">
</header><br>
 <body onload="show_loading()">
  <div id="load"><img src="onload/loading.gif" id="loading"></div>
		<img id="icon" src="images/8.png"><br> <span id="sid001">Not registered??</span><button id="btt121" onclick="window.location='registerpage.html';">Register</button>
	<div id="logform">
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validate_login()">
			CUSTOMER ID<br><input name="user" id="user" type="text" required><span id="err1"></span><br>
            PASSWORD<br><input name="psw" id="psw" type="password" required><span id="err2"></span><br>
			<input type="submit" value="LOG IN" id="btn">
		</form>
		
	</div>
    <footer></footer>
</body>
<script>
	function validate_login()
	{
		document.getElementById('err1').innerHTML='';
		var x=document.getElementById('user').value;
		var patt2 = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;
        var patt1 = /[^0-9]/g;
			if (patt1.test(x)||patt2.test(x))
			 {
                document.getElementById('err1').innerHTML='invalid constumer id';
                return false;
			 }
	}

function show_loading()
{
    document.getElementById('load').style.display='block';
    setTimeout(hide_loading,1000);
    
}
function hide_loading() {
        document.getElementById('load').style.display='none';
}
function openpanel(){
    document.getElementById('help').style.width='100%';
}
function closepanel()
{
     document.getElementById('help').style.width='0'; 
}

</script>
</html>