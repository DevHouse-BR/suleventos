<html>
	<head>
		<title>Fotografias</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>

	<body leftmargin="0" bottommargin="0" marginheight="0" marginwidth="0" topmargin="0" rightmargin="0" bgcolor="#FFFFFF">
		<center>
			<table width="356" height="259" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td width="17" height="17" background="imagens/canto_sup_esq.gif"></td>
					<td height="17" background="imagens/lateral_sup.gif"></td>
					<td width="17" height="17" background="imagens/canto_sup_dir.gif"></td>
				</tr>
				<tr>
					<td width="17" background="imagens/lateral_esq.gif"></td>
					<td bgcolor="#5F7DEE" valign="middle" align="center">
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
					<td width="17" background="imagens/lateral_dir.gif"></td>
				</tr>
				<tr>
					<td width="17" height="17" background="imagens/canto_inf_esq.gif"></td>
					<td height="17" background="imagens/lateral_inf.gif"></td>
					<td width="17" height="17" background="imagens/canto_inf_dir.gif"></td>
				</tr>
			</table>
			<br>
			<iframe src="ver_fotos_evento.php?cd=<?=$_GET["evento"]?>" height="120" width="400" frameborder="0" allowtransparency="yes"></iframe>
		</center>
	</body>
</html>
