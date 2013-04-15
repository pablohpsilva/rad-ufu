<?php
namespace RADUFU\Resource;

use RADUFU\Service\ComprovanteService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /arquivo
 * @uri /arquivo/:id
 */
class ArquivoResource extends Resource {

    private $comprovanteService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function download($id = null) {
        try {
        	if(!(isset($this->request->data->arquivo)))
            	return new Response(Response::BADREQUEST);

            $this->comprovanteService = new ComprovanteService();
            return new Response( Response::OK, $this->comprovanteService->download($id) );

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
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