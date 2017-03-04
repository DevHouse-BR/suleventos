<?php
error_reporting  (E_ERROR | E_PARSE);
require("permissao_documento.php");
require("funcoes_strings.php");
require("../includes/conectar_mysql.php");
require("funcoes.php");

if (strlen($_REQUEST["modo"]) != 0){
	if ($_REQUEST["modo"] == "novo_banner"){
		$imagem = verifica_nome_arquivo($_FILES['imagem']['name']);
		if (move_uploaded_file($_FILES['imagem']['tmp_name'], "../banners/" . $imagem)) {
			$query = "INSERT INTO banners (imagem, link, ordem) VALUES(";
			$query .= "'" . "banners/" . $imagem . "', ";
			$query .= "'" . $_POST["link"] . "', ";
			$query .= $_POST["ordem"] . ")";
			$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		}
	}
	elseif ($_REQUEST["modo"] == "apagar"){
		$query = "SELECT * FROM banners WHERE cd=" . $_REQUEST["cd"];
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$registro = mysql_fetch_assoc($result);
		unlink("../" . $registro["imagem"]);
		$query = "DELETE FROM banners WHERE cd=" . $_REQUEST["cd"];
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	}
}
?>
<html>
	<head>
		<title>suleventos.com.br</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="../includes/estilo.css" rel="stylesheet" rev="stylesheet">
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
									<param name="movie" value="../imagens/noiva.swf" />
									<param name="menu" value="false" />
									<param name="quality" value="high" />
									<param name="bgcolor" value="#000000" />
									<embed src="../imagens/noiva.swf" menu="false" quality="high" bgcolor="#2d5f90" width="157" height="139" name="Untitled-2" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
								</object>
							</td>
							<td colspan="2" align="left" valign="top">
								<?php constroi_menu_cabecalho(false); ?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="100%">
								<?php constroi_tabela_esq(-1); ?>
							</td>
							<td align="left" valign="top" bgcolor="#E6E6E6" class="conteudo" width="470">
								<? constroi_admin_banners(); ?>
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
function constroi_admin_banners(){
	?>
	<script language="javascript">
		function validaform(){
			if(document.forms['banner'].imagem.value == "") alert("Selecione uma imagem!");
			else if(document.forms['banner'].ordem.value == "") alert("Informe a ordem de aparência do banner.");
			else document.forms['banner'].submit();
		}
		function apagar(codigo){
			if(confirm("Deseja apagar este banner?")) window.location = "banners.php?modo=apagar&cd=" + codigo
		}
	</script>
	<table width="100%" bgcolor="#FFFFFF">
		<form action="banners.php" encType="multipart/form-data" method="post" name="banner">
			<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
			<tr>
				<td colspan="2"><h3>Novo Banner</h3></td>
			</tr>
			<tr>
				<td class="menurodape" width="30%">Imagem Banner:</td>
				<td class="cell" width="70%"><input maxLength="255" name="imagem" class="textfield" type="file" style="width: 100%;"></td>
			</tr>
			<tr>
				<td class="menurodape">Link&nbsp;<span style="font-size:9px;">(http://www.site.com.br)</span>:</td>
				<td class="cell"><input class="textfield" name="link" type="text" style="width: 100%;"></td>
			</tr>
			<tr>
				<td class="menurodape">Ordem de Aparência (1 ou 2 ou 3):</td>
				<td class="cell"><input class="textfield" name="ordem" type="text" style="width: 100%;"></td>
			</tr>
			<tr>
				<td class="menurodape">Salvar:</td>
				<td><input class="botao" type="button" value="  Enviar  " onClick="validaform();"></td>
			</tr>
			<input name="modo" type="hidden" value="novo_banner">
		</form>
	</table>
	<hr>
	<table width="100%">
	<?
	$query = "SELECT * FROM banners order by ordem, imagem";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	while($registro = mysql_fetch_assoc($result)){ ?>
		<tr>
			<td width="20%"><img src="../<?=$registro["imagem"]?>"></td>
			<td><input type="button" value="Apagar" onClick="apagar(<?=$registro["cd"]?>);"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	<? }
	echo("</table>");
}
require("../includes/desconectar_mysql.php");
?>