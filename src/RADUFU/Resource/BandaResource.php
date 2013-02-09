<?php

namespace Radiopet\Resource;
#require_once (__DIR__ . '/../service/BandaService.class.php');

use Radiopet\Service\BandaService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /bandas
 * @uri /bandas/:id
 */
class BandaResource extends Resource {

    private $bandaService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {

        try {

            $this->bandaService = new BandaService();

            if(is_null($id)) {
                return new Response(
                    Response::OK, $this->bandaService->findBanda());
            } else {
                return new Response(
                    Response::OK, $this->bandaService->findBanda($id));
            }

        } catch (Radiopet\Dao\NotFoundException $e) {
            throw new Tonic\NotFoundException();
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

        if(!is_null($id))
            throw new Tonic\MethodNotAllowedException();

        try {

            $this->bandaService = new BandaService();

            $this->bandaService->createBanda($this->request->data->nome);

            $criada = $this->bandaService->findBanda($this->request->data->nome);

            return new Response(Response::CREATED, array(
                'uri' => 'bandas/' . $criada->getId()
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

        if(!(isset($this->request->data->nome)
            && isset($this->request->data->aval)))
            return new Response(Response::BADREQUEST);

        try {

            $this->bandaService = new BandaService();

            $this->bandaService->updateBanda(
                $id, $this->request->data->nome, $this->request->data->aval);

            return new Response(Response::OK);

        } catch (Radiopet\Dao\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        } catch (Radiopet\Dao\Exception $e) {
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

            $this->bandaService = new BandaService();
            $this->bandaService->deleteBanda($id);

            return new Response(Response::OK);

        } catch (Radiopet\Dao\Exception $e) {
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
