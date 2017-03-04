<?php
error_reporting  (E_ERROR | E_PARSE);

session_start();
if (!isset($_SESSION['count'])) {
	$_SESSION['count'] = 0;
	$qtd = trim(retorna_config("contador"));
	$temp = $qtd + 1;
	altera_valor("contador", $temp);
}

$pagina_inicial = "index.php";
$eventos = "eventos.php";
$quem_somos = "quem_somos.php";
$parceiros = "parceiros.php";
$fale_conosco = "fale_conosco.php";
$dicas = "dicas.php";
$cartorios = "cartorios.php";
$igrejas = "igrejas.php";
$anunciantes = "anunciantes.php";
$agenda = "agenda.php";
$cartao_fidelidade = "cartao_fidelidade.php";

/*
$pedacos = explode("/", $_SERVER['PATH_INFO']);
$localizacao = "";
for($i = 0; $i < count($pedacos)-1; $i++){
	$localizacao .= $pedacos[$i] . "/";
}

$LOCAL = "http://" . $_SERVER['HTTP_HOST'] . $localizacao;*/

#################################################################################################################

function constroi_inicio_pagina(){
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
		<body onLoad="efeito_versiculo();">
			<table width="100%" height="100%" border="0" bgcolor="#98B4EE">
				<tr>
					<td align="center" valign="top">
						<table width="776" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="border:outset thin;">
							<tr>
								<td colspan="3" height="131" background="imagens/cabec.jpg" valign="top">
									<? constroi_menu_cabecalho(); ?>
								</td>
							</tr>
							<tr>
								<td colspan="3" height="131" background="imagens/cabec2.jpg">&nbsp;</td>
							</td>
							<tr>
								<td width="157" align="left" valign="top" height="100%" bgcolor="#E8EEFC"><br>
									<? constroi_tabela_esq(-1); ?>
								</td>
								<td align="left" valign="top" bgcolor="#E8EEFC" class="conteudo2" width="440">
	<?
	 constroi_form_busca();
}

function constroi_fim_pagina(){
?>
</td>
							<td width="170" align="right" valign="top">
								<table width="167" cellpadding="0" cellspacing="0">
									<tr>
										<td bgcolor="#FFFFFF" align="center">
										<div style="text-align: center; background-color: #FFFFFF; height: 272px; width: 160px;">
											<? banners_direita(); ?>
										</div>
										<hr>
									  <font style="font-size:2px;"><br></font>
									  <? constroi_destaque_cadastro_casamento(); ?>
									   <font style="font-size:2px;"><br></font>
									   <hr>
										<? constroi_outros_eventos(); ?>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="3" height="40" valign="bottom" background="imagens/rodape.jpg">&nbsp;</td>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
<?
}

################################################################################################################

function constroi_menu_cabecalho(){
	//global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas, $cartorios, $igrejas, $anunciantes; ?>
	<table width="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td width="367">&nbsp;</td>
			<td width="130">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="130" height="80" id="cartao_fidelidade" align="middle">
<param name="allowScriptAccess" value="sameDomain" />
<param name="movie" value="imagens/cartao_fidelidade.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />
<embed src="imagens/cartao_fidelidade.swf" quality="high" bgcolor="#ffffff" width="130" height="80" name="cartao_fidelidade" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
			
			</td>
			<td>&nbsp;</td>
			<td width="279" id="versiculo" style="text-align: center; font-family:Arial, Helvetica, sans-serif; font-size: <?=retorna_config("tamanho_fonte_versiculo")?>px;"></td>
		</tr>
	</table>
	<script language="javascript">
		function efeito_versiculo(){
			//parceirojava.innerHTML = '<img src="' + imagens[i] + '">';Blur(Add = 1, Direction = 225, Strength = 10)">"
			//document.all["versiculo"].style.filter='progid:DXImageTransform.Microsoft.Pixelate(MaxSquare="25")';
			document.all["versiculo"].style.filter='progid:DXImageTransform.Microsoft.RandomDissolve()';
			//document.all["versiculo"].filters[0].apply();
			//document.all["versiculo"].filters[0].play();
			//document.all["versiculo"].bgColor = "#FFFFFF";
			document.all["versiculo"].innerHTML = '<b><?=retorna_config("versiculo")?></b>';

			//alert("lixo");
			/*document.all["parceirojava"].src = imagens[i];
			document.all["nm_parceiro"].innerHTML = '<a class="menurodape" href="http://www.suleventos.com.br/ver_pagina_parceiro.php?cd=' + codigo[i] + '">' + parceiros[i] + '</a>';
			i++;
			if (imagens.length == i) i = 0;*/
		}
	</script>
	<!--<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="200" height="130">
		<param name="movie" value="imagens/1.swf">
		<param name="quality" value="high">
		<embed src="imagens/1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="200" height="130"></embed>
	</object>-->
	<? /*<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="right" valign="top">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td background="imagens/esquerdo_slogan.gif" width="6" height="93"></td>
						<td background="imagens/centro_slogan.gif">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="imagens/slogan.gif"></td>
						<td background="imagens/direito_slogan.gif" width="7"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="right" valign="bottom">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td background="imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="imagens/centro_menu.gif" align="center" valign="middle"><font class="menu"><a class="menu" href="<?=$pagina_inicial?>">Pagina Inicial</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$eventos?>">Eventos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$quem_somos?>">Quem Somos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$parceiros?>">Parceiros</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$anunciantes?>">Anunciantes</a><br><a class="menu" href="<?=$fale_conosco?>">Fale Conosco</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$dicas?>">Dicas e Curiosidades</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$cartorios?>">Cartórios</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$igrejas?>">Igrejas</a></font></td>
						<td background="imagens/direito_menu.gif" width="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>*/
}

#################################################################################################################

function constroi_tabela_esq($codigo){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas;
	$qtd = retorna_config("tam_enquete");
	?>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td valign="top">
				<? constroi_menu_esq(); ?>
			</td>
		</tr>
		<tr>
			<td style="font-size: 5px;">&nbsp;</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E8EEFC">
				<table width="157" cellpadding="0" cellspacing="2" border="0" class="conteudo">
					<tr>
						<td class="menuesquerdo" align="center"><b>Procure Eventos por Data</b>
							<iframe frameborder="0" src="calendario.php" width="152" height="180" scrolling="no"></iframe>
						</td>
					</tr>
					<tr>
						<td>
							<hr size="1">
						</td>
					</tr>
					<tr>
						<td class="menuesquerdo" align="center"><b>Enquete</b>
							<iframe frameborder="0" src="enquete.php" width="152" height="<?=$qtd?>" scrolling="no"></iframe>
						</td>
					</tr>
					<tr>
						<td>
							<hr size="1">
							<? monta_contador(); ?><br><br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td bgcolor="#E8EEFC" height="100%">&nbsp;</td>
		</tr>
	</table>
<?
}

#################################################################################################################

function monta_contador(){
	$qtd = trim(retorna_config("contador"));
	$contador = "";
	for($i = 0; $i < strlen($qtd); $i++) {
    	switch($qtd{$i}){
			case "0":
				$contador .= '<img width="17" height="20" src="imagens/0.gif">';
				break;
			case "1":
				$contador .= '<img width="17" height="20" src="imagens/1.gif">';
				break;
			case "2":
				$contador .= '<img width="17" height="20" src="imagens/2.gif">';
				break;
			case "3":
				$contador .= '<img width="17" height="20" src="imagens/3.gif">';
				break;
			case "4":
				$contador .= '<img width="17" height="20" src="imagens/4.gif">';
				break;
			case "5":
				$contador .= '<img width="17" height="20" src="imagens/5.gif">';
				break;
			case "6":
				$contador .= '<img width="17" height="20" src="imagens/6.gif">';
				break;
			case "7":
				$contador .= '<img width="17" height="20" src="imagens/7.gif">';
				break;
			case "8":
				$contador .= '<img width="17" height="20" src="imagens/8.gif">';
				break;
			case "9":
				$contador .= '<img width="17" height="20" src="imagens/9.gif">';
				break;
		}
	}
	echo('<div class="menuesquerdo" style="width: 100%; padding-left: 20px;">Visitante n&deg;<table cellpadding="0"><tr><td style="border-top: 5px solid #0000AA; border-left: 5px solid #0000AA; border-bottom: 5px solid #5C73AC; border-right: 5px solid #5C73AC;">' . $contador . '</td></tr></table></div>');
}


#################################################################################################################

