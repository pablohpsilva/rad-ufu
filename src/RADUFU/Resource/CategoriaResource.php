<?php
namespace RADUFU\Resource;

use RADUFU\Service\CategoriaService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /categoria
 * @uri /categoria/:id
 */
class CategoriaResource extends Resource {

    private $categoriaService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        try {
            $this->categoriaService = new CategoriaService();

            if (is_null($id))
                return new Response(Response::OK, $this->categoriaService->searchAll());
            else
                return new Response(Response::OK, $this->categoriaService->search($id));

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
    public function criar($id = null) {
        if(!(isset($this->request->data->nome)))
            return new Response(Response::BADREQUEST);
        /*
        if(!is_null($id))
            throw new \Tonic\MethodNotAllowedException();
        */
        try {
            $this->categoriaService = new CategoriaService();
            $this->categoriaService->post($this->request->data->nome);
            $criada = $this->categoriaService->search($this->request->data->nome);

            return new Response(Response::CREATED, array(
                'id' => $criada->getId()
                ));

        } catch (\RADUFU\DAO\Exception $e) {
            throw new \Tonic\Exception();
        }
    }

    /**
     * @method PUT
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function atualizar($id = null) {
        if(is_null($id))
            throw new \Tonic\MethodNotAllowedException();

        if(!(isset($this->request->data->nome)))
            throw new \Tonic\MethodNotAllowedException();

        try {
            $this->categoriaService = new CategoriaService();
            $this->categoriaService->update($id,
                                            $this->request->data->nome);

            return new Response(Response::OK);

        } catch (\RADUFU\DAO\NotFoundException $e) {
            throw new \Tonic\NotFoundException();
        } catch (\RADUFU\DAO\Exception $e) {
            throw new \Tonic\Exception();
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
            throw new \Tonic\MethodNotAllowedException();

        try {
            $this->categoriaService = new CategoriaService();
            $this->categoriaService->delete($id);

            return new Response(Response::OK);

        } catch (\RADUFU\DAO\Exception $e) {
            throw new \Tonic\Exception();
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
