{extends file = 'layout.tpl'}
{block name=titulo} Atividades Realizadas {/block}

{block name=styles}
  <link rel="stylesheet" href="static/rad-ufu/css/atividades.css">
{/block}

{block name=navigation}
<div data-spy="affix" data-offset-top=".5" class="nav-bt-tabs">
  <ul class="breadcrumb">
    <li><a href="inicio.php">Início</a> <span class="divider">></span></li>
        <li class="active">Atividades</li>
  </ul>
{/block}

{block name=conteudo}
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
{/block}

{block name=scripts}
  <script type="text/javascript" src="static/rad-ufu/js/errorReporter.js"></script>
  <script type="text/javascript" src="static/rad-ufu/js/ativLoader.js"></script>
  <script type="text/javascript">
    
    /* dispara ajax para atividades de ensino */
    $('#items a:first').click();
    
    /* inicializa tooltips */
    $('[rel=tooltip]').tooltip();
  </script>
{/block}