function constroi_form_busca(){ ?>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#E8EEFC">
			<form method="post" name="busca" action="eventos.php?busca=chave">
				<div class="menuesquerdo" style="vertical-align:middle; width: 100%; text-align:center;">Busca:&nbsp;<input type="text" name="chave">&nbsp;
					<select name="tipo">
						<option value="pessoas">Eventos por Pessoas</option>
					</select>&nbsp;
					<img src="imagens/busca.gif" onClick="document.forms['busca'].submit();" style="cursor: pointer;">
				</div>
			</form>
		</td>
	</tr>
</table>
	 <?
}

#################################################################################################################

function constroi_tabela_igrejas(){
	global $pagina_inicial, $parceiros;
	require("includes/conectar_mysql.php");
	$query = "SELECT * FROM igrejas ORDER BY nome";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<div width="100%" class="conteudo">Não há igrejas cadastradas</div>');
	?>
	<table width="100%" class="conteudo"> <?
	while($igreja = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
			<tr>
				<td align="left" valign="bottom"><a name="<?=$igreja["cd"]?>" class="menuesquerdo"><?=$igreja["nome"]?></a></td>
			</tr>
			<tr>
				<td colspan="2"><?=$igreja["descricao"]?></td>
			</tr>
			<tr>
				<td colspan="2"><font size="-2"><? if(strlen($igreja["telefone"]) != 0) echo($igreja["telefone"]); if(strlen($igreja["endereco"]) != 0) echo("<br>" . $igreja["endereco"]); if(strlen($igreja["email"]) != 0) echo('<br><a class="linkred" href="mailto: ' . $igreja["email"] . '">' . $igreja["email"] . '</a>'); ?></font></td>
			</tr>
			<tr>
				<td colspan="2" align="right">&nbsp;</td>
			</tr>
		<?
	}
	?> </table> <?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_rodape(){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas, $cartorios, $igrejas, $anunciantes; ?>
	<table width="100%" height="40" bgcolor="#E6E6E6" border="0">
		<tr>
			
		</tr>
		<tr>
			<td align="center" valign="middle"><font class="menurodape"><!--<a class="menurodape" href="<?=$pagina_inicial?>">Pagina Inicial</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$eventos?>">Eventos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$quem_somos?>">Quem Somos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$parceiros?>">Profissionais</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$anunciantes?>">Serviços Especiais</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$fale_conosco?>">Fale Conosco</a><br><a class="menurodape" href="<?=$dicas?>">Dicas e Curiosidades</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$cartorios?>">Cartórios</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$igrejas?>">Igrejas</a>
				<br><br>-->
				<font style="font-size:9px; font-weight:normal">Copyright&copy; Sul Eventos Ltda. - Todos os direitos reservados</font></font><br>
				<a class="menurodape" style="font-size:9px; font-weight:normal" href="mailto: leonardo.vasconcellos@gmail.com">Webmaster: Leonardo Vasconcellos</a>
			</td>
		</tr>
	</table>
<?
}

#################################################################################################################

function constroi_destaque_eventos($numerodedestaques, $colunas){
	$contador_de_colunas = 0;

	$query = "SELECT * FROM eventos WHERE (DATA < " . mktime() . ") AND (status = 0) ORDER BY data DESC LIMIT " . $numerodedestaques;
	require("includes/conectar_mysql.php");
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0){
		?>
		<table width="100%" cellspacing="5">
			<tr>
				<td align="center" valign="middle">Não há nenhum evento cadastrado.</td>
			</tr>
		</table>
		<?
	}
	else{
		?><table width="100%" cellspacing="5" border="0"><tr><?
		while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT path_thumb FROM fotos WHERE cd=" . $evento["imagem_destaque"];
			$result2 = mysql_query($query);
			$imagem = mysql_fetch_row($result2);
			?>
			<td width="33%" align="center" valign="top">
				<table width="100%" border="0" height="240" style="border: solid 1px #808080;" bgcolor="#FFFFFF">
					<tr>
						<td height="93" align="center" valign="top"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" src="<?=$imagem[0]?>"></a></td>
					</tr>
					<tr>
						<td class="celula" valign="top">
							<?
							if(strlen($evento["pginicial"] == 0)) echo(substr($evento["descricao"], 0, 150) . "...");
							else echo(substr($evento["pginicial"], 0, 150) . "...");
							?>
						</td>
					</tr>
					<tr>
						<td align="center" valign="bottom"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" align="bottom" src="imagens/mais.gif"></a></td>
					</tr>
				</table>
			</td>
			<?
			$contador_de_colunas++;
			if($contador_de_colunas >= $colunas){
				echo("</tr><tr>");
				$contador_de_colunas = 0;
			}
		}
		?></tr></table><?
	}
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_destaque_agenda($numerodedestaques, $colunas){
	$contador_de_colunas = 0;

	$query = "SELECT * FROM eventos WHERE (data > " . mktime() . ") AND (status = 1) ORDER BY data ASC LIMIT " . $numerodedestaques;
	require("includes/conectar_mysql.php");
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0){
		?>
		<table width="100%" cellspacing="5">
			<tr>
				<td align="center" valign="middle">Não há nenhum evento cadastrado.</td>
			</tr>
		</table>
		<?
	}
	else{
		?><table width="100%" cellspacing="5" border="0"><tr><?
		while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT path_thumb FROM fotos WHERE cd=" . $evento["imagem_destaque"];
			$result2 = mysql_query($query);
			$imagem = mysql_fetch_row($result2);
			?>
			<td width="33%" align="center" valign="top" <?=$style?>>
				<table width="100%" border="0" height="240" style="border: solid 1px #808080;" bgcolor="#FFFFFF">
					<tr>
						<td height="93" align="center" valign="top"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" src="<?=$imagem[0]?>"></a></td>
					</tr>
					<tr>
						<td class="celula" valign="top">
							<span style="font-weight: bold; color: #000000;"><?=date("d/m/Y", $evento["data"])?></span><br>
							<?
							if(strlen($evento["pginicial"] == 0)) echo(substr($evento["descricao"], 0, 150) . "...");
							else echo(substr($evento["pginicial"], 0, 150) . "...");
							?>
						</td>
					</tr>
					<tr>
						<td align="center" valign="bottom"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" align="bottom" src="imagens/mais.gif"></a></td>
					</tr>
				</table>
			</td>
			<?
			$contador_de_colunas++;
			if($contador_de_colunas >= $colunas){
				echo("</tr><tr>");
				$contador_de_colunas = 0;
			}
		}
		?></tr></table><?
	}
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_fotos_evento($codigo_evento, $colunas){
	global $pagina_inicial, $eventos, $agenda;
	$contador_de_colunas = 0;

	require("includes/conectar_mysql.php");
	$query = "SELECT * FROM eventos, tipodeevento WHERE eventos.tipo=tipodeevento.cd AND eventos.cd=" . $codigo_evento;
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
	?>
	<hr color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Clique na foto para ampliar</div><br>
	<table width="100%" cellspacing="5" cellpadding="0" border="0"><tr>
	<?
	$query = "SELECT cd, path, path_thumb FROM fotos WHERE cd_evento=" . $codigo_evento . " ORDER BY cd";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<td align="center" valign="top">
		<?
			if($evento["data"] > mktime(0,0,0,5,18,2004)){  ?>
				<img style="cursor:pointer;" onClick="javascript: void window.open('ver_fotos.php?foto=<?=$foto["cd"]?>&evento=<?=$codigo_evento?>', 'Fotografia', 'width=500,height=420,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="<?=$foto["path_thumb"]?>">
			<? }
			else { ?>
				<img style="cursor:pointer;" onClick="javascript: void window.open('<?=$foto["path"]?>', 'Fotografia', 'width=512,height=384,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="<?=$foto["path_thumb"]?>">
			<? } ?>
		</td>
		<?
		$contador_de_colunas++;
		if($contador_de_colunas >= $colunas){
			echo("</tr><tr>");
			$contador_de_colunas = 0;
		}
	}
	?></tr></table>
	<?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_menu_esq_old(){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas, $cartorios;
	?>
	<table width="157" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td background="imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$pagina_inicial?>">Pagina Inicial</a></td>
						<td background="imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$eventos?>">Eventos</a></td>
						<td background="imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$quem_somos?>">Quem Somos</a></td>
						<td background="imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$parceiros?>">Parceiros</a></td>
						<td background="imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$fale_conosco?>">Fale Conosco</a></td>
						<td background="imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$dicas?>">Dicas e Curiosidades</a></td>
						<td background="imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$cartorios?>">Cartórios</a></td>
						<td background="imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?
}

