<?php 
namespace RADUFU\Service;
use \FPDI,
  RADUFU\DAO\Factory,
	RADUFU\DAO\postgres\ProfessorDAO,
    RADUFU\Service\ProfessorService,
  # RADUFU\Service\ComprovanteService;
    RADUFU\Service\AtividadeService,
    RADUFU\Service\TipoService,	
    RADUFU\Model\Professor,
    RADUFU\Model\Relatorio,
    RADUFU\Model\Atividade,
    RADUFU\Relatorio\PDF,
    RADUFU\Service\CategoriaService;
require_once(__DIR__.'/../Autoloader.php');
require_once(__DIR__.'/Relatorio/src/FPDI-1.4.3/fpdi.php');
#require_once(__DIR__ . '/../../../Relatorio/src/FPDI-1.4.3/fpdi.php');

class RelatorioService extends FPDI{
	#services usados
	private $relatorioService;
	private $categoriaService;
	private $professorService;
	private $atividadeService;

	#variaveis da classe
    private $pdf;
	private $relatorio;
	private $prof; #Professor que requisitou o relatorio
    private $dataI;
    private $dataF;
    private $pontuacaoDeReferencia;
    private $limitacaoDeEnsino; #apenas a % de limitacao do ensino (% do valor de base)
    private $limiteEnsino; #o valor de $limitacaoDeEnsino * pontuacao de referencia
    private $pontuacoes;
	private $atividades; #atividades do professor entre as datas
	private $ativPeriodos; #Array de array. um array de periodos onde para cada periodo temos um arrray com as atividades presentes nele

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $idProfessor
     * @return Tonic\Response
     */
    public function __construct($id,$dataI,$dataF,$pont_ref,$lim_ensi)
        {
           $this->pdf = new FPDI("P","cm","A4");
           $this->atividades = array();
           $this->ativPeriodos = array();
           $this->atividadeService = new AtividadeService();
           $this->categoriaService = new CategoriaService();
           $this->prof = $this->GetProf($id);
           $this->pontuacaoDeReferencia = $pont_ref;
           $this->limitacaoDeEnsino = $lim_ensi;
           $this->limiteEnsino = $this->pontuacaoDeReferencia * $this->limitacaoDeEnsino;
           $this->dataI = $dataI;
           $this->dataF = $dataF;
        }

    public function GerarRelatorio(){
        /*
        Entrada: A definir (professor, inicio, fim, classe, nivel)
        Processo:
        0. "Preencher" as variaveis da classe 
        1. PrimeiraPagina()
        2. para cada periodo:
        3.      QuadroPontuacao()
        4.      RelatorioAtividade()
        5. Certificados()
        Saida: Nada, ira apenas gerar o relatorio
        */

        #Preenchendo as variaveis da classe
        #$this->prof = $this->GetProf($id);
        $this->atividades = $this->atividadeService->getEntreDatas($this->prof->getId(),$this->dataI,$this->dataF);
        $this->PeriodosAtividades();

        $this->relatorio = new Relatorio("P","cm","A4");
        $this->relatorio->SetMargins(3,1.5,2);
		$this->relatorio->AliasNbPages();
		$this->PrimeiraPagina();

		foreach ($this->ativPeriodos as $periodo => $ativs) {
			$this->QuadroPontuacao($periodo);
			$this->RelatorioAtividade($periodo);
		}
		$this->Comprovantes();
		$this->relatorio->Output($this->prof->getNome().'.pdf','F');
    }

