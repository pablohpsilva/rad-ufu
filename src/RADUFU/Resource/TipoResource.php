<?php
namespace RADUFU\Resource;

use RADUFU\Service\TipoService,
    Tonic\Resource,
    Tonic\Response;

require_once(__DIR__."/../Autoloader.php");

/**
 * @uri /tipo
 * @uri /tipo/:id
 */
class TipoResource extends Resource {

    private $tipoService = null;

    public function __construct(){
        $this->tipoService = new TipoService();
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
            return new Response( Response::OK, $this->tipoService->search($id) );

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
    public function criar($descricao = null) {

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
            $this->tipoService->update(
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
            $this->tipoService->delete($id);

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
