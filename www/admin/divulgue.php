<?php
error_reporting  (E_ERROR | E_PARSE);
$etapa = $_REQUEST["etapa"];
if(strlen($etapa) == 0) $etapa = "1";
include("funcoes.php");

?>
<html>
	<head>
		<title>suleventos.com.br</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="../includes/estilo.css" rel="stylesheet" rev="stylesheet">
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
								switch($etapa){
									case "1":
										constroi_texto_introducao();
										constroi_cadastro_casamento();
										constroi_instrucoes_cadastro_casamento();
										break;
								}
								?>
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
<?
function constroi_cadastro_casamento(){
	?>
	<hr>
	<table width="70%" border="0">
		<form method="post" name="cadastro">
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Noivos:</td>
			<td width="60%"><input type="text" name="noivos" style="width: 100%;" maxlength="255"></td>
		</tr>
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Data:</td>
			<td width="60%"><input maxlength="10" type="text" name="data" style="width: 100%;" onKeyDown="if (((event.keyCode > 47) && (event.keyCode < 58)) || ((event.keyCode > 95) && (event.keyCode < 106)) || (event.keyCode == 8) || (event.keyCode == 111) || (event.keyCode == 46) || ((event.keyCode > 36) && (event.keyCode < 41))) return true; else return false;"></td>
		</tr>
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Igreja:</td>
			<td width="60%"><input maxlength="255" type="text" name="igreja" style="width: 100%;"></td>
		</tr>
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Recep��o:</td>
			<td width="60%"><input maxlength="255" type="text" name="recepcao" style="width: 100%;"></td>
		</tr>
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Telefone:</td>
			<td width="60%"><input maxlength="30" type="text" name="telefone" style="width: 100%;"></td>
		</tr>
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Email:</td>
			<td width="60%"><input maxlength="255" type="text" name="email" style="width: 100%;"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="button" value="Proximo >>"></td>
		</tr>
		</form>
	</table>
	<?
}

#################################################################################################################

function constroi_instrucoes_cadastro_casamento(){
	?>
	<hr>
	<div class="conteudo">
		<b>Instru��es de Uso:</b><br><br>
		<li>Todos os campos s�o de preenchimento obrigat�rio.</li>
		<li>Informe o endere�o de email corretamente pois voc� receber� um email contendo senhas para utiliza��o do sistema.</li>
		<li>Ap�s o preenchimento do formul�rio as informa��es passar�o por um processo de valida��o. Voc� receber� um email quando aprovado o cadastro.</li>
		<li>A data deve estar no formato: dd/mm/yyyy</li>
	</div>
	<?
}

function constroi_texto_introducao(){
	?><iframe height="500" width="100%" src="wizard_texto.php?texto=cadastro_casamento" scrolling="no" allowtransparency="yes"></iframe><?	
}
?>