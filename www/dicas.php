<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);

include("includes/funcoes.php");

?>
<html>
	<head>
		<title>centuryeventos.com.br</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/estilo.css" rel="stylesheet" rev="stylesheet">
	</head>
	<body>
		<table width="100%" height="100%" border="0">
			<tr>
				<td align="center" valign="top">
					<table width="770" border="0" cellpadding="0" cellspacing="5">
						<tr>
							<td width="157" height="139"><img src="imagens/camera.jpg"></td>
							<td colspan="2" align="left" valign="top">
								<?php constroi_menu_cabecalho(); ?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="100%">
								<?php constroi_tabela_esq(-1); ?>
							</td>
							<td align="left" valign="top" bgcolor="#E6E6E6" class="conteudo" width="470">
								<? constroi_form_busca(); ?>
								<hr>
								<? constroi_tabela_dicas(); 
								constroi_banner(); ?>
							</td>
							<td width="140" align="right" valign="top" bgcolor="#001238">
								<? constroi_parceiro_em_destaque(); ?>
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