    public function PrimeiraPagina()
    {
        /*
        Entrada: Atividaes e datas de inicio e fim
        Processo:
            1. Construir o Cabecalho da pagina - OK
            2. Para cada periodo em atividades
            3.     BE[periodo] = CalcularBruto($atividades)
            4.     LE[periodo] = CalcularLimitadoEnsino($atividades)
            5.     O[periodo] = CalcularOutrasAtividades($atividades)
            6.     BT = BE[periodo] + O[periodo]
            7.     LT = LE[periodo] + O[periodo]
            8. Imprimir Pontos de Referencia
            9. Imprimir Media = ?
            10. Imprimir Limiração de ensino = max(LE)
        Saida: Constroi a primeira pagina do PDF
        */
	    $this->relatorio->AddPage();
	    #-- Cabeçalho
	        $this->relatorio->SetFont('Times','B',16);
	        $this->relatorio->MultiCell(0,0.4,utf8_decode('Quadro Geral de Pontução'));
	        $this->relatorio->SetFont('Times','B',12);
	        $this->relatorio->Cell(1.25,0.5,'',0,0,'C',0);
	        $this->relatorio->Cell(2,0.4,'Professor: ');
	        $this->relatorio->SetFont('Times','',12);
	        $this->relatorio->Cell(0,0.4,utf8_decode($this->prof->getNome()));
	        $this->relatorio->SetFont('Times','B',12);
	        $this->relatorio->Ln(1);
	    #-- Construindo a tabela
		    #--- Cabecalho da tabela
		        $this->relatorio->SetFillColor(200,200,200);
		        $this->relatorio->Cell(2.5,0.5,'',0,0,'C',0);//espaco em branco
		        $this->relatorio->Cell(5,0.5,'Ensino',1,0,'C',1);
		        $this->relatorio->Cell(4,1,'Outras atividades',1,0,'C',1);
		        $this->relatorio->Cell(5,0.5,'Total',1,0,'C',1);
		        $this->relatorio->Cell(4,0.5,'',0,0,'C',0);
		        $this->relatorio->Ln(0.5);
		        $this->relatorio->Cell(2.5,0.5,utf8_decode('Período'),1,0,'C',1);
		        $this->relatorio->Cell(2.5,0.5,'Bruto',1,0,'C',1);
		        $this->relatorio->Cell(2.5,0.5,'Limitado',1,0,'C',1);
		        $this->relatorio->Cell(4,0.5,'',0,0,'C',0);
		        $this->relatorio->Cell(2.5,0.5,'Bruto',1,0,'C',1);
		        $this->relatorio->Cell(2.5,0.5,'Limitado',1,0,'C',1);
		        $this->relatorio->Ln();
		    #--- Construindo o resto
		        $TotalLT = 0;
		        $pontuacoes = array();
		        foreach ($this->ativPeriodos as $periodo => $categoriasDicionario)
		        {
		        	
		        	$BE = $this->CalcularBruto($categoriasDicionario['Ensino']);
		        	$LE = $this->CalcularLimitadoEnsino($categoriasDicionario['Ensino'],$BE);
		        	$O = $this->CalcularOutrasAtividades($categoriasDicionario);
			        $BT = $BE+$O;
		        	$LT = $LE+$O;
		        	$MTP = $LT; //Media total por periodo
		        	$TotalLT += $MTP;		
				    $this->pontuacoes[$periodo]['BE'] = $BE;
				    $this->pontuacoes[$periodo]['LE'] = $LE;
				    $this->pontuacoes[$periodo]['O'] = $O;
				    $this->pontuacoes[$periodo]['BT'] = $BT;
				    $this->pontuacoes[$periodo]['LT'] = $LT;

				    for($j = 0; $j<6; $j++)
			            {
			            	switch ($j) {
			            		case 0:
			            			$this->relatorio->Cell(2.5,0.5,$periodo,1,0,'C',1);
			            			break;
		            			
		            			case 1:
		            				$this->relatorio->Cell(2.5,0.5,$BE,1,0,'C');
		            				break;
		            			
		            			case 2:
		            				$this->relatorio->Cell(2.5,0.5,$LE,1,0,'C');
		            				break;
		            			
		            			case 3:
		            				$this->relatorio->Cell(4,0.5,$O,1,0,'C');
		            				break;
		            			
		            			case 4:
		            				$this->relatorio->Cell(2.5,0.5,$BT,1,0,'C');
		            				break;

		            			case 5:
		            				$this->relatorio->Cell(2.5,0.5,$LT,1,0,'C');
		            				break;
			            		}
			    		}
		        	$this->relatorio->Ln();
		        }
	    #--- Parte Final
        $this->relatorio->Cell(11.5,0.5,'',0,0,'C',0);//espaco em branco
        $this->relatorio->Cell(2.5,0.5,'Media:',0,0,'C',0);
        $this->relatorio->Cell(2.5,0.5,$TotalLT/count($this->ativPeriodos),1,0,'C');
        $this->relatorio->Ln();
        $this->relatorio->Cell(4,0.5,utf8_decode('Pontos de referência'),1,0,'C',1);
        $this->relatorio->Cell(4,0.5,$this->pontuacaoDeReferencia,1,0,'C');
        $this->relatorio->Ln();
        $this->relatorio->Cell(4,0.5,utf8_decode('Limitação de ensino'),1,0,'C',1);
        $this->relatorio->Cell(4,0.5,($this->limitacaoDeEnsino *$this->pontuacaoDeReferencia),1,0,'C');
        $this->relatorio->Ln();    
    }

