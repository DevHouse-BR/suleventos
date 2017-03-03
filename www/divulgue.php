<?php
error_reporting  (E_ERROR | E_PARSE);
$etapa = $_REQUEST["etapa"];
if(strlen($etapa) == 0) $etapa = "1";
include("includes/funcoes.php");

?>
<html>
	<head>
		<title>suleventos.com.br</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/estilo.css" rel="stylesheet" rev="stylesheet">
	</head>
	<body>
		<table width="100%" height="100%" border="0">
			<tr>
				<td align="center" valign="top">
					<table width="770" border="0" cellpadding="0" cellspacing="5">
						<tr>
							<td width="157" height="139">
								<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="157" height="139" id="Untitled-2" align="middle">
									<param name="allowScriptAccess" value="sameDomain" />
									<param name="movie" value="imagens/noiva.swf" />
									<param name="menu" value="false" />
									<param name="quality" value="high" />
									<param name="bgcolor" value="#000000" />
									<embed src="imagens/noiva.swf" menu="false" quality="high" bgcolor="#2d5f90" width="157" height="139" name="Untitled-2" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
								</object>
							</td>
							<td colspan="2" align="left" valign="top">
								<?php constroi_menu_cabecalho(); ?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="100%">
								<?php constroi_tabela_esq(-1); ?>
							</td>
							<td align="left" valign="top" bgcolor="#E6E6E6" class="conteudo" width="470">
								<?php constroi_form_busca(); ?>
								<hr>
								<?
								switch($etapa){
									case "1":
										constroi_texto_introducao();
										constroi_cadastro_casamento();
										constroi_instrucoes_cadastro_casamento();
										break;
									case "2":
										inicia_processo_validacao();
										break;
								}
								constroi_banner();
								?>
							</td>
							<td width="140" align="right" valign="top" bgcolor="#001238">
								<? constroi_parceiro_em_destaque(); ?>
							  <font style="font-size:2px;"><br></font>
							  <? constroi_destaque_cadastro_casamento(); ?>
							   <font style="font-size:2px;"><br></font>
							  	<? constroi_outros_eventos(); ?>
							</td>
						</tr>
						<tr>
							<td colspan="3" height="70" valign="bottom">
								<?php constroi_rodape(); ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
<?
function constroi_cadastro_casamento(){
	?>
	<script language="JavaScript" src="admin/calendar1.js"></script>
	<script language="javascript" type="text/javascript">
		function valida_form(){
			var f = document.forms["cadastro"];
			if((f.tipo.value != "") && (f.nomes.value != "") && (f.data.value != "") && (f.local.value != "") && (f.email.value != "")){
				if(checkEmail(f)){
					f.data.disabled = false;
					f.submit();
				}
			}
			else alert("Preecha todos os campos com asterisco");
		}
		function checkEmail(myForm) {
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(myForm.email.value)){
				return (true)
			}
			alert("Endereço de Email Invalido!")
			return (false)
		}
	</script>
	<hr>
	<table width="100%" border="0">
		<form action="divulgue.php" method="post" name="cadastro" encType="multipart/form-data">
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">*Tipo de Evento:</td>
			<td><select name="tipo" style="width: 100%;">
			<?php
				$query = "SELECT * FROM tipodeevento ORDER BY tipo";
				require("includes/conectar_mysql.php");
				$result = mysql_query($query) or die("Erro na consulta ao Banco de dados: " . mysql_error());
				while($tipo = mysql_fetch_array($result, MYSQL_ASSOC)){
					echo('<option value="' . $tipo["cd"] . '"');
					if(($update) && ($tipo["cd"] == $evento["tipo"])) echo(" selected");
					echo('>' . $tipo["tipo"] . '</option>');
				}
				require("includes/desconectar_mysql.php");
			?></select>
			</td>
		</tr>
		<tr>
			<td width="30%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">*Nomes:</td>
			<td width="53%"><input type="text" name="nomes" style="width: 100%;" maxlength="255"></td>
			<td width="17%"></td>
		</tr>
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Foto:</td>
			<td colspan="2"><input name="image" type="file" accept="image/jpeg, image/jpg" style="width: 100%;"></td>
		</tr>
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">*Data:</td>
			<td><input maxlength="10" type="text" name="data" style="width: 100%;" value="Use o Calendario" disabled></td>
			<td><a href="javascript: document.forms['cadastro'].elements['data'].value=''; cal1.popup();"><img src="imagens/cal.gif" border="0" alt="Clique aqui para escolher a data."></a></td>
		</tr>
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">*Local:</td>
			<td><input maxlength="255" type="text" name="local" style="width: 100%;"></td>
		</tr>
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">*Email:</td>
			<td><input maxlength="255" type="text" name="email" style="width: 100%;"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="button" onClick="javascript: valida_form();" value="Proximo >>"></td>
		</tr>
		<input type="hidden" name="etapa" value="2">
		<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
		</form>
	</table>
	<script language="JavaScript">
		var cal1 = new calendar1(document.forms['cadastro'].elements['data']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
	</script>
	<?
}

#################################################################################################################

function constroi_instrucoes_cadastro_casamento(){
	?>
	<hr>
	<div class="conteudo">
		<b>Instruções de Uso:</b><br><br>
		<li>Todos os campos são de preenchimento obrigatório.</li>
		<li>Informe o endereço de email corretamente pois você receberá um email contendo senhas para utilização do sistema.</li>
		<li>Após o preenchimento do formulário as informações passarão por um processo de validação. Você receberá um email quando aprovado o cadastro.</li>
		<li>A data deve estar no formato: dd/mm/yyyy</li>
	</div>
	<?
}

#################################################################################################################

