<?php
error_reporting  (E_ERROR | E_WARNING | E_PARSE);
require("permissao_documento.php");
$passo = $_POST["passo"];
if (strlen($passo) == 0) $passo = 0;

switch($passo){
	case 0: constroi_passo0();
			break;
	case 1: constroi_passo1();
			break;
}



##############################################################################################
function constroi_passo0(){
	?>
	<html>
		<head>
			<title>Tipos de Anunciantes</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<style type="text/css">
				.label{
					font-family:Verdana, Arial, Helvetica, sans-serif;
					font-size:12px;
					text-align:right;
					vertical-align:top;				
				}
			</style>
		</head>
		<body>
			<table>
				<form action="form_tipodeanunciante.php" method="post" name="tipoparceiro">
				<tr>
					<td class="label">Tipo:</td>
					<td><input type="text" name="tipo" maxlength="255" size="40"></td>
				</tr>
				<tr>
					<td></td>
					<td class="label"><input type="submit" value="Adiciona"></td>
				</tr>
					<input type="hidden" name="passo" value="1">
				</form>
			</table>
		</body>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	
	$tipo = $_POST["tipo"];
	
	$query = "INSERT INTO tipodeanunciante (tipo) VALUES ('" . $tipo ."')";
		
	require("../includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
	constroi_passo0();
}

?>