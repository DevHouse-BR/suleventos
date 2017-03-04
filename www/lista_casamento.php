<?php
error_reporting  (E_ERROR | E_PARSE);
$cd_evento = $_GET["cd"];

include("includes/funcoes.php");


?>
<html>
	<head>
		<title>:: Sul Eventos :: O Portal de Eventos de Joinville Santa Catarina</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="content-language" content="pt-BR" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="robots" content="index,follow" />
		<meta name="keywords" content="eventos,Joinville,Santa Catarina,noivas,noiva,evento,bodas,carros antigos,casamento,aniversário,15 anos,bodas,lua de mel,nupcias,matrimonio,festa,noivado" /> 
		<meta name="author" content="Leonardo leonardo@udesc.br" /> 
		<meta name="description" content="Página de Eventos de Joinville Santa Catarina" /> 
		<link href="includes/estilo.css" rel="stylesheet" rev="stylesheet">
	</head>
	<body>
		<table width="100%" height="100%" border="0">
			<tr>
				<td align="center" valign="top">
					<table width="776" border="0" cellpadding="0" cellspacing="6">
						<tr>
							<td colspan="3" height="139">
								<img src="imagens/logo.gif" width="330" height="130">
								<?php constroi_menu_cabecalho(); ?>
							</td>
						</tr>
						<tr>
							<td width="157" align="left" valign="top" height="100%">
								<?php constroi_tabela_esq(-1); ?>
							</td>
							<td align="left" valign="top" bgcolor="#F0F0F0" class="conteudo2" width="440">
							<? constroi_form_busca(); ?>
							<?
							constroi_lista_casamento($cd_evento);
							?>
							</td>
							<td width="167" align="right" valign="top">
								<table width="167" cellpadding="0" cellspacing="0">
									<tr>
										<td><img src="imagens/bc.gif"></td>
									</tr>
									<tr>
										<td bgcolor="#FF9900" align="center">
										<div style="text-align: center; background-color: #FF9900; height: 150px; width: 160px;">
											<? constroi_parceiro_em_destaque(); ?>
										</div>
										<hr>
									  <font style="font-size:2px;"><br></font>
									  <? constroi_destaque_cadastro_casamento(); ?>
									   <font style="font-size:2px;"><br></font>
									   <hr>
										<? constroi_outros_eventos(); ?>
										</td>
									</tr>
									<tr>
										<td><img src="imagens/bf.gif"></td>
									</tr>
								</table>
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