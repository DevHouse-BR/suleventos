<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);
require("permissao_documento.php");
$passo = $_POST["passo"];
$texto = $_REQUEST["texto"];

if (strlen($passo) == 0) $passo = 0;

switch($passo){
	case 0: constroi_passo0($texto);
			break;
	case 1: constroi_passo1();
			break;
}



##############################################################################################
function constroi_passo0($texto){
	require("../includes/conectar_mysql.php");
	$query = "SELECT conteudo FROM textos WHERE nome='" . $texto . "'";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$text = mysql_fetch_row($result);
	require("../includes/desconectar_mysql.php");
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
				body {
					margin-left: 0px;
					margin-top: 0px;
					margin-right: 0px;
					margin-bottom: 0px;
				}
			</style>
			<script language="javascript" type="text/javascript">
				function valida_form() {
					if (!editor.cbMode.checked){
						document.all["texto"].value = editor.idEditbox.document.body.innerHTML;
					}
					else {
						document.all["texto"].value = editor.idEditbox.document.body.innerText;
					}
					novadica.submit();
				}
			</script>
		</head>
		<body>
			<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<form action="wizard_texto.php" method="post" name="novadica">
				<tr>
					<td class="label"><iframe width="100%" height="472" src="../editor.php?var=texto" name="editor" id="editor"></iframe></td>
				</tr>
				<tr>
					<td class="label"><input type="button" onClick="valida_form();" value="Salva"></td>
				</tr>
				<textarea name="texto" id="texto" style="visibility: hidden; position: absolute; z-index: -1;" cols="1" rows="1"><?=$text[0]?></textarea>
				<input type="hidden" name="passo" value="1">
				<input type="hidden" name="nome" value="<?=$texto?>">
				</form>
			</table>
	</body>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	
	$nome = $_POST["nome"];
	$conteudo = $_POST["texto"];	

	$query = "UPDATE textos SET ";
	$query .= "conteudo='" . $conteudo ."'";
	$query .= " WHERE nome='" . $nome . "'";
	
	require("../includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
	?>
	<html>
		<head>
			<title>TEXTO SALVO!</title>
		</head>
		<body>
			<h3>Texto Gravado com Sucesso!</h3>
			<br><br><br><br><br><br>
			<a href="javascript: self.history.back();">[OK]</a>
		</body>
	</html>
	<?
}

?>