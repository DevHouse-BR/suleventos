<?
error_reporting  (E_ERROR | E_PARSE);
$cd_casamento = $_REQUEST["cd_casamento"];
$cd = $_REQUEST["cd"];

if($_POST["modo"] == "add"){
	require("includes/conectar_mysql.php");
	$query = "SELECT senha_user FROM novos_casamentos WHERE cd=" . $cd_casamento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$senha = mysql_fetch_row($result);
	if(strcmp(trim($_POST["senha"]), trim($senha[0])) == 0){
		$query = "UPDATE novos_casamentos_itens SET reservado='" . $_POST["nome"] . "' WHERE cd=" . $cd;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		require("includes/desconectar_mysql.php");
		die('<html>
				<head>
					<title>Salvando as informações</title>
					<script language="JavaScript" type="text/javascript">
						setTimeout("finaliza();",2000);
						function finaliza(){
							if (opener) opener.location = opener.location;
							if (parent) parent.location = parent.location;
							self.close();
						}
					</script>
			</head>
			<body>
				<center><h3>Operação realizada com sucesso...</h3></center>
			</body>
		</html>');
	}
}
?>
<html>
	<head>
		<title>Reserva de Presente</title>
		<script language="javascript" type="text/javascript">
			function valida_form(){
				var f = document.forms[0];
				if((f.senha.value != "") && (f.nome.value != "")) f.submit();
				else alert("Todos os campos são obrigatórios!");
			}
		</script>
		<link href="includes/estilo.css" rel="stylesheet" rev="stylesheet">
	</head>
	<body>
		<table width="100%">
			<tr>
				<td align="center" valign="middle" height="100">
					<table width="90%" bgcolor="#E6E6E6" class="conteudo">
						<form action="reserva_item_casamento.php" method="post">
						<tr>
							<td align="right" width="30%">Senha:</td>
							<td><input type="password" name="senha" style="width: 80%;"></td>
						</tr>
						<tr>
							<td align="right">Seu Nome:</td>
							<td><input type="text" name="nome" style="width: 80%;">&nbsp;<input type="button" value="OK" onClick="valida_form();"></td>
						</tr>
						<input type="hidden" name="cd_casamento" value="<?=$cd_casamento?>">
						<input type="hidden" name="cd" value="<?=$cd?>">
						<input type="hidden" name="modo" value="add">
						</form>
					</table>
				</td>
			</tr>
		</table>
	</body>
</html>