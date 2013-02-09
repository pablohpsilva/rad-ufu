<?php /* Smarty version Smarty-3.1.12, created on 2013-02-05 18:09:52
         compiled from "/var/www/rad-ufu/src/views/atividades.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19558770565111671007d050-44968506%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4aaab7a372257b6dec5cfec8052784b4519475b7' => 
    array (
      0 => '/var/www/rad-ufu/src/views/atividades.tpl',
      1 => 1358341522,
      2 => 'file',
    ),
    'c878dab7329ecdc79416d4decc91a0134320985d' => 
    array (
      0 => '/var/www/rad-ufu/src/views/layout.tpl',
      1 => 1358341522,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19558770565111671007d050-44968506',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5111671011f629_17905802',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5111671011f629_17905802')) {function content_5111671011f629_17905802($_smarty_tpl) {?><!DOCTYPE html>
<html>
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> Atividades Realizadas </title>
    <link rel="stylesheet" href="static/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="static/lib/bootstrap/css/bootstrap-responsive.css">
    
  <link rel="stylesheet" href="static/rad-ufu/css/atividades.css">

  </head>
  
  <body style = "padding-top: 40px;">
    
    <div class = "navbar navbar-fixed-top">
      <div class = "navbar-inner">
        <div class = "container">
          <div class="row">
            <div class="span10 offset1">
          <a class = "brand" href = "inicio.php">RAD/UFU</a>
          <ul class = "nav pull-right">
            <li><a href = "atividades.php"> <i class="icon-list"></i> Atividades </a></li>
            <li><a href = "relatorio.php"> <i class="icon-info-sign"></i> Relatório </a></li>
            <li><a href = "ajuda.php"> <i class="icon-question-sign"></i> Ajuda</a></li>
            <li><a href = "sair.php"> <i class="icon-share"></i> Sair</a></li>
            </ul>
          </div>
          </div>
        </div>
      </div>
   </div>
   
   <div class = "container">
    <div class="row">
      <div class="span10 offset1">
        
<div data-spy="affix" data-offset-top=".5" class="nav-bt-tabs">
  <ul class="breadcrumb">
    <li><a href="inicio.php">Início</a> <span class="divider">></span></li>
        <li class="active">Atividades</li>
  </ul>

        
  <!-- Botões de inserção e remoção -->
  <div class="row">
    <div class="btn-group pull-right">
        <button class="btn" data-placement="top" rel="tooltip" 
          data-original-title="Nova atividade">
            <i class="icon-plus"></i>
        </button>
        <!--
        <button class="btn disabled" data-placement="top" rel="tooltip"
          data-original-title="Remover atividade">
            <i class="icon-minus"></i>
        </button>-->
    </div>
  </div>

  <!-- Abas de categoria de Atividade -->
  <ul class="nav nav-tabs" id="items">
      <li class = "active" ><a href="ensino" data-toggle = "tab">Ensino</a></li>
  	  <li><a href="orientacao" data-toggle = "tab">Orientação</a></li>
  	  <li><a href="producao" data-toggle = "tab">Produção</a></li>
  	  <li><a href="pesquisa" data-toggle = "tab">Pesquisa</a></li>
  	  <li><a href="extensao" data-toggle = "tab">Extensão</a></li>
  	  <li><a href="administracao" data-toggle = "tab">Administração</a></li>
  	  <li><a href="outras" data-toggle = "tab">Outras</a></li>
  </ul>
</div>
  <div id="error-wrapper"></div>
  <div id="tabela-atividades-wrapper"></div>
        
      </div>
    </div>
  </div>

   <script type = "text/javascript" src = "static/lib/jquery/jquery-1.8.1.min.js"></script>
   <script type = "text/javascript" src = "static/lib/bootstrap/js/bootstrap.min.js"></script>
   
  <script type="text/javascript" src="static/rad-ufu/js/errorReporter.js"></script>
  <script type="text/javascript" src="static/rad-ufu/js/ativLoader.js"></script>
  <script type="text/javascript">
    
    /* dispara ajax para atividades de ensino */
    $('#items a:first').click();
    
    /* inicializa tooltips */
    $('[rel=tooltip]').tooltip();
  </script>

  
  </body>

</html><?php }} ?>