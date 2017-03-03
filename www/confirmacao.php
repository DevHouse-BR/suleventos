<?
$confirma = $_GET["confirma"];
$chave = $_GET["chave"];
$cd = $_GET["cd"];
if(strlen($chave) == 0) die("Parametros Incompletos!");
if(strcmp("MTIzMDk4", trim($chave)) != 0) die("Senha Errada");

require("includes/conectar_mysql.php");
$query = "SELECT email FROM novos_casamentos WHERE cd=" . $cd;
$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
$casamento = mysql_fetch_assoc($result);

if($confirma == "sim"){
	$query = "UPDATE eventos SET status=1 WHERE cd=" . $cd;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	
	$mensagem = "Parabéns, o cadastro do seu casamento foi aprovado!\n\n\n";
	$mensagem .= "Visite o site para ver seu evento sendo divulgado:\n";
	$mensagem .= "http://www.suleventos.com.br";
	$mensagem .= "\n\nFelicidades, \n\nEquipe suleventos.com.br.";
	
	mail($casamento["email"], "CONFIRMAÇÃO DO CADASTRO DE CASAMENTO SULEVENTOS.COM.BR", $mensagem, "From: <suleventos@suleventos.com.br>");
}
elseif ($confirma == "nao"){
	$query = "SELECT cd, path, path_thumb FROM fotos WHERE cd_evento = " . $cd;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
		unlink($foto["path"]);
		unlink($foto["path_thumb"]);
		$result2 = mysql_query("DELETE FROM fotos WHERE cd = " . $foto["cd"]);
	}
	$query = "DELETE FROM eventos WHERE (cd=" . $cd . ") LIMIT 1";
	$result = mysql_query($query) or die("Erro ao remover registros do Banco de dados: " . mysql_error());	
}
require("includes/desconectar_mysql.php");

?>
<html>
	<head>
		<title>Salvando as informações</title>
		<? if ($result == 1){ ?>
			<script language="JavaScript" type="text/javascript">
				setTimeout("finaliza();",2000);
				function finaliza(){
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