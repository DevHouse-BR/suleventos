<?php
$cd_casamento = $_GET["cd_casamento"];
if($_COOKIE["noivo"] != $cd_casamento) die("Você não tem permissão para executar esta tarefa.");

$oque = $_GET["oque"];
$cd = $_GET["cd"];

require("includes/conectar_mysql.php");
$query = "DELETE FROM " . $oque . " WHERE (cd=" . $cd . ") LIMIT 1";
$result = mysql_query($query) or die("Erro ao remover registros do Banco de dados: " . mysql_error());	
require("includes/desconectar_mysql.php");

?>
<html>
	<head>
		<title>Salvando as informações</title>
		<? if ($result == 1){ ?>
			<script language="JavaScript" type="text/javascript">
				setTimeout("finaliza();",2000);
				function finaliza(){
					if (opener) opener.location = opener.location;
					if (parent) parent.location = parent.location;
					self.close();
				}
			</script>
		<? } ?>
	</head>
	<body>
		<? if ($result == 1){ ?>
			<center><h3>Operação realizada com sucesso...</h3></center>
		<? } ?>
	</body>
</html>