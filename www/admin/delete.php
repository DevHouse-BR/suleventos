<?php
require("permissao_documento.php");
$oque = $_GET["oque"];
$cd = $_GET["cd"];
require("../includes/conectar_mysql.php");

switch ($oque){
	case "nomedesecao":
		$query = "DELETE FROM secoes WHERE nomedesecao=" . $cd;
		$result = mysql_query($query) or die("Erro ao acessar registros do Banco de dados: " . mysql_error());;
		break;
		
	case "fotos":
		$query = "SELECT path, path_thumb FROM fotos WHERE cd=" . $cd;
		$result = mysql_query($query) or die("Erro ao acessar registros do Banco de dados: " . mysql_error());;
		$arquivo = mysql_fetch_row($result);
		if(!unlink("../" . $arquivo[0])) die("Erro ao apagar o arquivo!");
		if(!unlink("../" . $arquivo[1])) die("Erro ao apagar o arquivo!");
		break;
		
	case "pagina_parceiro_fotos":
		$query = "SELECT path, path_thumb FROM pagina_parceiro_fotos WHERE cd=" . $cd;
		$result = mysql_query($query) or die("Erro ao acessar registros do Banco de dados: " . mysql_error());;
		$arquivo = mysql_fetch_row($result);
		if(!unlink("../" . $arquivo[0])) die("Erro ao apagar o arquivo!");
		if(!unlink("../" . $arquivo[1])) die("Erro ao apagar o arquivo!");
		break;
		
	case "pagina_anunciante_fotos":
		$query = "SELECT path, path_thumb FROM pagina_anunciante_fotos WHERE cd=" . $cd;
		$result = mysql_query($query) or die("Erro ao acessar registros do Banco de dados: " . mysql_error());;
		$arquivo = mysql_fetch_row($result);
		if(!unlink("../" . $arquivo[0])) die("Erro ao apagar o arquivo!");
		if(!unlink("../" . $arquivo[1])) die("Erro ao apagar o arquivo!");
		break;
	
	case "parceiros":
		$query = "SELECT path, path_thumb FROM parceiros WHERE cd=" . $cd;
		$result = mysql_query($query) or die("Erro ao acessar registros do Banco de dados: " . mysql_error());;
		$arquivo = mysql_fetch_row($result);
		unlink("../" . $arquivo[0]);
		unlink("../" . $arquivo[1]);
		$query = "DELETE FROM parceiro_evento WHERE (parceiro=" . $cd . ")";
		$result = mysql_query($query) or die("Erro ao remover registros do Banco de dados: " . mysql_error());	
		break;
		
	case "anunciantes":
		$query = "SELECT path, path_thumb FROM anunciantes WHERE cd=" . $cd;
		$result = mysql_query($query) or die("Erro ao acessar registros do Banco de dados: " . mysql_error());;
		$arquivo = mysql_fetch_row($result);
		unlink("../" . $arquivo[0]);
		unlink("../" . $arquivo[1]);
		break;
		
	case "imagens":
		$query = "SELECT caminho_img, caminho_thumb FROM imagens WHERE cd=" . $cd;
		$result = mysql_query($query) or die("Erro ao acessar registros do Banco de dados: " . mysql_error());;
		$arquivo = mysql_fetch_row($result);
		if(!unlink("../" . $arquivo[0])) die("Erro ao apagar o arquivo!");
		if(substr($arquivo[1], -3) != "gif"){
			if(!unlink("../" . $arquivo[1])) die("Erro ao apagar o arquivo!");
		}
		break;
		
	case "eventos":
		$query = "SELECT cd, path, path_thumb FROM fotos WHERE cd_evento = " . $cd;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
			unlink("../" . $foto["path"]);
			unlink("../" . $foto["path_thumb"]);
			$result2 = mysql_query("DELETE FROM fotos WHERE cd = " . $foto["cd"]);
		}
		break;
		
	/*case "pagina_parceiro":
		$query = "SELECT cd, path, path_thumb FROM pagina_parceiro_fotos WHERE cd_evento = " . $cd;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
			unlink("../" . $foto["path"]);
			unlink("../" . $foto["path_thumb"]);
			$result2 = mysql_query("DELETE FROM fotos WHERE cd = " . $foto["cd"]);
		}
		break;
		
	case "pagina_anunciante":
		$query = "SELECT cd, path, path_thumb FROM fotos WHERE cd_evento = " . $cd;
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
			unlink("../" . $foto["path"]);
			unlink("../" . $foto["path_thumb"]);
			$result2 = mysql_query("DELETE FROM fotos WHERE cd = " . $foto["cd"]);
		}
		break;*/
}

$query = "DELETE FROM " . $oque . " WHERE (cd=" . $cd . ") LIMIT 1";
$result = mysql_query($query) or die("Erro ao remover registros do Banco de dados: " . mysql_error());	
require("../includes/desconectar_mysql.php");

?>
<html>
	<head>
		<title>Salvando as informações</title>
		<? if ($result == 1){ ?>
			<script language="JavaScript" type="text/javascript">
				setTimeout("finaliza();",2000);
				function finaliza(){
				<? if($oque == "eventos") echo("opener.location = 'eventos.php';");
				else { ?>
					if (opener) opener.location = opener.location;
					if (parent) parent.location = parent.location;
					self.close();
				<? } ?>
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