<?php
error_reporting  (E_ERROR | E_PARSE);
$cd_evento = $_GET["cd"];

if($_COOKIE["noivo"] == $cd_evento) $login = true;
elseif ($_POST["modo"] == "login"){
	if(verifica_senha($cd_evento)) $login = true;
	else $login = false;
}
else $login = false;

include("includes/funcoes.php");


?>
<html>
	<head>
		<title>suleventos.com.br</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<link href="includes/estilo.css" rel="stylesheet" rev="stylesheet">
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
									<param name="movie" value="imagens/noiva.swf" />
									<param name="menu" value="false" />
									<param name="quality" value="high" />
									<param name="bgcolor" value="#000000" />
									<embed src="imagens/noiva.swf" menu="false" quality="high" bgcolor="#2d5f90" width="157" height="139" name="Untitled-2" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
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
							<?
							if ($login) constroi_lista_casamento($cd_evento);
							elseif($_POST["modo"] == "login") constroi_login_errado2($cd_evento);
							else constroi_login($cd_evento);
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
function verifica_senha($codigo){
	require("includes/conectar_mysql.php");
	$query = "SELECT email, senha_admin FROM novos_casamentos WHERE cd=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_assoc($result);
	//die($evento["senha_admin"]);
	if((strcmp($evento["email"], $_POST["email"]) == 0) && (strcmp($evento["senha_admin"], $_POST["senha"]) == 0)){
		setcookie("noivo", $codigo);
		return true;
	}
	else return false;
	require("includes/desconectar_mysql.php");
}

function constroi_login($codigo){
	?>
	<span class="celula"><B>Esta área tem restrição de acesso.</B></span><BR><BR><BR><BR>
	<table width="50%" border="0">
		<form name="login" action="admin_lista.php?cd=<?=$codigo?>" method="post">
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Usuário:</td>
			<td width="60%"><input type="text" name="email" style="width: 100%;"></td>
		</tr>
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Senha:</td>
			<td><input type="password" name="senha" style="width: 100%;"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="OK"></td>
		</tr>
		<input type="hidden" name="modo" value="login">
		</form>
	</table>
	<?
}
#################################################################################################################

function constroi_login_errado2($codigo){
	?>
	<span class="celula"><B>Login ou Senha não conferem.</B></span><BR><BR><BR><BR>
	<table width="50%" border="0">
		<form name="login" action="admin_lista.php?cd=<?=$codigo?>" method="post">
		<tr>
			<td width="40%" style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Usuario:</td>
			<td width="60%"><input type="text" name="email" style="width: 100%;"></td>
		</tr>
		<tr>
			<td style="text-align: right; font:Arial, Helvetica, sans-serif; font-size:12px;">Senha:</td>
			<td><input type="password" name="senha" style="width: 100%;"></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" value="OK"></td>
		</tr>
		<input type="hidden" name="modo" value="login">
		</form>
	</table>
	<?
}

function constroi_lista_casamento($codigo){
	require("includes/conectar_mysql.php");
	if(($_REQUEST["modo"] == "item") && (strlen($_POST["item"]) > 0)){
		$query = "INSERT INTO novos_casamentos_itens (cd_casamento, item) VALUES (" . $codigo . ", '" . $_POST["item"] . "')";
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	}
	?>
	<table width="100%">
		<form name="item" action="admin_lista.php?modo=item&cd=<?=$codigo?>" method="post">
		<tr>
			<td style="font:Arial, Helvetica, sans-serif; font-size:12px;">Novo Item:&nbsp;<input type="text" name="item" size="45" maxlength="255">&nbsp;<input type="submit" value="Adicionar"></td>
		</tr>
		</form>
	</table>
	<hr>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('admin/confirmacao.html',['Confirme!','Deseja apagar este item?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?cd_casamento=<?=$codigo?>&oque=novos_casamentos_itens&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<?
	$query = "SELECT cd, item, reservado FROM novos_casamentos_itens WHERE cd_casamento=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0) echo('<table width="100%"><tr><td class="conteudo">Não Há Itens Cadastrados.</td></tr></table>');
	else{
		echo('<table width="100%"><tr><td></td><td class="menurodape">Item</td><td class="menurodape">Reservado Para</td></tr>');
		while($item = mysql_fetch_assoc($result)){
		?>
			<tr>
				<td width="5%"><a href="javascript: apagar(<?=$item["cd"]?>);"><img border="0" src="imagens/button_drop.png"></a></td>
				<td class="menurodape" style="font-weight: normal;"><?=$item["item"]?></td>
				<td class="menurodape" style="font-weight: normal;"><?=$item["reservado"]?></td>
			</tr>
		<?
		}
		echo('</table>');
	} ?>
	<hr>
	<li class="conteudo" style="padding: 5px;">Clique no ícone&nbsp;<img src="imagens/button_drop.png">&nbsp;para apagar um item.</li>
	<li class="conteudo" style="padding: 5px;">Clique <a href="lista_casamento.php?cd=<?=$codigo?>">aqui</a> para visualizar o resultado.</li>
	<?
}
?>