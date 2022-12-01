<?php 
    session_start();
    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php?error=notloggedin");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "user") {
        header("location: login.php?error=notadmin");
        exit();
    }

require('../fpdf/fpdf.php');
class PDF extends FPDF


{
// Page header
function Header()
{
    // Logo
    $this->Image('../img/Logo.png',15,8,0,0);
    // Arial bold
    $this->SetFont('helvetica','B',10);
    // Move to the right
    $this->Cell(80);
    // Contact Info    
    $this->Cell(0,4,'+361-655-6677',0,1,'R');
    $this->Cell(0,4,'CoolBreezeTexas.com',0,1,'R');
    $this->Cell(0,4,'questions@coolbreezetexas.com',0,0,'R');
    // Line break
    $this->Ln(20);
    
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Document variables 
if ((isset($_POST["submit"])) || (isset($_POST["download"]))) {


    $owner = 'Robert Soto';
    $applicant = $_POST["applicant"];
    $address = $_POST["address"];
    $depoAmount = $_POST["depoAmount"];
    $endDate = $_POST["endDate"];
    $todayDate = date('Y-m-d');

} else {
    $applicant = '';
    $address = '';
    $depoAmount = '';
    $todayDate = date('Y-m-d');
    $endDate = '' ;
};

$fileName = $applicant . "DepositReceipt.pdf";

//FPDF Start
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


// Title
$pdf->SetFont('helvetica' , '', 16);
$pdf->Cell(25);
$pdf->Cell(140, 15, 'Receipt and Holding Deposit Agreement', 'B', 1, 'C');
$pdf->Ln(10);


//Owner, Applicant, Address
$pdf->SetFont('helvetica' , '', 12);
$pdf->Cell(30, 6, 'Owner Name: ', 0, 0, 'L');
$pdf->Cell(45, 6, $owner, 'B', 0, 'C');
$pdf->Cell(5);
$pdf->Cell(34, 6, 'Applicant Name: ', 0, 0, 'L');
$pdf->Cell(50, 6, $applicant, 'B', 0);
$pdf->Ln(10);
$pdf->Cell(20, 6, 'Address: ', 0, 0, 'L');
$pdf->Cell(144, 6, $address, 'B', 1);
// $pdf->Ln(10);

//Header
$pdf->SetFont('helvetica' , '', 12);

$pdf->Cell(0, 15, 'The aforementioned Owner and Applicant agree on the following terms and conditions:', 0, 1, 'C');

//Body
$pdf->Cell(143, 6, 'This agreement acknowledges that the Landlord has received the sum of  $', 0, 0);
$pdf->Cell(12, 6, $depoAmount, 'B', 1, 'C');
$pdf->Ln(5);

$pdf->Cell(0, 6, 'This monetary sum shall be used as a holding deposit for the aforementioned rental unit from', 0, 1);
$pdf->Cell(20, 6, 'this date:', 0, 0);
$pdf->Cell(35, 6, $todayDate, 'B', 0, 'C');
$pdf->Cell(15, 6, ' until:', 0, 0);
$pdf->Cell(35, 6, $endDate, 'B', 1, 'C');
$pdf->Ln(5);

$pdf->MultiCell(0, 6, "If the Applicant's application is rejected or the property becomes unavailable within 14 days,
the holding deposit sum shall be returned in its entirety to the Applicant.
", 0, 1);
$pdf->Ln(5);

$pdf->MultiCell(0, 6, 'If the application is accepted, the holding deposit sum will be held until the end of the lease agreement. If any damages are made in the duration of the stay a portion or all of the deposit will
be used for repairs.
', 0, 1);
$pdf->Ln(5);

$pdf->Cell(0, 6, 'After expiration of the lease agreement, any balance not used on damages caused by the Applicant', 0, 1);
$pdf->Cell(0, 6, 'from the holding deposit shall be returned within 30 days', 0, 1);
$pdf->Ln(40);

$pdf->Cell(15);
$pdf->Cell(60, 6, $owner, 'B', 0, 'C');

$pdf->Cell(50);
$pdf->Cell(30, 6, date("m/d/y"), 'B', 1, 'C');


$pdf->Cell(15);
$pdf->Cell(60, 6, 'Owner', 0, 0, 'C');

$pdf->Cell(50);
$pdf->Cell(30, 6, 'Date', 0, 1, 'C');


$pdf->Ln(30);


$pdf->Cell(15);
$pdf->Cell(60, 6, $applicant, 'B', 1, 'C');

$pdf->Cell(15);
$pdf->Cell(60, 6, 'Applicant', 0, 0, 'C');
$pdf->Cell(40);

if (isset($_POST["submit"])) {

    $pdf->Output('I', $fileName);

} else if (isset($_POST["download"])) {

    $pdf->Output('D', $fileName);

} 

else if (isset($_POST["emailsig"])) {



    echo ' <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"> ';
    echo ' <label for="vehicle1"> I have a bike</label><br> ';



    $pdf->Output('I', $fileName);
}


?>