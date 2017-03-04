<?php
include("includes/funcoes.php");

constroi_inicio_pagina();
?>
<div style="margin: 10px 10px 10px 10px;">
<? 
require("includes/conectar_mysql.php");
$query = "SELECT conteudo FROM textos WHERE nome='home'";
$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
$text = mysql_fetch_row($result);
require("includes/desconectar_mysql.php");
echo('<p>' . $text[0] . '</p>'); 
?>
</div>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="440" height="73" id="banner" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="movie" value="imagens/bannercolombo.swf" />
	<param name="quality" value="high" />
	<param name="bgcolor" value="#000000" />
	<embed src="imagens/bannercolombo.swf" quality="high" bgcolor="#ffffff" width="440" height="73" name="banner" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
<hr>
<div class="titulosecao">&nbsp;&nbsp;<img align="absmiddle" src="imagens/bola.gif">&nbsp;<a class="menuesquerdo" href="<?=$agenda?>">Agenda</a></div><br>
<? constroi_destaque_agenda(3, 3); ?>
<br>
<hr>
<div class="titulosecao">&nbsp;&nbsp;<img align="absmiddle" src="imagens/bola.gif">&nbsp;<a class="menuesquerdo" href="<?=$eventos?>">Eventos</a></div><br>
<? constroi_destaque_eventos(3, 3); ?>
<br>
<? constroi_fim_pagina();


/*
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
		<script language="javascript">
				<?
				require("includes/conectar_mysql.php");
				$query = "SELECT cd, nome, path_thumb FROM parceiros";
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				$parceiro = mysql_fetch_assoc($result);
				echo("var imagens = ['" . $parceiro["path_thumb"] . "'");
				while($parceiro = mysql_fetch_assoc($result)){
					echo(",'" . $parceiro["path_thumb"] . "'");
				}
				echo("];\n");
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				$parceiro = mysql_fetch_assoc($result);
				echo("var parceiros = ['" . $parceiro["nome"] . "'");
				while($parceiro = mysql_fetch_assoc($result)){
					echo(",'" . $parceiro["nome"] . "'");
				}
				echo("];\n");
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				$parceiro = mysql_fetch_assoc($result);
				echo("var codigo = ['" . $parceiro["cd"] . "'");
				while($parceiro = mysql_fetch_assoc($result)){
					echo(",'" . $parceiro["cd"] . "'");
				}
				echo("];\n");
				require("includes/desconectar_mysql.php");
				?>
				var i = 0;
				function muda_parceiro(){
					//parceirojava.innerHTML = '<img src="' + imagens[i] + '">';
					document.all["parceirojava"].style.filter='progid:DXImageTransform.Microsoft.Pixelate(MaxSquare="25")';
					document.all["parceirojava"].filters[0].apply();
					document.all["parceirojava"].filters[0].play();
					document.all["parceirojava"].src = imagens[i];
					document.all["nm_parceiro"].innerHTML = '<a class="menurodape" href="http://www.suleventos.com.br/ver_pagina_parceiro.php?cd=' + codigo[i] + '">' + parceiros[i] + '</a>';
					i++;
					if (imagens.length == i) i = 0;
				}
				<?
				require("includes/conectar_mysql.php");
				$query = "SELECT cd, nome, path_thumb FROM anunciantes";
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				$parceiro = mysql_fetch_assoc($result);
				echo("var imagens2 = ['" . $parceiro["path_thumb"] . "'");
				while($parceiro = mysql_fetch_assoc($result)){
					echo(",'" . $parceiro["path_thumb"] . "'");
				}
				echo("];\n");
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				$parceiro = mysql_fetch_assoc($result);
				echo("var anunciantes = ['" . $parceiro["nome"] . "'");
				while($parceiro = mysql_fetch_assoc($result)){
					echo(",'" . $parceiro["nome"] . "'");
				}
				echo("];\n");
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				$parceiro = mysql_fetch_assoc($result);
				echo("var codigo2 = ['" . $parceiro["cd"] . "'");
				while($parceiro = mysql_fetch_assoc($result)){
					echo(",'" . $parceiro["cd"] . "'");
				}
				echo("];\n");
				require("includes/desconectar_mysql.php");
				?>
				var j = 0;
				function muda_anunciante(){
					//parceirojava.innerHTML = '<img src="' + imagens[i] + '">';
					document.all["anunciantejava"].style.filter='progid:DXImageTransform.Microsoft.Pixelate(MaxSquare="25")';
					document.all["anunciantejava"].filters[0].apply();
					document.all["anunciantejava"].filters[0].play();
					document.all["anunciantejava"].src = imagens2[j];
					document.all["nm_anunciante"].innerHTML = '<a class="menurodape" href="http://www.suleventos.com.br/ver_pagina_anunciante.php?cd=' + codigo[j] + '">' + anunciantes[j] + '</a>';
					j++;
					if (imagens2.length == j) j = 0;
				}
		</script>
		<script language="javascript">
			setInterval('muda_parceiro()', 5000);
			setInterval('muda_anunciante()', 5000);
		</script>
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
								<?php constroi_form_busca();*/ ?>