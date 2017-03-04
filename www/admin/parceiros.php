<?php
error_reporting  (E_ERROR | E_PARSE);
require("permissao_documento.php");
include("funcoes.php");
$tipo = $_GET["tipo"];
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
								<? 
								if (strlen($tipo) == 0)	constroi_tabela_tipo_parceiros_nova(); 
								else constroi_tabela_parceiros($tipo);
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
function tabela_edita_tipo_parceiro(){
	include("../includes/conectar_mysql.php");
	$query = "SELECT * FROM tipodeparceiro";
	$result = mysql_query($query);
	echo('<hr><div style="background-color: #001238; color: #FFFFFF; font-size: 14px; text-align: center; font-weight: bold;">Edição de Tipos de Parceiros</div><table width="100%"><tr><td></td><td class="menurodape">Tipo</td></tr>');
	while($tipo = mysql_fetch_assoc($result)){
		?>
		<tr>
			<td><img src="../<?=$tipo["path"]?>"></td>
			<td><li><a href="form_tipodeparceiro.php?cd=<?=$tipo["cd"]?>&modo=update" target="_blank"><?=$tipo["tipo"]?></a></li></td>
		</tr>
		<?
	}
	echo('</table>');
	include("../includes/desconectar_mysql.php");
}
function constroi_tabela_tipo_parceiros_nova(){
	//global $pagina_inicial, $parceiros;
	require("../includes/conectar_mysql.php");
	$query = "SELECT DISTINCT parceiros.tipo as tipo1, tipodeparceiro.tipo as tipo2, tipodeparceiro.cd, tipodeparceiro.path, tipodeparceiro.path_thumb FROM parceiros, tipodeparceiro WHERE parceiros.tipo=tipodeparceiro.cd ORDER BY tipodeparceiro.tipo";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<hr>
		<?
		$contador = 0;
		while($parceiro = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT COUNT(*) FROM parceiros WHERE tipo = " . $parceiro["tipo1"];
			$result2 = mysql_query($query);
			$resposta = mysql_fetch_row($result2);
			$qtd = $resposta[0];
			$query = "SELECT path_thumb FROM parceiros  WHERE tipo=" . $parceiro["tipo1"] . " order by rand() Limit 1";
			$result3 = mysql_query($query);
			$resposta = mysql_fetch_row($result3);
			$imagem = $resposta[0];
			?>
			<div style="vertical-align:bottom; border-top: solid 1px #E6E6E6; border-left: solid 1px #E6E6E6; border-bottom: solid 1px #666666; border-right: solid 1px #666666; height: 50px; filter: progid:DXImageTransform.Microsoft.Gradient(gradientType=1,startColorStr=#E6E6E6,endColorStr=#999999);">
				<table>
					<tr>
						<td width="65"><a href="parceiros.php?tipo=<?=$parceiro["tipo1"]?>"><img border="0" width="56" height="41" src="../<? if(strlen($parceiro["path"]) != 0) echo($parceiro["path"]); else echo($imagem); ?>"></a></td>
						<td width="300"><a class="menuparceiros" href="parceiros.php?tipo=<?=$parceiro["tipo1"]?>"><?=$parceiro["tipo2"]?>&nbsp;(<?=$qtd?>)</a></td>
						<td><a href="form_tipodeparceiro.php?cd=<?=$parceiro["cd"]?>&modo=update" target="_blank"><font face="wingdings" size="+2"><</font></a></td>
					</tr>
				</table>
			</div>
			<?
		}
	require("../includes/desconectar_mysql.php");
}
?>
