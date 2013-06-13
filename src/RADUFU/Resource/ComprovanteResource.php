<?php
namespace RADUFU\Resource;

use RADUFU\Service\ComprovanteService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /comprovante
 * @uri /comprovante/:id
 */
class ComprovanteResource extends Resource {

    private $comprovanteService = null;

    /**
     * @method GET
     * @provides application/json
     * @json
     * @param int $id
     * @return Tonic\Response
     */
    public function buscar($id = null) {
        try {
            $this->comprovanteService = new ComprovanteService();
            return new Response( Response::OK, $this->comprovanteService->search($id) );

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        }
    }

    /**
     * @method POST
     * @provides application/json
     * @multipart
     * @return Tonic\Response
     */
    public function criar() {
        session_start();
        $professor = $_SESSION["user"];

        if(!(isset($this->request->data->arquivo)
            &&isset($this->request->data->atividade)))
            return new Response(Response::BADREQUEST);
        try {

            $this->comprovanteService = new ComprovanteService();

            $tmp_file = $this->request->data->arquivo["tmp_name"] . "/" . $this->request->data->arquivo["name"];

            $path = $this->comprovanteService->post(
                    $professor,
                    $tmp_file,
                    $this->request->data->atividade
                    );

            $criado = $this->comprovanteService->readAll(
                    $path,
                    $this->request->data->atividade
                    );

            return new Response(Response::CREATED, array(
                'id' => $criado
                ));

        } catch (RADUFU\DAO\Exception $e) {
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
            $this->comprovanteService = new ComprovanteService();
            $this->comprovanteService->delete($id);

            return new Response(Response::OK);

        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\Exception($e->getMessage());
        }
    }

    protected function multipart () {
        $this->before(function ($request) {
            $data = (object) array("arquivo" => array_pop($_FILES), "atividade" => $_POST["id_atividade"]);
            $request->data = $data;
        });
        $this->after(function ($response) {
            $response->contentType = 'application/json';
            $response->body = json_encode($response->body);
        });
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
