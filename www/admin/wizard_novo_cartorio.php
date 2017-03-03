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
		$query = "SELECT * FROM cartorios where cd=" . $codigo;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$cartorio = mysql_fetch_array($result, MYSQL_ASSOC);
		require("../includes/conectar_mysql.php");
	}
	?>
	<html>
		<head>
			<title>Cadastro de Cartórios</title>
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
						cartorio.descricao.value = editor.idEditbox.document.body.innerHTML;
					}
					else {
						cartorio.descricao.value = editor.idEditbox.document.body.innerText;
					}
					cartorio.submit();
				}
				var txt = '<?=addslashes(str_replace(chr(13), "", str_replace(chr(10), "", $cartorio["descricao"])))?>';
			</script>
		</head>
		<body>
			<table width="500">
				<form action="wizard_novo_cartorio.php" method="post" name="cartorio">
				<tr>
					<td class="label">Título:</td>
					<td><input type="text" name="cartorio" maxlength="255" size="40"<? if($update) echo(' value="' . $cartorio["cartorio"] . '"');?>></td>
				</tr>
				<tr>
					<td colspan="2" class="label"><iframe width="100%" height="400" src="../editor.php?var=descricao" name="editor" id="editor"></iframe></td>
				</tr>
				<tr>
					<td></td>
					<td class="label"><input type="button" onClick="valida_form();" value="Salva"></td>
				</tr>
				<input type="hidden" name="descricao" id="descricao" value="">
				<input type="hidden" name="passo" value="1">
				<input type="hidden" name="modo" value="<? if($update) echo("update"); else echo("add");?>">
				<input type="hidden" name="cd" value="<? if($update) echo($cartorio["cd"]);?>">
				</form>
			</table>
		</body>
	</html>
	<script language="javascript" type="text/javascript">
		document.forms[0].descricao.value = txt;
	</script>
	<? 
}

##############################################################################################
function constroi_passo1(){
	
	$cartorio = $_POST["cartorio"];
	$descricao = $_POST["descricao"];
	$modo = $_POST["modo"];
	
	if ($modo == "add")	{
		$query = "INSERT INTO cartorios (cartorio, descricao) VALUES ('";
		$query .= $cartorio ."','";
		$query .= $descricao ."')";
	}
	if ($modo == "update") {
		$query = "UPDATE cartorios SET ";
		$query .= "cartorio='" . $cartorio ."', ";
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
			<a href="wizard_novo_cartorio.php">[Adicionar Novo Cartório]</a>
			<br><br>
			<a href="javascript: self.close(); opener.location = opener.location">[Fechar]</a>
		</body>
	</html>
	<?
}

?>