<?php

namespace RADUFU\Relatorio;
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
 #include("file_with_errors.php");
header("Content-type: text/html; charset=utf-8");
require('../src/FPDI-1.4.3/fpdi.php');
#require('tabela.php');

class PDF extends FPDI
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
	        $this->Image('../img/ufu.jpg',3,1,0.9);
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

// Primeira Pagina: Cabeçalho e Tabela
    function PrimeiraPagina($nome,$periodos)
    {
    #-- Cabeçalho
        $this->SetFont('Times','B',16);
        $this->MultiCell(0,0.4,utf8_decode('Quadro Geral de Pontução'));
        $this->SetFont('Times','B',12);
        $this->Cell(1.25,0.5,'',0,0,'C',0);
        $this->Cell(2,0.4,'Professor: ');
        $this->SetFont('Times','',12);
        $this->Cell(0,0.4,utf8_decode($nome));
        $this->SetFont('Times','B',12);
        $this->Ln(1);
    #-- Construindo a tabela
        #Cabeçalho da tabela
        $this->SetFillColor(200,200,200);
        $this->Cell(2.5,0.5,'',0,0,'C',0);//espaco em branco
        $this->Cell(5,0.5,'Ensino',1,0,'C',1);
        $this->Cell(4,1,'Outras atividades',1,0,'C',1);
        $this->Cell(5,0.5,'Total',1,0,'C',1);
        $this->Cell(4,0.5,'',0,0,'C',0);
        $this->Ln(0.5);
        $this->Cell(2.5,0.5,utf8_decode('Período'),1,0,'C',1);
        $this->Cell(2.5,0.5,'Bruto',1,0,'C',1);
        $this->Cell(2.5,0.5,'Limitado',1,0,'C',1);
        $this->Cell(4,0.5,'',0,0,'C',0);
        $this->Cell(2.5,0.5,'Bruto',1,0,'C',1);
        $this->Cell(2.5,0.5,'Limitado',1,0,'C',1);
        $this->Ln();
        #Construindo o resto
        for($i = 0; $i < $periodos; $i++)
            {   
                for($j = 0; $j<6; $j++)
                    {
                        if($j==0)
                            {                                
                                $this->Cell(2.5,0.5,'2009-2',1,0,'C',1);    
                            }
                        else if($j==3)
                            {
                                $this->Cell(4,0.5,'1243',1,0,'C');
                            }
                        else
                            {
                                $this->Cell(2.5,0.5,'312',1,0,'C');
                            }    
                    }
                $this->Ln();
            }
            #Parte Final:
            $this->Cell(11.5,0.5,'',0,0,'C',0);//espaco em branco
            $this->Cell(2.5,0.5,'Media:',0,0,'C',0);
            $this->Cell(2.5,0.5,'1234,34',1,0,'C');
            $this->Ln();
            $this->Cell(4,0.5,utf8_decode('Pontos de referência'),1,0,'C',1);
            $this->Cell(4,0.5,'166',1,0,'C');
            $this->Ln();
            $this->Cell(4,0.5,utf8_decode('Limitação de ensino'),1,0,'C',1);
            $this->Cell(4,0.5,'141,1',1,0,'C');
            $this->Ln();
    }

