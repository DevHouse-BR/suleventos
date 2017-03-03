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
		$query = "SELECT cd,  nome, descricao, site, email, telefone, endereco, tipo FROM parceiros where cd=" . $codigo;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$parceiro = mysql_fetch_array($result, MYSQL_ASSOC);
		require("../includes/conectar_mysql.php");
	}
	
	?>
	<html>
		<head>
			<title>Cadastro de Parceiros</title>
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
				function valida_form(){
					if(sendform.altera_imagem){
						if ((sendform.altera_imagem[0].checked) && (sendform.image.value == "")) alert("Imagens são obrigatórias");
						else sendform.submit();
					}
					else{
						if (sendform.image.value == "") alert("Imagens são obrigatórias");
						else sendform.submit();
					}
				}
			</script>
		</head>
		<body>
			<table>
				<form action="wizard_novo_parceiro.php" encType="multipart/form-data" method="post" name="sendform">
				<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
				<? if($update) { ?>
					<tr>
						<td rowspan="2" class="label">Altera Imagem:</td>
						<td colspan="2" class="label" style="text-align:left;"><input type="radio" name="altera_imagem" value="sim">&nbsp;Sim</td>
					</tr>
					<tr>
					<td colspan="2" class="label" style="text-align:left;"><input type="radio" name="altera_imagem" value="nao" checked>&nbsp;Não</td>
				</tr>
				<? } ?>
				<tr>
					<td class="label">Tipo:</td>
					<td>
						<select name="tipo">
						<?php
							$query = "SELECT * FROM tipodeparceiro ORDER BY tipo";
							require("../includes/conectar_mysql.php");
							$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
							while($tipo = mysql_fetch_array($result, MYSQL_ASSOC)){
								echo('<option value="' . $tipo["cd"] . '"');
								if(($update) && ($tipo["cd"] == $parceiro["tipo"])) echo(" selected");
								echo('>' . $tipo["tipo"] . '</option>');
							}
							require("../includes/desconectar_mysql.php");
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="label">Imagem:</td>
					<td colspan="2"><input name="image" type="file" accept="image/jpeg, image/jpg" style="width: 100%;"></td>
				</tr>
				<tr>
					<td class="label">Nome:</td>
					<td><input type="text" name="nome" maxlength="255" size="40"<? if($update) echo(' value="' . $parceiro["nome"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Endereço:</td>
					<td><input type="text" name="endereco" maxlength="255" size="40"<? if($update) echo(' value="' . $parceiro["endereco"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Site:</td>
					<td><input type="text" name="site" maxlength="255" size="40"<? if($update) echo(' value="' . $parceiro["site"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Email:</td>
					<td><input type="text" name="email" maxlength="255" size="40"<? if($update) echo(' value="' . $parceiro["email"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Telefone:</td>
					<td><input type="text" name="telefone" maxlength="255" size="40"<? if($update) echo(' value="' . $parceiro["telefone"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Descricao:</td>
					<td><textarea name="descricao" rows="5" cols="30" onKeyUp="contador.innerHTML = 'Quantidade de Caracteres: ' + this.value.length;" onKeyDown="if ((this.value.length > 254) && (event.keyCode != 8) && (event.keyCode != 46)  && (event.keyCode != 37)  && (event.keyCode != 38)  && (event.keyCode != 39)  && (event.keyCode != 40)) return false;"><? if($update) echo($parceiro["descricao"]);?></textarea><div class="label" id="contador">Quantidade de Caracteres: 0</div></td>
				</tr>
				<tr>
					<td></td>
					<td class="label"><input type="button" value="Salva" onClick="valida_form();"></td>
				</tr>
				<input type="hidden" name="passo" value="1">
				<input type="hidden" name="modo"<? if($update) echo(' value="update"'); else echo(' value="add"'); ?>>
				<input type="hidden" name="cd" <? if($update) echo(' value="' . $parceiro["cd"] . '"'); ?>>
				<input type="hidden" name="img" value="<? if($update) echo($parceiro["imagem"]); ?>">
				</form>
			</table>
			<iframe width="100%" src="form_tipodeparceiro.php" height="70" scrolling="no"></iframe>
		</body>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	
	$nome = $_POST["nome"];
	$endereco = $_POST["endereco"];
	$descricao = $_POST["descricao"];
	$site = $_POST["site"];
	$telefone = $_POST["telefone"];
	$email = $_POST["email"];
	$tipo = $_POST["tipo"];
	$modo = $_POST["modo"];
	$altera_imagem = $_POST["altera_imagem"];
	$img = $_POST["img"];
	
	if (($modo == "add") || ($altera_imagem == "sim")){
		if($altera_imagem == "sim") {
			$query = "SELECT path, path_thumb FROM parceiros WHERE cd=" . $_POST["cd"];
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
		$nome_arquivo = $nome . ".jpg";
		$info_imagem = upload_imagem($pasta, $arquivo, $nome_arquivo, 320, 240, 120, 90, true);
	}
	
	if ($modo == "add")	{
		$query = "INSERT INTO parceiros (nome, descricao, site, email, telefone, endereco, tipo, path, path_thumb, largura, altura) VALUES ('";
		$query .= $nome ."', '";
		$query .= $descricao ."', '";
		$query .= $site ."', '";
		$query .= $email ."', '";
		$query .= $telefone ."', '";
		$query .= $endereco ."', '";
		$query .= $tipo ."', '";
		$query .= $info_imagem[0] ."', '";
		$query .= $info_imagem[1] ."', '";
		$query .= $info_imagem[3] ."', '";
		$query .= $info_imagem[4] ."')";
	}
	if ($modo == "update") {
		$query = "UPDATE parceiros SET ";
		if($altera_imagem == "sim"){
			$query .= "path='" . $info_imagem[0] ."', ";
			$query .= "path_thumb='" . $info_imagem[1] ."', ";
			$query .= "largura='" . $info_imagem[3] ."', ";
			$query .= "altura='" . $info_imagem[4] ."', ";
		}
		$query .= "nome='" . $nome ."', ";
		$query .= "descricao='" . $descricao ."', ";
		$query .= "site='" . $site ."', ";
		$query .= "email='" . $email ."', ";
		$query .= "endereco='" . $endereco ."', ";
		$query .= "tipo='" . $tipo ."', ";
		$query .= "telefone='" . $telefone ."'";
		$query .= " WHERE cd=" . $_POST["cd"];
	}
	require("../includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
	?>
	<html>
		<head>
			<title>Parceiro Salvo!</title>
		</head>
		<body>
			<h3>Parceiro Salvo com Sucesso!</h3>
			<br><br>
			<a href="wizard_novo_parceiro.php">[Adicionar Novo Parceiro]</a>
			<br><br>
			<a href="javascript: self.close(); opener.location = opener.location">[Fechar]</a>
		</body>
	</html>
	<?
}

?>