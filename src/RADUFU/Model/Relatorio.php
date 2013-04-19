<?php
namespace RADUFU\Model;
use \FPDI;
header("Content-type: text/html; charset=utf-8");
require_once(__DIR__.'/../Autoloader.php');
require_once(__DIR__.'/../Service/Relatorio/src/FPDI-1.4.3/fpdi.php');

use \JsonSerializable,
    #   RADUFU\Relatorio\FPDI,
    RADUFU\util\LazyDelCollection;

class Relatorio extends FPDI
{
	var $header_flag = true;
	var $footer_flag = true;

#-- Funcao louca que encontrei
	var $widths;
	var $aligns;

	function SetWidths($w)
		{
		    //Set the array of column widths
		    $this->widths=$w;
		}

	function SetAligns($a)
		{
		    //Set the array of column alignments
		    $this->aligns=$a;
		}

	function Row($data)
		{
		    //Calculate the height of the row
		    $nb=0;
		    for($i=0;$i<count($data);$i++)
		        $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		    $h=0.5*$nb;
		    //Issue a page break first if needed
		    $this->CheckPageBreak($h);
		    //Draw the cells of the row
		    for($i=0;$i<count($data);$i++)
		    {
		        $w=$this->widths[$i];
		        $tipo = ($i == 2) ? 'J' : 'C';
		        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : $tipo;
		        //Save the current position
		        $x=$this->GetX();
		        $y=$this->GetY();
		        //Draw the border
		        $this->Rect($x, $y, $w, $h);
		        //Print the text
		        $this->MultiCell($w, 0.5, $data[$i], 0, $a);
		        //Put the position to the right of the cell
		        $this->SetXY($x+$w, $y);
		    }
		    //Go to the next line
		    $this->Ln($h);
		}

	function CheckPageBreak($h)
		{
		    //If the height h would cause an overflow, add a new page immediately
		    if($this->GetY()+$h>$this->PageBreakTrigger)
		        $this->AddPage($this->CurOrientation);
		}

	function NbLines($w, $txt)
		{
		    //Computes the number of lines a MultiCell of width w will take
		    $cw=&$this->CurrentFont['cw'];
		    if($w==0)
		        $w=$this->w-$this->rMargin-$this->x;
		    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		    $s=str_replace("\r", '', $txt);
		    $nb=strlen($s);
		    if($nb>0 and $s[$nb-1]=="\n")
		        $nb--;
		    $sep=-1;
		    $i=0;
		    $j=0;
		    $l=0;
		    $nl=1;
		    while($i<$nb)
		    {
		        $c=$s[$i];
		        if($c=="\n")
		        {
		            $i++;
		            $sep=-1;
		            $j=$i;
		            $l=0;
		            $nl++;
		            continue;
		        }
		        if($c==' ')
		            $sep=$i;
		        $l+=$cw[$c];
		        if($l>$wmax)
		        {
		            if($sep==-1)
		            {
		                if($i==$j)
		                    $i++;
		            }
		            else
		                $i=$sep+1;
		            $sep=-1;
		            $j=$i;
		            $l=0;
		            $nl++;
		        }
		        else
		            $i++;
		    }
		    return $nl;
		}

//Page header
    function Header()
    {
    	if ($this->header_flag == 1) {	    	
	        //Logo
	        $this->Image(__DIR__.'/img/ufu.jpg',3,1,0.9);
	        //Arial bold 15
	        $this->SetFont('Times','B',12);
	        //Move to the right
	        $this->Cell(3);
	        //Title
	        $this->Cell(10,0,utf8_decode('Universidade Federal de Uberlândia'),0,0,'C');

	        $this->Ln();
	        #$this->Line(3,2.27,19,2.27);
	        $this->SetFont('Arial','',7);

	        $this->Ln(1);
	        #$this->MultiCell(0,0.2,utf8_decode('Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamco'));
	        #$this->cMargin=1;
	        #$this->Cell(0.5,2.7,'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamco',0,0); 
	        #$this->Line(3,3.1,19,3.1);
	        //Line break
	        $this->Ln(0.7);
    	}
    }

//Page footer
    function Footer()
    {
    	if ($this->footer_flag)
    	{	
	        //Position at 1.5 cm from bottom
	        $this->SetY(-1.5);
	        //Arial italic 8
	        $this->SetFont('Arial','I',8);
	        //Page number
	        $this->Cell(0,1,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
	    }
    }

    function Certificados($certificados) 
    {
    	#Desabilitando o Header:
    	$this->header_flag = false;
    	foreach($certificados AS $cert) 
        {
            $pagecount = $this->setSourceFile($cert);

            for($i = 1; $i <= $pagecount; $i++) 
            {
                
                $tplidx = $this->ImportPage($i);
                $s = $this->getTemplatesize($tplidx);
                #Mega bug! Nao sei pq isso funciona asism, so sei que apenas funciona assim!
                #Nao mecher! haeuhueahuaehe
                #O correto seria: $this->AddPage($s['w'] > $s['h'] ? 'L': 'P', array($s['w'], $s['h']));
                if ($s['w']>$s['h']) 
                {
                	$this->AddPage('L', array($s['h'], $s['w']));
                }
                else 
                {
                	$this->AddPage('P', array($s['w'], $s['h']));
                }
                $this->useTemplate($tplidx);
            }
        }
        $this->header_flag = 1;
    }
}

?>