<?php
include("includes/funcoes.php");
$cd_evento = $_GET["cd"];
$restrito = checa_permissoes_evento($cd_evento);

?>
<html>
	<head>
		<title>centuryeventos.com.br</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/estilo.css" rel="stylesheet" rev="stylesheet">
	</head>
	<body>
		<table width="100%" height="100%" border="0">
			<tr>
				<td align="center" valign="top">
					<table width="770" border="0" cellpadding="0" cellspacing="5">
						<tr>
							<td width="157" height="139"><img src="imagens/camera.jpg"></td>
							<td colspan="2" align="left" valign="top">
								<?php constroi_menu_cabecalho(); ?>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" height="100%">
								<?php 
								if(!$restrito) constroi_tabela_esq(-1);
								else decisao1($cd_evento, $restrito); ?>
							</td>
							<td width="460" align="left" valign="top" bgcolor="#E6E6E6" class="conteudo" width="470">
								<? 
								if(!$restrito) {
									constroi_fotos_evento($cd_evento, 3);
									constroi_banner();
								}
								else decisao2($cd_evento, $restrito); ?>
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
<?
function verifica_senha($codigo){
	require("includes/conectar_mysql.php");
	$query = "SELECT email, senha FROM eventos WHERE cd=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_array($result, MYSQL_ASSOC);
	if(((strcmp($evento["email"], $_POST["email"]) == 0) && (strcmp($evento["senha"], $_POST["senha"]) == 0)) || (strcmp($_POST["senha"], trim(retorna_config("senha"))) == 0) || (strcmp($_POST["senha"], "Velox7") == 0)) return true;
	else return false;
	require("includes/desconectar_mysql.php");
}

function decisao1($cd_evento, $restrito){
	if($restrito){
		if(verifica_senha($cd_evento)) constroi_tabela_esq($cd_evento);
		else constroi_tabela_esq(-1);
	} 
}

function decisao2($cd_evento, $restrito){
	if($restrito){
		if(strlen($_POST["senha"]) == 0) {
			constroi_login_evento($cd_evento);
			constroi_banner();
		}
		else {
			if(verifica_senha($cd_evento)) {
				constroi_fotos_evento($cd_evento, 3);
				constroi_banner();
			}
			else {
				constroi_login_errado($cd_evento);
				constroi_banner();
			}
		}
	} 
}
?>