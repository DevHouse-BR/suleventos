<html>
	<head>
		<title>Fotografias</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>

	<body leftmargin="0" bottommargin="0" marginheight="0" marginwidth="0" topmargin="0" rightmargin="0" bgcolor="#000000">
		<center>
			<table width="341" height="259" cellpadding="0" cellspacing="0" background="imagens/fundo_porta_retrato.gif" border="0">
				<tr>
					<td align="center" valign="middle">
						<?
						$cd = $_GET["foto"];
						require("includes/conectar_mysql.php");
						$query = "SELECT path from fotos WHERE cd=" . $cd;
						$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
						$fotos = mysql_fetch_assoc($result);
						echo('<img id="moldura" src="' . $fotos["path"] . '">');
						require("includes/desconectar_mysql.php");
						?>		
					</td>
				</tr>
			</table>
			<br>
			<iframe src="ver_fotos_evento.php?cd=<?=$_GET["evento"]?>" height="120" width="400" frameborder="0" allowtransparency="yes"></iframe>
			<div style="position:absolute; z-index: 2; top:0; left:0; width: 100%; height:100%">
				<table width="341" height="259" cellpadding="0" cellspacing="0" border="0">
					<tr height="50">
						<td width="55"><img src="imagens/estrela_porta_retrato.gif"></td>
						<td>&nbsp;</td>
						<td width="55"><img src="imagens/estrela_porta_retrato.gif"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr height="50">
						<td><img src="imagens/estrela_porta_retrato.gif"></td>
						<td>&nbsp;</td>
						<td><img src="imagens/estrela_porta_retrato.gif"></td>
					</tr>
				</table>
			</div>
		</center>
	</body>
</html>
