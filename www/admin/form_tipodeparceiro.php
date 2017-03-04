<?php
error_reporting  (E_ERROR | E_PARSE);
require("permissao_documento.php");
$passo = $_POST["passo"];
$modo = $_GET["modo"];
$codigo = $_GET["cd"];

if (strlen($passo) == 0) $passo = 0;

switch($passo){
	case 0: constroi_passo0();
			break;
	case 1: constroi_passo1();
			break;
}



##############################################################################################
function constroi_passo0(){
	global $modo, $codigo;
	if ($modo == "update"){
		include("../includes/conectar_mysql.php");
		$query = "SELECT * FROM tipodeparceiro WHERE cd=" . $codigo;
		$result = mysql_query($query);
		$tipo = mysql_fetch_assoc($result);
		include("../includes/desconectar_mysql.php");
	}
	else $modo = "add";
	?>
	<html>
		<head>
			<title>Tipos de Parceiros</title>
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
				<form action="form_tipodeparceiro.php" encType="multipart/form-data" method="post" name="tipoparceiro">
				<tr>
					<td class="label">Tipo:</td>
					<td><input type="text" name="tipo" maxlength="255" size="40"<? if($modo == "update") echo(' value="' . $tipo["tipo"] . '"'); ?>></td>
				</tr>
				<tr>
					<td class="label">Imagem:</td>
					<td><input name="image" type="file" accept="image/gif, image/jpg" style="width: 100%;"></td>
				</tr>
				<? if($modo == "update") { ?>
					<tr>
						<td rowspan="2" class="label">Altera Imagem:</td>
						<td colspan="2" class="label" style="text-align:left;"><input type="radio" name="altera_imagem" value="sim">&nbsp;Sim</td>
					</tr>
					<tr>
						<td colspan="2" class="label" style="text-align:left;"><input type="radio" name="altera_imagem" value="nao" checked>&nbsp;Não</td>
					</tr>
				<? } ?>
				<tr>
					<td></td>
					<td class="label"><input type="submit" value="Salvar"></td>
				</tr>
					<input type="hidden" name="modo" value="<?=$modo?>">
					<input type="hidden" name="cd" value="<?=$codigo?>">
					<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
					<input type="hidden" name="passo" value="1">
				</form>
			</table>
		</body>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	$modo = $_POST["modo"];
	$tipo = $_POST["tipo"];
	$altera_imagem = $_POST["altera_imagem"];
	
	
	if (($modo == "add") || ($altera_imagem == "sim")){
		if($altera_imagem == "sim") {
			$query = "SELECT path, path_thumb FROM tipodeparceiro WHERE cd=" . $_POST["cd"];
			require("../includes/conectar_mysql.php");
			$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
			$imagem = mysql_fetch_row($result);
			require("../includes/desconectar_mysql.php");
			unlink("../" . $imagem[0]);
			unlink("../" . $imagem[1]);
		}
		include("img_uploader.php");
		$pasta = "../parceiros";
		$arquivo = $_FILES["image"];
		$extensao = split("/", $_FILES['image']['type']);
		$nome_arquivo = "tipodeparceiro_" . $tipo . "." . $extensao[1];
		$info_imagem = upload_imagem($pasta, $arquivo, $nome_arquivo, 56, 41, 56, 41, true);
	}
	
	if ($modo == "update") {
		$query = "UPDATE tipodeparceiro SET ";
		if($altera_imagem == "sim"){
			$query .= "path='" . $info_imagem[0] ."', ";
			$query .= "path_thumb='" . $info_imagem[1] ."', ";
		}
		$query .= "tipo='" . $tipo ."'";
		$query .= " WHERE cd=" . $_POST["cd"];
	}
	elseif ($modo == "add"){
		$query = "INSERT INTO tipodeparceiro (tipo, path, path_thumb) VALUES ('";
		$query .=  $tipo . "', '";
		$query .=  $info_imagem[0] . "', '";
		$query .=  $info_imagem[1] . "')";
	}
		
	require("../includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
	echo("<html>\n
			<head>\n
				<title>Upload de Imagem Realizado Com Sucesso!</title>\n
				<script language='Javascript'>\n
					alert('Operação realizada com Sucesso!');
					self.close();
					opener.location = opener.location;
				</script>\n
			</head>\n
		</html>");
}

?>