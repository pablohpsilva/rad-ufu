<?php
namespace RADUFU\Resource;

use RADUFU\Service\AtividadeService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /professor/:id/atividade
 * @uri /professor/:id/atividade/:id_ativ
 */
class ProfessorAtividadeResource extends Resource {

    private $atividadeService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $idProfessor
     * @return Tonic\Response
     */
    public function buscar($idProfessor = null, $idAtividade = null) {
        if(is_null($idProfessor) && is_null($idAtividade))
                throw new \Tonic\MethodNotAllowedException();

        try {
            $this->atividadeService = new AtividadeService();

            if (!is_null($idAtividade))
                return new Response( Response::OK, $this->atividadeService->get($idAtividade) );
            else
                return new Response( Response::OK, $this->atividadeService->searchAll($idProfessor) );

        } catch (\RADUFU\DAO\NotFoundException $e) {
            throw new \Tonic\NotFoundException();
        }
    }

    /**
     * @method POST
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function criar($professor = null) {
        if(is_null($professor))
            throw new Tonic\MethodNotAllowedException();

        if(!(isset($this->request->data->descricao)
            &&isset($this->request->data->inicio)
            &&isset($this->request->data->fim)
            &&isset($this->request->data->valorMult)
            &&isset($this->request->data->tipo)))
            return new Response(Response::BADREQUEST);

        try {
            //public function post($tipo, $descricao, $datainicio, $datafim, $valorMult, $comprovante, $professor, $id = null){
            $this->atividadeService = new AtividadeService();

            $criado = $this->atividadeService->getNextId();

            $this->atividadeService->post(
                    $criado,
                    $this->request->data->tipo,
                    $this->request->data->descricao,
                    $this->request->data->inicio,
                    $this->request->data->fim,
                    $this->request->data->valorMult,
                    [],
                    $professor
                    );

            return new Response(Response::CREATED, array(
                'id' => $criado
                ));

        } catch (RADUFU\DAO\Exception $e) {
            throw new Tonic\Exception($e->getMessage());
        }
    }

    /**
     * @method PUT
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function atualizar($idProfessor = null, $idAtividade = null) {
        //$tipo, $descricao, $datainicio, $datafim, $valor, $professor
        if(is_null($idProfessor) || is_null($idAtividade))
            throw new Tonic\MethodNotAllowedException();
        if(!(isset($this->request->data->tipo)
            &&isset($this->request->data->descricao)
            &&isset($this->request->data->inicio)
            &&isset($this->request->data->fim)
            &&isset($this->request->data->valorMult)))
            return new Response(Response::BADREQUEST);

        try {
            $this->atividadeService = new AtividadeService();
            $this->atividadeService->update(
                    $idAtividade,
                    $this->request->data->tipo,
                    $this->request->data->descricao,
                    $this->request->data->inicio,
                    $this->request->data->fim,
                    $this->request->data->valorMult,
                    $idProfessor
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
    public function remover($id_prof = null, $id_ativ = null) {
        if(is_null($id_ativ))
            throw new Tonic\MethodNotAllowedException();

        try {
            $this->atividadeService = new AtividadeService();
            $this->atividadeService->delete($id_ativ);

            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\Exception($e->getMessage());
        }
    }

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