<?php
namespace RADUFU\Resource;

use RADUFU\Service\ComprovanteService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /comprovante/:id/atividade
 */
class ComprovanteAtividadeResource extends Resource {

	private $comprovanteService = null;

	/**
     * @method GET
     * @provides application/json
     * @json
     * @param int $idAtividade
     * @return Tonic\Response
     */
    public function buscarPorAtividade($idAtividade = null) {

        if(is_null($idAtividade))
                throw new \Tonic\MethodNotAllowedException();
        try {
            $this->comprovanteService = new ComprovanteService();
            return new Response( Response::OK, $this->comprovanteService->searchAll($idAtividade) );

        } catch (\RADUFU\DAO\NotFoundException $e) {
            throw new \Tonic\NotFoundException();
        }
    }

}
?>