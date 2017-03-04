<?php

error_reporting  (E_ERROR | E_PARSE);
require("permissao_documento.php");
$passo = $_REQUEST["passo"];

if (strlen($passo) == 0) $passo = 0;

switch($passo){
	case 0: constroi_passo0();
			break;
	case 1: constroi_passo1();
			break;
	case 2: constroi_passo2();
			break;
	case 3: constroi_passo3();
			break;
	case 4: constroi_passo4();
			break;
	case 5: constroi_passo5();
			break;
}



##############################################################################################
function constroi_passo0(){
	$modo = $_REQUEST["modo"];
	$codigo = $_REQUEST["cd_parceiro"];
	
	if($modo == "update"){
		$update = true;
		require("../includes/conectar_mysql.php");
		$query = "SELECT * from pagina_parceiro where cd_parceiro=" . $codigo;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$pagina = mysql_fetch_array($result, MYSQL_ASSOC);
		require("../includes/conectar_mysql.php");
	}
	strlen($evento["email"]);
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
						paginaparceiro.texto.value = editor.idEditbox.document.body.innerHTML;
					}
					else {
						paginaparceiro.texto.value = editor.idEditbox.document.body.innerText;
					}
					paginaparceiro.submit();
				}
			</script>
		</head>
		<body>
			<table width="100%">
				<form action="wizard_pagina_parceiro.php" method="post" name="paginaparceiro">
				<tr>
					<td colspan="2" class="label" style="text-align: center; font-weight: bold;">Texto da Pagina do Parceiro</td>
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
				<input type="hidden" name="cd" value="<? if($update) echo($pagina["cd"]);?>">
				<input type="hidden" name="cd_parceiro" value="<? if($update) echo($pagina["cd_parceiro"]); else echo($codigo);?>">
				</form>
			</table>
		</body>
		<script language="javascript" type="text/javascript">
			var txt = '<?=addslashes(str_replace(chr(13), "", str_replace(chr(10), "", $pagina["texto"])))?>';
			document.forms[0].texto.value = txt;
		</script>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	$texto = $_POST["texto"];
	$modo = $_REQUEST["modo"];
	$cd = $_REQUEST["cd"];
	$cd_parceiro = $_REQUEST["cd_parceiro"];
	
	if ($modo == "add")	{
		$query = "INSERT INTO pagina_parceiro (cd_parceiro, texto) VALUES (";
		$query .= $cd_parceiro . ", '";
		$query .= $texto ."')";
	}
	if ($modo == "update") {
		$query = "UPDATE pagina_parceiro SET ";
		$query .= "cd_parceiro=" . $cd_parceiro .", ";
		$query .= "texto='" . $texto ."'";
		$query .= " WHERE cd=" . $cd;
	}
	if (($modo == "update") || ($modo == "add")){
		require("../includes/conectar_mysql.php");
			$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
			if (($result) && ($modo == "add")) {
				$result = mysql_query("SELECT LAST_INSERT_ID();") or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
				$registro = mysql_fetch_row($result);
				$cd = $registro[0];
			}
		require("../includes/desconectar_mysql.php");
	}
	if ($modo == "update") die('<html><script language="javascript">parent.location = parent.location;</script></html>');
	?>
	<html>
		<head>
			<title>Pagina do Parceiro: Segundo Passo</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		</head>
		<body>
			<table width="400" border="0" class="tabela">
				<tr>
					<td colspan="2" align="center"><h3>Adicionar Fotografia</h3></td>
				</tr>
				<form action="wizard_pagina_parceiro.php" encType="multipart/form-data" method="post" name="sendform">
				<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
				<tr>
					<td>Foto:</td>
					<td colspan="2"><input name="image" type="file" accept="image/jpeg, image/jpg" style="width: 100%;"></td>
				</tr>
				<tr>
					<td width="20%">Descrição:</td>
					<td width="60%"><input name="descricao" type="text" style="width: 100%;" maxlength="20"></td>
					<td width="20%"><input name="Submit" type="submit" value="Enviar" style="width: 100%;"></td>
				</tr>
				<input type="hidden" name="numero_imagem" value="1">
				<input type="hidden" name="passo" value="2">
				<input type="hidden" name="modo" value="<?=$modo?>">
				<input type="hidden" name="cd_pagina" value="<?=$cd?>">
				</FORM>
			</table>
		</body>
	</html>
	<? 
}

##############################################################################################