    public function QuadroPontuacao($periodo){
        /*
        Entrada: Periodo, atividades, Tipos
        Processo: Constroi o quadro de pontuacao do periodo com todas as descricoes dos tipos das atividades que aparecem no mesmo juntamente com o item ao qual pertencem, quantidade, pontos e Documento Pag.
        Saida: Nada, ira apenas gerar a tabela para o FPDF
        */
        $this->relatorio->AddPage();
    #-- Cabeçalho
        $this->relatorio->SetFont('Times','B',16);
        $this->relatorio->MultiCell(0,0.4,utf8_decode('Quadro de Pontução de ').$periodo);
        $this->relatorio->SetFont('Times','B',12);
        $this->relatorio->Cell(1.25,0.5,'',0,0,'C',0);
        $this->relatorio->Cell(2,0.4,'Professor: ');
        $this->relatorio->SetFont('Times','',12);
        $this->relatorio->Cell(0,0.4,utf8_decode($this->prof->getNome()));
        $this->relatorio->SetFont('Times','B',12);
        $this->relatorio->Ln(1);
	#-- Tabela
		#--- Cabeçalho da tabela
        $this->relatorio->Cell(1.5,0.5,'Item',1,0,'C',1);
        $this->relatorio->Cell(1.5,0.5,'Qtd',1,0,'C',1); 
        $this->relatorio->Cell(9,0.5,utf8_decode('Descrição da atividade'),1,0,'C',1);      
        $this->relatorio->Cell(2,0.5,'Pontos',1,0,'C',1);
        $this->relatorio->Cell(3,0.5,'Documento Pag.',1,0,'C',1);
        $this->relatorio->SetFont('Times','',12);
        $this->relatorio->Ln();

        $this->relatorio->SetWidths(array(1.5,1.5,9,2,3));

   		#--- Tabela em si
   		foreach ($this->ativPeriodos[$periodo] as $categoriasDicionario => $ativs)
	   		{
	   			foreach ($ativs as $atvdd)
	   				{
	   					$this->relatorio->Row(array($atvdd->getTipo()->getId(),$atvdd->getMultValor(),utf8_decode($atvdd->getDescricao()),$this->pontosAtividade($atvdd),''));
	   				}	
	   		}
    #-- Resumo das Atividades
        $this->relatorio->Ln();
        $this->relatorio->Cell(1.25,0.5,'',0,0,'C',0);
        $this->relatorio->SetFont('Times','B',14);
        $this->relatorio->MultiCell(0,0.4,'Resumo das atividades');
        $this->relatorio->Ln();
        $this->relatorio->SetFont('Times','B',12);
        $this->relatorio->Cell(5.5,0.5,'Ensino',1,0,'C',1);
        $this->relatorio->Cell(5.5,0.5,'Demais Atividades',1,0,'C',1);
        $this->relatorio->Cell(5.5,0.5,'Total',1,0,'C',1);
        $this->relatorio->Ln();
        $this->relatorio->SetFont('Times','',12);
        $this->relatorio->Cell(5.5,0.5,$this->pontuacoes[$periodo]['BE'],1,0,'C');
        $this->relatorio->Cell(5.5,0.5,$this->pontuacoes[$periodo]['O'],1,0,'C');
        $this->relatorio->Cell(5.5,0.5,$this->pontuacoes[$periodo]['BT'],1,0,'C');
        $this->relatorio->Ln();            
    }
    public function RelatorioAtividade($periodo){
        /*
        Entrada: Periodo, atividades, categoria
        Processo: 
            1. Cria o cabecalho da pagina
            2. Para cada Categoria
            3.      Imprime o nome seguido do total de pontos
            4.      para cada atividade da categoria
            5.          imprime a descricao
        Saida: Nada, apenas ira gerar o relatorio de atividade do periodo em questao para o fdpf
        */
        $this->relatorio->AddPage();
    #-- Cabeçalho
        $this->relatorio->SetFont('Times','B',16);
        $this->relatorio->MultiCell(0,0.4,utf8_decode('Relatório de Atividades'));
        $this->relatorio->SetFont('Times','B',12);
        $this->relatorio->Cell(1.25,0.5,'',0,0,'C',0);
        $this->relatorio->Cell(2,0.4,utf8_decode('Período: '));
        $this->relatorio->SetFont('Times','',12);
        $this->relatorio->Cell(0,0.4,$periodo);
        $this->relatorio->Ln();
        $this->relatorio->SetFont('Times','B',12);
        $this->relatorio->Cell(1.25,0.5,'',0,0,'C',0);
        $this->relatorio->Cell(2,0.4,'Professor: ');
        $this->relatorio->SetFont('Times','',12);
        $this->relatorio->Cell(0,0.4,utf8_decode($this->prof->getNome()));
        $this->relatorio->SetFont('Times','B',12);
        $this->relatorio->Ln(1);
    #-- Tipos de atividades
        //5: Atividade de Ensino, Atividade de Orientação, Produção bibliográfica, Produção Técnica, Outras Atividades.
        $this->relatorio->Ln();


        $bullets = array();
        $bullets[0] = chr(127);
        $bullets[1] = chr(155);
        $bullets[2] = chr(187);
        $bullets[3] = chr(186);
        $bullets[4] = chr(185);
        $bullets[5] = chr(183);
        $bullets[6] = chr(176);
        //Caso haja mais de 5 tipos de atividade basta colocar um for aqui!
        foreach ($this->ativPeriodos[$periodo] as $categoriasDicionario => $ativs)
            {
                $nivel = 0;
                $this->relatorio->SetFont('Times','',14);
                $this->relatorio->Cell(6.5,0.4,$bullets[$nivel].'Atividades de '.utf8_decode($categoriasDicionario).': '.$this->CalcularBruto($ativs).' pontos');
                $this->relatorio->Ln(1);

                $this->relatorio->SetFont('Times','',12);
                foreach ($ativs as $atvdd)
                    {
                        $nivel = 1;
                        $this->relatorio->Cell(1 * $nivel,0.5,'',0,0,'C',0);
                        $this->relatorio->Cell(6.5,0.4,$bullets[$nivel].utf8_decode(' Disciplinas no Curso de Bacharelado de Ciência da Computação ').$nivel);
                        $this->relatorio->Ln(1);
                    }   
            }      
    }

