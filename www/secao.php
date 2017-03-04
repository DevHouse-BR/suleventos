<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);
include("includes/funcoes.php");
constroi_inicio_pagina();
$secao = $_GET["secao"];
$subsecao = $_GET["subsecao"];
if(strlen($secao) == 0) $secao = 1;
if(strlen($subsecao) == 0) $subsecao = 0;
constroi_tabela_secao($secao, $subsecao);
constroi_fim_pagina();
?>