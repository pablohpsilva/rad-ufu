<?php
namespace RADUFU\Resource;

use RADUFU\Service\RelatorioService,
    RADUFU\Service\AtividadeService,
    Tonic\Resource,
    Tonic\Response,
    RADUFU\Model\Professor;
/**
 * @uri /relatorio
 * @uri /relatorio/:id
 */
class RelatorioResource extends Resource {
/**
    Esta classe esta destinada a gerar o relatorio final, de acordo com as datas informadas utilizando o framework FPDF e FPDI.
*/
    private $relatorioService;
    public function __construct()
        {
            #$this->prof = new Professor();
            #$this->atividades = array();
            #$this->relatorioService = new RelatorioService();
            #$this->atividadeService = new atividadeService();
            #$this->prof = new Professor();
        }

    public function GerarRelatorio($id){
        /**
           $id, $dataI, $dataF,$classe,$nivel 
        */
        #Criando o dicionario com as opcoes possiveis(classe,nivel[0,1,2])
            $pont_ref["auxiliar"][0] = 120;
            $pont_ref["auxiliar"][1] = 125;
            $pont_ref["auxiliar"][2] = 130;
            
            $pont_ref["assistente"][0] = 138;
            $pont_ref["assistente"][1] = 146;
            $pont_ref["assistente"][2] = 154;

            $pont_ref["adjunto"][0] = 166;
            $pont_ref["adjunto"][1] = 178;
            $pont_ref["adjunto"][2] = 190;

            $pont_ref["associado"][0] = 214;
            $pont_ref["associado"][1] = 226;
            $pont_ref["associado"][2] = 238;
        #limitacao de ensino sera igual para todos
            $lim_ensi = 0.85;
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();

        if(!(isset($this->request->data->id)
            &&isset($this->request->data->dataI)
            &&isset($this->request->data->dataF)
            &&isset($this->request->data->classe)
            &&isset($this->request->data->nivel)))
            return new Response(Response::BADREQUEST);
        
        try {
            $data_inicio = $this->data($dataI);
            $data_final = $this->data($dataF);
            $this->relatorioService = new RelatorioService(
                $this->request->data->id,
                $this->request->data->dataI,
                $this->request->data->dataF,
                $this->request->data->classe,
                $this->request->data->nivel
                );
            $this->relatorioService->GerarRelatorio();
            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        } catch (RADUFU\DAO\Exception $e) {
            throw new Tonic\Exception($e->getMessage());
        }
    }
    #funcao para formatar a data
    private function data($data)
        {
            $aux = explode("/",$data);
            return $aux[2].'-'.$aux[1].'-'.$aux[0];
        }

    private function download($arquivo)
        {
            // Define o tempo máximo de execução em 0 para as conexões lentas
            set_time_limit(0);
            // Arqui você faz as validações e/ou pega os dados do banco de dados
            $aquivoNome = 'imagem.jpg'; // nome do arquivo que será enviado p/ download
            $arquivoLocal = '/pasta/do/arquivo/'.$aquivoNome; // caminho absoluto do arquivo

            // Verifica se o arquivo não existe

            if (!file_exists($arquivoLocal)) {
                // Exiba uma mensagem de erro caso ele não exista
                exit;
            }
            $novoNome = 'imagem_nova.jpg';
            // Configuramos os headers que serão enviados para o browser

            header('Content-Description: File Transfer');

            header('Content-Disposition: attachment; filename="'.$novoNome.'"');

            header('Content-Type: application/octet-stream');

            header('Content-Transfer-Encoding: binary');

            header('Content-Length: ' . filesize($aquivoNome));

            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');

            header('Pragma: public');

            header('Expires: 0');

            readfile($arquivo);
        }

    protected function json() {

        $this->before(function ($request) {
            if ($request->contentType == 'application/json') {
                $request->data = json_decode($request->data);
            }
        });
        #Não necessito da resposta!
        $this->after(function ($response) {
         $response->contentType = 'application/json';
         $response->body = json_encode($response->body);
     });
    }
}
?>
