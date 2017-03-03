<?php
require("permissao_documento.php");
include("funcoes.php");
$cd_evento = $_GET["cd"];
?>
<html>
	<head>
		<title>centuryeventos.com.br</title>
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
							<td colspan="2" align="left" valign="top">
								<?php constroi_menu_cabecalho(false); ?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="100%">
								<?php constroi_tabela_esq($cd_evento); ?>
							</td>
							<td width="460" align="left" valign="top" bgcolor="#E6E6E6" class="conteudo" width="470">
								<? constroi_fotos_evento($cd_evento, 3); ?>
								<a href="javascript: void window.open('wizard_novo_evento.php?modo=altera_destaque&passo=1&codigo_evento=<?=$cd_evento?>', 'EVENTO', 'width=420,height=160,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Alterar Foto de Destaque]</a>&nbsp;&nbsp;
								<a href="javascript: void window.open('wizard_novo_evento.php?modo=adiciona_imagem&passo=3&codigo_evento=<?=$cd_evento?>', 'EVENTO', 'width=420,height=160,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Adicionar Foto]</a>&nbsp;&nbsp;
								<a href="javascript: void window.open('wizard_novo_evento.php?modo=edita_parceiro&passo=4&codigo_evento=<?=$cd_evento?>', 'EVENTO', 'width=420,height=400,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Editar Parceiros]</a>
								<hr>
								<iframe width="100%" height="400" src="wizard_novo_evento.php?modo=update&codigo_evento=<?=$cd_evento?>"></iframe>
							</td>
							<td width="140" align="right" valign="top" bgcolor="#001238">
								<? constroi_parceiro_em_destaque(); ?>
							  <font style="font-size:2px;"><br></font>
							  	<? constroi_outros_eventos(10); ?>
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