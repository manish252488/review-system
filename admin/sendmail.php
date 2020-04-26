<?php
$sql="SELECT id,state FROM users WHERE shop='$shopv'";
$result=mysqli_query($conn,$sql);
while ($row=mysqli_fetch_row($result)) 
{
    $userid=$row[0];
    $state=$row[1];
    mysqli_real_escape_string($conn,$userid);
      mysqli_real_escape_string($conn,$state);
      $sql="SELECT mail FROM $state WHERE id='$userid'";
      $result1=mysqli_query($conn,$sql);
     while ($row=mysqli_fetch_row($result1))
     {
            $mail=$row[0];
            $msg="your problem request for the dealer id ".$shopv." is under progress.we will resolve your dispute as soon as possible.REGARDS PDS REVIEW SYSTEM";
            $sub="REGARDING ACCEPTANCE OF YOUR DISPUTE";
         $x=sendmail($mail,$msg,$sub);
     } 

}
     function sendmail($mail,$msg,$sub)
{
    $x=mail($mail,$sub,$msg);
    if ($x==true) 
    {
     return 0;
    }
}
?>