#################################################################################################################

function constroi_menu_esq(){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas, $cartorios, $igrejas, $anunciantes, $agenda, $cartao_fidelidade;
	?>
	<script language="javascript" type="text/javascript">
		var saiu = 0;
		var intervalo;
		var count = 0;
		var intervalofade;

		function start(){
			count = 0;
			saiu = 0;
			intervalo = setInterval(checamouse, 500);
		}
		function checamouse(){
			if (saiu != 0){
				escondemenu();
				clearInterval(intervalo);
				saiu = 0;
				count = 0;
			}
		}
		function escondemenu(){
			document.all["menu_1"].innerHTML = "";
			document.all["menu_1"].style.visibility = "hidden";
			document.all["menu_2"].innerHTML = "";
			document.all["menu_2"].style.visibility = "hidden";
			document.all["menu_3"].innerHTML = "";
			document.all["menu_3"].style.visibility = "hidden";
			document.all["menu_4"].innerHTML = "";
			document.all["menu_4"].style.visibility = "hidden";
			document.all["menu_5"].innerHTML = "";
			document.all["menu_5"].style.visibility = "hidden";
			<?
			$counter = 6;
			require("includes/conectar_mysql.php");
			$result = mysql_query("SELECT cd FROM nomedesecao");
			while($secao = mysql_fetch_assoc($result)){
				?>
				document.all["menu_<?=$counter?>"].innerHTML = "";
				document.all["menu_<?=$counter?>"].style.visibility = "hidden";
				<?
				$counter++;
			}
			?>
		}
		function mostramenu1(){
			escondemenu();
			var html = 	'<table border="0" width="380" bgcolor="#E5E5E5">'
			<?
			require("includes/conectar_mysql.php");
			$result = mysql_query("SELECT DISTINCT parceiros.tipo as tipo1, tipodeparceiro.tipo as tipo2 FROM parceiros, tipodeparceiro WHERE parceiros.tipo=tipodeparceiro.cd ORDER BY tipodeparceiro.tipo");
			$i = 0;
			while($tipos = mysql_fetch_assoc($result)){
				if($i == 0)	echo("+ '<tr>'");
				echo("+ '<td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"parceiros.php?tipo=" . $tipos["tipo1"] . "\">" . $tipos["tipo2"] . "</a></li></td>'" . chr(10));
				if($i == 1){
					echo("+ '</tr>'" . chr(10));
					$i = 0;
				}
				else $i = 1;
			}
			require("includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_1"].innerHTML = html;
			document.all["menu_1"].style.position = "absolute";
			document.all["menu_1"].style.zIndex = "99999";
			document.all["menu_1"].style.visibility = "visible";
			document.all["menu_1"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		function mostramenu2(){
			escondemenu();
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("includes/conectar_mysql.php");
			$result = mysql_query("SELECT cd, dica FROM dicas ORDER BY dica");
			while($dica = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"dicas.php#" . $dica["cd"] . "\">" . ucwords(strtolower($dica["dica"])) . "</a></li></td></tr>'" . chr(10));
			require("includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_2"].innerHTML = html;
			document.all["menu_2"].style.position = "absolute";
			document.all["menu_2"].style.zIndex = "99999";
			document.all["menu_2"].style.visibility = "visible";
			document.all["menu_2"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		function mostramenu3(){
			escondemenu();
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("includes/conectar_mysql.php");
			$result = mysql_query("SELECT DISTINCT anunciantes.tipo as tipo1, tipodeanunciante.tipo as tipo2 FROM anunciantes, tipodeanunciante WHERE anunciantes.tipo=tipodeanunciante.cd ORDER BY tipodeanunciante.tipo");
			while($tipos = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"anunciantes.php?tipo=" . $tipos["tipo1"] . "\">" . $tipos["tipo2"] . "</a></li></td></tr>'" . chr(10));
			require("includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_3"].innerHTML = html;
			document.all["menu_3"].style.position = "absolute";
			document.all["menu_3"].style.zIndex = "99999";
			document.all["menu_3"].style.visibility = "visible";
			document.all["menu_3"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		function mostramenu4(){
			escondemenu();
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("includes/conectar_mysql.php");
			$result = mysql_query("SELECT cd, nome FROM igrejas ORDER BY nome");
			while($igreja = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"igrejas.php#" . $igreja["cd"] . "\">" . ucwords(strtolower($igreja["nome"])) . "</a></li></td></tr>'" . chr(10));
			require("includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_4"].innerHTML = html;
			document.all["menu_4"].style.position = "absolute";
			document.all["menu_4"].style.zIndex = "99999";
			document.all["menu_4"].style.visibility = "visible";
			document.all["menu_4"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		function mostramenu5(){
			escondemenu();
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("includes/conectar_mysql.php");
			$result = mysql_query("SELECT cd, cartorio FROM cartorios ORDER BY cartorio");
			while($cartorio = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"cartorios.php#" . $cartorio["cd"] . "\">" . ucwords(strtolower($cartorio["cartorio"])) . "</a></li></td></tr>'" . chr(10));
			require("includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_5"].innerHTML = html;
			document.all["menu_5"].style.position = "absolute";
			document.all["menu_5"].style.zIndex = "99999";
			document.all["menu_5"].style.visibility = "visible";
			document.all["menu_5"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		<?
		$counter = 6;
		require("includes/conectar_mysql.php");
		$result = mysql_query("SELECT * FROM nomedesecao ORDER BY nome");
		while($secao = mysql_fetch_assoc($result)){
			?>
			function mostramenu<?=$counter?>(){
				escondemenu();
				var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
				<?
				require("includes/conectar_mysql.php");
				$result2 = mysql_query("SELECT cd, titulo FROM secoes WHERE nomedesecao=" . $secao["cd"] . " ORDER BY titulo");
				while($subsecao = mysql_fetch_assoc($result2)){
					if($secao["pgseparadas"] == "n") echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"secao.php?secao=" . $secao["cd"] . "#" . $subsecao["cd"] . "\">" . ucwords(strtolower($subsecao["titulo"])) . "</a></li></td></tr>'" . chr(10));
					else echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"secao.php?secao=" . $secao["cd"] . "&subsecao=" . $subsecao["cd"] . "\">" . ucwords(strtolower($subsecao["titulo"])) . "</a></li></td></tr>'" . chr(10));
				}
				require("includes/desconectar_mysql.php");
				if(mysql_num_rows($result2) != 0) echo('document.all["menu_' . $counter . '"].innerHTML = html;');
				?>
				document.all["menu_<?=$counter?>"].style.position = "absolute";
				document.all["menu_<?=$counter?>"].style.zIndex = "99999";
				document.all["menu_<?=$counter?>"].style.visibility = "visible";
				document.all["menu_<?=$counter?>"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
			}
			<?
			$counter++;
		}
		require("includes/desconectar_mysql.php");
	?>
	</script>
	<table width="159" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$pagina_inicial?>">Pagina Inicial</a></td>
						<td width="22"><img src="imagens/menu1.gif" /></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$agenda?>">Agenda</a></td>
						<td width="22"><img src="imagens/menu1.gif" /></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$eventos?>">Eventos</a></td>
						<td width="22"><img src="imagens/menu1.gif" /></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<!--<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$cartao_fidelidade?>">Cartão Fidelidade</a></td>
						<td width="22"><img src="imagens/menu1.gif" /></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>-->
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$quem_somos?>">Quem Somos</a></td>
						<td width="22"><img src="imagens/menu1.gif" /></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="mostramenu1();"><a class="menuesquerdo" href="<?=$parceiros?>">Profissionais</a></td>
						<td width="22" background="imagens/menu1.gif" /><div id="menu_1" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="mostramenu3();"><a class="menuesquerdo" href="<?=$anunciantes?>">Servi&ccedil;os Especiais</a></td>
						<td width="22" background="imagens/menu1.gif" /><div id="menu_3" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$fale_conosco?>">Fale Conosco</a></td>
						<td width="22"><img src="imagens/menu1.gif" /></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="mostramenu2();"><a class="menuesquerdo" href="<?=$dicas?>">Dicas/Curiosidades</a></td>
						<td width="22" background="imagens/menu1.gif" /><div id="menu_2" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="mostramenu5();"><a class="menuesquerdo" href="<?=$cartorios?>">Cartórios</a></td>
						<td width="22" background="imagens/menu1.gif" /><div id="menu_5" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="mostramenu4();"><a class="menuesquerdo" href="<?=$igrejas?>">Igrejas</a></td>
						<td width="22" background="imagens/menu1.gif" /><div id="menu_4" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="escondemenu();"><a class="menuesquerdo" href="sites_parceiros.php">Sites de Parceiros</a></td>
						<td width="22"><img src="imagens/menu1.gif" /></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td background="imagens/menu2.gif" width="5">&nbsp;</td>
						<td height="20" background="imagens/menu2.gif" onMouseOver="escondemenu();"><a class="menuesquerdo" href="http://www.suleventos.com.br/chat">Chat&nbsp;
							<?
							require("includes/conectar_mysql.php");
							$result = mysql_query("SELECT COUNT(*) FROM blte_online");
							$registro = mysql_fetch_row($result);
							echo("(" . $registro[0] . ")");
							require("includes/desconectar_mysql.php");
							?>
							</a></td>
						<td width="22" background="imagens/menu1.gif" /></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
				</table>
			</td>
		</tr>
		
		<?
		$counter = 6;
		require("includes/conectar_mysql.php");
		$result = mysql_query("SELECT * FROM nomedesecao ORDER BY nome");
		while($secao = mysql_fetch_assoc($result)){
			?>
			<tr>
				<td width="100%">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td background="imagens/menu2.gif" width="5">&nbsp;</td>
							<td height="20" background="imagens/menu2.gif" onMouseOver="mostramenu<?=$counter?>();"><?
								if($secao["pgseparadas"] == "n"){?>
									<a class="menuesquerdo" href="secao.php?secao=<?=$secao["cd"]?>"><?=$secao["nome"]?></a>
								<? }
								else echo('<span class="menuesquerdo">' . $secao["nome"] . '</span>');
								?></td>
							<td width="22" background="imagens/menu1.gif" /><div id="menu_<?=$counter?>" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
						</tr>
						<tr>
							<td colspan="3" height="2"></td>
						</tr>
					</table>
				</td>
			</tr>
			<?
			$counter++;
		}
		?>
	</table><?
}

#################################################################################################################

function constroi_ficha_tecnica($codigo_evento){
	require("includes/conectar_mysql.php");
	$query = "SELECT * FROM eventos WHERE cd=" . $codigo_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<center>
	<table width="100%" style="color:#000000; text-align:center;" class="menuesquerdo">
		<tr>
			<td><img align="left" src="imagens/prancheta.gif"><span style="font-size:24px; text-align: left;">Ficha Técnica</span></td>
		</tr>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Nomes</td>
		</tr>
		<tr>
			<td style="color:#ffffff;"><?=$evento["nomes"]?></td>
		</tr>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td>Data</td>
		</tr>
		<tr>
			<td style="color:#ffffff;"><?=date("d/m/Y", $evento["data"])?></td>
		</tr>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td>Local</td>
		</tr>
		<tr>
			<td style="color:#ffffff;"><?=$evento["local"]?></td>
		</tr>
	<?
	$query = "SELECT parceiros.cd, parceiros.nome, tipodeparceiro.cd as tipo2, tipodeparceiro.tipo from parceiro_evento, parceiros, tipodeparceiro where tipodeparceiro.cd=parceiros.tipo and parceiro_evento.parceiro=parceiros.cd and parceiro_evento.evento=" . $codigo_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$qtd = mysql_num_rows($result);
	$contador = 0;
	while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td><?=$evento["tipo"]?></td>
		</tr>
		<tr>
			<td><a class="fichaparceiro" href="http://www.suleventos.com.br/ver_pagina_parceiro.php?cd=<?=$evento["cd"]?>"><?=$evento["nome"]?></a></td>
		</tr>
		<?
		$contador++;
		//if($contador == $qtd) echo('<tr><td>&nbsp;</td></tr>');
	}
	$query = "SELECT tipodeparceiro.cd, tipodeparceiro.tipo from tipodeparceiro, tipodeparceiro_evento where tipodeparceiro.cd=tipodeparceiro_evento.tipodeparceiro and tipodeparceiro_evento.evento=" . $codigo_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$qtd = mysql_num_rows($result);
	$contador = 0;
	while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td><?=$evento["tipo"]?></td>
		</tr>
		<tr>
			<td><a class="fichaparceiro" href="http://www.suleventos.com.br/parceiros.php?tipo=<?=$evento["cd"]?>">Clique aqui e conheça nossas opções nesta área</a></td>
		</tr>
		<?
		$contador++;
		if($contador == $qtd) echo('<tr><td>&nbsp;</td></tr>');
	}
	?>
	</table>
	</center>
	<?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_parceiro_em_destaque(){
	$ultimo_parceiro = retorna_config("ultimoparceiro");
	require("includes/conectar_mysql.php");

	$result = mysql_query("SELECT COUNT(*) FROM parceiros") or die("Erro de conexão ao banco de dados: " . mysql_error());
	$total = mysql_fetch_row($result);

	if ($ultimo_parceiro >= $total[0] - 1) $proximo_parceiro = 0;
	else $proximo_parceiro = $ultimo_parceiro + 1;

	altera_valor("ultimoparceiro", $proximo_parceiro);

	require("includes/conectar_mysql.php");
	$query = "SELECT cd, nome, tipo, path_thumb from parceiros order by cd LIMIT " . $proximo_parceiro . ",1";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<table width="100%" bgcolor="#E6E6E6" border="0" class="menurodape" height="100"><tr><td valign="top"><img src="imagens/bullet_red.gif">Não Há Profissionais Cadastrados</td></tr></table>');
	else {
		$parceiro = mysql_fetch_array($result, MYSQL_ASSOC);
		?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" align="center">
					<table width="100%">
						<tr>
							<td align="left" valign="top"><img src="imagens/bullet_orange.gif"></td>
							<td style="font-size:11px; font-family:'Lucida Sans Unicode', Verdana, Arial; vertical-align:top; text-align: left; font-weight:bold; color:#FFFFFF;">Profissional em Destaque</td>
						</tr>
						<tr>
							<td colspan="2" align="center" valign="top"><img width="100" src="<?=$parceiro["path_thumb"]?>"></td>
						</tr>
						<tr>
							<td colspan="2" align="center"><a class="menu" href="parceiros.php?tipo=<?=$parceiro["tipo"]?>#<?=$parceiro["cd"]?>"><?=$parceiro["nome"]?></a></td>
						</tr>
						<tr>
							<td colspan="2" align="center" valign="top"><a href="parceiros.php?tipo=<?=$parceiro["tipo"]?>#<?=$parceiro["cd"]?>"><img src="imagens/mais.gif" border="0"></a></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<?
	}
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_destaque_cestas(){
	$ultimo_parceiro = retorna_config("ultimacesta");
	require("includes/conectar_mysql.php");

	$result = mysql_query("SELECT COUNT(*) FROM parceiros where tipo=31") or die("Erro de conexão ao banco de dados: " . mysql_error());
	$total = mysql_fetch_row($result);

	if ($ultimo_parceiro >= $total[0] - 1) $proximo_parceiro = 0;
	else $proximo_parceiro = $ultimo_parceiro + 1;

	altera_valor("ultimacesta", $proximo_parceiro);
	require("includes/conectar_mysql.php");
	$query = "SELECT cd, nome, tipo, path_thumb from parceiros where tipo=31 order by cd LIMIT " . $proximo_parceiro . ",1";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<table width="100%" bgcolor="#E6E6E6" border="0" class="menurodape" height="100"><tr><td valign="top"><img src="imagens/bullet_red.gif">Não Há Profissionais Cadastrados</td></tr></table>');
	else {
		$parceiro = mysql_fetch_array($result, MYSQL_ASSOC);
		?>
		<table width="100%" bgcolor="#FF9900" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td valign="top" align="center">
					<table width="100%" border="0">
						<tr>
							<td width="5%" align="left" valign="top"></td>
							<td width="95%"><a href="parceiros.php?tipo=<?=$parceiro["tipo"]?>#<?=$parceiro["cd"]?>"><marquee direction="left" class="menurodape"  truespeed><?=$parceiro["nome"]?> - Cestas de Caf&eacute; da Manh&atilde; - Clique Aqui!</marquee></a></td>
						</tr>
						<tr>
							<td colspan="2" height="105" align="center" valign="middle"><a href="parceiros.php?tipo=<?=$parceiro["tipo"]?>#<?=$parceiro["cd"]?>"><img border="0" id="img_cesta" width="100" src="<?=$parceiro["path_thumb"]?>"></a></td>
						</tr>
					</table>
					<script language="javascript">
						var cesta = document.getElementById("img_cesta");
						var tempo = window.setInterval('muda_cesta()',2000);
						function muda_cesta(){
							if(cesta.src == "<? echo("http://" . $_SERVER['HTTP_HOST']) ?>/imagens/cesta_cafe_manha.jpg") cesta.src = "<?=$parceiro["path_thumb"]?>";
							else cesta.src = "<? echo("http://" . $_SERVER['HTTP_HOST']) ?>/imagens/cesta_cafe_manha.jpg";
						}
					</script>
				</td>
			</tr>
		</table>
		<?
	}
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_destaque_cadastro_casamento(){
	?>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top" align="center">
				<table width="100%">
					<tr>
						<td colspan="2" align="center" valign="top"><img src="imagens/teste.jpg"></td>
					</tr>
					<tr>
						<td align="left" valign="top"><img src="imagens/bullet_orange.gif"></td>
						<td align="center" valign="top"><a class="menu" style="font-size:10px; font-weight:bold;" href="divulgue.php">Divulgue Seu Evento!</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?
}


#################################################################################################################

function constroi_outros_eventos(){
	$qtd = retorna_config("qtd_outros_eventos");
	if (strlen($qtd ) == 0) $qtd = "6";
	?>
	<table width="100%" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">
				<table width="100%" cellpadding="2" cellspacing="0" border="0" style="width: 100%;">
					<tr>
						<td colspan="2">
							<table width="100%" cellpadding="0" cellspacing="0">
								<td align="left" valign="top"><img src="imagens/bullet_orange.gif"></td>
								<td style="font-size:10px; font-family:'Lucida Sans Unicode', Verdana, Arial; vertical-align:top; text-align: left; font-weight:bold; color: #FFFFFF;">Outros Eventos</td>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" valign="top" style="font-size:6px;">&nbsp;</td>
					</tr>
					<?
					require("includes/conectar_mysql.php");
					$query = "SELECT eventos.cd, eventos.nomes, eventos.data, tipodeevento.tipo FROM eventos, tipodeevento WHERE eventos.tipo=tipodeevento.cd ORDER BY eventos.data DESC LIMIT " . $qtd;
					$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
					$contador = 0;
					$numero_registros = mysql_num_rows($result);
					if($numero_registros == 0) {
						echo('<tr><td colspan="2" class="textonoazul">Não Há Eventos Cadastrados</td></tr>');
					}
					while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
						?>
						<tr>
							<td align="left" valign="top" class="menu" style="font-size:10px;" width="8">*</td>
							<td class="textonoazul"><a style="font-size: 10px; font-weight: normal;" class="menu" href="ver_evento.php?cd=<?=$evento["cd"]?>"><?=$evento["tipo"]?>&nbsp;de<br><?=$evento["nomes"]?><br><?=date("d/m/Y", $evento["data"])?></a></td>
						</tr>
						<?
						$contador++;
						if ($contador < $numero_registros) echo('<tr><td colspan="2"><hr></td></tr>');
					}
	?>
				</table>
			</td>
		</tr>
	</table>
	<?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_eventos($numerodedestaques, $colunas, $pagina){
	$contador_de_colunas = 0;

	$limite = ($numerodedestaques * ($pagina -1));
	$query_limit = " LIMIT " . $limite . "," . $numerodedestaques;

	if($_GET["busca"] == "data") {
		$data = $_GET["data"];
		$filtro = "AND eventos.data=" . $data;
				$query = "SELECT eventos.cd, eventos.nomes, eventos.data, eventos.imagem_destaque, tipodeevento.tipo FROM eventos, tipodeevento WHERE (eventos.tipo=tipodeevento.cd) " . $filtro . " ORDER BY data DESC" . $query_limit;
	}
	elseif($_GET["busca"] == "chave"){
		$chave = $_REQUEST["chave"];
		$filtro = "AND eventos.nomes LIKE '%" . $chave . "%'";
		$query = "SELECT eventos.cd, eventos.nomes, eventos.data, eventos.imagem_destaque, tipodeevento.tipo FROM eventos, tipodeevento WHERE (eventos.tipo=tipodeevento.cd) " . $filtro . " ORDER BY data DESC" . $query_limit;
	}
	else $query = "SELECT eventos.cd, eventos.nomes, eventos.data, eventos.imagem_destaque, tipodeevento.tipo FROM eventos, tipodeevento WHERE (eventos.tipo=tipodeevento.cd) AND (eventos.data < " . mktime() . ") AND (eventos.status = 0) " . $filtro . " ORDER BY data DESC" . $query_limit;

	require("includes/conectar_mysql.php");
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error() . $query);
	?>
	<center><font id="fp"><strong>Eventos<br>
			<font color="#CCCCCC">-----------------------------------
			</font> </center>
	<?
	if(mysql_num_rows($result) == 0){
		?>
		<table width="100%" cellspacing="5">
			<tr>
				<td align="center" valign="middle">Não foi encontrado nenhum evento.</td>
			</tr>
		</table>
		<?
	}
	else{
		?><table width="100%" cellspacing="5"><tr><?
		if($_GET["busca"] == "data") {
			$data = $_GET["data"];
			$filtro = "WHERE data=" . $data;
		}
		elseif($_GET["busca"] == "chave"){
			$chave = $_REQUEST["chave"];
			$filtro = "WHERE nomes LIKE '%" . $chave . "%'";
		}
		$query = "SELECT COUNT(*) FROM eventos, tipodeevento WHERE (eventos.tipo=tipodeevento.cd) AND (eventos.data < " . mktime() . ") AND (eventos.status = 0) " . $filtro;
		$tmp = mysql_fetch_row(mysql_query($query));
		$eof = $tmp[0];

		while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT path_thumb FROM fotos WHERE cd=" . $evento["imagem_destaque"];
			$result2 = mysql_query($query);
			$imagem = mysql_fetch_row($result2);
			?>
			<td width="33%" align="center" valign="top">
				<table width="100%" height="200" border="0">
					<tr>
						<td class="menu" height="12" style="text-align: center; font-size:11px; color: #FF3300;">[<?=date("d/m/Y", $evento["data"])?>]</td>
					</tr>
					<tr>
						<td align="center" valign="top" height="50%"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" src="<?=$imagem[0]?>"></a></td>
					</tr>
					<tr>
						<td class="celula" valign="top"><center><?=$evento["tipo"]?>&nbsp;de&nbsp;<b><?=$evento["nomes"]?></b></center></td>
					</tr>
				</table>
			</td>
			<?
			$contador_de_colunas++;
			if($contador_de_colunas >= $colunas){
				echo("</tr><tr>");
				$contador_de_colunas = 0;
			}
		}
		?></tr>
		<tr>
			<td align="left">
				<?
				if($_GET["busca"] == "data") $busca = "&busca=data&data=" . $data;
				if($_GET["busca"] == "chave") $busca = "&busca=chave&chave=" . $_REQUEST["chave"];
				else $busca="";
				if($pagina != 1) echo('<a href="eventos.php?pagina=' . ($pagina-1) . $busca . '"><img border="0" src="imagens/voltar.gif"></a>'); ?>
			</td>
			<td></td>
			<td align="right">
				<? if($limite + $numerodedestaques < $eof) echo('<a href="eventos.php?pagina=' . ($pagina+1) . $busca . '"><img border="0" src="imagens/avancar.gif"></a>'); ?>
			</td>
		</tr>
		</table><?
	}
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_agenda($numerodedestaques, $colunas, $pagina){
	$contador_de_colunas = 0;

	$limite = ($numerodedestaques * ($pagina -1));
	$query_limit = " LIMIT " . $limite . "," . $numerodedestaques;

	if($_GET["busca"] == "data") {
		$data = $_GET["data"];
		$filtro = "AND eventos.data=" . $data;
	}
	elseif($_GET["busca"] == "chave"){
		$chave = $_REQUEST["chave"];
		$filtro = "AND eventos.nomes LIKE '%" . $chave . "%'";
	}

	$query = "SELECT eventos.cd, eventos.nomes, eventos.data, eventos.imagem_destaque, tipodeevento.tipo FROM eventos, tipodeevento WHERE (eventos.tipo=tipodeevento.cd) AND (eventos.data > " . mktime() . ") AND (eventos.status = 1)" . $filtro . " ORDER BY data ASC" . $query_limit;
	require("includes/conectar_mysql.php");
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<center><font id="fp"><strong>Agenda<br>
			<font color="#CCCCCC">-----------------------------------
			</font> </center>
	<?
	if(mysql_num_rows($result) == 0){
		?>
		<table width="100%" cellspacing="5">
			<tr>
				<td align="center" valign="middle">Não foi encontrado nenhum evento.</td>
			</tr>
		</table>
		<?
	}
	else{
		?><table width="100%" cellspacing="0"><tr><?
		if($_GET["busca"] == "data") {
			$data = $_GET["data"];
			$filtro = "WHERE data=" . $data;
		}
		elseif($_GET["busca"] == "chave"){
			$chave = $_REQUEST["chave"];
			$filtro = "WHERE nomes LIKE '%" . $chave . "%'";
		}
		$query = "SELECT COUNT(*) FROM eventos, tipodeevento WHERE (eventos.tipo=tipodeevento.cd) AND (eventos.data > " . mktime() . ") AND (eventos.status = 1)" . $filtro;
		$tmp = mysql_fetch_row(mysql_query($query));
		$eof = $tmp[0];

		while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT path_thumb FROM fotos WHERE cd=" . $evento["imagem_destaque"];
			$result2 = mysql_query($query);
			$imagem = mysql_fetch_row($result2);
			?>
			<td width="33%" align="center" valign="top">
				<table width="100%" height="200" border="0">
					<tr>
						<td class="menu" height="12" style="text-align: center; font-size:11px; color: #FF3300;">[<?=date("d/m/Y", $evento["data"])?>]</td>
					</tr>
					<tr>
						<td align="center" valign="top" height="50%"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" src="<?=$imagem[0]?>"></a></td>
					</tr>
					<tr>
						<td class="celula" valign="top"><center><?=$evento["tipo"]?>&nbsp;de&nbsp;<b><?=$evento["nomes"]?></b><br></center></td>
					</tr>
				</table>
			</td>
			<?
			$contador_de_colunas++;
			if($contador_de_colunas >= $colunas){
				echo("</tr><tr>");
				$contador_de_colunas = 0;
			}
		}
		?></tr>
		<tr>
			<td align="left">
				<?
				if($_GET["busca"] == "data") $busca = "&busca=data&data=" . $data;
				if($_GET["busca"] == "chave") $busca = "&busca=chave&chave=" . $_REQUEST["chave"];
				else $busca="";
				if($pagina != 1) echo('<a href="agenda.php?pagina=' . ($pagina-1) . $busca . '"><img border="0" src="imagens/voltar.gif"></a>'); ?>
			</td>
			<td></td>
			<td align="right">
				<? if($limite + $numerodedestaques < $eof) echo('<a href="agenda.php?pagina=' . ($pagina+1) . $busca . '"><img border="0" src="imagens/avancar.gif"></a>'); ?>
			</td>
		</tr>
		</table><?
	}
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_parceiros($tipo){
	global $pagina_inicial, $parceiros;
	require("includes/conectar_mysql.php");
	$query = "SELECT tipo FROM tipodeparceiro WHERE cd=" . $tipo;
	$result = mysql_query($query);
	$tipodeparceiro = mysql_fetch_row($result);
	$query = "SELECT parceiros.cd, parceiros.path, parceiros.path_thumb, parceiros.largura, parceiros.altura, parceiros.nome, parceiros.descricao, parceiros.site, parceiros.email, parceiros.telefone, parceiros.endereco, tipodeparceiro.tipo FROM parceiros, tipodeparceiro WHERE parceiros.tipo=tipodeparceiro.cd AND parceiros.tipo=" . $tipo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<div width="100%" class="conteudo">Não há Profissionais cadastrados.</div>');
	?>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$parceiros?>">[PROFISSIONAIS]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape">[<?=$tipodeparceiro[0]?>]</a>
	<hr>
	<table width="100%"> <?
	while($parceiro = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
			<tr>
				<td width="10%"><a name="<?=$parceiro["cd"]?>"><img border="0" src="<?=$parceiro["path_thumb"]?>" onClick="javascript: void window.open('ver_imagem.php?imagem=<?=urlencode($parceiro["path"])?>', 'Fotografia', 'width=<?=$parceiro["largura"]?>,height=<?=$parceiro["altura"]?>,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" style="cursor: pointer;"></a></td>
				<td align="left" valign="bottom">
					<?
					if(strlen($parceiro["site"]) != 0) echo('<a class="menurodape" href="javascript: void window.open(\'http://' . $parceiro["site"] . '\')">' . $parceiro["nome"] . '</a>');
					else echo('<a class="menurodape">' . $parceiro["nome"] . '</a>');
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2"><?=$parceiro["descricao"]?></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><font size="-2"><? if(strlen($parceiro["telefone"]) != 0) echo($parceiro["telefone"]); if(strlen($parceiro["email"]) != 0) echo("&nbsp;-&nbsp;<a href=\"mailto: " . $parceiro["email"] . "\">" . $parceiro["email"] . "</a>"); if(strlen($parceiro["endereco"]) != 0) echo("&nbsp;-&nbsp;" . $parceiro["endereco"]); ?></font></td>
			</tr>
			<?
			if(verifica_pagina_parceiro($parceiro["cd"])) echo('<tr><td colspan="2" align="right" valign="bottom"><a href="ver_pagina_parceiro.php?cd=' . $parceiro["cd"] . '" class="menurodape">Veja&nbsp;+&nbsp;<img border="0" src="imagens/bullet_green.gif" align="bottom"></a></td></tr>');
			?>
			<tr>
				<td colspan="2" align="right">&nbsp;</td>
			</tr>
		<?
	}
	?> </table> <?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_anunciantes($tipo){
	global $pagina_inicial, $anunciantes;
	require("includes/conectar_mysql.php");
	$query = "SELECT tipo FROM tipodeanunciante WHERE cd=" . $tipo;
	$result = mysql_query($query);
	$tipodeanunciante = mysql_fetch_row($result);
	$query = "SELECT anunciantes.cd, anunciantes.path, anunciantes.path_thumb, anunciantes.largura, anunciantes.altura, anunciantes.nome, anunciantes.descricao, anunciantes.site, anunciantes.email, anunciantes.telefone, anunciantes.endereco, tipodeanunciante.tipo FROM anunciantes, tipodeanunciante WHERE anunciantes.tipo=tipodeanunciante.cd AND anunciantes.tipo=" . $tipo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<div width="100%" class="conteudo">Não há serviços cadastrados.</div>');
	?>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$anunciantes?>">[SERVI&Ccedil;OS ESPECIAIS]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape">[<?=$tipodeanunciante[0]?>]</a>
	<hr>
	<table width="100%" class="conteudo"> <?
	while($anunciante = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
			<tr>
				<td width="10%"><a name="<?=$anunciante["cd"]?>"><img border="0" src="<?=$anunciante["path_thumb"]?>" onClick="javascript: void window.open('ver_imagem.php?imagem=<?=urlencode($anunciante["path"])?>', 'Fotografia', 'width=<?=$anunciante["largura"]?>,height=<?=$anunciante["altura"]?>,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" style="cursor: pointer;"></a></td>
				<td align="left" valign="bottom">
					<?
					if(strlen($anunciante["site"]) != 0) echo('<a class="menurodape" href="javascript: void window.open(\'http://' . $anunciante["site"] . '\')">' . $anunciante["nome"] . '</a>');
					else echo('<a class="menurodape">' . $anunciante["nome"] . '</a>');
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2"><?=$anunciante["descricao"]?></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><font size="-2"><? if(strlen($anunciante["telefone"]) != 0) echo($anunciante["telefone"]); if(strlen($anunciante["email"]) != 0) echo("&nbsp;-&nbsp;<a href=\"mailto: " . $anunciante["email"] . "\">" . $anunciante["email"] . "</a>"); if(strlen($anunciante["endereco"]) != 0) echo("&nbsp;-&nbsp;" . $anunciante["endereco"]); ?></font></td>
			</tr>
			<?
			if(verifica_pagina_anunciante($anunciante["cd"])) echo('<tr><td colspan="2" align="right" valign="bottom"><a href="ver_pagina_anunciante.php?cd=' . $anunciante["cd"] . '" class="menurodape">Veja&nbsp;+&nbsp;<img border="0" src="imagens/bullet_green.gif" align="bottom"></a></td></tr>');
			?>
			<tr>
				<td colspan="2" align="right">&nbsp;</td>
			</tr>
		<?
	}
	?> </table> <?
	require("includes/desconectar_mysql.php");
}


#################################################################################################################

function constroi_tabela_dicas(){
	require("includes/conectar_mysql.php");
	$query = "SELECT * FROM dicas";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<div width="100%" class="conteudo">Não há dicas cadastradas</div>');
	?> <table width="100%" class="conteudo"> <?
	while($dica = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<tr>
			<td><b><a name="<?=$dica["cd"]?>"><?=strtoupper($dica["dica"])?></a></b></td>
		</tr>
		<tr>
			<td><?=$dica["descricao"]?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<?
	}
	?> </table> <?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_dicas_destaque(){
	require("includes/conectar_mysql.php");
	$query = "SELECT * FROM dicas ORDER BY RAND() LIMIT 2,1";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<div width="100%" class="conteudo">Não há dicas cadastradas</div>');
	else {
		$dica = mysql_fetch_array($result, MYSQL_ASSOC);
		?>
		<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Dicas</div><br>
		<p><b><?=strtoupper($dica["dica"])?></b></p>
		<p><?=$dica["descricao"]?></p>
		<p align="right"><a href="dicas.php"><img border="0" src="imagens/veja.gif"></a></p>
		<?
	}
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_faleconosco(){
	?>
	<div class="titulosecao">&nbsp;Fale Conosco</div><br>
	<table width="100%" class="conteudo">
		<form action="fale_conosco.php?modo=enviar" method="post">
		<tr>
			<td align="right" valign="top" width="20%">Nome</td>
			<td><input style="width:100%" type="text" name="nome"></td>
		</tr>
		<tr>
			<td align="right" valign="top">Telefone</td>
			<td><input style="width:100%" type="text" name="telefone"></td>
		</tr>
		<tr>
			<td align="right" valign="top">Email</td>
			<td><input style="width:100%" type="text" name="email"></td>
		</tr>
		<tr>
			<td align="right" valign="top">Mensagem</td>
			<td><textarea style="width:100%" cols="40" rows="15" name="mensagem"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="right" valign="top"><input type="submit" value="enviar"></td>
		</tr>
		</form>
	</table>
	<?
}

#################################################################################################################

function envia_mensagem(){
	$nome = $_POST["nome"];
	$telefone = $_POST["telefone"];
	$email = $_POST["email"];
	$mensagem = $_POST["mensagem"];
	$destino = retorna_config("email");
	?>
	<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Fale Conosco!</div><br>
	<?
	if(mail($destino, "Formulário Fale Conosco - suleventos.com.br", $mensagem . "\n\n\nNome: " . $nome . "\nTelefone: " . $telefone, "From: " . $nome . " <" . $email . ">")){ ?>
		<table width="100%" class="conteudo">
			<tr>
				<td>A mensagem foi enviada com sucesso!</td>
			</tr>
			<tr>
				<td><br><br><br><br><br><a href="fale_conosco.php">[Nova Mensagem]</a></td>
			</tr>
		</table>
<?	}
	else{ ?>
		<table width="100%" class="conteudo">
			<tr>
				<td>Problemas no envio da mensagem</td>
			</tr>
			<tr>
				<td><br><br><br><br><br><a href="javascript: history.back();">[Tentar Novamente]</a></td>
			</tr>
		</table>
<?	}
}

#################################################################################################################

function altera_valor($chave, $valor){
	$banco = mysql_connect("localhost", "root", "vertrigo") or die("Erro de conexão com o banco: " . mysql_error());
	mysql_select_db("suleventos");
	$query = "UPDATE config SET valor='" . $valor . "' WHERE chave='" . $chave . "'";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	mysql_close($banco);
}
function retorna_config($chave){
	$banco = mysql_connect("localhost", "root", "vertrigo") or die("Erro de conexão com o banco: " . mysql_error());
	mysql_select_db("suleventos");
	$query = "SELECT valor FROM config WHERE chave='" . $chave . "'";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$valor = mysql_fetch_assoc($result);
	return $valor["valor"];
	mysql_close($banco);
}

#################################################################################################################

function checa_permissoes_evento($codigo){
	require("includes/conectar_mysql.php");
	$query = "SELECT email, senha FROM eventos WHERE cd=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_array($result, MYSQL_ASSOC);
	if ((strlen($evento["email"]) != 0) && (strlen($evento["senha"]) != 0)) return true;
	else return false;
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_login_evento($codigo){
	?>
	<span class="celula"><B>Este evento tem restrição de acesso.</B></span><BR><BR><BR><BR>
	<table width="50%" border="0">
		<form name="login" action="ver_evento.php?cd=<?=$codigo?>" method="post">
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Email:</td>
			<td width="60%"><input type="text" name="email" style="width: 100%;"></td>
		</tr>
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Senha:</td>
			<td><input type="password" name="senha" style="width: 100%;"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="OK"></td>
		</tr>
		</form>
	</table>
	<?
}
#################################################################################################################

function constroi_login_errado($codigo){
	?>
	<span class="celula"><B>Login ou Senha não conferem.</B></span><BR><BR><BR><BR>
	<table width="50%" border="0">
		<form name="login" action="ver_evento.php?cd=<?=$codigo?>" method="post">
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Email:</td>
			<td width="60%"><input type="text" name="email" style="width: 100%;"></td>
		</tr>
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Senha:</td>
			<td><input type="password" name="senha" style="width: 100%;"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="OK"></td>
		</tr>
		</form>
	</table>
	<?
}

#################################################################################################################

function constroi_banner(){
	?>
	<!--
	<br>
	<hr color="#001238" size="1"><br>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="440" height="87" id="Untitled-1" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="imagens/banner.swf" />
		<param name="quality" value="high" />
		<param name="bgcolor" value="#ffffff" />
		<param name="wmode" value="transparent">
		<embed src="imagens/banner.swf" width="440" height="87" align="middle" quality="high" bgcolor="#ffffff" wmode="transparent" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>-->
	<?
}

#################################################################################################################

function constroi_tabela_tipo_parceiros(){
	global $pagina_inicial, $parceiros;
	require("includes/conectar_mysql.php");
	$query = "SELECT DISTINCT parceiros.tipo as tipo1, tipodeparceiro.tipo as tipo2, tipodeparceiro.path, tipodeparceiro.path_thumb FROM parceiros, tipodeparceiro WHERE parceiros.tipo=tipodeparceiro.cd ORDER BY tipodeparceiro.tipo";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$parceiros?>">[PROFISSIONAIS]</a>
	<hr color="#001238" size="1">
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
			<table>
				<tr>
					<td width="65">&nbsp;</td>
					<td><a class="menuesquerdo" href="parceiros.php?tipo=<?=$parceiro["tipo1"]?>"><?=$parceiro["tipo2"]?>&nbsp;(<?=$qtd?>)</a></td>
				</tr>
			</table>
			<?
		}
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_tipo_anunciantes(){
	global $pagina_inicial, $anunciantes;
	require("includes/conectar_mysql.php");
	$query = "SELECT DISTINCT anunciantes.tipo as tipo1, tipodeanunciante.tipo as tipo2 FROM anunciantes, tipodeanunciante WHERE anunciantes.tipo=tipodeanunciante.cd ORDER BY tipodeanunciante.tipo";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$anunciantes?>">[SERVI&Ccedil;OS ESPECIAIS]</a>
	<hr color="#001238" size="1">
	<? if(mysql_num_rows($result) == 0) echo('<div width="100%" class="conteudo">Não há servi&cedil;os cadastrados</div>'); ?>
	<table width="100%" border="0">
		<tr>
		<?
		$contador = 0;
		while($anunciante = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT COUNT(*) FROM anunciantes WHERE tipo = " . $anunciante["tipo1"];
			$result2 = mysql_query($query);
			$resposta = mysql_fetch_row($result2);
			$qtd = $resposta[0];
			$query = "SELECT path_thumb FROM anunciantes  WHERE tipo=" . $anunciante["tipo1"] . " order by rand() Limit 1";
			$result3 = mysql_query($query);
			$resposta = mysql_fetch_row($result3);
			$imagem = $resposta[0];
			?><td valign="bottom">
				<table width="100%">
					<tr>
						<td><img src="<?=$imagem?>"></td>
					</tr>
					<tr>
						<td class="menurodape"><a class="menurodape" href="anunciantes.php?tipo=<?=$anunciante["tipo1"]?>"><?=$anunciante["tipo2"]?></a>&nbsp;(<?=$qtd?>)</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
				</table>
			<?
			$contador++;
			if($contador == 2){
				$contador = 0;
				echo("</tr><tr>");
			}
		}
		?>
		</tr>
	</table>
	<?
	require("includes/desconectar_mysql.php");
}


#################################################################################################################

function constroi_pagina_parceiro($codigo, $colunas){
	global $parceiros, $pagina_inicial;
	require("includes/conectar_mysql.php");
	$query = "SELECT tipodeparceiro.tipo, parceiros.tipo as codigotipo, parceiros.nome, parceiros.telefone, parceiros.site, parceiros.email, parceiros.endereco, pagina_parceiro.cd, pagina_parceiro.texto FROM tipodeparceiro, parceiros, pagina_parceiro WHERE tipodeparceiro.cd=parceiros.tipo AND parceiros.cd=" . $codigo . " AND parceiros.cd=pagina_parceiro.cd_parceiro";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$pagina = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$parceiros?>">[PROFISSIONAIS]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;" href="parceiros.php?tipo=<?=$pagina["codigotipo"]?>">[<?=$pagina["tipo"]?>]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;">[<?=$pagina["nome"]?>]</a>
	<hr color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="imagens/bullet_blue3.gif">&nbsp;<?=$pagina["nome"]?></div><br><br>
	<table width="100%" class="conteudo">
		<tr>
			<td><?=$pagina["texto"]?></td>
		</tr>
	</table>
	 <?
	$contador_de_colunas = 0;
	?>
	<br>
	<hr align="center" color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="imagens/telefone.gif">&nbsp;Contato</div>
	<div class="conteudo">
		<?
		if (strlen($pagina["endereco"]) > 0) echo('Endereço: ' . $pagina["endereco"] . "<br>");
		if (strlen($pagina["telefone"]) > 0) echo('Telefone: ' . $pagina["telefone"] . "<br>");
		if (strlen($pagina["email"]) > 0) echo('Email: <a href="mailto: ' . $pagina["email"] . '">' . $pagina["email"] . '</a><br>');
		if (strlen($pagina["site"]) > 0) echo('Site: <a href="http://' . $pagina["site"] . '">' . $pagina["site"] . '</a><br>');
		?>
	</div>
	<br>
	<hr align="center" color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="imagens/bullet_silver.gif">&nbsp;Clique na foto para ampliar</div><br>
	<table width="100%" cellspacing="5" cellpadding="0" border="0"><tr>
	<?
	$query = "SELECT path, path_thumb, descricao FROM pagina_parceiro_fotos WHERE cd_pagina=" . $pagina["cd"] . " ORDER BY cd";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<td align="center" valign="top" class="label" style="text-align: center;">
			<img style="cursor:pointer;" onClick="javascript: void window.open('ver_imagem.php?imagem=<?=urlencode($foto["path"])?>', 'Fotografia', 'width=640,height=480,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="<?=$foto["path_thumb"]?>"><br>
			<?=$foto["descricao"]?>
		</td>
		<?
		$contador_de_colunas++;
		if($contador_de_colunas >= $colunas){
			echo("</tr><tr>");
			$contador_de_colunas = 0;
		}
	}
	?></tr></table><?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_pagina_anunciante($codigo, $colunas){
	global $anunciantes, $pagina_inicial;
	require("includes/conectar_mysql.php");
	$query = "SELECT tipodeanunciante.tipo, anunciantes.tipo as codigotipo, anunciantes.nome, anunciantes.telefone, anunciantes.site, anunciantes.email, anunciantes.endereco, pagina_anunciante.cd, pagina_anunciante.texto FROM tipodeanunciante, anunciantes, pagina_anunciante WHERE tipodeanunciante.cd=anunciantes.tipo AND anunciantes.cd=" . $codigo . " AND anunciantes.cd=pagina_anunciante.cd_parceiro";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$pagina = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$anunciantes?>">[SERVI&Ccedil;OS ESPECIAIS]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;" href="parceiros.php?tipo=<?=$pagina["codigotipo"]?>">[<?=$pagina["tipo"]?>]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;">[<?=$pagina["nome"]?>]</a>
	<hr color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="imagens/bullet_blue3.gif">&nbsp;<?=$pagina["nome"]?></div><br><br>
	<table width="100%" class="conteudo">
		<tr>
			<td><?=$pagina["texto"]?></td>
		</tr>
	</table>
	 <?
	$contador_de_colunas = 0;
	?>
	<br>
	<hr align="center" color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="imagens/telefone.gif">&nbsp;Contato</div>
	<div class="conteudo">
		<?
		if (strlen($pagina["endereco"]) > 0) echo('Endereço: ' . $pagina["endereco"] . "<br>");
		if (strlen($pagina["telefone"]) > 0) echo('Telefone: ' . $pagina["telefone"] . "<br>");
		if (strlen($pagina["email"]) > 0) echo('Email: ' . $pagina["email"] . "<br>");
		if (strlen($pagina["site"]) > 0) echo('Site: ' . $pagina["site"] . "<br>");
		?>
	</div>
	<br>
	<hr align="center" color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="imagens/bullet_silver.gif">&nbsp;Clique na foto para ampliar</div><br>
	<table width="100%" cellspacing="5" cellpadding="0" border="0"><tr>
	<?
	$query = "SELECT path, path_thumb, descricao FROM pagina_anunciante_fotos WHERE cd_pagina=" . $pagina["cd"];
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<td align="center" valign="top" class="label" style="text-align: center;">
			<img style="cursor:pointer;" onClick="javascript: void window.open('ver_imagem.php?imagem=<?=urlencode($foto["path"])?>', 'Fotografia', 'width=640,height=480,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="<?=$foto["path_thumb"]?>"><br>
			<?=$foto["descricao"]?>
		</td>
		<?
		$contador_de_colunas++;
		if($contador_de_colunas >= $colunas){
			echo("</tr><tr>");
			$contador_de_colunas = 0;
		}
	}
	?></tr></table><?
	require("includes/desconectar_mysql.php");
}


#################################################################################################################

function verifica_pagina_parceiro($codigo){
	require("includes/conectar_mysql.php");
	$query = "select cd from pagina_parceiro where cd_parceiro=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$qtd = mysql_num_rows($result);
	require("includes/desconectar_mysql.php");

	if ($qtd > 0) return true;
	else return false;
}

#################################################################################################################

function verifica_pagina_anunciante($codigo){
	require("includes/conectar_mysql.php");
	$query = "select cd from pagina_anunciante where cd_parceiro=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$qtd = mysql_num_rows($result);
	require("includes/desconectar_mysql.php");

	if ($qtd > 0) return true;
	else return false;
}


#################################################################################################################

function constroi_tabela_cartorios(){
	require("includes/conectar_mysql.php");
	$query = "SELECT * FROM cartorios";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<div width="100%" class="conteudo">Não há itens cadastrados</div>');
	if(mysql_num_rows($result) == 0) { ?>
		<table width="100%" class="conteudo">
			<tr>
				<td>Não há itens cadastrados.</td>
			</tr>
		</table>

	<? } ?>
	<table width="100%" class="conteudo"> <?
	while($cartorio = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<tr>
			<td><a name="<?=$cartorio["cd"]?>">&nbsp;</a></td>
		</tr>
		<tr>
			<td><?=$cartorio["descricao"]?></td>
		</tr>
		<?
	}
	?> </table> <?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_secao($secao, $subsecao){
	require("includes/conectar_mysql.php");
	if($subsecao == 0) $query = "SELECT * FROM secoes WHERE nomedesecao=" . $secao . " ORDER BY titulo";
	else $query = "SELECT * FROM secoes WHERE cd=" . $subsecao;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<table width="100%" class="conteudo"> <?
	while($texto = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<tr>
			<td><a name="<?=$texto["cd"]?>">&nbsp;</a></td>
		</tr>
		<tr>
			<td><?=$texto["texto"]?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<?
	}
	?> </table> <?
	require("includes/desconectar_mysql.php");
}

#################################################################################################################

function banners_direita(){
	?>
	<center>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="10" height="29"></td>
				<td width="15"><img src="imagens/menu3.gif"></td>
				<td background="imagens/menu4.gif" class="menuesquerdo" valign="top">Parceiros</td>
		</table>
		<br>
		<?
		require("includes/conectar_mysql.php");
		$query = "SELECT * FROM banners order by ordem, imagem";
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		while($registro = mysql_fetch_assoc($result)){ ?>
			<a target="_blank" href="<?=$registro["link"]?>"><img border="0" src="<?=$registro["imagem"]?>" width="160" height="51"></a><br><br>
		<? } ?>
	</center>
	<? 
	require("includes/desconectar_mysql.php");
	?><span class="menu">Anuncie aqui!</span><?	
}
?>


