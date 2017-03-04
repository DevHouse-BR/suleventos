<?php
require("permissao_documento.php");
include("funcoes.php");
$cd_evento = $_GET["cd"];
?>
<html>
	<head>
		<title>suleventos.com.br</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="../includes/estilo.css" rel="stylesheet" rev="stylesheet">
		<script language="javascript" type="text/javascript">
			function apagar_evento(codigo){
				if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar este evento e todas as suas fotografias?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
					void window.open('delete.php?oque=eventos&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
				}
			}
		</script>
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
									<param name="movie" value="../imagens/noiva.swf" />
									<param name="menu" value="false" />
									<param name="quality" value="high" />
									<param name="bgcolor" value="#000000" />
									<embed src="../imagens/noiva.swf" menu="false" quality="high" bgcolor="#2d5f90" width="157" height="139" name="Untitled-2" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
								</object>
							</td>
							<td colspan="2" align="left" valign="top">
								<?php constroi_menu_cabecalho(false); ?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="100%">
								<?php constroi_tabela_esq(-1); ?>
							</td>
							<td width="460" align="left" valign="top" bgcolor="#E6E6E6" class="conteudo" width="470">
								<? constroi_fotos_evento($cd_evento, 3); ?>
								<a href="javascript: void window.open('wizard_novo_evento.php?modo=altera_destaque&passo=1&codigo_evento=<?=$cd_evento?>', 'EVENTO', 'width=420,height=160,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Foto de Destaque]</a>&nbsp;&nbsp;
								<a href="javascript: void window.open('wizard_novo_evento.php?modo=adiciona_imagem&passo=3&codigo_evento=<?=$cd_evento?>', 'EVENTO', 'width=420,height=160,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Adicionar Foto]</a>&nbsp;&nbsp;
								<a href="javascript: void window.open('wizard_novo_evento.php?modo=edita_parceiro&passo=4&codigo_evento=<?=$cd_evento?>', 'EVENTO', 'width=420,height=400,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Editar Parceiros]</a>&nbsp;&nbsp;
								<a href="javascript: apagar_evento(<?=$cd_evento?>);">[Apagar Evento]</a>
								<? constroi_ficha_tecnica($cd_evento); ?>
								<hr>
								<iframe width="100%" height="500" src="wizard_novo_evento.php?modo=update&codigo_evento=<?=$cd_evento?>"></iframe>
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