<?php
namespace RADUFU\Resource;

use RADUFU\Service\MultiplicadorService,
    Tonic\Resource,
    Tonic\Response;

require_once(__DIR__."/../Autoloader.php");

/**
 * @uri /multiplicador
 * @uri /multiplicador/:id
 */
class MultiplicadorResource extends Resource {

    private $multiplicadorService = null;

    public function __construct(){
        $this->multiplicadorService = new MultiplicadorService();
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
            return new Response( Response::OK, $this->multiplicadorService->search($id) );

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
    public function criar($nome = null) {

        if(!( isset($this->request->data->nome)
            &&isset($this->request->data->valor)
            &&isset($this->request->data->limite)
            &&isset($this->request->data->tipo) ))
            return new Response(Response::BADREQUEST);
        try {
            $this->multiplicadorService->post(
                    $nome,
                    $this->request->data->valor,
                    $this->request->data->limite,
                    $this->request->data->tipo
                    );
            $criada = $this->multiplicadorService->search($this->request->data->nome);

            return new Response(Response::CREATED, array(
                'uri' => 'multiplicador/' . $criada->getId()
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
        if(!( isset($this->request->data->campo)
            &&isset($this->request->data->modificacao) ))
            return new Response(Response::BADREQUEST);
        try {
            $this->multiplicadorService->update(
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
            $this->multiplicadorService->delete($id);

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
