<?php
//Conecta com o banco de dados informando o ip ou nome do servidor e login e senha do usuario do banco de dados.
//$db = mysql_connect("ftp.inf.univali.br", "cristiane", "4297608")
$db = mysql_connect("localhost", "root", "") or die("Erro de conexão com o banco: " . mysql_error());
//mysql_select_db ("tcc_agenda");
mysql_select_db ("agenda");
?>