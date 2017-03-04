<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

include("includes/funcoes.php");
constroi_inicio_pagina();
require("includes/conectar_mysql.php");
$query = "SELECT conteudo FROM textos WHERE nome='quemsomos'";
$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
$text = mysql_fetch_row($result);
require("includes/desconectar_mysql.php");
echo('<div>' . $text[0] . '</div>');
constroi_fim_pagina();
?>