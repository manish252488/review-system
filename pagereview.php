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
	 echo "<script>window.location='errors/error.html';</script>";
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
	<title>review panel</title>
	<link rel="icon" type="jpg/png/gif" href="icons/main.png">
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width,initial-scale=1.0">
 	<link rel="stylesheet" type="text/css" href="css1/pagereview.css">
 	<script src="js/reviewpage.js"></script>
</head>
 <body onload="show_loading();">
  <div id="load"><img src="onload/loading.gif" id="loading"></div>

<header><img id="icon" src="icons/mainpg.png">
	<div id="block01">REVIEW PANEL<span style="color:tomato">!</span><div id="a001">A vission of Corrouption free India.</div></div>
</header>
<section><div id="left">
	<button class="panelcate" id="b001" onclick="displayblock(1)">give review</button>
	<button class="panelcate" id="b002" onclick="displayblock(2)">view your reviews</button>
	<button class="panelcate" id="b003" onclick="displayblock(3)">view your shop reviews</button>
</div>
	<div id="right">
		<div id="block1">
			<span class="title">UPLOAD YOUR REVIEW/COMPLAINTS</span>
			<form  action="uploadreview.php" method="post">
				SELECT CATEGORY OF YOUR PROBLEM<br><select name="category" id="check" oninput="checkval()">
					<option value="price">price</option>
					<option value="weight">weight</option>
					<option value="quality">quality</option>
					<option value="other">other</option>
				</select><br>
					<div id="cate">SUBJECT OF YOUR PROBLEM<br><input type="text" name="cate"></div>
					COMMENT<br><input type="text" name="review" maxlength="150" placeholder="describe problem" required rows="4" cols="40">
					<input type="submit" value="submit">
			</form>



		</div><div id="block2">
			<?php
			mysqli_real_escape_string($conn,$user);
				$sql="SELECT shopid,name,category,subcate,review,uptime,seen FROM reviews WHERE id='$user'";
				if($result=mysqli_query($conn,$sql))
				{
					while($row=mysqli_fetch_row($result))
					{

					if ($row[6]==false) 
					{
						if ($row[2]=="other") 
						{
							echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."&nbspsub-category:".$row[3]."<br>".$row[4]."</div><span class='time'>".$row[5]."<img id='seen' src='icons/notseen.png'></span></div>";
						}
						else
					echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."<br>".$row[4]."</div><span class='time'>".$row[5]."<img id='seen' src='icons/notseen.png'></span></div>";
				}
				else
				{
					if ($row[2]=="other") 
						{
							echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."&nbspsub-category:".$row[3]."<br>".$row[4]."</div><span class='time'>".$row[5]."<img id='seen' src='icons/seen.png'></span></div>";
						}
						else
					echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."<br>".$row[4]."</div><span class='time'>".$row[5]."<img id='seen' src='icons/seen.png'></span></div>";
				}

			}
		}
			?>
			
		</div><div id="block3">
			<span class="title" style="text-decoration: none;">ALL REVIEWS OF DEALER <span style="color: white;background: blue;padding: 0.2vw;border-radius: 0.5vw;"><?php echo $shop; ?></span></span>
			<?php
			mysqli_real_escape_string($conn,$shop);
				$sql="SELECT shopid,name,category,subcate,review,uptime FROM reviews WHERE shopid='$shop'";
				if($result=mysqli_query($conn,$sql))
				{
					while($row=mysqli_fetch_row($result))
					{
								if ($row[2]=="other") {
							echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."&nbspsub-category:".$row[3]."<br>".$row[4]."</div><span class='time'>".$row[5]."</span></div>";
						}
						else
					echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."<br>".$row[4]."</div><span class='time'>".$row[5]."</span></div>";
				}
			}
			?>
		</div><div id="block4">
					<span class="a2020">SEARCH FROM CATEGORIES<span style="color: tomato;">:</span></span>	
			<?php
			mysqli_real_escape_string($conn,$shop);
				$sql="SELECT shopid,name,category,review,uptime FROM reviews WHERE shopid='$shop' AND category='price'";
				if($result=mysqli_query($conn,$sql))
				{
					while($row=mysqli_fetch_row($result))
					echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."<br>".$row[3]."</div><span class='time'>".$row[4]."</span></div>";
				}
			?>
		</div>
		</div>

	</section>
	<footer></footer>
</body>
</html>