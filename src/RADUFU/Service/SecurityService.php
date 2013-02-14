<?php
/*
 *	Servico de seguranca.
 *	
 *	TO DO: Manipulacao de Cookies e Sessao.
 *		- Matar cookies ainda ativos [Por algum motivo].
 *		- Resetar sessao a cada login.
 *		- Destruicao de cookies e sessao no logout.
 *		- Gerenciar cookies. Injecao de cookies->servidor
 *
 *	Retorno com JSON usando criptografia.
 *	Entrada com JSON criptografado. Tirar criptografia.
 */

namespace RADUFU\Service;
 
class SecurityService{
	private function __construct(){}

	private static $banishedStrings = array(
		"javascript",
		"http",
		"www",
		"%",
		"%2",
		"%3",
		"<",
		">",
		"'",
		"\"",
		";",
		"-",
		"Ow==",
		"0y0",
		"0y",
		"LS0=",
		"LSA=",
		"/",
		"RFJPU",
		"BBT",
		"BBTE",
		"[",
		"]",
		"{",
		"}",
		"&",
		"*",
		"(",
		")",
		"$",
		"#",
		"@",
		"!",
		"^",
		",",
		"_",
		":",
		"?",
		"|",
		"+",
		"`",
		"~" );
	
	public static function verificarExistenciaInjection($input){
		# Verifico se tenho palavras e caracteres chave: javascript, " [ ] { } & * ( ) $ % # @ ! ^ % , . - _ ' " ; : ? / \ | + ` ~  "
		# Se tiver, deu merda. Pode parar que esses caracteres nem devem existir. Uma camada em JS sera implementada
		# para nem ao menos deixar o usuario digitar os caracteres acima. Se o JS for desativado e o usuario tentar
		# injetar codigo no campo, temos essa camada como uma "proteca" entre a interface e o real servico.
		#	O retorno aqui sera TRUE se EXISTIR XSS e FALSE se NAO existir XSS.
		foreach (self::$banishedStrings as $val) {
			if(strpos($input,$val) != FALSE)
				return TRUE;
		}
		return FALSE;
	}

	public static function verificarCompressaoPorNumeros($input){
		# Varias chamadas em JS e PHP podem ser comprimidas em numeros. Exemplo: 0127366182288819
		# Esse codigo e interpretado por um dos compiladores e um codigo pode ser executado.
		# Esse tipo de ataque e comum usando JS. E um tipo de XSS. Porem, por motivos de futura
		# compreencao do codigo, resolvi separar essa funcao da funcao acima mais generica.
		if(is_numeric($input) || is_int($input))
			return TRUE;
		else
			return FALSE;
	}

	public static function verificarExtensao($input,$kind){
		# Exemplo: verificarExtensao("PDF","Folder/folder/file.pdf");
		# Verifica-se tudo que vier depois de um ponto final " . ". Se tiver qualquer coisa depois
		# do ponto final que nao seja igual a PDF. Retorna TRUE se tem erro na extensao.
		$aux = explode(".", $input);
		if(substr_count($input,".") > 1)
			return TRUE;
		if(strlen($aux[1]) > 3 || strlen($aux[1]) < 3)
			return TRUE;
		if(strcmp( strtolower($kind),strtolower($aux[1]) ) != 0)
			return TRUE;
		if(self::verificarCompressaoPorNumeros($aux[0]))
			return TRUE;
		unset($aux);
		return FALSE;
	}

	public static function sLogin($input){
		# Essa funcao sera responsavel por verificar a entrada no campo de login do sistema.
		# Refere-se ao usuario, conta do usuario. NAO pode ser usado no campo de senha.
		# Sempre retorna TRUE se tudo estiver bem. Retorna FALSE caso algo errado aconteceu.
		if(strlen($input) > 15)
			return FALSE;
		if(self::verificarExistenciaInjection($input))
			return FALSE;
		if(self::verificarCompressaoPorNumeros($input))
			return FALSE;
		else
			return TRUE;
	}

	public static function sPassword($input){
		# Essa funcao sera responsavel por verificar a entrada no campo de senha do sistema.
		# Refere-se a senha, password, palavra chave do usuario. NAO pode ser usada no campo
		# login. Sempre retorna TRUE se tudo estiver bem. Retorna FALSE em caso contrario.
		if(strlen($input) > 30)
			return FALSE;
		if(self::verificarExistenciaInjection($input))
			return FALSE;
		if(self::verificarCompressaoPorNumeros($input))
			return FALSE;
		else
			return TRUE;
	}

	public static function sFile($input,$kind){
		# Essa funcao sera responsavel por verificar o arquivo que entrara no sistema.
		# Um comprovante. O seu tamanho deve ser ate 1Mb (tamanho pode oscilar para menos).
		# 
		if(self::verificarExtensao($input,$kind))
			return FALSE;
		if(self::verificarExistenciaInjection($input))
			return FALSE;
		if(self::verificarCompressaoPorNumeros($input))
			return FALSE;
		else
			return TRUE;
	}

	public static function sField($input){
		if(self::verificarExistenciaInjection($input))
			return FALSE;
		if(self::verificarCompressaoPorNumeros($input))
			return FALSE;
		else
			return TRUE;
	}
}

?>