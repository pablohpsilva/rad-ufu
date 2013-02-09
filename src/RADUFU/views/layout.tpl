<!DOCTYPE html>
<html>
  
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{block name=titulo}Rad-UFU{/block}</title>
    <link rel="stylesheet" href="static/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="static/lib/bootstrap/css/bootstrap-responsive.css">
    {block name=styles}{/block}
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
        {block name=navigation}{/block}
        {block name=conteudo} Hello Smarty! {/block}        
      </div>
    </div>
  </div>

   <script type = "text/javascript" src = "static/lib/jquery/jquery-1.8.1.min.js"></script>
   <script type = "text/javascript" src = "static/lib/bootstrap/js/bootstrap.min.js"></script>
   {block name=scripts}{/block}
  
  </body>

</html>