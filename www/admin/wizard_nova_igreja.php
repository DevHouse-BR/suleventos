<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);
require("permissao_documento.php");
$passo = $_REQUEST["passo"];
$modo = $_REQUEST["modo"];

if (strlen($passo) == 0) $passo = 0;

switch($passo){
	case 0: constroi_passo0();
			break;
	case 1: constroi_passo1();
			break;
}



##############################################################################################
function constroi_passo0(){
	
	global $modo;
	
	if($modo == "update"){
		$codigo = $_REQUEST["cd"];
		$update = true;
		require("../includes/conectar_mysql.php");
		$query = "SELECT cd,  nome, endereco, email, telefone, descricao FROM igrejas where cd=" . $codigo;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$igreja = mysql_fetch_array($result, MYSQL_ASSOC);
		require("../includes/conectar_mysql.php");
	}
	
	?>
	<html>
		<head>
			<title>Cadastro de Igrejas</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<style type="text/css">
				.label{
					font-family:Verdana, Arial, Helvetica, sans-serif;
					font-size:12px;
					text-align:right;
					vertical-align:top;				
				}
			</style>
		</head>
		<body>
			<table>
				<form action="wizard_nova_igreja.php" method="post" name="sendform">
				<tr>
					<td class="label">Nome:</td>
					<td><input type="text" name="nome" maxlength="255" size="40"<? if($update) echo(' value="' . $igreja["nome"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Endereço:</td>
					<td><input type="text" name="endereco" maxlength="255" size="40"<? if($update) echo(' value="' . $igreja["endereco"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Email:</td>
					<td><input type="text" name="email" maxlength="255" size="40"<? if($update) echo(' value="' . $igreja["email"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Telefone:</td>
					<td><input type="text" name="telefone" maxlength="255" size="40"<? if($update) echo(' value="' . $igreja["telefone"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Descricao:</td>
					<td><textarea name="descricao" rows="5" cols="30" onKeyUp="contador.innerHTML = 'Quantidade de Caracteres: ' + this.value.length;" onKeyDown="if ((this.value.length > 254) && (event.keyCode != 8) && (event.keyCode != 46)  && (event.keyCode != 37)  && (event.keyCode != 38)  && (event.keyCode != 39)  && (event.keyCode != 40)) return false;"><? if($update) echo($igreja["descricao"]);?></textarea><div class="label" id="contador">Quantidade de Caracteres: 0</div></td>
				</tr>
				<tr>
					<td></td>
					<td class="label"><input type="submit" value="Salva"></td>
				</tr>
				<input type="hidden" name="passo" value="1">
				<input type="hidden" name="modo"<? if($update) echo(' value="update"'); else echo(' value="add"'); ?>>
				<input type="hidden" name="cd" <? if($update) echo(' value="' . $igreja["cd"] . '"'); ?>>
				</form>
			</table>
		</body>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	
	$nome = $_POST["nome"];
	$endereco = $_POST["endereco"];
	$descricao = $_POST["descricao"];
	$telefone = $_POST["telefone"];
	$email = $_POST["email"];

	$modo = $_POST["modo"];
	
	if ($modo == "add")	{
		$query = "INSERT INTO igrejas (nome, descricao, email, telefone, endereco) VALUES ('";
		$query .= $nome ."', '";
		$query .= $descricao ."', '";
		$query .= $email ."', '";
		$query .= $telefone ."', '";
		$query .= $endereco ."')";
	}
	if ($modo == "update") {
		$query = "UPDATE igrejas SET ";
		$query .= "nome='" . $nome ."', ";
		$query .= "descricao='" . $descricao ."', ";
		$query .= "email='" . $email ."', ";
		$query .= "endereco='" . $endereco ."', ";
		$query .= "telefone='" . $telefone ."'";
		$query .= " WHERE cd=" . $_POST["cd"];
	}
	require("../includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
	?>
	<html>
		<head>
			<title>Igreja Salva!</title>
		</head>
		<body>
			<h3>Igreja Salva com Sucesso!</h3>
			<br><br>
			<a href="wizard_nova_igreja.php">[Adicionar Nova Igreja]</a>
			<br><br>
			<a href="javascript: self.close(); opener.location = opener.location">[Fechar]</a>
		</body>
	</html>
	<?
}

?>