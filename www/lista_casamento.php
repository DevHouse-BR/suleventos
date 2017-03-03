<?php
error_reporting  (E_ERROR | E_PARSE);
$cd_evento = $_GET["cd"];

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
							<?
							constroi_lista_casamento($cd_evento);
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
function constroi_lista_casamento($codigo){
	require("includes/conectar_mysql.php");
	
	$query = "SELECT * FROM novos_casamentos WHERE cd=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$casamento = mysql_fetch_assoc($result);
	?>
	<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Informações do Casamento:</div><br>
	<li>Noivos:&nbsp;<?=$casamento["noivos"]?></li>
	<li>Data:&nbsp;<?=$casamento["data"]?></li>
	<li>Igreja:&nbsp;<?=$casamento["igreja"]?></li>
	<li>Recepção:&nbsp;<?=$casamento["recepcao"]?></li><br><br>
	<hr>
	<?
	$query = "SELECT cd, item, reservado FROM novos_casamentos_itens WHERE cd_casamento=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<table width="100%"><tr><td class="conteudo">Não Há Itens Cadastrados.</td><td></td></tr></table>');
	else{
		echo('<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Lista de Presentes:</div><br><table width="100%"><tr bgcolor="#001238"><td class="menu">Item</td><td class="menu">Reservado Para</td></tr>');
		$cont = 0;
		while($item = mysql_fetch_assoc($result)){
			if($cont == 1){
			?>
				<tr>
					<td bgcolor="#66CCFF" class="menurodape" style="font-weight: normal;"><?=$item["item"]?></td>
					<td bgcolor="#66CCFF" class="menurodape" style="font-weight: normal;"><?=$item["reservado"]?></td>
					<td class="menurodape"><? if(strlen($item["reservado"]) == 0) echo('<a class="menurodape" style="font-weight: normal;" href="javascript: void window.open(\'reserva_item_casamento.php?cd_casamento=' . $codigo . '&cd=' . $item["cd"] . '\', \'CONFIG\', \'width=300,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes\');">[Reservar]</a>'); ?></td> 
				</tr>
			<?
			$cont = 0;
			}
			else{
			?>
				<tr>
					<td  bgcolor="#CCCCCC" class="menurodape" style="font-weight: normal;"><?=$item["item"]?></td>
					<td  bgcolor="#CCCCCC" class="menurodape" style="font-weight: normal;"><?=$item["reservado"]?></td>
					<td class="menurodape"><? if(strlen($item["reservado"]) == 0) echo('<a class="menurodape" style="font-weight: normal;" href="javascript: void window.open(\'reserva_item_casamento.php?cd_casamento=' . $codigo . '&cd=' . $item["cd"] . '\', \'CONFIG\', \'width=300,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes\');">[Reservar]</a>'); ?></td> 
				</tr>
			<?
			$cont = 1;
			}
		}
		echo('</table>');
	}
}
?>