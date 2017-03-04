<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

include("includes/funcoes.php");

constroi_inicio_pagina();
if($_GET["modo"] == "enviar") envia_mensagem();
else { 
	constroi_faleconosco();
}
constroi_fim_pagina();
?>