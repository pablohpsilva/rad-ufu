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
     * @param int $id
     * @return Tonic\Response
     */
    public function download($id = null) {
        try {
        	if(!(isset($id)))
            	return new Response(Response::BADREQUEST);

            $this->comprovanteService = new ComprovanteService();
            $comp = $this->comprovanteService->get($id);
            
            $fHandle = fopen($comp->getArquivo(),'rb');
            $body = fread($fHandle, filesize($comp->getArquivo()));
            fclose($fHandle);

            $headers = array(
                'Content-Description' => 'File Transfer',
                'Content-type' => 'application/'.$comp->separaExtensao(),
                'Content-Disposition' => 'attachment; filename=' .$comp->separaNome(),
                'Content-Length' => filesize($comp->getArquivo()),
                'Content-Transfer-Encoding' => ' binary',
                'Expires' => ' 0',
                'Cache-Control' => ' must-revalidate, post-check=0, pre-check=0',
                'Pragma' => ' public'
                );

            return new Response(Response::OK, $body, $headers);


        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        }
    }   
}
?>