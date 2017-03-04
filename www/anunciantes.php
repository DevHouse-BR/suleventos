<?php
error_reporting  (E_ERROR | E_PARSE);

include("includes/funcoes.php");
$tipo = $_GET["tipo"];

constroi_inicio_pagina(); 
if (strlen($tipo) == 0)	constroi_tabela_tipo_anunciantes(); 
else constroi_tabela_anunciantes($tipo);
constroi_banner();
constroi_fim_pagina();
?>