<?php
require("permissao_documento.php");

	#####################     Constantes     ###################################################
	$LARGURA_IMG_FINAL  = "1024";	# Largura da imagem original guardada no servidor
	$ALTURA_IMG_FINAL	= "768";	# Altura da imagem original guardada no servidor
	
	$LARGURA_THUMB  = 120;  # Largura do thumbnail						
	$ALTURA_THUMB = 90;   	# Altura do thumbnail
	
	$IMG_ROOT = "../img/";	# Diretório onde as imagens serão transmitidas
	$THUMB_ROOT = "thumb/";	# Diretório onde os thumbnails serão transmitidos
	
	$JPG_QUALITY	=	90;  # Qualidade do JPG criado.
	
	$CARACTERES_SEM_PERMISSAO = "ÂÊÎÔÛâêîôûãõñÃÕÑáéíóúÁÉÍÓÚüÜçÇ@#$%&*ªº°?§' "; //caracteres que deverão ser substituidos
	$TRADUZIDOS_PARA = "aeiouaeiouaonaonaeiouaeiouuucc_____________"; //por estes caracteres.
	
	$HTML_RETORNO1 = "<html><head><title>Erro no Upload de Imagem</title><script language='Javascript'>function retorna(){ window.history.back();}</script></head><body><center><h3>Já existe uma imagem com este nome. Mude-o e tente novamente.</h3></center><br><a href='Javascript: retorna()'>Voltar</a></body></html>";
	$HTML_RETORNO2 = "<html><head><title>Erro no Upload de Imagem</title><script language='Javascript'>alert('São permitidos uploads de imagens apenas do tipo jpg.'); function retorna(){ window.history.back();}</script></head><body><a href='Javascript: retorna()'>Voltar</a></body></html>";
	$HTML_RETORNO3 = "<html><head><title>Erro no Upload de Imagem</title><script language='Javascript'>function retorna(){ window.history.back();}</script></head><body><center><h3>Erro ao utilizar função imagecreate().</h3></center><br><a href='Javascript: retorna()'>Voltar</a></body></html>";
	$HTML_RETORNO4 = "<html><head><title>Erro no Upload de Imagem</title><script language='Javascript'>function retorna(){ window.history.back();}</script></head><body><center><h3>Erro ao utilizar função imagecopyresized().</h3></center><br><a href='Javascript: retorna()'>Voltar</a></body></html>";

	#############################################################################################

	$imagem_array = $_FILES["image"];
	$imagem_arquivo = $imagem_array["tmp_name"];
	$imagem_info = getimagesize($imagem_arquivo);
	$imagem_largura = $imagem_info[0];
	$imagem_altura = $imagem_info[1];
	$imagem_tipo = $imagem_info[2];
	$nome_da_imagem = strtolower(strtr($imagem_array["name"],$CARACTERES_SEM_PERMISSAO, $TRADUZIDOS_PARA));
	if ($imagem_tipo != "1"){
		if($imagem_tipo != 2) die($HTML_RETORNO2);
		if(file_exists( $IMG_ROOT . "/" . $nome_da_imagem)) die($HTML_RETORNO1);
		
		$imagem_original = imagecreatefromjpeg($imagem_arquivo);
		
		########################## Imagem Grande ###################################################
		
		if($imagem_largura > $imagem_altura) $fator_proporcao = $LARGURA_IMG_FINAL / $imagem_largura;
		else $fator_proporcao = $ALTURA_IMG_FINAL / $imagem_altura;
		if ($fator_proporcao > 1) $fator_proporcao = 1;
		
		$nova_largura_img = $imagem_largura * $fator_proporcao;
		$nova_altura_img = $imagem_altura * $fator_proporcao;
		
		$nova_imagem = imagecreatetruecolor($nova_largura_img,$nova_altura_img) or die($HTML_RETORNO3); 
		imagecopyresampled($nova_imagem, $imagem_original, 0, 0, 0, 0, $nova_largura_img, $nova_altura_img, $imagem_largura, $imagem_altura) or die($HTML_RETORNO4); 
		
		$nova_imagem_grande = $IMG_ROOT . $nome_da_imagem;
		
		imagejpeg($nova_imagem, $nova_imagem_grande, $JPG_QUALITY);
		
		#############################################################################################
		
		
		############################### Thumbnail ###################################################
		
		if($imagem_largura > $imagem_altura) $fator_proporcao = $LARGURA_THUMB / $imagem_largura;
		else $fator_proporcao = $ALTURA_THUMB / $imagem_altura;
		
		$nova_largura_thumb = $imagem_largura * $fator_proporcao;
		$nova_altura_thumb = $imagem_altura * $fator_proporcao;
		

		$nova_imagem = imagecreatetruecolor($nova_largura_thumb,$nova_altura_thumb) or die($HTML_RETORNO3); 
		imagecopyresampled($nova_imagem, $imagem_original, 0, 0, 0, 0, $nova_largura_thumb, $nova_altura_thumb, $imagem_largura, $imagem_altura) or die($HTML_RETORNO4); 
		
		$nova_imagem_thumb = $IMG_ROOT . $THUMB_ROOT . "thumb_" . $nome_da_imagem;
		
		imagejpeg($nova_imagem, $nova_imagem_thumb, $JPG_QUALITY);
		
		#############################################################################################
	}
	else{
		###################################### GIF ##################################################
		if (move_uploaded_file($_FILES['image']['tmp_name'], $IMG_ROOT . $nome_da_imagem)) {
			$nova_imagem_thumb = $IMG_ROOT . $nome_da_imagem;
			$nova_imagem_grande = $IMG_ROOT . $nome_da_imagem;
			$nova_largura_img = $imagem_largura;
			$nova_altura_img = $imagem_altura ;
		} 
	}
	
	########################## Gravação no Banco de Dados ##############################################
	$nova_imagem_grande = str_replace( "../", "",$nova_imagem_grande);
	$nova_imagem_thumb = str_replace( "../", "",$nova_imagem_thumb);
	require("../includes/conectar_mysql.php");
	
	$query = "INSERT INTO imagens (nome, tamanho, caminho_img, caminho_thumb) VALUES ('";
	$query .= $nome_da_imagem ."','";
	$query .= round($nova_largura_img) . " X " . round($nova_altura_img) ."','";
	$query .= $nova_imagem_grande ."','";
	$query .= $nova_imagem_thumb ."')";
	
	if (!mysql_query($query)){
		unlink($nova_imagem_grande);
		unlink($nova_imagem_thumb);
		die("<html>\n<head>\n<title>Erro no Upoload de Imagem</title>\n<script language='Javascript'>\nfunction retorna(){\n window.history.back();\n}\n</script>\n</head>\n<body>\n<center><h3>Problemas para gravar o registro da imagem no banco de dados. Erro: " . mysql_error() . "</h3></center><br>\n<a href='Javascript: retorna()'>Voltar</a>\n</body>\n</html>");
	}

	$query = "SELECT cd FROM imagens WHERE nome='" . $nome_da_imagem . "'";
	$result = mysql_query($query);
	$cd = mysql_fetch_row($result);
	
	require("../includes/desconectar_mysql.php");
	
	#############################################################################################
	
	if ($_POST["img_full"])	echo("<html>\n<head>\n<title>Upload Realizado Com Sucesso!</title>\n<script language='Javascript'>\n window.open('edita_img.php?cd=" . $cd[0] . "', 'IMG','status=no,resizable=yes,top=0,left=0,dependent=yes,alwaysRaised=yes,scrollbars=yes');\nfunction retorna(){\n window.history.back(); \n}\n</script>\n</head>\n<body>\n<table width='100%' border='0'>\n<tr>\n<td align='center'>Operação realizada com Sucesso!<br><a href='Javascript: retorna()'>Voltar</a></td>\n</tr>\n</table>\n</body>\n</html>");
	else echo("<html>\n<head>\n<title>Upload Realizado Com Sucesso!</title>\n<script language='Javascript'>\nfunction retorna(){\n window.history.back(); \n}\n</script>\n</head>\n<body>\n<table width='100%' border='0'>\n<tr>\n<td align='center'>Operação realizada com Sucesso!<br><a href='Javascript: retorna()'>Voltar</a></td>\n</tr>\n</table>\n</body>\n</html>");

function gd_version() { 
   static $gd_version_number = null; 
   if ($gd_version_number === null) { 
       // Use output buffering to get results from phpinfo() 
       // without disturbing the page we're in.  Output 
       // buffering is "stackable" so we don't even have to 
       // worry about previous or encompassing buffering. 
       ob_start(); 
       phpinfo(8); 
       $module_info = ob_get_contents(); 
       ob_end_clean(); 
       if (preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", 
               $module_info,$matches)) { 
           $gd_version_number = $matches[1]; 
       } else { 
           $gd_version_number = 0; 
       } 
   } 
   return $gd_version_number; 
}
?>