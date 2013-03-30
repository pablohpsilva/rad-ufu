<?php
namespace RADUFU\Resource;

use RADUFU\Service\AtividadeService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /atividade
 * @uri /atividade/:id
 */
class AtividadeResource extends Resource {

    private $atividadeService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        try {
            $this->atividadeService = new AtividadeService();
            if(is_null($id))
                return new Response(Response::OK, $this->atividadeService->searchAll());
            else
                return new Response( Response::OK, $this->atividadeService->search($id) );

        } catch (\RADUFU\DAO\NotFoundException $e) {
            throw new \Tonic\NotFoundException();
        }
    }

    /**
     * @method PUT
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function atualizar($id = null) {
        //$tipo, $descricao, $datainicio, $datafim, $valor, $professor
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();
        if(!(isset($this->request->data->tipo)
            &&isset($this->request->data->descricao)
            &&isset($this->request->data->datainicio)
            &&isset($this->request->data->datafim)
            &&isset($this->request->data->valorMult)
            &&isset($this->request->data->professor)))
            return new Response(Response::BADREQUEST);

        try {
            $this->atividadeService = new AtividadeService();
            $this->atividadeService->update(
                    $id,
                    $this->request->data->tipo,
                    $this->request->data->descricao,
                    $this->request->data->datainicio,
                    $this->request->data->datafim,
                    $this->request->data->valorMult,
                    $this->request->data->professor
                    );

            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        } catch (RADUFU\DAO\Exception $e) {
            throw new Tonic\Exception($e->getMessage());
        }

    }

    /**
     * @method DELETE
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function remover($id = null) {
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();

        try {
            $this->atividadeService = new AtividadeService();
            $this->atividadeService->delete($id);

            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\Exception($e->getMessage());
        }
    }

    /**
     * Transforma as requisições json para array e as repostas array para json
     */
    protected function json() {
        $this->before(function ($request) {
            if ($request->contentType == 'application/json') {
                $request->data = json_decode($request->data);
            }
        });

        $this->after(function ($response) {
         $response->contentType = 'application/json';
         $response->body = json_encode($response->body);
     });
    }
}

?>
