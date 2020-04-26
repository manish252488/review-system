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
$shopv="";
$counterreviews=0;
if ($_SERVER["REQUEST_METHOD"]=="POST") 
{

$shopv=$_POST["svalue"];
mysqli_real_escape_string($conn,$shopv);
$sql="SELECT * FROM reviews WHERE shopid='$shopv'";
$result=mysqli_query($conn,$sql);
while ($row=mysqli_fetch_row($result)) 
{
	$counterreviews++;
}
$sql="UPDATE reviews SET seen ='1' WHERE shopid = '$shopv'";
mysqli_query($conn,$sql); 

}

	
require('fpdf/fpdf.php');

class PDF extends FPDF
{
function Header()
{
	    global $title ;
	    $this->Image('ico/mainpg.png',15,4,30);

    // Arial bold 15
    $this->SetFont('Arial','B',25);
    // Colors of frame, background and text
    $this->SetTextColor(0,0,0);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell(150,20,"COMPLAINT FILE",0,1,'C',FALSE);
    // Line break
    $this->Ln(10);

}

// Page footer
function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',8);
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',15);
$pdf->Cell(0,15,"DEALER ID:  ".$shopv,0,1);
$pdf->SetFont('Times','B',15);
$pdf->Cell(0,15,"STATE:  ".$state,0,1);
$pdf->SetFont('Times','B',15);
$pdf->Cell(0,15,"NO OF COMPLAINTS AGAINTS SHOP:  ".$counterreviews,0,1);
$sql1="SELECT DISTINCT category,subcate FROM reviews WHERE shopid='$shopv'";
$result=mysqli_query($conn,$sql1);
$pdf->Cell(0,15,"COMPLAINTS ISSUES: ",0,1);
        $pdf->SetFont('Times','B',15);
while ($row=mysqli_fetch_row($result)) 
{
	if ($row[0]=="other") 
	{
		$pdf->Cell(0,15,$row[1],0,1);
        $pdf->SetFont('Times','B',15);
	}
	else
	{
		$pdf->Cell(0,15,$row[0],0,1);
        $pdf->SetFont('Times','B',15);
	}
}



		$pdf->Cell(10,15,"Lodge Complaint against the respective DEALER ID ".$shopv,0,1);
        $pdf->SetFont('Times','B',15);
         $pdf->Cell(0,15,"________________________________________________________________________",0,1);
        $pdf->SetFont('Times','B',15);
        $pdf->Cell(10,15,"with Complaint number___/________",0,1);
        $pdf->SetFont('Times','B',15);
            $pdf->Cell(10,15,"Signature__________________",0,1);
        $pdf->SetFont('Times','B',15);
$pdf->Output();
require('sendmail.php');
?>
