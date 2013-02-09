<?php
require_once(__DIR__.'/../lib/Smarty-3.1.12/libs/Smarty.class.php');
require_once(__DIR__.'/../config.php');

/**
 * Renderizador de templates Smarty (Pode ser singleton?)
 */
class Renderer {
  private $_smarty;

  function __construct() {

    global $renderer_config;
    $this->_smarty = new Smarty();

    $this->_smarty->setTemplateDir($renderer_config['template_dir']);  
    $this->_smarty->setCompileDir($renderer_config['compile_dir']);  
    $this->_smarty->setConfigDir($renderer_config['configs_dir']);
    $this->_smarty->setCacheDir($renderer_config['cache_dir']); 
  }
  /**
   * Renderiza o template com as variáveis substituidas pelos seus valores
   * @param  String $template O nome do arquivo template
   * @param  array  $data     O array dos valores das variáveis indexado pelos
   *   nomes da variáveis
   */
  function render($template, $data = array()){  
  
    foreach($data as $key => $value){  
      $this->_smarty->assign($key, $value);  
    }  
  
    /*clear the cache*/
    $this->_smarty->clearAllCache();
    $this->_smarty->display($template . '.tpl');  
  }  
}
?>