function inicia_processo_validacao(){
	$nomes = $_POST["nomes"];
	$data_temp = $_POST["data"];
	$local = $_POST["local"];
	$email = $_POST["email"];
	$tipo = $_POST["tipo"];
	$listadecasamento = $_POST["listadecasamento"];

	$temp = split("/", $data_temp);
	$data = mktime(0,0,0,$temp[1], $temp[0], $temp[2]);
	//$senha_admin = str_replace("=", "", base64_encode(rand(100000000, 9999999999)));
	//$senha_user = str_replace("=", "", base64_encode(rand(100000000, 9999999999)));
	$status = 3;
		
	$destino = retorna_config("email");
	//$destino = "llv@brturbo.com";
	
	require("includes/conectar_mysql.php");
		$query = "INSERT INTO eventos (nomes, data, local, email, status, listadecasamento, tipo) VALUES ('";
		$query .= $nomes ."', ";
		$query .= $data .", '";
		$query .= $local ."', '";
		$query .= $email ."', ";
		$query .= $status .", '";
		$query .= $listadecasamento ."',";
		$query .= $tipo .")";

		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$result = mysql_query("SELECT LAST_INSERT_ID();") or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
		$cd = mysql_fetch_row($result);
		$codigo_evento = $cd[0];
		
		if(empty($_FILES["image"]["name"])){
			copy("imagens/imagemnaodisponivel.jpg", "fotos/" . $codigo_evento . "_01.jpg");
			copy("imagens/thumb_imagemnaodisponivel.jpg", "fotos/thumb/thumb_" . $codigo_evento . "_01.jpg");
			$info_imagem = array("fotos/" . $codigo_evento . "_01.jpg", "fotos/thumb/thumb_" . $codigo_evento . "_01.jpg", "28818", "320", "240");
		}
		else {
			include("admin/img_uploader.php");
			$pasta = "fotos";
			$arquivo = $_FILES["image"];
			$nome_arquivo = $codigo_evento . "_01.jpg";
			$info_imagem = upload_imagem($pasta, $arquivo, $nome_arquivo, 320, 240, 120, 90, true);
		}
		
		$query = "INSERT INTO fotos (path, path_thumb, cd_evento, bytes, largura, altura) VALUES ('";
		$query .= $info_imagem[0] ."','";
		$query .= $info_imagem[1] . "',";
		$query .= $codigo_evento . ","; 
		$query .= "0" . ","; 
		$query .= $info_imagem[3] . ",";
		$query .= $info_imagem[4] . ")";
		
		if (!mysql_query($query)){
			unlink($info_imagem[0]);
			unlink($info_imagem[1]);
			die("<html>\n<head>\n<title>Erro no Upoload de Imagem</title>\n<script language='Javascript'>\nfunction retorna(){\n window.history.back();\n}\n</script>\n</head>\n<body>\n<center><h3>Problemas para gravar o registro da imagem no banco de dados. Erro: " . mysql_error() . "</h3></center><br>\n<a href='Javascript: retorna()'>Voltar</a>\n</body>\n</html>");
		}
		$result = mysql_query("SELECT LAST_INSERT_ID();") or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
		$cd = mysql_fetch_row($result);
		$query = "UPDATE eventos SET ";
		$query .= "imagem_destaque=" . $cd[0];
		$query .= " WHERE cd=" . $codigo_evento;
		$result = mysql_query($query);
		
	require("includes/desconectar_mysql.php");
	
	$mensagem = "Pedido de Cadastro de Casamento\n\n\Nomes: " . $nomes;
	$mensagem .= "\nData: " . $data_temp;
	$mensagem .= "\nEmail: " . $email;
	$mensagem .= "\n\nPara visualizar o evento clique no link abaixo:\nhttp://www.suleventos.com.br/ver_evento.php?cd=" . $codigo_evento;
	$mensagem .= "\n\nPara confirmar clique no link abaixo:\nhttp://www.suleventos.com.br/confirmacao.php?confirma=sim&chave=MTIzMDk4&cd=" . $codigo_evento;
	$mensagem .= "\n\nPara negar o pedido clique no link abaixo:\nhttp://www.suleventos.com.br/confirmacao.php?confirma=nao&chave=MTIzMDk4&cd=" . $codigo_evento;
	
	if($result) mail($destino, "CADASTRO DE CASAMENTO SULEVENTOS.COM.BR", $mensagem, "From: <suleventos@suleventos.com.br>");
	
	$mensagem = '<table width="100%" border="0" class="conteudo"><tr><td>';
	$mensagem .= "<b>Pedido de Cadastro de Evento</b><br><br>";
	$mensagem .= "As informações estão sendo analizadas e em breve você terá um retorno sobre o seu cadastro. ";
	$mensagem .= "Verifique seu email em breve para novas instruções.<br><br>";
	$mensagem .= "Felicidades,<br><br>Equipe suleventos.com.br";
	$mensagem .= '</td></tr></table>';
	
	echo($mensagem);
}

function constroi_texto_introducao(){
	require("includes/conectar_mysql.php");
	$query = "SELECT conteudo FROM textos WHERE nome='cadastro_casamento'";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$text = mysql_fetch_row($result);
	require("includes/desconectar_mysql.php");
	echo('<div>' . $text[0] . '</div>');
	?>
	<hr>
	<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Escolha um site para cadastrar sua lista de presentes!</div><br>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="440" height="73" id="banner" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="imagens/bannercolombo.swf" />
		<param name="quality" value="high" />
		<param name="bgcolor" value="#FFFFFF" />
		<param name="wmode" value="transparent">
		<embed src="imagens/bannercolombo.swf" quality="high" bgcolor="#ffffff" width="440" height="73" name="banner" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
	<?
}
?>