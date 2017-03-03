<?php
//Este script verifica se usuario tem permiss�o para acessar a pagina que contem este script.

$TIPO = $HTTP_COOKIE_VARS["tipo_usuario_agenda"]; //Guarda na vari�vel tipo, se o usu�rio � aluno ou professor.

if (empty($TIPO)){ //Caso n�o exista o cookie tipo ent�o o browser � redirecionado para a tela de login.
	header("Location: index.php"); 
}
$sao_permitidos = split("/",$PERMISSAO_DE_ACESSO); //Aqui s�o verificados os tipo de usuario permitidos a acessar a p�gia.
//A vari�vel $PERMISSAO_DE_ACESSO deve ser preenchida em cada p�gina que chama esta include, informando os tipo de usuarios permitidos.

$i = 0;
foreach ($sao_permitidos as $valor){
	if(substr_count($TIPO, $valor) != 0) $i++; //Verifica se o tipo do usuario � tamb�m um tipo permitido nesta p�gina.
}
if($i == 0) die("Voc� n�o tem permiss�o de acesso a este documento."); //Caso n�o seja ent�o e mostrada uma mensagem de erro.

?>