<?php
namespace RADUFU\Resource;

use RADUFU\service\ProfessorService,
    Tonic\Resource,
    Tonic\Response;
/*
require_once (__DIR__ . '/../service/ProfessorService.php');
require_once (__DIR__ . '/../../vendor/peej/tonic/src/Tonic/Resource.php');
require_once (__DIR__ . '/../../vendor/peej/tonic/src/Tonic/Response.php');
*/


/**
 * @uri /professor
 * @uri /professor/:id
 */
class ProfessorResource extends Resource {

    private $professorService = null;

    public function __construct(){
        $this->professorService = new ProfessorService();
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
            //$this->professorService = new ProfessorService();
            return new Response( Response::OK, $this->professorService->search($id) );

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
    public function criar($id = null) {

        //$siape, $nome, $sobrenome, $usuario, $senha, $ativo = TRUE

        if(!(isset($this->request->data->usuario)))
            return new Response(Response::BADREQUEST);
        if(is_null($id))
            throw new Tonic\MethodNotAllowedException();
        try {
            //$this->professorService = new ProfessorService();
            $this->professorService->post(
                    $this->request->data->id,
                    $this->request->data->nome,
                    $this->request->data->sobrenome,
                    $this->request->data->usuario,
                    $this->request->data->senha,
                    $this->request->data->ativo
                    );
            $criada = $this->professorService->search($this->request->data->usuario);

            return new Response(Response::CREATED, array(
                'uri' => 'professor/' . $criada->getId()
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
    public function atualizar($idOuUsuario = null) {

        if(is_null($idOuUsuario))
            throw new Tonic\MethodNotAllowedException();
        if(!(isset($this->request->data->campo)
            && isset($this->request->data->modificacao)))
            return new Response(Response::BADREQUEST);
        try {
            //$this->professorService = new professorService();
            $this->professorService->update(
                    $idOuUsuario, 
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
            //$this->professorService = new professorService();
            $this->professorService->delete($id);

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
