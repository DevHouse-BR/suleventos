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
	require("../includes/conectar_mysql.php");
	$query = "SELECT cd, pergunta, data, ativa from enquetes order by data desc";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<html>
		<head>
			<title>Gerenciar Enquetes</title>
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
			<table class="label" style="text-align: left;">
			<thead bgcolor="#FFCC99">
				<th>Enquete</th>
				<th>Data</th>
				<th>Ativa</th>
				<th>Editar</th>
				<th>Apagar</th>
			</thead>
			<?
				while($enquete = mysql_fetch_array($result, MYSQL_ASSOC)){ ?>
					<tr>
						<td><?=$enquete["pergunta"]?></td>
						<td><?=date("d/m/Y", $enquete["data"])?></td>
						<td><?
							if($enquete["ativa"] == "s") echo('<input type="checkbox" checked disabled>');
							elseif($enquete["ativa"] == "n") echo('<input type="checkbox" disabled>');
							?>
						</td>
						<td><a href="wizard_nova_enquete.php?modo=update&cd=<?=$enquete["cd"]?>"><img border="0" title="Edita Enquete" src="../imagens/button_edit.png"></a></td>
						<td><a href="wizard_nova_enquete.php?modo=update&cd=<?=$enquete["cd"]?>"><img border="0" title="Edita Enquete" src="../imagens/button_edit.png"></a></td>
					</tr>
			<? } ?>
			</table>
		</body>
	</html>
	<? 
}

##############################################################################################
function constroi_passo1(){
	
	$pergunta = $_POST["pergunta"];
	$opcao1 = $_POST["opcao1"];
	$opcao2 = $_POST["opcao2"];
	$opcao3 = $_POST["opcao3"];
	$opcao4 = $_POST["opcao4"];
	$ativa = $_POST["ativa"];
	$data = mktime();
	$modo = $_POST["modo"];
	
	if ($modo == "add")	{
		$query = "INSERT INTO enquetes (pergunta, opcao1, opcao2, opcao3, opcao4, ativa, data) VALUES ('";
		$query .= $pergunta ."','";
		$query .= $opcao1 ."','";
		$query .= $opcao2 ."','";
		$query .= $opcao3 ."','";
		$query .= $opcao4 ."','";
		$query .= $ativa ."',";
		$query .= $data .")";
	}
	if ($modo == "update") {
		$query = "UPDATE eventos SET ";
		$query .= "nomes='" . $nomes ."', ";
		$query .= "data='" . $data ."', ";
		$query .= "local='" . $local ."', ";
		$query .= "descricao='" . $descricao ."', ";
		$query .= "email='" . $email ."', ";
		$query .= "senha='" . $senha ."', ";
		$query .= " WHERE cd='" . $_POST["cd"] . "'";
	}
	require("../includes/conectar_mysql.php");
		$result = mysql_query($query) or die("Erro ao atualizar registros no Banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
	?>
	<html>
		<head>
			<title>Enquete Criada!</title>
		</head>
		<body>
			<h3>Enquete Criada com Sucesso!</h3>
			<br><br>
			<a href="javascript: self.close();">[Fechar]</a>
		</body>
	</html>
	<?
}

?>