 <?php 
 session_start(); 
 ?>
 <?php
 $servername=$_SERVER["SERVER_NAME"];
 $username="manish25";
 $pass="1997";
 $dbname="reviewsystem";
 $conn=mysqli_connect($servername,$username,$pass,$dbname);
 if(!$conn)
 	echo "<script>window.location='error.html';</script>";
 if($_SERVER["REQUEST_METHOD"]=="POST")
 {
 	$cs_id=$fname=$mname=$lname=$dob=$phno=$mail=$add=$st=$shop="";
 	$cs_id=$_POST["cus_id"];
 	$_SESSION["cs_id"] = $cs_id;
 	$shop=$_POST["shop"];
 	$_SESSION["shop"]=$shop;
 	$fname=strtolower($_POST["fname"]);
	$mname=strtolower($_POST["mname"]);
 	$lname=strtolower($_POST["lname"]);
 	if ($mname=="") 
 	{
 	$fullname=$fname." ". $lname;
 	$_SESSION["name"] = $fullname;
	}
 	else
 	{
 		$fullname=$fname." ".$mname. " ". $lname;
 		$_SESSION["name"] = $fullname;
 	}
 	$dob=$_POST["dob"];
 	$_SESSION["dob"] = $dob;
 	$phno=$_POST["phno"];
 	$_SESSION["phno"] = $phno;
 	$mail=$_POST["mail"];
 	$_SESSION["mail"] = $mail;
 	$add=strtolower($_POST["address"]);
 	$_SESSION["add"] = $add;
 	$st=$_POST["state"];
 	$_SESSION["st"] = $st;
 	$script="<script>window.location='password_portal.php'</script>";
 	echo $script;
}
?>

