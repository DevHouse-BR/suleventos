<?php
error_reporting(0);

$passo = $_POST["passo"];
if (strlen($passo) == 0) $passo = 0;
if ($_COOKIE["javotou"]) $passo = 2;

switch($passo){
	case 0: constroi_passo0();
			break;
	case 1: constroi_passo1();
			break;
	case 2: constroi_passo2();
			break;
}

function constroi_passo0(){
	require("includes/conectar_mysql.php");
	$query = "SELECT cd, pergunta, opcao1, opcao2, opcao3, opcao4 FROM enquetes WHERE ativa='s' ORDER BY data DESC LIMIT 1";
	$result = mysql_query($query) or die("Erro ao acessar registros no Banco de dados: " . mysql_error());
	$enquete = mysql_fetch_array($result, MYSQL_ASSOC);
	if(mysql_num_rows($result) == 0) $vazio = true;
	else $vazio = false;
	require("includes/desconectar_mysql.php");
	
	?>
	<html>
		<head>
			<link href="includes/estilo.css" rel="stylesheet">
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		</head>
		<body leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" marginwidth="0" marginheight="0" style="background: none; background-color: #666666;">
			<table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1">
				<tr>
					<td width="100%" align="left" valign="top">
						<?
						if ($vazio) echo('<br><br><span class="menu">Nenhuma Enquete Criada</span>');
						else { ?>
							<table border="0">
								<tr>
									<td colspan="2" class="menu" style="font-size:10px;"><?=$enquete["pergunta"]?></td>
								</tr>
								<form action="enquete.php" method="post">
								<?
								if (strlen($enquete["opcao1"]) != 0) echo('<tr><td width="10%"><input type="radio" name="opcao" value="1"></td><td class="menu" style="font-weight: normal; font-size:10px;">' . $enquete["opcao1"] . '</td></tr>');
								if (strlen($enquete["opcao2"]) != 0) echo('<tr><td width="10%"><input type="radio" name="opcao" value="2"></td><td class="menu" style="font-weight: normal; font-size:10px;">' . $enquete["opcao2"] . '</td></tr>');
								if (strlen($enquete["opcao3"]) != 0) echo('<tr><td width="10%"><input type="radio" name="opcao" value="3"></td><td class="menu" style="font-weight: normal; font-size:10px;">' . $enquete["opcao3"] . '</td></tr>');
								if (strlen($enquete["opcao4"]) != 0) echo('<tr><td width="10%"><input type="radio" name="opcao" value="4"></td><td class="menu" style="font-weight: normal; font-size:10px;">' . $enquete["opcao4"] . '</td></tr>');
								?>
								<tr>
									<td colspan="2" align="right"><input type="submit" value="Votar"></td>
								</tr>
								<input type="hidden" name="passo" value="1">
								<input type="hidden" name="codigo" value="<?=$enquete["cd"]?>">
								</form>
							</table>
						<? } ?>
					</td>
				</tr>
			</table>
		</body>
	</html>
	<?
}

##############################################################################################
function constroi_passo1(){

	$opcao = $_POST["opcao"];
	$codigo = $_POST["codigo"];
	
	$query = "UPDATE enquetes SET ";
	
	switch($opcao){
		case 1: $query .= "qtd_opcao1=qtd_opcao1+1";
			break;
		case 2: $query .= "qtd_opcao2=qtd_opcao2+1";
			break;
		case 3: $query .= "qtd_opcao3=qtd_opcao3+1";
			break;
		case 4: $query .= "qtd_opcao4=qtd_opcao4+1";
			break;
	}

	$query .= " WHERE cd=" . $codigo;

	require("includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("includes/desconectar_mysql.php");
	setcookie("javotou", true);
	constroi_passo2();
}

##############################################################################################
function constroi_passo2(){
	
	$query = "SELECT * FROM enquetes WHERE ativa='s' ORDER BY data DESC LIMIT 1";
	require("includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
		$enquete = mysql_fetch_array($result, MYSQL_ASSOC);
		$total = $enquete["qtd_opcao1"] + $enquete["qtd_opcao2"] + $enquete["qtd_opcao3"] + $enquete["qtd_opcao4"];
		$percentagem_opcao1 = round(((int) $enquete["qtd_opcao1"] * 100)/$total);
		$percentagem_opcao2 = round(((int) $enquete["qtd_opcao2"] * 100)/$total);
		$percentagem_opcao3 = round(((int) $enquete["qtd_opcao3"] * 100)/$total);
		$percentagem_opcao4 = round(((int) $enquete["qtd_opcao4"] * 100)/$total);
		?>
		<html>
			<head>
				<link href="includes/estilo.css" rel="stylesheet">
				<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			</head>
			<body leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" marginwidth="0" marginheight="0" style="background: none; background-color: #666666;">
				<table width="100%" height="100%" border="0" cellpadding="1" cellspacing="1">
					<tr>
						<td width="100%" align="left" valign="top">
							<table border="0">
								<tr>
									<td colspan="2" class="menu" style="font-size:10px;"><?=$enquete["pergunta"]?></td>
								</tr>
								<?
								if (strlen($enquete["opcao1"]) != 0) echo('<tr><td colspan="2" class="menu" style="font-weight: normal; font-size:10px;">' . $enquete["opcao1"] . '</td></tr><tr><td width="80%" valign="bottom"><div style="width: 100%; border: 1px solid white; background-color: #A6A6A6;"><div style="font-size: 8px; background-color: blue; width: ' . $percentagem_opcao1 . '%;"></div></div></td><td class="menu" style="font-size: 10px; vertical-align: bottom;">' . $percentagem_opcao1 . '%</td></tr>');
								if (strlen($enquete["opcao2"]) != 0) echo('<tr><td colspan="2" class="menu" style="font-weight: normal; font-size:10px;">' . $enquete["opcao2"] . '</td></tr><tr><td valign="bottom"><div style="width: 100%; border: 1px solid white; background-color: #A6A6A6;"><div style="font-size: 8px; background-color: green; width: ' . $percentagem_opcao2 . '%;">&nbsp;</div></div></td><td class="menu" style="font-size: 10px; vertical-align: bottom;">' . $percentagem_opcao2 . '%</td></tr>');
								if (strlen($enquete["opcao3"]) != 0) echo('<tr><td colspan="2" class="menu" style="font-weight: normal; font-size:10px;">' . $enquete["opcao3"] . '</td></tr><tr><td valign="bottom"><div style="width: 100%; border: 1px solid white; background-color: #A6A6A6;"><div style="font-size: 8px; background-color: yellow; width: ' . $percentagem_opcao3 . '%;">&nbsp;</div></div></td><td class="menu" style="font-size: 10px; vertical-align: bottom;">' . $percentagem_opcao3 . '%</td></tr>');
								if (strlen($enquete["opcao4"]) != 0) echo('<tr><td colspan="2" class="menu" style="font-weight: normal; font-size:10px;">' . $enquete["opcao4"] . '</td></tr><tr><td valign="bottom"><div style="width: 100%; border: 1px solid white; background-color: #A6A6A6;"><div style="font-size: 8px; background-color: red; width: ' . $percentagem_opcao4 . '%;">&nbsp;</div></div></td><td class="menu" style="font-size: 10px; vertical-align: bottom;">' . $percentagem_opcao4 . '%</td></tr>');
								?>
							</table>
						</td>
					</tr>
				</table>
			</body>
		</html>
		<?
	require("includes/desconectar_mysql.php");
}
?>