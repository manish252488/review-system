<?php session_start(); ?>
<?php
 $servername=$_SERVER["SERVER_NAME"];
 $username="manish25";
 $pass="1997";
 $dbname="reviewsystem";
 $conn=mysqli_connect($servername,$username,$pass,$dbname);
 if(!$conn)
 	echo "<script>window.location='errors/error.html';</script>";
 error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>
<head>
	<title>AWARE INDIA!!</title>
	<link rel="icon" type="jpg/png/gif" href="icons/main.png">
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width,initial-scale=1.0">
 	<link rel="stylesheet" type="text/css" href="css1/front.css">
 	<link rel="stylesheet" type="text/css" href="css1/slideshowcss.css">
 	<script src="front.js"></script>
 	<script src="slideshowjscript.js"></script>
</head>
 <body onload="show_loading(); currentSlide(1); ">
  <div id="load"><img src="onload/loading.gif" id="loading"></div>

<header><img id="icon" src="icons/mainpg.png">
	<div id="block1">AWARE INDIA<span style="color:tomato">!</span><div id="a001">A vission of Corrouption free India.</div></div>
	<div id="block2"><?php if ($_SESSION["user"]=="") {echo "<a href='login.php'>LOG IN</a><span id='a002'>|</span><a href='registerpage.html'>REGISTER</a>";} else echo "<a id='profile' href='main_page.php' style='background:mediumseagreen;padding:0.5vw;'>PROFILE</a><span id='a002'>|</span><a href='logout.php' style='background:mediumseagreen;padding:0.5vw;'>LOGOUT</a>";?></div>
</header>
<div id="s001">
<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade" style="display: block;">
    <div class="numbertext">1 / 3</div>
    <img class="img001" src="images/1.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img class="img001" src="images/2.jpg" style="width:100%">
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img class="img001" src="images/3.jpg" style="width:100%">
  </div>

  <!-- Next and previous buttons -->
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span> 
  <span class="dot" onclick="currentSlide(2)"></span> 
  <span class="dot" onclick="currentSlide(3)"></span> 
</div>



</div>
<div id="s002">
	<div id="k002">
   <span style="color: tomato; text-decoration: underline;">Instructions: </span> <br><br>
   <div>
     1. New consumers register using the register button<br><br>
     2. Existing consumer may login using consumer id & password <br><br>
     3. Consumers are expected to give rating and feedback for the shop they visit<br><br>
     4. Please specify any other problems using the dialog box<br><br>
     5. Rating must be based on personal experiences<br><br>
     6. Each user is responsible for the feedbacks they give<br><br>
   </div>
 </div>
</div>
<footer>
<div>This is the PDS review Portal of India, developed with an objective to enable a single window access to give feedback on PDS being provided by the various Indian Government entities. This Portal is a Mission Mode Project under the National E-Governance Plan, designed and developed by National Informatics Centre (NIC), Ministry of Electronics & Information Technology, Government of India.
</div>
</footer>


</body>
</html>