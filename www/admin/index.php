<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

include("funcoes.php");

$pagina = $_GET["pagina"];
if(strlen($pagina) == 0) $pagina = 1;

?>
<html>
	<head>
		<title>fer_eventos.com</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="../includes/estilo.css" rel="stylesheet" rev="stylesheet">
	</head>
	<body>
		<table width="100%" height="100%" border="0">
			<tr>
				<td align="center" valign="top">
					<table width="770" border="0" cellpadding="0" cellspacing="5">
						<tr>
							<td width="157" height="139"><img src="../imagens/camera.jpg"></td>
							<td align="left" valign="top" width="613" style="border: 3px solid #E57D00; background-color: #FF9900;">
								<?php constroi_menu_cabecalho(true); ?>
							</td>
						</tr>
						<tr>
							<td align="center" valign="top" bgcolor="#E6E6E6" class="conteudo" colspan="2" width="627">
								<span class="celula"><B>ADMINISTRAÇÃO DE CONTEÚDO</B></span><BR><BR><BR><BR>
								<table width="35%" border="0">
									<form name="login" action="valida_usuario.php" method="post">
									<tr>
										<td width="20%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Senha:</td>
										<td width="60%"><input type="password" name="senha" style="width: 100%;"></td>
										<td width="10%"><input type="submit" value="OK"></td>
									</tr>
									</form>
								</table>
								<? if($_GET["status"] == "erro") echo('<div style="color: #FF0000">Senha Errada!</div>'); ?>
 							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>