//Quadro de pontuação por período
    function QuadroPeriodo($nome,$periodo,$atividades)
    {
    #-- Cabeçalho
        $this->SetFont('Times','B',16);
        $this->MultiCell(0,0.4,utf8_decode('Quadro de Pontução de ').$periodo);
        $this->SetFont('Times','B',12);
        $this->Cell(1.25,0.5,'',0,0,'C',0);
        $this->Cell(2,0.4,'Professor: ');
        $this->SetFont('Times','',12);
        $this->Cell(0,0.4,utf8_decode($nome));
        $this->SetFont('Times','B',12);
        $this->Ln(1);
    #-- Tabela
        #Cabeçalho da tabela
        $this->Cell(1.5,0.5,'Item',1,0,'C',1);
        $this->Cell(3,0.5,'Documento Pag.',1,0,'C',1); 
        $this->Cell(1.5,0.5,'Qtd',1,0,'C',1);      
        $this->Cell(2,0.5,'Pontos',1,0,'C',1);
        $this->Cell(9,0.5,utf8_decode('Descrição da atividade'),1,0,'C',1);
        $this->Ln();

        #Conteudo da tabela
        $texto = 'Disciplina INF13: Organização de Computadores 2 ';
        $texto0 = 'Disciplina GSI001: Empreendedorismo em Informática';  
        $texto1 = 'Publicação de trabalho completo em anais de reunião científica nacional, com corpo de revisores.';        
        $texto2 = 'Membro titular de banca de defesa de projetos,estágio supervisionado e de monografias de graduação';       
        $texto3 = 'Publicação de trabalho completo em anais de reunião científica internacional, com corpo de revisores ';
        $column_width = 9;
        $this->SetFont('Times','',12);
        for($i = 0; $i<$atividades;$i++)
            {
            	if ($i%3 == 0) 
	            	{
	            		$texto = $texto2;
	            		#$y = ($this->GetStringWidth($texto)) % (($column_width + 0.2)* 10);
	            		#$x = ceil( ($this->GetStringWidth($texto)-$y)/(($column_width + 0.2)*10));
	            		#$x = 5;
	            	}
	            else if ($i%2 == 0) {
	            	$texto = $texto0;
	            }
            	else if($i%5 == 0)
            		{
            			$texto = $texto1;
            		}
            	else{
            		$texto = $texto3;
            	}
            	if($this->GetStringWidth($texto) > 250)
            		{
            			$x = ceil($this->GetStringWidth($texto)/($column_width - ($this->GetStringWidth($texto)/225)));
            		}
            	else if($this->GetStringWidth($texto) > 350)
            		{
            			$x = ceil($this->GetStringWidth($texto)/($column_width - ($this->GetStringWidth($texto)/152))) - 3;
            		}
            	else 
            		{
            			$x = ceil($this->GetStringWidth($texto)/($column_width - ($this->GetStringWidth($texto)/200)));
            		}

            	
               for($j = 0; $j<5;$j++)
               {
                    if($j==0)
                    {
                        $this->Cell(1.5,0.5*$x,ceil($this->GetStringWidth($texto)),1,0,'C');
                    }
                    else if($j==1)
                    {
                    	$this->Cell(3,0.5*$x,ceil($this->GetStringWidth($texto)/$column_width),1,0,'C');                 
                    }
                    else if($j==2)
                    {
                    	$this->Cell(2,0.5*$x,$x,1,0,'C');                 
                    }
                    else if($j==3)
                    {
                        $this->Cell(1.5,0.5*$x,$x,1,0,'C');   
                    }
                    else
                    {
                        $this->MultiCell(9,0.5,utf8_decode($texto),1,'J',0,0);
                    }
               }
               #$this->Ln(); 
            }
    #-- Resumo das Atividades
        $this->Ln();
        $this->Cell(1.25,0.5,'',0,0,'C',0);
        $this->SetFont('Times','B',14);
        $this->MultiCell(0,0.4,'Resumo das atividades');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(5.5,0.5,'Ensino',1,0,'C',1);
        $this->Cell(5.5,0.5,'Demais Atividades',1,0,'C',1);
        $this->Cell(5.5,0.5,'Total',1,0,'C',1);
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(5.5,0.5,'142.3',1,0,'C');
        $this->Cell(5.5,0.5,'13443',1,0,'C');
        $this->Cell(5.5,0.5,'24142.4',1,0,'C');
        $this->Ln();
    }

//Segundo quadro de pontuação, utilizando a outra função

function QuadroPeriodo2($nome,$periodo,$atividades)
	{
    #-- Cabeçalho
		$this->SetFont('Times','B',16);
        $this->MultiCell(0,0.4,utf8_decode('Quadro de Pontução de ').$periodo);
        $this->SetFont('Times','B',12);
        $this->Cell(1.25,0.5,'',0,0,'C',0);
        $this->Cell(2,0.4,'Professor: ');
        $this->SetFont('Times','',12);
        $this->Cell(0,0.4,utf8_decode($nome));
        $this->SetFont('Times','B',12);
        $this->Ln(1);        
	#-- Tabela
		#--- Cabeçalho da tabela
        $this->Cell(1.5,0.5,'Item',1,0,'C',1);
        $this->Cell(1.5,0.5,'Qtd',1,0,'C',1); 
        $this->Cell(9,0.5,utf8_decode('Descrição da atividade'),1,0,'C',1);      
        $this->Cell(2,0.5,'Pontos',1,0,'C',1);
        $this->Cell(3,0.5,'Documento Pag.',1,0,'C',1);
        $this->SetFont('Times','',12);
        $this->Ln();

        $this->SetWidths(array(1.5,1.5,9,2,3));

        $texto = 'Disciplina INF13: Organização de Computadores 2 ';
        $texto0 = 'Disciplina GSI001: Empreendedorismo em Informática';  
        $texto1 = 'Publicação de trabalho completo em anais de reunião científica nacional, com corpo de revisores.';        
        $texto2 = 'Membro titular de banca de defesa de projetos,estágio supervisionado e de monografias de graduação';       
        $texto3 = 'Publicação de trabalho completo em anais de reunião científica internacional, com corpo de revisores ';
        
        $texto = array();
        $texto[0] = utf8_decode($texto0);
        $texto[1] = utf8_decode($texto1);
        $texto[2] = utf8_decode($texto2);
        $texto[3] = utf8_decode($texto3);
   		#--- Tabela em si
        for($i=0;$i<20;$i++)
        	{
        		$this->Row(array($i,$i,$texto[$i%4],$i,$i));
        	}
    #-- Resumo das Atividades
        $this->Ln();
        $this->Cell(1.25,0.5,'',0,0,'C',0);
        $this->SetFont('Times','B',14);
        $this->MultiCell(0,0.4,'Resumo das atividades');
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(5.5,0.5,'Ensino',1,0,'C',1);
        $this->Cell(5.5,0.5,'Demais Atividades',1,0,'C',1);
        $this->Cell(5.5,0.5,'Total',1,0,'C',1);
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(5.5,0.5,'142.3',1,0,'C');
        $this->Cell(5.5,0.5,'13443',1,0,'C');
        $this->Cell(5.5,0.5,'24142.4',1,0,'C');
        $this->Ln();
	}



