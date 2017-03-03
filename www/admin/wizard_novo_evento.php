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
	$codigo = $_REQUEST["codigo_evento"];
	
	if($modo == "update"){
		$update = true;
		require("../includes/conectar_mysql.php");
		$query = "SELECT cd, nomes, data, local, descricao, email, tipo, status, listadecasamento from eventos where cd=" . $codigo;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$evento = mysql_fetch_array($result, MYSQL_ASSOC);
		require("../includes/conectar_mysql.php");
	}
	strlen($evento["email"]);
	?>
	<html>
		<head>
			<title>Cadastro de Eventos: Primeiro Passo</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<style type="text/css">
				.label{
					font-family:Verdana, Arial, Helvetica, sans-serif;
					font-size:12px;
					text-align:right;
					vertical-align:top;				
				}
			</style>
			<script language="JavaScript" src="calendar1.js"></script>
		</head>
		<body>
			<table>
				<form name="passo0" action="wizard_novo_evento.php" method="post">
				<tr>
					<td class="label">Tipo:</td>
					<td><select name="tipo">
					<?php
						$query = "SELECT * FROM tipodeevento ORDER BY tipo";
						require("../includes/conectar_mysql.php");
						$result = mysql_query($query) or die("Erro na consulta ao Banco de dados: " . mysql_error());
						while($tipo = mysql_fetch_array($result, MYSQL_ASSOC)){
							echo('<option value="' . $tipo["cd"] . '"');
							if(($update) && ($tipo["cd"] == $evento["tipo"])) echo(" selected");
							echo('>' . $tipo["tipo"] . '</option>');
						}
						require("../includes/desconectar_mysql.php");
					?></select>
					</td>
				</tr>
				<tr>
					<td class="label">Status:</td>
					<td>
						<select name="status">
							<option value="0"<? if(($update) && ($evento["status"] == 0)) echo(" selected"); ?>>Evento Realizado</option>
							<option value="1"<? if(($update) && ($evento["status"] == 1)) echo(" selected"); ?>>Agenda</option>
							<option value="2"<? if(($update) && ($evento["status"] == 2)) echo(" selected"); ?>>Desativado</option>
							<option value="3"<? if(($update) && ($evento["status"] == 3)) echo(" selected"); ?>>Em Aprovação</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="label">Nomes:</td>
					<td><input type="text" name="nomes" maxlength="255" size="40"<? if($update) echo(' value="' . $evento["nomes"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Data:</td>
					<td><input type="text" name="data" maxlength="10" size="40" <? if($update) echo(' value="' . date("d/m/Y",$evento["data"]) . '"');?> onKeyDown="if (((event.keyCode > 47) && (event.keyCode < 58)) || ((event.keyCode > 95) && (event.keyCode < 106)) || (event.keyCode == 8) || (event.keyCode == 111) || (event.keyCode == 46) || ((event.keyCode > 36) && (event.keyCode < 41))) return true; else return false;">&nbsp;<a href="javascript:cal1.popup();"><img src="../imagens/cal.gif" border="0" alt="Clique aqui para escolher a data."></a></td>
				</tr>
				<tr>
					<td class="label">Local:</td>
					<td><input type="text" name="local" maxlength="255" size="40"<? if($update) echo(' value="' . $evento["local"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Lista de Presentes:</td>
					<td><input type="text" name="listadecasamento" maxlength="255" size="40"<? if($update) echo(' value="' . $evento["listadecasamento"] . '"');?>></td>
				</tr>
				<tr>
					<td class="label">Descricao:</td>
					<td><textarea name="descricao" rows="5" cols="30" onKeyUp="contador.innerHTML = 'Quantidade de Caracteres: ' + this.value.length;" onKeyDown="if ((this.value.length > 254) && (event.keyCode != 8) && (event.keyCode != 46)  && (event.keyCode != 37)  && (event.keyCode != 38)  && (event.keyCode != 39)  && (event.keyCode != 40)) return false;"><? if($update) echo($evento["descricao"]);?></textarea><div class="label" id="contador">Quantidade de Caracteres: 0</div></td>
				</tr>
				<tr>
					<td class="label">Requer Senha?</td>
					<td class="label" style="text-align:left;"><input type="radio" name="restrito" value="sim" onClick="passo0.email.disabled=false;" <? if(($update) && (strlen($evento["email"]) > 0)) echo(" checked"); ?>>Sim<br><input type="radio" name="restrito" value="nao" onClick="passo0.email.disabled=true; passo0.email.value='';" <? if(($update) && (strlen(trim($evento["email"])) == 0)) echo(" checked"); ?>>Não</td>
				</tr>
				<tr>
					<td class="label">Email:</td>
					<td><input type="text" name="email" maxlength="255" size="40" <? if($update) echo(' value="' . $evento["email"] . '"');  if(($update) && (strlen($evento["email"]) == 0)) echo(" disabled"); ?>></td>
				</tr>
				<?
				if ($update) { ?>
					<tr>
						<td></td>
						<td class="label"><input type="submit" value="Salvar"></td>
					</tr>
				<?
				}
				else { ?>
					<tr>
						<td></td>
						<td class="label"><input type="submit" value="Próximo >>"></td>
					</tr>
				<? } ?>
				<input type="hidden" name="passo" value="1">
				<input type="hidden" name="modo" value="<? if($update) echo("update"); else echo("add"); ?>">
				<? if($update) echo('<input type="hidden" name="codigo_evento" value="' . $codigo . '">'); ?>
				</form>
			</table>
			<iframe width="100%" src="form_tipodeevento.php" height="50" scrolling="no"></iframe>
		</body>
	</html>
	<script language="JavaScript">
		var cal1 = new calendar1(document.forms['passo0'].elements['data']);
		cal1.year_scroll = true;
		cal1.time_comp = false;
	</script>
	<? 
}

##############################################################################################
function constroi_passo1(){
	$nomes = $_POST["nomes"];
	$local = $_POST["local"];
	$descricao = $_POST["descricao"];
	$restrito = $_POST["restrito"];
	$tipo = $_POST["tipo"];
	$modo = $_REQUEST["modo"];
	$cd = $_REQUEST["codigo_evento"];
	$email = $_POST["email"];
	$status = $_POST["status"];
	
	if ($restrito == "sim"){
		$senha = str_replace("=", "", base64_encode(rand(100000, 999999)));
	}
	else {
		$email = "";
		$senha = "";
	}
	
	$tmp = split("/", $_POST["data"]);
	$data = mktime( 0, 0, 0, $tmp[1], $tmp[0], $tmp[2]);
	
	if ($modo == "add")	{
		$query = "INSERT INTO eventos (nomes, data, local, descricao, email, senha, tipo, status) VALUES ('";
		$query .= $nomes ."','";
		$query .= $data ."','";
		$query .= $local ."','";
		$query .= $descricao ."','";
		$query .= $email ."','";
		$query .= $senha . "', ";
		$query .= $tipo . ", ";
		$query .= $status . ")";
	}
	if (($modo == "update") && (strlen($email) != 0)){
		$consulta = "SELECT email FROM eventos WHERE cd=" . $cd;
		$resultado = mysql_query($consulta);
		$temp = mysql_fetch_row($resultado);
		if ($temp[0] != $email) $envia = true;
		else $envia = false;
	}
	if ($modo == "update") {
		$query = "UPDATE eventos SET ";
		$query .= "nomes='" . $nomes ."', ";
		$query .= "data='" . $data ."', ";
		$query .= "local='" . $local ."', ";
		$query .= "descricao='" . $descricao ."', ";
		$query .= "email='" . $email ."', ";
		$query .= "senha='" . $senha ."', ";
		$query .= "status='" . $status ."' ";
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
	if (($modo == "add") && (strlen($email) != 0)){
		mail($email, "Informações Cadastrais suleventos.com.br", "Caro(a) amigo(a), \n\nSeu evento foi incluido no site suleventos.com.br!\nPara acessá-la aponte seu navegador para:\n\nhttp://www.suleventos.com.br/ver_evento.php?cd=" . $cd . "\n\nUsuário: " . $email . "\nSenha: " . $senha, "From: <suleventos@suleventos.com.br>");
	}
	elseif (($modo == "update") && ($envia)) {
		mail($email, "Informações Cadastrais suleventos.com.br", "Caro(a) amigo(a), \n\nSeu evento foi incluido no site suleventos.com.br!\nPara acessá-la aponte seu navegador para:\n\nhttp://www.suleventos.com.br/ver_evento.php?cd=" . $cd . "\n\nUsuário: " . $email . "\nSenha: " . $senha, "From: <suleventos@suleventos.com.br>");
	}
	if ($modo == "update") die('<html><script language="javascript">parent.location = parent.location;</script></html>');
	?>
	<html>
		<head>
			<title>Cadastro de Eventos: Segundo Passo</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		</head>
		<body>
			<table width="400" border="0" class="tabela">
				<tr>
					<td colspan="2" align="center"><h3>Fotografia de Destaque</h3></td>
				</tr>
				<form action="wizard_novo_evento.php" encType="multipart/form-data" method="post" name="sendform">
				<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
				<tr>
					<td width="80%"><input name="image" type="file" accept="image/jpeg, image/jpg" style="width: 100%;"></td>
					<td width="20%"><input name="Submit" type="submit" value="Enviar" style="width: 100%;"></td>
				</tr>
				<input type="hidden" name="numero_imagem" value="1">
				<input type="hidden" name="passo" value="2">
				<input type="hidden" name="destaque" value="sim">
				<input type="hidden" name="codigo_evento" value="<?=$cd?>">
				<input type="hidden" name="modo" value="<?=$modo?>">
				</FORM>
			</table>
		</body>
	</html>
	<? 
}

##############################################################################################

function constroi_passo2(){
	$modo = $_REQUEST["modo"];
	$codigo_evento = $_REQUEST["codigo_evento"];
	require("../includes/conectar_mysql.php");
	
	if($modo == "altera_destaque") {
		unlink("../fotos/" . $codigo_evento . "_" . $_POST["numero_imagem"] . ".jpg");
		unlink("../fotos/thumb/thumb_" . $codigo_evento . "_" . $_POST["numero_imagem"] . ".jpg");
		$query = "SELECT imagem_destaque from eventos WHERE cd=" . $codigo_evento;
		$result = mysql_query($query);
		$codigo_foto = mysql_fetch_row($result);
		$query = "DELETE FROM fotos WHERE cd=" . $codigo_foto[0];
		$result = mysql_query($query);
	}
	include("img_uploader.php");
	$pasta = "../fotos";
	$arquivo = $_FILES["image"];
	$nome_arquivo = $_POST["codigo_evento"] . "_" . $_POST["numero_imagem"] . ".jpg";
	$info_imagem = upload_imagem($pasta, $arquivo, $nome_arquivo, 320, 240, 120, 90, true);
	
	$query = "INSERT INTO fotos (path, path_thumb, cd_evento, bytes, largura, altura) VALUES ('";
	$query .= $info_imagem[0] ."','";
	$query .= $info_imagem[1] . "',";
	$query .= $codigo_evento . ","; 
	$query .= $_FILES['image']['size'] . ","; 
	$query .= $info_imagem[3] . ",";
	$query .= $info_imagem[4] . ")";
	
	if (!mysql_query($query)){
		unlink("../" . $info_imagem[0]);
		unlink("../" . $info_imagem[1]);
		die("<html>\n<head>\n<title>Erro no Upoload de Imagem</title>\n<script language='Javascript'>\nfunction retorna(){\n window.history.back();\n}\n</script>\n</head>\n<body>\n<center><h3>Problemas para gravar o registro da imagem no banco de dados. Erro: " . mysql_error() . "</h3></center><br>\n<a href='Javascript: retorna()'>Voltar</a>\n</body>\n</html>");
	}
	
	if ($_POST["destaque"] == "sim") {
		$result = mysql_query("SELECT LAST_INSERT_ID();") or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
		$cd = mysql_fetch_row($result);
		$query = "UPDATE eventos SET ";
		$query .= "imagem_destaque=" . $cd[0];
		$query .= " WHERE cd=" . $codigo_evento;
		$result = mysql_query($query);
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
				if(($modo != "altera_destaque") && ($modo != "adiciona_imagem")){ ?>
					<tr>
						<td align='center'>
							<form method="post" action="wizard_novo_evento.php">
								<input type="submit" value="Adiciona Foto">
								<input type="hidden" name="passo" value="3">
								<input type="hidden" name="numero_imagem" value="<?=$_POST["numero_imagem"]?>">
								<input type="hidden" name="codigo_evento" value="<?=$codigo_evento?>">
							</form>
						</td>
					</tr>
					<tr>
						<td align='right'>
							<form method="post" action="wizard_novo_evento.php">
								<input type="submit" value="Próximo >>">
								<input type="hidden" name="passo" value="4">
								<input type="hidden" name="codigo_evento" value="<?=$codigo_evento?>">
							</form>
						</td>
					</tr>
				<? 
				} 
				elseif (($modo == "adiciona_imagem") || ($_REQUEST["modo"] == "altera_destaque")) echo('<tr><td align="center"><a href="javascript: self.close(); opener.location = opener.location;">[Fechar]</a></td></tr>');
				?>
			</table>
		</body>
	</html>
	<?
}

##############################################################################################

function constroi_passo3(){
	$codigo_evento = $_REQUEST["codigo_evento"];
	$modo = $_REQUEST["modo"];
	
	if($_POST["numero_imagem"] == ""){
		require("../includes/conectar_mysql.php");
		$query = "SELECT cd FROM fotos WHERE cd_evento=" . $codigo_evento . " ORDER BY cd DESC";
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
				<form action="wizard_novo_evento.php" encType="multipart/form-data" method="post" name="sendform">
				<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
				<tr>
					<td width="80%"><input name="image" type="file" accept="image/jpeg, image/jpg" style="width: 100%;"></td>
					<td width="20%"><input name="Submit" type="submit" value="Enviar" style="width: 100%;"></td>
				</tr>
				<input type="hidden" name="numero_imagem" value="<?=$numero_imagem?>">
				<input type="hidden" name="passo" value="2">
				<input type="hidden" name="destaque" value="nao">
				<input type="hidden" name="modo" value="<?=$modo?>">
				<input type="hidden" name="codigo_evento" value="<?=$codigo_evento?>">
				</FORM>
			</table>
		</body>
	</html>
	<? 
}

##############################################################################################

function constroi_passo4(){ ?>
	<html>
		<head>
			<title>Cadastro de Eventos: Terceiro Passo</title>
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
				function remove_parceiro(codigo){
					if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar os parceiros selecionados deste evento?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
						passo4.modo.value = "remove";
						passo4.parceiro.value = codigo;
						passo4.submit();
					}
				}
			</script>
		</head>
		<body>
			<table border="1" width="100%">
				<tr>
					<td colspan="3" align="center"><b>Parceiros</b></td>
				</tr>
				<?php
					require("../includes/conectar_mysql.php");
					$query = "SELECT parceiro FROM parceiro_evento WHERE evento='" . $_REQUEST["codigo_evento"] . "'";
					$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
					if(mysql_num_rows($result) == 0){
						echo("<tr><td>Nenhum Parceiro Cadastrado</td></tr>");
					}
					while($registros = mysql_fetch_row($result)){
						$query = "SELECT cd, nome, tipo FROM parceiros WHERE cd=" . $registros[0];
						$result2 = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
						while($parceiro = mysql_fetch_array($result2, MYSQL_ASSOC)){
							$query = "SELECT tipo from tipodeparceiro where cd=" . $parceiro["tipo"];
							$result3 = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
							$tipodoparceiro = mysql_fetch_row($result3);
							?>
							<tr>
								<td><a href="javascript: remove_parceiro('<?=$parceiro["cd"]?>');">[Remove]</a></td>
								<td><?=$parceiro["nome"]?></td>
								<td><?=$tipodoparceiro[0]?></td>
							</tr>
							<?
						}
					}
					require("../includes/desconectar_mysql.php");
				?>
			</table>
			<hr>
			<table>
				<form name="passo4" action="wizard_novo_evento.php" method="post">
				<tr>
					<td class="label">Parceiro:</td>
					<td>
						<select name="parceiro">
						<?php
							$query = "SELECT cd, nome FROM parceiros ORDER BY tipo";
							require("../includes/conectar_mysql.php");
							$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
							while($tipo = mysql_fetch_array($result, MYSQL_ASSOC)) echo('<option value="' . $tipo["cd"] . '">' . $tipo["nome"] . '</option>');
							require("../includes/desconectar_mysql.php");
						?>
						</select>
						<input type="Submit" value="Adicionar">
					</td>
				</tr>
				<input type="hidden" name="codigo_evento" value="<?=$_REQUEST["codigo_evento"]?>">
				<input type="hidden" name="passo" value="5">
				<input type="hidden" name="modo" value="add">
				</form>
			</table>
			<hr>
			<input type="button" value="Concluir" onClick="javascript: self.close(); opener.location = opener.location;">
		</body>
	</html>
<?
}

##############################################################################################

function constroi_passo5(){
	$parceiro = $_POST["parceiro"];
	$codigo_evento = $_POST["codigo_evento"];
	$modo = $_POST["modo"];
	
	if ($modo == "add")	{
		if (verifica_parceiro_existente($codigo_evento, $parceiro)){
			$query = "INSERT INTO parceiro_evento (parceiro, evento) VALUES (";
			$query .= $parceiro .",";
			$query .= $codigo_evento .")";
			require("../includes/conectar_mysql.php");
			$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
			require("../includes/desconectar_mysql.php");
			constroi_passo4();
		}
		else {
			?> <html><body><h3>Parceiro Já Cadastrado</h3><form name="passo4" action="wizard_novo_evento.php" method="post"><input type="hidden" name="codigo_evento" value="<?=$_POST["codigo_evento"]?>"><input type="hidden" name="passo" value="4"><input type="submit" value="Voltar"></form></body></html> <?
		}
	}
	if ($modo == "remove") {
		require("../includes/conectar_mysql.php");
		$query = "DELETE FROM parceiro_evento WHERE (parceiro=" . $_POST["parceiro"] . ") AND (evento=" . $_POST["codigo_evento"] . ") LIMIT 1";
		$result = mysql_query($query) or die("Erro ao remover registros do Banco de dados: " . mysql_error());	
		require("../includes/conectar_mysql.php");
		constroi_passo4();
	}
}

function verifica_parceiro_existente($codigo_evento, $codigo_parceiro){
	require("../includes/conectar_mysql.php");
	$query = "SELECT parceiro FROM parceiro_evento WHERE evento=$codigo_evento AND parceiro=$codigo_parceiro";
	$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . $query . mysql_error());
	$registro = mysql_fetch_row($result);
	require("../includes/desconectar_mysql.php");
	if(strlen($registro[0]) == 0) return true;
	else return false;
}
?>