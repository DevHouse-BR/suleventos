<?
require("permissao_documento.php");
?>
<html>
	<head>
		<title>Upload de Imagens</title>
		<style type="text/css">
			<!--
			@import url("../includes/forms.css");
			-->
		</style>
		<script language="JavaScript">
			function validaform(){
				if (document.all["sendform"].image.value == "") alert("Selecione uma imagem para upload.");
				if (document.all["sendform"].image.value != "") document.all["sendform"].submit();
			}
			function sair(){
				self.opener.location = self.opener.location;
				self.close();
			}
		</script>
	</head>
	<body marginheight="0" marginwidth="0" leftmargin="0" rightmargin="0" topmargin="0" bottommargin="0">
		<table width="100%" border="0" height="100%">
		<form action="img_uploader2.php" encType="multipart/form-data" method="post" name="sendform">
			<input name="MAX_FILE_SIZE" type="hidden" value="10000000">
			<tr>
				<td align="center" valign="middle">
					<table width="400" border="0" class="tabela">
						<tr>
							<td colspan="2" class="cell"><input maxLength="255" name="image" class="textfield" type="file" accept="image/jpeg, image/jpg"></td>
							<td rowspan="2" class="cell"><input class="botao" type="button" value="Enviar" onClick="validaform();" style="width: 100%; height: 45px;"></td>
						</tr>
						<tr>
							<td colspan="2" class="cell"><input type="checkbox" name="img_full" checked class="checkbox">&nbsp;Mostrar Imagem em tamanho real após upload.</td>
							<td class="cell"><input name="exit" class="botao" type="button" value="Sair" onClick="sair();" style="width: 100%;"></td>
						</tr>
					</table>					
				</td>
			</tr>
 		</FORM>
		</table>
	</body>
</html>
