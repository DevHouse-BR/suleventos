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
		$query = "SELECT cd, pergunta, data, opcao1, opcao2, opcao3, opcao4, ativa from enquetes where cd=" . $codigo;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$enquete = mysql_fetch_array($result, MYSQL_ASSOC);
		require("../includes/conectar_mysql.php");
	}
	?>
	<html>
		<head>
			<title>Criação de Enquetes</title>
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
				<form action="wizard_nova_enquete.php" method="post">
				<tr>
					<td class="label">Pergunta:</td>
					<td><input type="text" name="pergunta" maxlength="255" size="40"<? if($update) echo(' value="' . $enquete["pergunta"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">1&ordf;&nbsp;Opção:</td>
					<td><input type="text" name="opcao1" maxlength="255" size="40"<? if($update) echo(' value="' . $enquete["opcao1"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">2&ordf;&nbsp;Opção:</td>
					<td><input type="text" name="opcao2" maxlength="255" size="40"<? if($update) echo(' value="' . $enquete["opcao2"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">3&ordf;&nbsp;Opção:</td>
					<td><input type="text" name="opcao3" maxlength="255" size="40"<? if($update) echo(' value="' . $enquete["opcao3"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">4&ordf;&nbsp;Opção:</td>
					<td><input type="text" name="opcao4" maxlength="255" size="40"<? if($update) echo(' value="' . $enquete["opcao4"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Ativa?</td>
					<td class="label" style="text-align:left;"><input type="radio" name="ativa" value="s"<? if($update){ if($enquete["ativa"] == "s") echo(' checked');} else echo(" checked");?>>Sim<br><input type="radio" name="ativa" value="n"<? if($update){ if($enquete["ativa"] == "n") echo(' checked');}?>>Não</td>
				</tr>
				<tr>
					<td></td>
					<td class="label"><input type="submit" value="Salva"></td>
				</tr>
				<input type="hidden" name="passo" value="1">
				<input type="hidden" name="modo" value="<? if($update) echo('update'); else echo('add');?>">
				<? if($update) echo('<input type="hidden" name="cd" value="' . $codigo . '">'); ?>
				</form>
			</table>
			<? if($update) echo('<a href="gerencia_enquetes.php">[Voltar]</a>'); ?>
		</body>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	global $modo;
	
	$codigo = $_REQUEST["cd"];
	$pergunta = $_POST["pergunta"];
	$opcao1 = $_POST["opcao1"];
	$opcao2 = $_POST["opcao2"];
	$opcao3 = $_POST["opcao3"];
	$opcao4 = $_POST["opcao4"];
	$ativa = $_POST["ativa"];
	$data = mktime();
	
	if ($modo == "add")	{
		$query = "INSERT INTO enquetes (pergunta, opcao1, opcao2, opcao3, opcao4, ativa, data) VALUES ('";
		$query .= $pergunta ."','";
		$query .= $opcao1 ."','";
		$query .= $opcao2 ."','";
		$query .= $opcao3 ."','";
		$query .= $opcao4 ."','";
		$query .= $ativa ."',";
		$query .= $data .")";
	}
	elseif ($modo == "update") {
		$query = "UPDATE enquetes SET ";
		$query .= "pergunta='" . $pergunta ."', ";
		$query .= "opcao1='" . $opcao1 ."', ";
		$query .= "opcao2='" . $opcao2 ."', ";
		$query .= "opcao3='" . $opcao3 ."', ";
		$query .= "opcao4='" . $opcao4 ."', ";
		$query .= "ativa='" . $ativa ."'";
		$query .= " WHERE cd=" . $codigo;
	}
	require("../includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
	?>
	<html>
		<head>
			<title>Enquete Criada!</title>
		</head>
		<body>
			<? 
			if($modo == "update") echo('<h3>Enquete Alterada com Sucesso!</h3><br><br><a href="gerencia_enquetes.php">[Voltar]</a>');
			else echo('<h3>Enquete Criada com Sucesso!</h3>');
			?>
			<br><br>
			<a href="javascript: self.close();">[Fechar]</a>
		</body>
	</html>
	<?
}

?>