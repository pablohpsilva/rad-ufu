<?php
header("Content-type: text/html; charset=utf-8");
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
require('relatorio.php');

$pdf = new PDF("P","cm","A4");
$pdf->SetMargins(3,1.5,2);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->PrimeiraPagina('Renan Gonçalves Cattelan',5);
$pdf->AddPage();
$pdf->QuadroPeriodo2('Renan Gonçalves Cattelan','2009/2',60);
$pdf->AddPage();
$pdf->RelatorioAtividade('Renan Gonçalves Cattelan','2009/2');
$pdf->SetFont('Times','',12);
$certificados = array('../mensaoHonrosa.pdf');
$pdf->Certificados($certificados);
$pdf->Output();
?>