<?php
namespace RADUFU\Resource;

use RADUFU\Service\ProfessorService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /professor
 * @uri /professor/:id
 */
class ProfessorResource extends Resource {

    private $professorService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        try {
            $this->professorService = new ProfessorService();
            if (is_null($id))
                return new Response(Response::OK, $this->professorService->searchAll());
            else
                return new Response( Response::OK, $this->professorService->search($id) );

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
    public function criar($id = null) {
        /*
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();
        */
        if(!(isset($this->request->data->siape)
            &&isset($this->request->data->nome)
            &&isset($this->request->data->senha)))
            return new Response(Response::BADREQUEST);

        try {
            $this->professorService = new ProfessorService();
            $this->professorService->post(
                    $this->request->data->siape,
                    $this->request->data->nome,
                    $this->request->data->senha,
                    $id
                    );
            $criada = $this->professorService->search($this->request->data->usuario)->getId();

            return new Response(Response::CREATED, array(
                'id' => $criada
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
        if(!(isset($this->request->data->nome)
            && isset($this->request->data->siape)
            && isset($this->request->data->senha)))
            return new Response(Response::BADREQUEST);

        try {
            $this->professorService = new ProfessorService();
            $this->professorService->update(
                    $id,
                    $this->request->data->nome,
                    $this->request->data->siape,
                    $this->request->data->senha
                    );

            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        } catch (RADUFU\DAO\DAO\Exception $e) {
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
            $this->professorService = new ProfessorService();
            $this->professorService->delete($id);

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
