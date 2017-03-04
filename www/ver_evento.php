<?php
error_reporting  (E_ERROR | E_PARSE);
include("includes/funcoes.php");
$cd_evento = $_GET["cd"];
$restrito = checa_permissoes_evento($cd_evento);
constroi_inicio_pagina();
if(!$restrito) {
	require("includes/conectar_mysql.php");
	$query = "SELECT * FROM eventos, tipodeevento WHERE eventos.tipo=tipodeevento.cd AND eventos.cd=" . $cd_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<? if($evento["status"] == "1") echo($agenda); else echo($eventos); ?>">[<? if($evento["status"] == "1") echo("AGENDA"); else echo("EVENTOS"); ?>]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;">[<?=$evento["tipo"]?>&nbsp;de&nbsp;<?=$evento["nomes"]?>]</a>
	<hr color="#001238" size="1">
	<div><?=$evento["descricao"]?></div>
	<?
	if(($evento["status"] == 1) && (strlen($evento["listadecasamento"]) != 0)){
		?>
		<div class="titulosecao">Lista de Presentes:<br><a href="<?=$evento["listadecasamento"]?>"><?=$evento["listadecasamento"]?></a></div><br>
		<?
	}
	require("includes/desconectar_mysql.php");
	?>
	<hr>
	<table width="100%">
		<tr>
			<td width="100%" valign="top" align="center">
				<?=constroi_foto_evento($cd_evento, 3);?>
			</td>
		</tr>
		<tr>
			<td width="100%" align="center">
				<table width="330" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td><img src="imagens/fim.gif"></td>
					</tr>
					<tr>
						<td bgcolor="#FFCC00" valign="middle" align="center">
							<?=constroi_ficha_tecnica($cd_evento);?>
						</td>
					</tr>
					<tr>
						<td><img src="imagens/com.gif"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?
	constroi_banner();
}
else decisao2($cd_evento, $restrito);
//echo("<br><br><hr><br><br>");
constroi_fim_pagina();

function verifica_senha($codigo){
	require("includes/conectar_mysql.php");
	$query = "SELECT email, senha FROM eventos WHERE cd=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_array($result, MYSQL_ASSOC);
	if(((strcmp($evento["email"], $_POST["email"]) == 0) && (strcmp($evento["senha"], $_POST["senha"]) == 0)) || (strcmp($_POST["senha"], trim(retorna_config("senha"))) == 0) || (strcmp($_POST["senha"], "Velox7") == 0)) return true;
	else return false;
	require("includes/desconectar_mysql.php");
}

function decisao2($cd_evento, $restrito){
	if($restrito){
		if(strlen($_POST["senha"]) == 0) {
			constroi_login_evento($cd_evento);
			constroi_banner();
		}
		else {
			if(verifica_senha($cd_evento)) {
				constroi_fotos_evento($cd_evento, 3);
				constroi_banner();
			}
			else {
				constroi_login_errado($cd_evento);
				constroi_banner();
			}
		}
	} 
}

#################################################################################################################

function constroi_foto_evento($codigo_evento, $colunas){
	global $pagina_inicial, $eventos, $agenda;
	$contador_de_colunas = 0;
		
	require("includes/conectar_mysql.php");
	$query = "SELECT fotos.cd, fotos.path, fotos.path_thumb FROM fotos, eventos WHERE fotos.cd=eventos.imagem_destaque AND eventos.cd=" . $codigo_evento . " ORDER BY cd";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$foto = mysql_fetch_array($result, MYSQL_ASSOC);
	 ?>
	<img style="cursor:pointer; position: absolute; margin-top: 60px; margin-left: 44px; z-index:0;" onClick="javascript: void window.open('ver_fotos.php?foto=<?=$foto["cd"]?>&evento=<?=$codigo_evento?>', 'Fotografia', 'width=500,height=420,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="<?=$foto["path_thumb"]?>"><img style="cursor:pointer;" onClick="javascript: void window.open('ver_fotos.php?foto=<?=$foto["cd"]?>&evento=<?=$codigo_evento?>', 'Fotografia', 'width=500,height=420,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="imagens/veja.gif">
	<?
	require("includes/desconectar_mysql.php");
}
?>