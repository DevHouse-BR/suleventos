<?php
	require("permissao_documento.php");
	$cd = $_GET["cd"];
	
	require("../includes/conectar_mysql.php");
	
	$query = "SELECT nome, caminho_img FROM imagens WHERE cd='" . $cd . "'";
	$result = mysql_query($query);
	if (mysql_num_rows($result) != 0) $img = mysql_fetch_row($result);
	else die("<html>\n<head>\n<title>Erro de Banco de Dados</title>\n<script language='Javascript'>\nfunction retorna(){\n window.history.back();\n}\n</script>\n</head>\n<body>\n<center><h3>Problemas com o banco de Dados. Erro: " . mysql_error() . "</h3></center><br>\n<a href='Javascript: retorna()'>Voltar</a>\n</body>\n</html>");
	
	$nome = $img[0];
	$path = $img[1];
	
	require("../includes/desconectar_mysql.php");
?>
<html>
	<head>
		<title><?=$nome?></title>
		<style type="text/css">
			<!--
			@import url("../includes/forms.css");
			-->
		</style>
		<script language="JavaScript" type="text/javascript">
			function apagar(){
				if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar esta Imagem?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
					self.location = "delete.php?oque=imagens&cd=<?=$cd?>";
				}
			}
			function sair(){
				self.close();
			}
		</script>
	</head>
	<body>
		<table class="tabela" width="100%">
			<tr>
				<td><input type="button" class="botao" onClick="javascript: apagar();" value="Apagar"></td>
				<td class="label" align="center"><b><?=$nome?></b></td>
				<td><input type="button" class="botao" onClick="javascript: sair();" value="Sair"></td>
			</tr>
		</table>
		<br>
		<table class="tabela" width="100%">
			<tr><td align="center"><img src="../<?=$path?>"></td></tr>
		</table>
	</body>
</html>