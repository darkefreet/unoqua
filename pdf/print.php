
<?php
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('header.png',10,10,20);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Move to the right
    $this->Cell(20);
    // Title
    $this->Cell(1,15,'PT. EMPAT MENARA MANDOSAWU');
    $this->SetFont('Arial','',10);
    $this->Cell(10,28,'Jalan Delima RT 21/ RW 007, Kelurahan Pau, Kecamatan Langke Rembong, Ruteng, NTT');
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

$lcell = 30;

// Instanciation of inherited class
$pdf = new PDF("L","mm","A4");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',9);

//SUBTITLE
$pdf->Cell(0,10,'SLIP GAJI KARYAWAN');
$pdf->Ln(5);

//PERIODE
$pdf->Cell($lcell,10,'Periode');
$pdf->Cell(5,10,':');
$pdf->Cell(0,10,$_POST['periode']);
$pdf->Ln(5);

//NIK
$pdf->Cell($lcell,10,'NIK');
$pdf->Cell(5,10,':');
$pdf->Cell(0,10,$_POST['NIK']);
$pdf->Ln(5);

//NAMA
$nama=$_POST['nama'];
$pdf->Cell($lcell,10,'Nama');
$pdf->Cell(5,10,':');
$pdf->Cell(0,10,$nama);
$pdf->Ln(5);

//JABATAN
$pdf->Cell($lcell,10,'Jabatan');
$pdf->Cell(5,10,':');
$pdf->Cell(0,10,$_POST['jabatan']);
$pdf->Ln(5);

$half=120;
$cell1=$half/2 - 20;
$cell2=10;
$cell3=$half/2 - 20;
$cell4=30;

//PENGHASILAN
$pdf->Ln(5);
$pdf->Cell($half,10,'PENGHASILAN');
$pdf->Cell($half,10,'POTONGAN');
$pdf->Ln(5);

//BARIS I
$pdf->Cell($cell1,10,'Gaji Pokok');
$pdf->Cell($cell2,10,'=');
$pdf->Cell($cell3,10,$_POST['gaji'],'','','R');
$pdf->Cell($cell4);
$pdf->Cell($cell1,10,'PPh21');
$pdf->Cell($cell2,10,'=');
$pdf->Cell($cell3,10,$_POST['pph21'],'','','R');
$pdf->Cell($cell4);
$pdf->Ln(5);

//BARIS II
$pdf->Cell($cell1,10,'Tunjangan');
$pdf->Cell($cell2,10,'=');
$pdf->Cell($cell3,10,$_POST['tunjangan'],'','','R');
$pdf->Cell($cell4);
$pdf->Cell($cell1,10,'Asuransi');
$pdf->Cell($cell2,10,'=');
$pdf->Cell($cell3,10,$_POST['asuransi'],'','','R');
$pdf->Cell($cell4);
$pdf->Ln(5);

//BARIS III
$pdf->Cell($cell1,10,'Bonus');
$pdf->Cell($cell2,10,'=');
$pdf->Cell($cell3,10,$_POST['bonus'],'','','R');
$pdf->Cell($cell4);
$pdf->Ln(10);

//BARIS IV
$pdf->Cell($cell1,10,'Total(A)');
$pdf->Cell($cell2,10,'=');
$pdf->SetFont('Arial','B',9);
$pdf->Cell($cell3,10,$_POST['totalA'],'','','R');
$pdf->Cell($cell4);
$pdf->SetFont('Arial','',9);
$pdf->Cell($cell1,10,'Total(B)');
$pdf->Cell($cell2,10,'=');
$pdf->SetFont('Arial','B',9);
$pdf->Cell($cell3,10,$_POST['totalB'],'','','R');
$pdf->Cell($cell4);
$pdf->SetFont('Arial','',9);
$pdf->Ln(10);


$pdf->Cell($half/2,10,'PENERIMAAN BERSIH');
$pdf->Cell($cell2,10,'=');
$pdf->SetFont('Arial','B',9);
$pdf->Cell($cell3,10,$_POST['totalAll'],'','','R');
$pdf->SetFont('Arial','',9);

$ttd = $half+60;

$tempatTanggal = $_POST['kota'].", ".$_POST['tanggal'];
$pdf->Ln(10);
$pdf->Cell($ttd);
$pdf->Cell(0,10,$tempatTanggal);

$pdf->Ln(5);
$pdf->Cell($ttd);
$pdf->Cell(0,10,$_POST['jabatan_penyetuju']);

$pdf->Ln(30);
$pdf->Cell($ttd);
$pdf->Cell(0,10,$_POST['penyetuju']);


$pdf->Output();
?>