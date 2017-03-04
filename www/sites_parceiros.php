<?php
error_reporting(E_NONE);

include("includes/funcoes.php");
constroi_inicio_pagina();
require("includes/conectar_mysql.php");

$query = "SELECT conteudo FROM textos WHERE nome='sites_parceiros'";
$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
$text = mysql_fetch_row($result);
echo('<div>' . $text[0] . '</div><br><br>');

$query = "SELECT DISTINCT(site) FROM parceiros WHERE site<>'' order by site";
$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
?>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<?
while($registro = mysql_fetch_assoc($result)){
	?>
	<tr><td align="center"><a target="_blank" href="http://<?=$registro['site']?>"><?=$registro['site']?></a></td></tr>
	<tr><td><font size="1">&nbsp;</font></td></tr>
	<?
}
?>
</table>
<?
require("includes/desconectar_mysql.php");
constroi_fim_pagina();
?>