function constroi_passo2(){
	$modo = $_REQUEST["modo"];
	$cd_pagina = $_REQUEST["cd_pagina"];
	$desc = $_REQUEST["descricao"];
	
	require("../includes/conectar_mysql.php");
	
	include("img_uploader.php");
	$pasta = "../parceiros";
	$arquivo = $_FILES["image"];
	$nome_arquivo = $_POST["cd_pagina"] . "_" . $_POST["numero_imagem"] . ".jpg";
	$info_imagem = upload_imagem($pasta, $arquivo, $nome_arquivo, 640, 480, 120, 90, true);
	
	$query = "INSERT INTO pagina_parceiro_fotos (cd_pagina, path, path_thumb, descricao) VALUES (";
	$query .= $cd_pagina . ", '";
	$query .= $info_imagem[0] ."','";
	$query .= $info_imagem[1] ."','";
	$query .= $desc . "')";
	
	if (!mysql_query($query)){
		unlink("../" . $info_imagem[0]);
		unlink("../" . $info_imagem[1]);
		die("<html>\n<head>\n<title>Erro no Upoload de Imagem</title>\n<script language='Javascript'>\nfunction retorna(){\n window.history.back();\n}\n</script>\n</head>\n<body>\n<center><h3>Problemas para gravar o registro da imagem no banco de dados. Erro: " . $query . mysql_error() . "</h3></center><br>\n<a href='Javascript: retorna()'>Voltar</a>\n</body>\n</html>");
	}
	require("../includes/desconectar_mysql.php"); 
	?>
	<html>
		<head>
			<title>Upload Realizado Com Sucesso!</title>
		</head>
		<body>
			<table width='100%' border='0'>
				<tr>
					<td align="center"><img border="0" src="../<?=$info_imagem[1]?>"></td>
				</tr>
				<tr>
					<td align='center'>Operação realizada com Sucesso!</td>
				</tr>
				<?
				if($modo != "adiciona_imagem"){ ?>
					<tr>
						<td align='center'>
							<form method="post" action="wizard_pagina_parceiro.php">
								<input type="submit" value="Adiciona Foto">
								<input type="hidden" name="passo" value="3">
								<input type="hidden" name="numero_imagem" value="<?=$_POST["numero_imagem"]?>">
								<input type="hidden" name="cd_pagina" value="<?=$cd_pagina?>">
							</form>
						</td>
					</tr>
				<? } ?>
					<tr>
						<td align="center"><a href="javascript: self.close(); opener.location = opener.location;">[Fechar]</a></td>
					</tr>
			</table>
		</body>
	</html>
	<?
}

##############################################################################################

function constroi_passo3(){

	$cd_pagina = $_REQUEST["cd_pagina"];
	$modo = $_REQUEST["modo"];
	
	if($_POST["numero_imagem"] == ""){
		require("../includes/conectar_mysql.php");
		$query = "SELECT cd FROM pagina_parceiro_fotos WHERE cd_pagina=" . $cd_pagina . " ORDER BY cd DESC";
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . $query .  mysql_error());
		$cd = mysql_fetch_row($result);
		$numero_imagem = $cd[0] + 1;
		require("../includes/desconectar_mysql.php");
	}
	else $numero_imagem = $_POST["numero_imagem"] + 1;
	?>
	<html>
		<head>
			<title>Cadastro de Eventos: Terceiro Passo</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		</head>
		<body>
			<table width="400" border="0" class="tabela">
				<tr>
					<td colspan="2" align="center"><h3>Adicionar Fotografia</h3></td>
				</tr>
				<form action="wizard_pagina_parceiro.php" encType="multipart/form-data" method="post" name="sendform">
				<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
				<tr>
					<td>Foto:</td>
					<td colspan="2"><input name="image" type="file" accept="image/jpeg, image/jpg" style="width: 100%;"></td>
				</tr>
				<tr>
					<td width="20%">Descrição:</td>
					<td width="60%"><input name="descricao" type="text" style="width: 100%;" maxlength="20"></td>
					<td width="20%"><input name="Submit" type="submit" value="Enviar" style="width: 100%;"></td>
				</tr>
				<input type="hidden" name="numero_imagem" value="<?=$numero_imagem?>">
				<input type="hidden" name="passo" value="2">
				<input type="hidden" name="modo" value="<?=$modo?>">
				<input type="hidden" name="cd_pagina" value="<?=$cd_pagina?>">
				</FORM>
			</table>
		</body>
	</html>
	<?
}
?>