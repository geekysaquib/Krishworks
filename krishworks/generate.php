<?php 
require_once("configpdf.php");
if(isset($_POST['generatepdf'])){
    $emailpost = $_POST['email'];
require('fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

// code for print Heading of tables
$pdf->SetFont('Arial','B',9);	
$ret ="SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='studyeze_database' AND `TABLE_NAME`='student_database'";
$query1 = $dbh -> prepare($ret);
$query1->execute();
$header=$query1->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query1->rowCount() > 0)
{
foreach($header as $heading) {
foreach($heading as $column_heading)
$pdf->Cell(20,9,$column_heading,1);
}}
//code for print data
$sql = "SELECT * from student_database";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{

foreach($results as $row) {
	$pdf->SetFont('Arial','',9);	
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(20,9,$column,1);
} }
$pdf->Output();
    
    
}

?>