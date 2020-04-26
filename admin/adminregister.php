<?php session_start(); ?>
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
 		$name=$_POST["fname"].$_POST["mname"].$_POST["lname"];
 		$id=$_POST["id"];
 		$state=$_POST["state"];
 		$psw=$_POST["psw1"];
 		$sql="SELECT * FROM pdsadminstrator";
 		if (mysqli_query($conn,$sql))
 		{
 			insert_data($conn,$name,$id,$state,$psw);
 		}
 		else
 		{
 			create_table($conn);
 			insert_data($conn,$name,$id,$state,$psw);
 		
 		}
 }
 function create_table($value)
 {
 	$sql="CREATE TABLE pdsadminstrator(id int primary key,name varchar(30),state varchar(20),password varchar(50))";
    mysqli_query($value,$sql);
 	return 0;		
 }
 function insert_data($c,$n,$i,$s,$p)
 {
 	mysqli_real_escape_string($c,$i);
 	mysqli_real_escape_string($c,$n);
 	mysqli_real_escape_string($c,$p);
 	mysqli_real_escape_string($c,$s);
 	$sql="INSERT INTO pdsadminstrator(id,name,state,password) VALUES('$i','$n','$s','$p')";
 	mysqli_query($c,$sql);
 	$script="<script>window.location='loginadmin.php'</script>";
 	echo $script;
 }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>register pds adminstrator</title>
 	<style type="text/css">
 		body
 		{
          background:mediumseagreen no-repeat fixed;
	      background-size: contain;
 		}
 		header
        {
	       width: 98%;
	       height: 9vw;
	       background: linear-gradient(to right, #000046, #1cb5e0);
           position: relative;
	       top: 0;
	       left: 0;
	       box-shadow: 0.1vw 0.2vw 0.3vw white;
	       padding-top: 2vw;
	       padding-bottom: 2vw;
	       padding-right: 1vw;
	       padding-left: 1vw;
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
        #a001
        {
            font-size: 3vw;
            font-family: title1;
            color: #ddd;
            text-shadow: none;
            text-decoration: underline white;
            margin-left: 14vw;
            position: relative;
            top: 0;
        }

        #block0001
        {
	       font-family: title;
	       font-size: 3vw;
	       color: mediumseagreen;
	       text-shadow: 0.1vw 0.2vw 0.1vw #333;
	       padding: 0.5vw;
	       position: relative;
	       top: 0;
	       left: 0;
	       display: inline-block;
        }
        #home
        {
	       width: 3vw;
	       cursor: pointer;
	       position: relative;
	       left:23vw;
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
#icon
{
	width: 7vw;
	height: 7vw;
	background-color: white;
	position: relative;
	top: 0.5vw;
	left: 0.5vw;
	display: inline-block;
	margin-right: 1vw;
	border-radius: 50%;
}
#block2
{
	width:70%;
	height:auto;
	background:burlywood;
	float: none;
	left: 13%;
	top: 10px;
	margin-bottom: 10px;
	position: relative;
	padding: 2vw;
	font-size: 1.5vw;
	color:black;
	font-weight: bold;
}
form
{
	width: 98%;
	border:0.2vw solid black;
	padding: 1vw;
	margin-left: -9.5px;
}
input[type=text],input[type=email]
{
	width:50%;
	height: 4vw;
	border-radius: 1vw;
	border:0.2vw solid green;
	padding: 1vw;
	font-size: 1vw;
}
input[type=date]
{
	width: 15vw;
	height:2vw;
	border-radius: 1vw;
	border:0.2vw solid green;
	padding: 1vw;
	font-size: 1vw;
}
select
{
	border-radius: 1vw;
	border:0.2vw solid green;
	width: 15vw;
	height:4vw;
	padding: 0.5vw;
	font-size: 1vw;
}
input[type=textfield]
{
	width: 40%;
	height: 2vw;
	font-size: 1vw;
	padding: 0.5vw;
	border: 0.2vw solid green;
	border-radius: 1vw;
}
input[type=submit]
{
	width: 10vw;
	background-color: mediumseagreen;
	cursor: pointer;
	font-size: 1.5vw;
	color: white;
	padding: 0.5vw;
	transition: 0.1s;
}
input[type=submit]:hover
{
	transform: scale(1.1);
}
#err2,#err3,#err4,#err5,#err6
{
	color: red;
	font-size: 1vw;
	display:inline-block;
}
section::after
{
	clear: both;
	content: " ";
	display: block;
}
footer
{
	position: relative;
	height: 10vw;
	top: 10px;
	width: 100%;
	background-color: black;
	margin-top: 1vw;
}
   </style>
 </head>
<header><img id="icon" src="">
	<div id="block0001">AWARE INDIA<span style="color:tomato">!</span><div id="a001">A vission of Corrouption free India.</div></div>
	 <img id="home" src="icons/home.ico" alt="HOME" onclick="window.location='index.php'">
</header>
 	<section>
	<div id="block2">
 	<form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
 		
 		First Name<br><input type="text" name="fname" id="fname" maxlength="20" required><span id="err2"></span><br>
 		Middle Name<br><input type="text" name="mname" id="mname" maxlength="20"><span id="err3"></span><br>
 		Last Name<br><input type="text" name="lname" id="lname" maxlength="20" required><span id="err4"></span><br>
 		Date Of Birth<br><input type="date" name="dob" required><br>
 		Mobile no.<br><input type="text" name="phno" id="phno" maxlength="10" minlength="10" required><span id="err5"></span><br>
 		Email<br><input type="email" name="mail" maxlength="50"><br>
 		
 	   STATE<br><select name="state">
 		<option value="AndhraPradesh">Andhra Pradesh</option>
 		<option value="ArunachalPradesh">Arunachal Pradesh</option>
 		<option value="assam">assam</option>
 		<option value="Bihar">Bihar</option>
 		<option value="Chhattisgarh">Chhattisgarh</option>
 		<option value="Goa">Goa</option>
 		<option value="Gujrat">Gujrat</option>	 										
 		<option value="Haryana">Haryana</option>
 		<option value="HimachalPradesh">Himachal Pradesh</option>
 		<option value="JammuandKashmir">Jammu and Kashmir</option>
 		<option value="Jharkhand">Jharkhand</option>
 		<option value="Karnataka">Karnataka</option>
 		<option value="Kerala">Kerala</option>
 		<option value="MadhyaPradesh">Madhya Pradesh</option>
 		<option value="Maharashtra">Maharashtra</option>
 		<option value="Manipur">Manipur</option>
 		<option value="Meghalaya">Meghalaya</option>
 		<option value="Mizoram">Mizoram</option>
 		<option value="Nagaland">Nagaland</option>
 		<option value="Odisha">Odisha</option>
 		<option value="Punjab">Punjab</option>
 		<option value="Rajasthan">Rajasthan</option>
 		<option value="Sikkim">Sikkim</option>
 		<option value="Tamilnadu">Tamil nadu</option>
 		<option value="Hyderabad">Hyderabad</option>
 		</select><br>
 		City<br><input type="text" name="city"><br>
 		Pin code<br><input type="text" name="pcode" id="pcode" required><span id="err6"></span><br>
 		PASSWORD<br>
 		<input type="text" name="psw1"><br>
 		RE_TYPE PASSWORD<br>
 		<input type="text" name="psw2"><br><br>
 		<input type="submit" value="REGISTER">
 	</form>
 </div>
</section>
<footer></footer>
 </body>
 </html>