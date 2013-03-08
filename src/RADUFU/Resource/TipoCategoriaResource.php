<?php
namespace RADUFU\Resource;

use RADUFU\Service\ComprovanteService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /categoria/:id/tipos
 */
class TipoCategoriaResource extends Resource {

	private $tipoService = null;

	/**
     * @method GET
     * @provides application/json
     * @json
     * @param int $idCategoria
     * @return Tonic\Response
     */
    public function buscarPorCategoria($idCategoria = null) {
        if(is_null($idCategoria))
                throw new \Tonic\MethodNotAllowedException();

        try {
            $this->tipoService = new TipoService();
            return new Response( Response::OK, $this->tipoService->searchAll($idCategoria) );

        } catch (\RADUFU\DAO\NotFoundException $e) {
            throw new \Tonic\NotFoundException();
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