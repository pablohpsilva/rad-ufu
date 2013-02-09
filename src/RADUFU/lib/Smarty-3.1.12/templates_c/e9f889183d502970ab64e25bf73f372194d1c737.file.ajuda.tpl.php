<?php /* Smarty version Smarty-3.1.12, created on 2013-02-05 18:09:59
         compiled from "/var/www/rad-ufu/src/views/ajuda.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5631659651116717bc6350-35207552%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9f889183d502970ab64e25bf73f372194d1c737' => 
    array (
      0 => '/var/www/rad-ufu/src/views/ajuda.tpl',
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
  'nocache_hash' => '5631659651116717bc6350-35207552',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51116717c5c398_55751503',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51116717c5c398_55751503')) {function content_51116717c5c398_55751503($_smarty_tpl) {?><!DOCTYPE html>
<html>
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> Ajuda </title>
    <link rel="stylesheet" href="static/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="static/lib/bootstrap/css/bootstrap-responsive.css">
    
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
        
  <ul class="breadcrumb">
    <li><a href="inicio.php">Início</a> <span class="divider">></span></li>
        <li class="active">Ajuda</li>
   </ul>

        
  <h1 align="center">TO-DO</h1>
        
      </div>
    </div>
  </div>

   <script type = "text/javascript" src = "static/lib/jquery/jquery-1.8.1.min.js"></script>
   <script type = "text/javascript" src = "static/lib/bootstrap/js/bootstrap.min.js"></script>
   
  
  </body>

</html><?php }} ?>