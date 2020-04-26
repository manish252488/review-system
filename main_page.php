<?php session_start(); ?>
<?php
 $servername=$_SERVER["SERVER_NAME"];
 $username="manish25";
 $pass="1997";
 $dbname="reviewsystem";
 $conn=mysqli_connect($servername,$username,$pass,$dbname);
 if(!$conn)
 echo "<script>window.location='errors/error.html';</script>";
$user=$_SESSION["user"];
$pass=$_SESSION["pass"];
if (($user=="")&&($pass=="")) 
{
	 echo "<script>window.location='login.php';</script>";
}
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
    		if ($pass!=$row[0])
    			{
    		
    		session_unset();
    		session_destroy();
    		echo "<script>window.location='login.php';</script>";
		   		}
		  
			}
		}
	else
	{
		echo "<script>window.location='errors/error.html';</script>";
		session_unset();
    		session_destroy();
	}
	}
	$sql3="SELECT state FROM users WHERE id=$user";
	$result=mysqli_query($conn,$sql3);
	$row=mysqli_fetch_row($result);
	$state=$row[0];
	mysqli_real_escape_string($conn,$state);
	mysqli_real_escape_string($conn,$user);
	$sql="SELECT name,dob,phone,mail,address FROM $state WHERE id=$user";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_row($result);
	$name=$row[0];
	$dob=$row[1];
	$phone=$row[2];
	$mail=$row[3];
	$address=$row[4];
    	$sql2="SELECT shop FROM users WHERE id=$user";
    	$result=mysqli_query($conn,$sql2);
    	$row=mysqli_fetch_row($result);
    	$shop=$row[0];

?>
<!DOCTYPE html>
<html>
<head>
	<title>review</title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width,initial-scale=1.0">
 	<link rel="stylesheet" type="text/css" href="css1/reviewpage.css">
 	<script src="js/main.js"></script>
</head>
 <body onload="show_loading()">
  <div id="load"><img src="onload/loading.gif" id="loading"></div>
	<header>
	<img id="icon1" src="icons/mainpg.png">
    <div id="block123">AWARE INDIA<span style="color:tomato">!</span><div id="a001">A vission of Corrouption free India.</div></div>
    <img id="home" src="icons/home.ico" alt="HOME" onclick="window.location='index.php'">
</header>
<div id="container">
	<div id="block1">
		<img id="profileic" src="images/cover.png">
		<div id="userdetail">
			NAME:<span class="det"><?php echo "".strtoupper($name)."";?></span><br>
			CONSUMER ID:<span class="det"><?php echo "".$user."";?></span><br>
			DEALER ID:<span class="det"><?php echo "".$shop."";?></span><br>
			MOBILE NO:<span class="det"><?php echo $phone;?></span><br>
			MAIL:<span class="det"><?php echo $mail;?></span><br>
			STATE:<span class="det"><?php echo strtoupper($state);?></span><br>
			ADDRESS:<span class="det"><?php echo $address;?></span><br>
			<button onclick="window.location='logout.php'" id="logout">logout</button>
		</div>
	</div>
	<div id="block2">
		
		<div id="contents">
			<span id="inst00">RATE YOUR SHOP<span style="color: tomato">:</span></span><br>
			<div class="task">
					<div class="reviewcontent">
					SHOP RATING<br><span class="des11">SATISFIED WITH THE SERVICE??</span><br><span id="re"></span>
				</div>
			<div class="panel"><?php 
			mysqli_real_escape_string($conn,$user);
			$sql="SELECT rating FROM rating WHERE id='$user'";
			if($result=mysqli_query($conn,$sql)){
			$row=mysqli_fetch_row($result);
			$a=intval($row[0]);
			if ($a==1) 
			{
				echo "<img src='icons/redstar.ico' id='pstar1' onclick='changestar(1)'>
				<img src='icons/star.ico' id='pstar2' onclick='changestar(2)'>
				<img src='icons/star.ico' id='pstar3' onclick='changestar(3)'>
				<img src='icons/star.ico' id='pstar4' onclick='changestar(4)'>
				<img src='icons/star.ico' id='pstar5' onclick='changestar(5)'>";
			}else
			if ($a==2) 
			{
				echo "<img src='icons/redstar.ico' id='pstar1' onclick='changestar(1)'>
				<img src='icons/redstar.ico' id='pstar2' onclick='changestar(2)'>
				<img src='icons/star.ico' id='pstar3' onclick='changestar(3)'>
				<img src='icons/star.ico' id='pstar4' onclick='changestar(4)'>
				<img src='icons/star.ico' id='pstar5' onclick='changestar(5)'>";
			}
			else
			if ($a==3) 
			{
				echo "<img src='icons/glowstar.ico' id='pstar1' onclick='changestar(1)'>
				<img src='icons/glowstar.ico' id='pstar2' onclick='changestar(2)'>
				<img src='icons/glowstar.ico' id='pstar3' onclick='changestar(3)'>
				<img src='icons/star.ico' id='pstar4' onclick='changestar(4)'>
				<img src='icons/star.ico' id='pstar5' onclick='changestar(5)'>";
			}else
			if ($a==4) 
			{
				echo "<img src='icons/green.ico' id='pstar1' onclick='changestar(1)'>
				<img src='icons/green.ico' id='pstar2' onclick='changestar(2)'>
				<img src='icons/green.ico' id='pstar3' onclick='changestar(3)'>
				<img src='icons/green.ico' id='pstar4' onclick='changestar(4)'>
				<img src='icons/star.ico' id='pstar5' onclick='changestar(5)'>";
			}
			else
			if ($a==5)
			{
			echo "<img src='icons/green.ico' id='pstar1' onclick='changestar(1)'>
			<img src='icons/green.ico' id='pstar2' onclick='changestar(2)'>
			<img src='icons/green.ico' id='pstar3' onclick='changestar(3)'>
			<img src='icons/green.ico' id='pstar4' onclick='changestar(4)'>
			<img src='icons/green.ico' id='pstar5' onclick='changestar(5)'>";
			}
				else
			{
				echo "<img src='icons/star.ico' id='pstar1' onclick='changestar(1)'>
				<img src='icons/star.ico' id='pstar2' onclick='changestar(2)'>
				<img src='icons/star.ico' id='pstar3' onclick='changestar(3)'>
				<img src='icons/star.ico' id='pstar4' onclick='changestar(4)'>
				<img src='icons/star.ico' id='pstar5' onclick='changestar(5)'>";
			}
			}
			else
			{
				echo "<img src='icons/star.ico' id='pstar1' onclick='changestar(1)'>
				<img src='icons/star.ico' id='pstar2' onclick='changestar(2)'>
				<img src='icons/star.ico' id='pstar3' onclick='changestar(3)'>
				<img src='icons/star.ico' id='pstar4' onclick='changestar(4)'>
				<img src='icons/star.ico' id='pstar5' onclick='changestar(5)'>";
			}
			?></div>

			
		</div>
		<div class="task" onclick="window.location='pagereview.php'">
				<div class="reviewcontent">
					CLICK<br><span class="des11">TO GIVE REVIEWS/COMPLAINTS</span>
				</div>
		</div>
		</div>
		<div style="position: relative;top: 5vw;">
					<img src="images/rating.png">
				</div>

	</div>

</div>
<footer><form action="rate.php" id="formele" method="post">
				<input type="text" name="inputrate" id="inputrate" oninput="submitvalues()">
				<input type="submit" value="submit">
			</form></footer>
</body>

</html>