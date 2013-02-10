<?php

namespace RADUFU\Resource;

use RADUFU\Service\TipoService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /tipo
 * @uri /tipo/:id
 */
class TipoResource extends Resource {

    private $tipoService = null;

    /**
     * @method GET
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        $this->tipoService = new TipoService();
        try {
            return new Response( Response::OK, $this->tipoService->search($id) );

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
    public function criar($descricao = null) {
        $this->tipoService = new TipoService();
        if(!(isset($this->request->data->descricao)
            &&isset($this->request->data->categoria)
            &&isset($this->request->data->pontuacao)
            &&isset($this->request->data->pontuacaoreferencia)
            &&isset($this->request->data->pontuacaolimite)))
            return new Response(Response::BADREQUEST);
        try {
            $this->tipoService->post(
                    $this->request->data->categoria,
                    $descricao,
                    $this->request->data->pontuacao,
                    $this->request->data->pontuacaoreferencia,
                    $this->request->data->pontuacaolimite
                    );
            //$criada = $this->tipoService->search($this->request->data->nome);

            return new Response(Response::CREATED, array(
                'uri' => 'tipo/' . "CREATED"//$criada->getId()
                ));

        } catch (\Exception $e) {
            throw new \Tonic\Exception($e->getMessage());
        }
    }

    /**
     * @method PUT
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function atualizar($id = null) {
        $this->tipoService = new TipoService();
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();
        if(!(isset($this->request->data->campo)
            &&isset($this->request->data->modificacao)))
            return new Response(Response::BADREQUEST);
        try {
            $this->tipoService->update(
                    $id,
                    $this->request->data->campo,
                    $this->request->data->modificacao
                    );

            return new Response(Response::OK);

        } catch (\RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        } catch (\Exception $e) {
            throw new \Tonic\Exception($e->getMessage());
        }

    }

    /**
     * @method DELETE
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function remover($id = null) {
        $this->tipoService = new TipoService();
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();
        try {
            $this->tipoService->delete($id);

            return new Response(Response::OK);

        } catch (\RADUFU\DAO\NotFoundException $e) {
            throw new \Tonic\Exception($e->getMessage());
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
