<?php
namespace RADUFU\Resource;

use RADUFU\Service\ComprovanteService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /comprovante
 * @uri /comprovante/:id
 */
class ComprovanteResource extends Resource {

    private $comprovanteService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        try {
            $this->comprovanteService = new ComprovanteService();
            return new Response( Response::OK, $this->comprovanteService->search($id) );

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        }
    }

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $idAtividade
     * @return Tonic\Response
     */
    public function buscarPorAtividade($idAtividade = null) {
        if(is_null($idAtividade))
                throw new Tonic\MethodNotAllowedException();
        try {
            $this->comprovanteService = new ComprovanteService();
            return new Response( Response::OK, $this->comprovanteService->searchAll($idAtividade) );

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        }
    }

    /**
     * @method POST
     * @provides application/json
     * @json
     * @return Tonic\Response
     */
    public function criar($arquivo = null) {

        if(!(isset($this->request->data->arquivo)
            &&isset($this->request->data->atividade)))
            return new Response(Response::BADREQUEST);
        try {
            $this->comprovanteService = new ComprovanteService();
            $criado = $this->comprovanteService->getNextId();
            $this->comprovanteService->post( 
                    $this->request->data->professor,
                    $arquivo,
                    $this->request->data->atividade
                    );
            $criada = $this->comprovanteService->search($aux);

            return new Response(Response::CREATED, array(
                'uri' => $criado
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
    public function atualizar($id = null) {

        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();
        if(!(isset($this->request->data->campo)
            &&isset($this->request->data->modificacao)))
            return new Response(Response::BADREQUEST);
        try {
            $this->comprovanteService = new ComprovanteService();
            $this->comprovanteService->update(
                    $id,
                    $this->request->data->campo,
                    $this->request->data->modificacao
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
            $this->comprovanteService = new ComprovanteService();
            $this->comprovanteService->delete($id);

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