//Relatorio de atividades de um determinado periodo
    function RelatorioAtividade($nome,$periodo)
    {
    #-- Cabeçalho
        $this->SetFont('Times','B',16);
        $this->MultiCell(0,0.4,utf8_decode('Relatório de Atividades'));
        $this->SetFont('Times','B',12);
        $this->Cell(1.25,0.5,'',0,0,'C',0);
        $this->Cell(2,0.4,utf8_decode('Período: '));
        $this->SetFont('Times','',12);
        $this->Cell(0,0.4,$periodo);
        $this->Ln();
        $this->SetFont('Times','B',12);
        $this->Cell(1.25,0.5,'',0,0,'C',0);
        $this->Cell(2,0.4,'Professor: ');
        $this->SetFont('Times','',12);
        $this->Cell(0,0.4,utf8_decode($nome));
        $this->SetFont('Times','B',12);
        $this->Ln(1);
    #-- Tipos de atividades
        //5: Atividade de Ensino, Atividade de Orientação, Produção bibliográfica, Produção Técnica, Outras Atividades.
        $this->Ln();
        //Caso haja mais de 5 tipos de atividade basta colocar um for aqui!
        $atividades = array();
        $atividades[0]=utf8_decode('Atividades de Ensino');
        $atividades[1]=utf8_decode('Atividades de Orientação');
        $atividades[2]=utf8_decode('Produção bibliográfica');
        $atividades[3]=utf8_decode('Produção Técnica');
        $atividades[4]=utf8_decode('Outras atividades');

        $pontos = array();
        $pontos[0] = 1234;
        $pontos[1] = 134;
        $pontos[2] = 234;
        $pontos[3] = 125;
        $pontos[4] = 834;

        $bullets = array();
        $bullets[0] = chr(127);
        $bullets[1] = chr(155);
        $bullets[2] = chr(187);
        $bullets[3] = chr(186);
        $bullets[4] = chr(185);
        $bullets[5] = chr(183);
        $bullets[6] = chr(176);

        for($i = 0; $i<5;$i++)
        {
        $nivel = 0;        
        //Nivel 0:
        $this->SetFont('Times','',14);
        $this->Cell(6.5,0.4,$bullets[$nivel].' '.$atividades[$i].': '.$pontos[$i].' pontos');
        $this->Ln(1);

        $this->SetFont('Times','',12);
        $nivel = 1;
        //Nivel 1:
            for ($j=0; $j < 3; $j++) { 
                $this->Cell(1 * $nivel,0.5,'',0,0,'C',0);
                $this->Cell(6.5,0.4,$bullets[$nivel].utf8_decode(' Disciplinas no Curso de Bacharelado de Ciência da Computação ').$nivel);
                $this->Ln(1);

                $nivel ++ ;

                for ($k=0; $k <3 ; $k++) { 
                      #  $this->Cell(1 * $nivel,0.5,'',0,0,'C',0);
                      #  $this->Cell(6.5,0.4,$bullets[$nivel].utf8_decode(' Isto é um texto de nível ').$nivel);
                      #  $this->Ln(1);
                }

                $nivel --;

            }
        $nivel --;
        #$this->SetFont('Times','',12);
        #$this->Cell(0,0.4,$pontos[$i].' pontos',0,0,'L',0);                

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