 <?php session_start(); ?>
<?php
 $servername=$_SERVER["SERVER_NAME"];
 $username="manish25";
 $pass="1997";
 $dbname="reviewsystem";
 $conn=mysqli_connect($servername,$username,$pass,$dbname);
 if(!$conn)
 	echo "<script>window.location='errors/error.html';</script>";
 	$cs_id=$fullname=$dob=$phno=$mail=$add=$st="";
	$cs_id=$_SESSION["cs_id"];
  if ($cs_id=="")
  {
      echo "<script>window.location='errors/error.html';</script>";
  }
    $fullname=$_SESSION["name"] ;
 	$dob=$_SESSION["dob"];
 	$phno=$_SESSION["phno"];
 	$mail=$_SESSION["mail"];
 	$add=$_SESSION["add"];
 	$st=$_SESSION["st"];
  $shop=$_SESSION["shop"];
  $sql="SELECT id FROM users";
 if ($result=mysqli_query($conn,$sql)) 
 {
while($row=mysqli_fetch_row($result))
{
  if($cs_id==$row[0])
    echo "<script>window.location='errors/error.html';</script>";
}
 }
if ($_SERVER["REQUEST_METHOD"]=="POST")
{  
	$psw="";
	$psw=$_POST["psw1"];
	$_SESSION["psw"]=$psw;
	mysqli_real_escape_string($conn,$st);
	$table="SELECT * FROM $st";
 	if(mysqli_query($conn,$table))
	{
		insert_data($conn,$cs_id,$fullname,$dob,$phno,$mail,$add,$st,$psw);
  }
 	else
 	{
 		create_table($conn,$st);
    
 		insert_data($conn,$cs_id,$fullname,$dob,$phno,$mail,$add,$st,$psw);
  
 	}
  $table2="SELECT * FROM users";
  if(mysqli_query($conn,$table2))
     insert_user_data($conn,$cs_id,$shop,$st,$psw);
  else
{
  create_table2($conn,"users");
    insert_user_data($conn,$cs_id,$shop,$st,$psw);
}
  session_unset();
  session_destroy();

}
function create_table2($c,$value)
{
  mysqli_real_escape_string($c,$value);
  $createT="CREATE TABLE $value(id VARCHAR(20) PRIMARY KEY,shop INT(12),state VARCHAR(30),password VARCHAR(50))";
  mysqli_query($c,$createT);
}
function insert_user_data($c,$cs,$sh,$stt,$p)
{
mysqli_real_escape_string($c,$cs);
 mysqli_real_escape_string($c,$sh);
  mysqli_real_escape_string($c,$p);
  mysqli_real_escape_string($c,$stt);
$insert="INSERT INTO users(id,shop,state,password) VALUES('$cs','$sh','$stt','$p');";
mysqli_query($c,$insert);
}
function create_table($c,$state)
    {
    mysqli_real_escape_string($c,$state);
    $createT="CREATE TABLE $state(id VARCHAR(20) PRIMARY KEY,name VARCHAR(30),dob VARCHAR(30),phone INT(10),mail VARCHAR(100),address TINYTEXT,state VARCHAR(30),password VARCHAR(50),reg_date TIMESTAMP)";
	mysqli_query($c,$createT);
}
function insert_data($c,$i,$n,$d,$p,$m,$a,$s,$pass)
{
 mysqli_real_escape_string($c,$n);
 mysqli_real_escape_string($c,$i);
  mysqli_real_escape_string($c,$d);
  mysqli_real_escape_string($c,$p);
  mysqli_real_escape_string($c,$m);
  mysqli_real_escape_string($c,$a);
  mysqli_real_escape_string($c,$s);
  mysqli_real_escape_string($c,$pass);
  $insert="INSERT INTO $s(id,name,dob,phone,mail,address,state,password) VALUES('$i','$n','$d','$p','$m','$a','$s','$pass')";
  if(mysqli_query($c,$insert))
  {
    $script="<script>window.location='login.php'</script>";
  	echo $script;
 
  }
  else
  {
  echo "<script>alert('cunsumerId already registered!');window.location='registerpage.html';</script>";
 }
  
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>secure</title>
	<link rel="stylesheet" type="text/css" href="css1/pass.css">
 	<link rel="icon" type="jpg/png/gif" href="icons/main.ico">
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
 <body onload="show_loading()">
  <div id="load"><img src="onload/loading.gif" id="loading"></div>
<header><img id="icon" src="icons/mainpg.png">
  <div id="block1">AWARE INDIA<span style="color:tomato">!</span><div id="a001">A vission of Corrouption free India.</div></div></header>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return validatepass()">
	enter password<br><input type="text" name="psw1" id="psw1" minlength="8" required><span id="err001"></span><br>
	re-enter password<br><input type="text" name="psw2" id="psw2" minlength="8" required><span id="err002"></span><br>
	<input type="submit" value="continue">
</form>
</body>
<script src="validation.js"></script>
</html>
