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
if ($_SERVER["REQUEST_METHOD"]=="POST") 
{
$rating=$_POST["inputrate"];
$sql="SELECT * FROM rating";
if (mysqli_query($conn,$sql)) 
{
insertvalue($conn,$user,$shop,$state,$rating);
}
else
{
createtable($conn);
insertvalue($conn,$user,$shop,$state,$rating);

}
}

function createtable($c)
{
$sql="CREATE TABLE rating(id int primary key,shopid varchar(20),state varchar(20),rating int(10))";
mysqli_query($c,$sql);
return 0;
}

function insertvalue($c,$i,$sh,$st,$r)
{
  mysqli_real_escape_string($c,$i);
    mysqli_real_escape_string($c,$sh);
      mysqli_real_escape_string($c,$st);
        mysqli_real_escape_string($c,$r);
$sql="INSERT INTO rating VALUES('$i','$sh','$st','$r')";
if (!mysqli_query($c,$sql)) 
{
 updaterating($c,$i,$sh,$st,$r);
}
else
redirectto();
}

function updaterating($c,$i,$sh,$st,$r)
{
mysqli_real_escape_string($c,$i);
    mysqli_real_escape_string($c,$sh);
      mysqli_real_escape_string($c,$st);
        mysqli_real_escape_string($c,$r);
        $sql="UPDATE rating SET rating='$r' WHERE id='$i'";
        mysqli_query($c,$sql);
redirectto();
}
function redirectto()
{
    $script="<script>window.location='main_page.php'</script>";
    echo $script;
}
?>