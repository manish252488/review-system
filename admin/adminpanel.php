<?php session_start(); ?>
<?php
 $servername=$_SERVER["SERVER_NAME"];
 $username="manish25";
 $pass="1997";
 $dbname="reviewsystem";
 $conn=mysqli_connect($servername,$username,$pass,$dbname);
 if(!$conn)
 echo "<script>window.location='errors/error.html';</script>";
	$id=$_SESSION["userid"];
$pass=$_SESSION["pass"];
mysqli_real_escape_string($conn,$id);
$sql="SELECT state FROM admin WHERE id='$id'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_row($result);
$state=$row[0];
?>
<!DOCTYPE html>
<html>
<head>
	<title>admin</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="admin1.css">
	<script src="script1.js"></script>
</head>
 <body onload="show_loading()">
  <div id="load"><img src="onload/loading.gif" id="loading"></div>
	<header><img id="icon" src="ico/mainpg.png">
	<div id="block1">AWARE INDIA<span style="color:tomato">!</span><div id="a001">A vission of Corrouption free India.</div></div>

	<!--<span id="block2"><img id="notify" src="ico/notify.png" onclick="displaynoti()">-->
		<span id="block2"><?php 
		if ($id=="")
		 {
			echo "<script>window.location='loginadmin.php';</script>";
		}
		else
		{
		mysqli_real_escape_string($conn,$id); 
		$sql="SELECT name FROM admin WHERE id='$id'"; 
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_row($result);
		$name=$row[0];
		echo $name."|<a href='logout.php'>LOGOUT</a>";
	}
		?>
	</span>
	</header>
	
	
<div id="reviewpanel">

	<div id="links">
		<button onclick="display(1)">DEALERS REGISTERED</button>
		<button onclick="display(2)">VIEW REVIEWS</button>
		<button onclick="display(3)">VIEW RATINGS AND REVIEWS</button>
		<!--<button onclick="display(4)">GENERATE COMPLAINT FILE</button>-->
	</div>
	<div id="displayarea">
		
		<div id="block01">
			<?php 
			$counter=0;
			mysqli_real_escape_string($conn,$state);
				$sql="SELECT DISTINCT shop FROM users WHERE state='$state'";
				$result=mysqli_query($conn,$sql);
				while($row=mysqli_fetch_row($result))
				$counter++;
			echo "<span class='des'>TOTAL NUMBER OF DEALERS REGISTERED:<span style=''>".$counter."</span></span>";
				$sql="SELECT DISTINCT shop FROM users WHERE state='$state'";
				$result=mysqli_query($conn,$sql);
			while($row=mysqli_fetch_row($result))
			{
				echo "<div class='k009'>".$row[0]."</div>";
			}
			?>
		</div>
		<div id="block02">

			<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" id="m0001">
				<span id="ti002">SELECT DEALER ID:</span>
			<select name="shop" id="shop" oninput="submitform()">
				<?php 
				mysqli_real_escape_string($conn,$state);
				$sql="SELECT DISTINCT shopid FROM reviews WHERE state='$state'";
				$result=mysqli_query($conn,$sql);
				while($row=mysqli_fetch_row($result))
				echo "<option value='". $row[0] ."'>".$row[0]."</option>";
			?>
			</select><br>
			<input type="submit" value="go" id="k002" autofocus>
		</form>
			<div id="panelcate1">
				<?php
			
				if ($_SERVER["REQUEST_METHOD"]=="POST")
				{
					$script="<script>document.getElementById('block01').style.display='none';
								document.getElementById('block02').style.display='block';
								document.getElementById('block03').style.display='none';
								document.getElementById('block04').style.display='none';</script>";
								echo $script;
					$value=$_POST["shop"];
					mysqli_real_escape_string($conn,$value);
					mysqli_real_escape_string($conn,$state);
					$sql="SELECT shopid,name,category,subcate,review,uptime FROM reviews WHERE shopid='$value' AND state='$state'";
					if($result=mysqli_query($conn,$sql))
					{
					while($row=mysqli_fetch_row($result))
					{
						if ($row[2]=="other")
							echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."&nbspsub-category:".$row[3]."<br>".$row[4]."</div><span class='time'>".$row[5]."</span></div>";
					else
					echo "<div id='commentbox'><span class='name002'>".strtoupper($row[1])."</span>&nbsp<span class='id001'>DEALER ID:".$row[0]."</span><div id='comment'><span class='cate123'>CATEGORY:".$row[2]."</span>"."<br>".$row[4]."</div><span class='time'>".$row[5]."</span></div>";
					}
				}
			}
		
			?>	
</div>
							
			
		</div>
		<div id="block03">
		<?php
		$sql="SELECT DISTINCT shopid FROM reviews";
		$result=mysqli_query($conn,$sql);
		while($row=mysqli_fetch_row($result))
		{
			$x=$row[0];
			$count1=0;
			mysqli_real_escape_string($conn,$x);
			$sql1="SELECT * FROM reviews WHERE shopid='$x'";
			$result1=mysqli_query($conn,$sql1);
			while($row1=mysqli_fetch_row($result1))
				{//no of complaints
								$count1++;
			    }
			    $calrate=0;
			    $n=0;
		$ratein="SELECT rating FROM rating";
			$result3=mysqli_query($conn,$ratein);
			while($row3=mysqli_fetch_row($result3))
			{
				$calrate+=$row3[0];
				$n++;
			}
			$avgrate=($calrate/(5*$n))*100;
			
				if ($count1>7) 
				{
				 echo "<form action='genreport.php' method='post' onsubmit='return displayinputpanel()'>";
								echo "<div class='ratingboxlow'>DEALER ID:<span id='shopid202'><span style='color:tomato'>".$x."</span><br>RATINGS:<span style='color:tomato'>".$avgrate."&#x25</span></span><br>no of complaints:<span style='color:tomato'>".$count1."</span><br><button id='btn0002' name='svalue' type='submit' value='". $x ."'>click to genrate complaint</button></div>";
									echo "</form>";
				}
				else
				if ($count1>=4 AND $count1<=7) 
				{
					echo "<div class='ratingboxavg'>DEALER ID:<span id='shopid202'><span style='color:tomato'>".$x."</span><br>RATINGS:<span style='color:tomato'>".$avgrate."&#x25</span></span><br>no of complaints:<span style='color:tomato'>".$count1."</span></div>";
				}
				else
				if ($count1<4)
				{
						echo "<div class='ratingboxhigh'>DEALER ID:<span id='shopid202'><span style='color:tomato'>".$x."</span><br>RATINGS:<span style='color:tomato'>".$avgrate."&#x25</span></span><br>no of complaints:<span style='color:tomato'>".$count1."</span></div>";
				}
		}
		?>
		</div>
		<div id="block04">
			<form action="genreport.php" method="post">
				<input type="text" name="shopidentity" placeholder="enter the shop id">
				<input type="submit" value="">
			</form>
		</div>

	</div>
</div>
<footer></footer>
</body>
</html>