<?php
include("includes/funcoes.php");
?>
<html>
	<head>
		<title>suleventos.com.br</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="content-language" content="pt-BR" />
		<meta http-equiv="pragma" content="no-cache" />
		<meta name="robots" content="index,follow" />
		<meta name="keywords" content="palavras chaves separadas por vírgula" /> 
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
								require("includes/conectar_mysql.php");
								$query = "SELECT conteudo FROM textos WHERE nome='home'";
								$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
								$text = mysql_fetch_row($result);
								require("includes/desconectar_mysql.php");
								echo('<p>' . $text[0] . '</p>');
								?>
								<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="440" height="73" id="banner" align="middle">
									<param name="allowScriptAccess" value="sameDomain" />
									<param name="movie" value="imagens/bannercolombo.swf" />
									<param name="quality" value="high" />
									<param name="bgcolor" value="#FFFFFF" />
									<param name="wmode" value="transparent">
									<embed src="imagens/bannercolombo.swf" quality="high" bgcolor="#ffffff" width="440" height="73" name="banner" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
								</object>
								<hr>
								<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Agenda</div><br>
								<? constroi_destaque_agenda(3, 3); ?>
								<br>
								<DIV class="menurodape" style="width: 100%; text-align:right;"><a class="menurodape" href="<?=$agenda?>">[AGENDA]</a></DIV>
								<hr>
								<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Eventos Recentes</div><br>
								<? constroi_destaque_eventos(3, 3); ?>
								<br>
								<DIV class="menurodape" style="width: 100%; text-align:right;"><a class="menurodape" href="<?=$eventos?>">[EVENTOS]</a></DIV>
								<? constroi_banner(); ?>
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