    # Anexa ao fim do documento os certificados das atividades
    public function Comprovantes(){

    	#Desabilitando o Header:
    	$this->relatorio->header_flag = false;
    	#Para cada atividade
    	foreach ($this->ativPeriodos as $periodo => $categoriasDicionario) {
    		foreach ($categoriasDicionario as $categoria => $atividadesPorCategoria) {
    			foreach ($atividadesPorCategoria as $atividade) {
    				if($atividade->getComprovantes())
    				{
    					foreach ($atividade->getComprovantes() as $comprovante)
    					{
    						//echo $comprovante->getArquivo().'                ';
    						$pagecount = $this->relatorio->setSourceFile($comprovante->getArquivo());
    						//echo $pagecount. '------------';
    						if (!empty($pagecount))
    						{
				            for($i = 1; $i <= $pagecount; $i++) 
					            {
					                
					                $tplidx = $this->relatorio->ImportPage($i);

					                $s = $this->relatorio->getTemplatesize($tplidx);
					                #Mega bug! Nao sei pq isso funciona asism, so sei que apenas funciona assim!
					                #Nao mecher! haeuhueahuaehe
					                #O correto seria: $this->AddPage($s['w'] > $s['h'] ? 'L': 'P', array($s['w'], $s['h']));
					                if ($s['w']>$s['h']) 
					                {
					                	$this->relatorio->AddPage('L', array($s['h'], $s['w']));
					                }
					                else 
					                {
					                	$this->relatorio->AddPage('P', array($s['w'], $s['h']));
					                }
					                $this->relatorio->useTemplate($tplidx);
					            }
					        }	
    					}
    				}
    			}
    		}
    	}
		$this->relatorio->header_flag = true;
    }

#---------------------- FUNCOES AUXILIARES ----------------------#
    private function PeriodosAtividades()
	    {
	    	$ano = '';
	    	$periodo = '';
	    	$categorias = $this->categoriaService->searchAll();
	    	#iniciando todas as possiveis entradas ao dicionario
	    	foreach ($this->atividades as $ativ) {
	    		$data_i = explode("/",$ativ->getDataInicio());
	    		$ano = $data_i[2];
	    		$periodo = ((int)$data_i[1]<7)?'1':'2';
	    		
	    		$periodo2 = ($periodo == '1') ? '2':'1';
	    		$ano2 = ((int)$ano - 1).'';
	    		$ano2 =  ($periodo2 == '1') ? ($ano) : ($ano2);
		
	    		$this->ativPeriodos[$ano2.'-'.$periodo2] = array();
	    		$this->ativPeriodos[$ano.'-'.$periodo] = array();
	    	}
	    	#adicionando as atividades ao dicionario
	    	foreach ($this->atividades as $ativ) {
	    		$data_i = explode("/",$ativ->getDataInicio());
	    		$ano = $data_i[2];
	    		$periodo = ((int)$data_i[1]<7)?'1':'2';
				#tratando a greve
	    		if (2012 == (int)$data_i[2])
		    		{
		    			$ano = '2012';
		 	   			$periodo = ((int)$data_i[1] < 10)? '1' : '2';
		 	   		}	
	 	   		elseif (2013 == (int)$data_i[2])
		 	   		{
		 	   			if ((int)$data_i<5)
			 	   			{
			 	   				$ano = '2012';
			 	   				$periodo = '2';
			 	   			}
		 	   			elseif((int)$data_i < 11)
			 	   			{
			 	   				$ano = '2013';
			 	   				$periodo = '1';
			 	   			}
		 	   			else
			 	   			{
			 	   				$ano = '2013';
			 	   				$periodo = '2';	
			 	   			}
		 	   		}
	 	   		elseif(2014 == (int)$data_i[2])
		    		{
		    			if ((int)$data_i<3)
			 	   			{
			 	   				$ano = '2013';
			 	   				$periodo = '1';
			 	   			}
		 	   			elseif((int)$data_i < 8)
			 	   			{
			 	   				$ano = '2014';
			 	   				$periodo = '1';
			 	   			}
		 	   			else
			 	   			{
			 	   				$ano = '2014';
			 	   				$periodo = '2';	
			 	   			}
		    		}
		    	$per = $ano.'-'.$periodo;		
				$this->ativPeriodos[$per][$ativ->getTipo()->getCategoria()->getNome()][] = $ativ;	    	
	    	}
	    	#limpando as partes vazias do dicionario
	    	foreach ($this->ativPeriodos as $key => $ativs) {
	    		if(count($ativs) == 0)
	    			{
	    				unset($this->ativPeriodos[$key]);
	    			}
	    	}
	    }
    private function CalcularBruto(array $atividades)
	    {
	    	$bruto = 0;
	    	foreach ($atividades as $ativ)
		    	{
		    			$bruto += $this->pontosAtividade($ativ);
		    	}
		    return $bruto;
	    }
    private function CalcularLimitadoEnsino(array $atividadesEnsino, $bruto)
    	{
    		return ($bruto > $this->limiteEnsino) ? $this->limiteEnsino : $bruto;
    	}
    private function CalcularOutrasAtividades(array $categoriasDicionario)
    	{
    		
    		$outras = 0;
    		foreach ($categoriasDicionario as $cat => $atividadesDaCategoria)
	    		{
	    			if ($cat != 'Ensino') {
	    				foreach ($atividadesDaCategoria as $ativ)
					    	{
					    		$outras += $this->pontosAtividade($ativ);
					    	}
	    			}
	    		}
    		return $outras;
    	}
    private function pontosAtividade($atividade)
    	{
    		$pontuacaoLimite = $atividade->getTipo()->getPontuacaoLimite();
    		$pontuacaoReferencia = $atividade->getTipo()->getPontuacaoReferencia();
    		$pontuacao = $atividade->getTipo()->getPontuacao();
    		$pontos = $atividade->getMultValor() * $pontuacao;
    		
	    	return (!is_null($pontuacaoLimite) && $pontos > $pontuacaoLimite) ? $pontuacaoLimite : $pontos;
    	}     	    
    public function GetProf($id)
        {
            #Argumentos: Id do professor
            #Saida: Objeto professor
            $professorService = new ProfessorService();
            return $professorService->get($id);
        }
}
?>
