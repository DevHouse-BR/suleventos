<?php
include("funcoes.php");
require("permissao_documento.php");
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
								<?php constroi_tabela_esq(-1); ?>
							</td>
							<td align="left" valign="top" bgcolor="#E6E6E6" class="conteudo" width="470">
								<div style="font-size:12px; color:#000000; background-color:#FFFFFF;">Alterar Senha Administrador<br>Nova Senha:&nbsp;<input type="password" id="senha"><br>Confirmação:<input type="password" id="confirma">&nbsp;&nbsp;<input type="button" onClick="if((document.all['senha'].value == document.all['confirma'].value) && (document.all['senha'].value != '')) window.open('salva_config.php?chave=senha&valor=' + document.all['senha'].value, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes'); else { alert('A senha não confere!'); document.all['senha'].value = ''; document.all['confirma'].value = ''; }" value="OK"></div>
								<hr>
								<?php constroi_form_busca(); ?>
								<hr color="#001238" size="1">
								<iframe height="500" width="100%" src="wizard_texto.php?texto=home" scrolling="no" allowtransparency="yes"></iframe>
								<hr size="8" align="center" color="#FD9800">
								<div class="titulosecao"><img align="bottom" src="../imagens/bullet_red.gif">&nbsp;Eventos Recentes</div><br>
								<? constroi_destaque_eventos(6, 3); ?>
								<br>
								<DIV class="menurodape" style="width: 100%; text-align:right;"><a class="menurodape" href="<?=$eventos?>">[EVENTOS]</a></DIV>
								<hr size="8" align="center" color="#FD9800">
								<? constroi_dicas_destaque(); ?>
								<hr size="8" align="center" color="#FD9800">
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
