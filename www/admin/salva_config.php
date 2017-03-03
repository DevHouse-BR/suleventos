<?
require("permissao_documento.php");
$chave = $_GET["chave"];
$valor = $_GET["valor"];
include("funcoes.php");
altera_valor($chave, $valor);
?>
<html>
	<script language="javascript" type="text/javascript">
		self.close();
		opener.location = opener.location;
	</script>
</html>