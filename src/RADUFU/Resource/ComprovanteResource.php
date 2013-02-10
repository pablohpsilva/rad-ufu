<?php
namespace RADUFU\Resource;

use RADUFU\Service\ComprovanteService,
    Tonic\Resource,
    Tonic\Response;

require_once(__DIR__."/../Autoloader.php");

/**
 * @uri /comprovante
 * @uri /comprovante/:id
 */
class ComprovanteResource extends Resource {

    private $Service = null;

    public function __construct(){
        $this->comprovanteService = new ComprovanteService();
    }

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        try {
            return new Response( Response::OK, $this->comprovanteService->search($id) );

        } catch (src\DAO\NotFoundException $e) {
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
            $this->comprovanteService->post(
                    $arquivo,
                    $this->request->data->atividade
                    );
            $criada = $this->comprovanteService->search($this->request->data->arquivo);

            return new Response(Response::CREATED, array(
                'uri' => 'comprovante/' . $criada->getId()
                ));

        } catch (Radiopet\Dao\Exception $e) {
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
            $this->comprovanteService->update(
                    $id,
                    $this->request->data->campo,
                    $this->request->data->modificacao
                    );

            return new Response(Response::OK);

        } catch (src\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        } catch (src\DAO\Exception $e) {
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
            $this->comprovanteService->delete($id);

            return new Response(Response::OK);

        } catch (src\DAO\NotFoundException $e) {
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
