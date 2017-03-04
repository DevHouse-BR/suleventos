<?
require("permissao_documento.php");
$chave = $_GET["chave"];
if($chave == "senha") $valor = base64_encode($_GET["valor"]);
elseif($chave == "versiculo") $valor = str_replace("\r\n", "<br>", $_GET["valor"]);
else $valor = $_GET["valor"];

include("funcoes.php");
altera_valor($chave, $valor);
?>
<html>
	<script language="javascript" type="text/javascript">
		self.close();
		opener.location = opener.location;
	</script>
</html>