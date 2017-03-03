<?php
//Este script verifica se usuario tem permissão para acessar a pagina que contem este script.

$TIPO = $HTTP_COOKIE_VARS["tipo_usuario_agenda"]; //Guarda na variável tipo, se o usuário é aluno ou professor.

if (empty($TIPO)){ //Caso não exista o cookie tipo então o browser é redirecionado para a tela de login.
	header("Location: index.php"); 
}
$sao_permitidos = split("/",$PERMISSAO_DE_ACESSO); //Aqui são verificados os tipo de usuario permitidos a acessar a págia.
//A variável $PERMISSAO_DE_ACESSO deve ser preenchida em cada página que chama esta include, informando os tipo de usuarios permitidos.

$i = 0;
foreach ($sao_permitidos as $valor){
	if(substr_count($TIPO, $valor) != 0) $i++; //Verifica se o tipo do usuario é também um tipo permitido nesta página.
}
if($i == 0) die("Você não tem permissão de acesso a este documento."); //Caso não seja então e mostrada uma mensagem de erro.

?>