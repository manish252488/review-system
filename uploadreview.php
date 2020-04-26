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
        $date=date("Y-m-d");
	if ($_SERVER["REQUEST_METHOD"]=="POST") 
    	{    
         $category=$_POST["category"];
               $subcate="";
               if ($category=="other") 
               {
                   $subcate=$_POST["cate"];
               }
             $review=$_POST["review"];
             mysqli_real_escape_string($conn,$user);
         $sql="SELECT udate from reviews where id='$user'";
         if ($result=mysqli_query($conn,$sql)) 
         {
    if(!$row=mysqli_fetch_row($result)) 
     {
   insertvalues($conn,$user,$shop,$state,$name,$category,$subcate,$review,$date);
     }
     else
     { $uploadingdate=date_create(date("y-m-d"));
     $sql="SELECT udate from reviews where id='$user'";
     $result=mysqli_query($conn,$sql);
      while($row=mysqli_fetch_row($result)) 
      {
       $uploadingdate=date_create($row[0]);
      }
      $currentdate= date_create(date("Y-m-d"));
      $diff=date_diff($currentdate,$uploadingdate);
      $x=$diff->format("%R%a");
      $x=intval($x);
      if($x<7)
      {
        $script="<script>alert('Looks like you reviewed recently,please try after few days!!');window.location='pagereview.php';</script>";
            echo $script;
      }
      else
      {
       insertvalues($conn,$user,$shop,$state,$name,$category,$subcate,$review,$date);
      }
     }
}
else
{
  createtable($conn);
   insertvalues($conn,$user,$shop,$state,$name,$category,$subcate,$review,$date);
}
}
function insertvalues($conn,$user,$shop,$state,$name,$category,$subcate,$review,$date)
{
   mysqli_real_escape_string($conn,$user);
                    mysqli_real_escape_string($conn,$shop);
                  mysqli_real_escape_string($conn,$name);
                      mysqli_real_escape_string($conn,$category);
                     mysqli_real_escape_string($conn,$subcate);
                    mysqli_real_escape_string($conn,$review);
                    mysqli_real_escape_string($conn,$date);
                    mysqli_real_escape_string($conn,$state);
 $sql="INSERT INTO reviews(id,shopid,state,name,category,subcate,review,udate) VALUES('$user','$shop','$state','$name','$category','$subcate','$review','$date')";
                   mysqli_query($conn,$sql);
                   $script="<script>window.location='pagereview.php'</script>";
                   echo $script;
}
function createtable($conn)
{
   $sql="CREATE TABLE reviews(slno int NOT NULL AUTO_INCREMENT, id int,state varchar(20),shopid int,name varchar(20),category varchar(20),subcate text,review text,udate date,uptime TIMESTAMP,
                    seen boolean default false,PRIMARY KEY(slno))";
                    mysqli_query($conn,$sql);
                    return 0;
}
        ?>
