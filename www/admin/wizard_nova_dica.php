<?php
error_reporting  (E_ERROR | E_PARSE);

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
		$query = "SELECT * FROM dicas where cd=" . $codigo;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$dica = mysql_fetch_array($result, MYSQL_ASSOC);
		require("../includes/conectar_mysql.php");
	}
	?>
	<html>
		<head>
			<title>Cadastro de Dicas</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<style type="text/css">
				.label{
					font-family:Verdana, Arial, Helvetica, sans-serif;
					font-size:12px;
					text-align:right;
					vertical-align:top;				
				}
			</style>
			<script language="javascript" type="text/javascript">
				function valida_form() {
					if (!editor.cbMode.checked){
						novadica.texto.value = editor.idEditbox.document.body.innerHTML;
					}
					else {
						novadica.texto.value = editor.idEditbox.document.body.innerText;
					}
					novadica.submit();
				}
			</script>
		</head>
		<body>
			<table width="500">
				<form action="wizard_nova_dica.php" method="post" name="novadica">
				<tr>
					<td class="label">Título:</td>
					<td><input type="text" name="dica" maxlength="255" size="40"<? if($update) echo(' value="' . $dica["dica"] . '"');?>></td>
				</tr>
				<tr>
					<td colspan="2" class="label"><iframe width="100%" height="400" src="../editor.php?var=texto" name="editor" id="editor"></iframe></td>
				</tr>
				<tr>
					<td></td>
					<td class="label"><input type="button" onClick="valida_form();" value="Salva"></td>
				</tr>
				<input type="hidden" name="texto" id="texto">
				<input type="hidden" name="passo" value="1">
				<input type="hidden" name="modo" value="<? if($update) echo("update"); else echo("add");?>">
				<input type="hidden" name="cd" value="<? if($update) echo($dica["cd"]);?>">
				</form>
			</table>
		</body>
		<script language="javascript" type="text/javascript">
			var txt = '<?=addslashes(str_replace(chr(13), "", str_replace(chr(10), "", $dica["descricao"])))?>';
			document.forms[0].texto.value = txt;
		</script>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	
	$dica = $_POST["dica"];
	$descricao = $_POST["texto"];
	$modo = $_POST["modo"];
	
	if ($modo == "add")	{
		$query = "INSERT INTO dicas (dica, descricao) VALUES ('";
		$query .= $dica ."','";
		$query .= $descricao ."')";
	}
	if ($modo == "update") {
		$query = "UPDATE dicas SET ";
		$query .= "dica='" . $dica ."', ";
		$query .= "descricao='" . $descricao ."'";
		$query .= " WHERE cd='" . $_POST["cd"] . "'";
	}
	
	require("../includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
	?>
	<html>
		<head>
			<title>Dica Salva!</title>
		</head>
		<body>
			<h3>Dica Gravada com Sucesso!</h3>
			<br><br>
			<a href="wizard_nova_dica.php">[Adicionar Nova Dica]</a>
			<br><br>
			<a href="javascript: self.close(); opener.location = opener.location">[Fechar]</a>
		</body>
	</html>
	<?
}

?>