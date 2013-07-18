<?php
namespace RADUFU\Service;

class Security{
	
	#private $OKFiles = array("pdf","jpg","jpeg","gif","bitmap","doc","docx","txt","odt");
	
	public static function verificarExtensao($input){
		# Exemplo: verificarExtensao("PDF","Folder/folder/file.pdf");
		# Verifica-se tudo que vier depois de um ponto final " . ". Se tiver qualquer coisa depois
		# do ponto final que nao seja igual a PDF. Retorna TRUE se tem erro na extensao.
		$aux = explode(".", $input);
		#if(strcmp($kind,strtolower($aux[1]) ) != 0)
		#	return TRUE;
		if( !in_array($aux[1], $this->OKFiles) )
			throw new Exception("Erro! Os formatos permitidos sao: pdf, jpg, jpeg, gif, bitmap, doc, docx, txt, odt");
		unset($aux);
	}

	public static function filterCharacters($input){		
		preg_match_all("/[a-zA-Z0-9_!@#$^&*.]/", $input, $match);
		return implode('', $match[0]);
	}

	public static function preventXSS($input){
		//return htmlspecialchars(strip_tags($input));
		//return strip_tags(htmlspecialchars($input));
		return strip_tags($input);
	}

	public static function filterLetters($input){		
		preg_match_all("/\w/", $input, $match);
		return implode('', $match[0]);
	}

	public static function filterNumbers($input){
		if(is_null($input))
			return null;
		preg_match_all("/[0-9]/", $input, $match);
		return implode('', $match[0]);
	}

	public static function encrypt($target,$helper){
		return crypt($target,md5($helper . substr($helper, 0, 3)));
	}
}

?>