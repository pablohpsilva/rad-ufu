<?php
namespace RADUFU\Resource;

use RADUFU\Service\ComprovanteService,
    Tonic\Resource,
    Tonic\Response;
/**
 * @uri /arquivo/:tipo/:id
 * @uri /arquivo/:tipo/:id/:tStamp
 */
class ArquivoResource extends Resource {

    private $comprovanteService = null;

    /**
     * @method GET
     * @param int $id
     * @return Tonic\Response
     */
    public function download($tipo = null, $id = null, $tStamp = null) {
        $caminho = "";
        $relDirPrefix = "/tmp";
        $relFileSufix = ".pdf";

        try {
        	if( !(isset($tipo) && isset($id)) )
            	return new Response(Response::BADREQUEST);

            if ($tipo === "comprovante") {
                $this->comprovanteService = new ComprovanteService();
                $caminho = $this->comprovanteService->get($id)->getArquivo();

            } else if ($tipo === "relatorio" && isset($tStamp)) {
                $caminho = $relDirPrefix . "/" . $id . "/" . $tStamp . $relFileSufix;

            } else {
                return new Response(Response::BADREQUEST);
            }

            return $this->fileResponse($caminho);


        } catch (RADUFU\DAO\NotFoundException $e) {
            throw new Tonic\NotFoundException();
        }
    }

    private function fileResponse ($caminho) {

        $fHandle = fopen($caminho,'rb');

        if (!$fHandle)
            return new Response(Response::INTERNALSERVERERROR);

        $body = fread($fHandle, filesize($caminho));
        fclose($fHandle);

        $headers = array(
            'Content-Description' => 'File Transfer',
            'Content-type' => 'application/'.$this->getFileExtension($caminho),
            'Content-Disposition' => 'attachment; filename=' .$this->getFileName($caminho),
            'Content-Length' => filesize($caminho),
            'Content-Transfer-Encoding' => ' binary',
            'Expires' => ' 0',
            'Cache-Control' => ' must-revalidate, post-check=0, pre-check=0',
            'Pragma' => ' public'
            );

        return new Response(Response::OK, $body, $headers);
    }

    private function getFileName ($caminho) {
        $partes = explode("/", $caminho);
        return array_pop($partes);
    }

    private function getFileExtension ($caminho) {
        $output = explode(".", $this->getFileName($caminho))[1];
        return $output;
    }
}
?>
