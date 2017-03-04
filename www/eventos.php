<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

include("includes/funcoes.php");

$pagina = $_GET["pagina"];
if(strlen($pagina) == 0) $pagina = 1;

constroi_inicio_pagina();
constroi_tabela_eventos(12, 3, $pagina);
constroi_fim_pagina();
?>