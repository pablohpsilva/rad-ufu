<?php
namespace RADUFU\Resource;

use RADUFU\Service\AtividadeService,
    Tonic\Resource,
    Tonic\Response;

/**
 * @uri /professor/:id/atividade
 */
class ProfessorAtividadeResource extends Resource {

	private $atividadeService = null;

	/**
     * @method GET
     * @provides application/json
     * @json
     * @param int $idProfessor
     * @return Tonic\Response
     */
    public function buscar($idProfessor = null) {
        if(is_null($idProfessor))
                throw new \Tonic\MethodNotAllowedException();
            
        try {
            $this->atividadeService = new AtividadeService();
            return new Response( Response::OK, $this->atividadeService->searchAll($idProfessor) );

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