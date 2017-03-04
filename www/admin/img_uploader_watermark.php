<?php
//require("permissao_documento.php");
	function upload_imagem($IMG_ROOT, $imagem_array, $nome, $LARGURA_IMG_FINAL, $ALTURA_IMG_FINAL, $LARGURA_THUMB, $ALTURA_THUMB, $cria_thumb, $WATERMARK){
		#####################     Constantes     ###################################################
		
		$THUMB_ROOT = "thumb/";	# Diretório onde os thumbnails serão transmitidos
		
		$JPG_QUALITY	=	90;  # Qualidade do JPG criado.
		
		$HTML_RETORNO1 = "<html><head><title>Erro no Upload de Imagem</title><script language='Javascript'>function retorna(){ window.history.back();}</script></head><body><center><h3>Já existe uma imagem com este nome. Mude-o e tente novamente.</h3></center><br><a href='Javascript: retorna()'>Voltar</a></body></html>";
		$HTML_RETORNO2 = "<html><head><title>Erro no Upload de Imagem</title><script language='Javascript'>alert('São permitidos uploads de imagens apenas do tipo jpg.'); function retorna(){ window.history.back();}</script></head><body><a href='Javascript: retorna()'>Voltar</a></body></html>";
		$HTML_RETORNO3 = "<html><head><title>Erro no Upload de Imagem</title><script language='Javascript'>function retorna(){ window.history.back();}</script></head><body><center><h3>Erro ao utilizar função imagecreate().</h3></center><br><a href='Javascript: retorna()'>Voltar</a></body></html>";
		$HTML_RETORNO4 = "<html><head><title>Erro no Upload de Imagem</title><script language='Javascript'>function retorna(){ window.history.back();}</script></head><body><center><h3>Erro ao utilizar função imagecopyresized().</h3></center><br><a href='Javascript: retorna()'>Voltar</a></body></html>";
	
		#############################################################################################

		$imagem_arquivo = $imagem_array["tmp_name"];
		$imagem_info = getimagesize($imagem_arquivo);
		$imagem_largura = $imagem_info[0];
		$imagem_altura = $imagem_info[1];
		$imagem_tipo = $imagem_info[2];
		
		include("funcoes_strings.php");
		
		if (strlen($nome) == 0)	$nome_da_imagem = verifica_nome_arquivo($imagem_array["name"]);
		else $nome_da_imagem = verifica_nome_arquivo($nome);
		
		if ($imagem_tipo == "2"){
			
			if(file_exists( $IMG_ROOT . "/" . $nome_da_imagem)){
				if(file_exists($IMG_ROOT . "/" . str_replace(".jpg", "_b.jpg", $nome_da_imagem))){
					if(file_exists( $IMG_ROOT . "/" . str_replace(".jpg", "_c.jpg", $nome_da_imagem))) die($HTML_RETORNO1);
					else $nome_da_imagem = str_replace(".jpg", "_c.jpg", $nome_da_imagem);
				}
				else $nome_da_imagem = str_replace(".jpg", "_b.jpg", $nome_da_imagem);
			}
			
			$imagem_original = imagecreatefromjpeg($imagem_arquivo);
			
			########################## Imagem Grande ###################################################
			
			if($imagem_largura > $imagem_altura) $fator_proporcao = $LARGURA_IMG_FINAL / $imagem_largura;
			else $fator_proporcao = $ALTURA_IMG_FINAL / $imagem_altura;
			if ($fator_proporcao > 1) $fator_proporcao = 1;
			
			$nova_largura_img = $imagem_largura * $fator_proporcao;
			$nova_altura_img = $imagem_altura * $fator_proporcao;
			
			$nova_imagem = imagecreatetruecolor($nova_largura_img,$nova_altura_img) or die($HTML_RETORNO3); 
			imagecopyresampled($nova_imagem, $imagem_original, 0, 0, 0, 0, $nova_largura_img, $nova_altura_img, $imagem_largura, $imagem_altura) or die($HTML_RETORNO4); 
			
			if($WATERMARK){
				$watermark = imagecreatefrompng("../imagens/watermark.png");
				imagecopy($nova_imagem, $watermark, ($nova_largura_img - 180), ($nova_altura_img - 38), 0, 0, 180, 34);
			}
						
			$nova_imagem_grande = $IMG_ROOT . "/" . $nome_da_imagem;
			
			imagejpeg($nova_imagem, $nova_imagem_grande, $JPG_QUALITY);
			
			#############################################################################################
			
			if ($cria_thumb){
				############################### Thumbnail ###################################################
				
				if($imagem_largura > $imagem_altura) $fator_proporcao = $LARGURA_THUMB / $imagem_largura;
				else $fator_proporcao = $ALTURA_THUMB / $imagem_altura;
				
				$nova_largura_thumb = $imagem_largura * $fator_proporcao;
				$nova_altura_thumb = $imagem_altura * $fator_proporcao;
				

				$nova_imagem = imagecreatetruecolor($nova_largura_thumb,$nova_altura_thumb) or die($HTML_RETORNO3); 
				imagecopyresampled($nova_imagem, $imagem_original, 0, 0, 0, 0, $nova_largura_thumb, $nova_altura_thumb, $imagem_largura, $imagem_altura) or die($HTML_RETORNO4); 
				
				$nova_imagem_thumb = $IMG_ROOT . "/" . $THUMB_ROOT . "thumb_" . $nome_da_imagem;
				
				imagejpeg($nova_imagem, $nova_imagem_thumb, $JPG_QUALITY);
				
				#############################################################################################
			}
		}
		else{
			###################################### GIF ##################################################
			if (move_uploaded_file($_FILES['image']['tmp_name'], $IMG_ROOT . "/" . $nome_da_imagem)) {
				$nova_imagem_thumb = $IMG_ROOT . "/" . $nome_da_imagem;
				$nova_imagem_grande = $IMG_ROOT . "/" . $nome_da_imagem;
				$nova_largura_img = $imagem_largura;
				$nova_altura_img = $imagem_altura ;
			} 
		}
		$nova_imagem_grande = str_replace( "../", "",$nova_imagem_grande);
		$nova_imagem_thumb = str_replace( "../", "",$nova_imagem_thumb);
		
		return array($nova_imagem_grande, $nova_imagem_thumb, $tamanhoarquivo, $nova_largura_img, $nova_altura_img);
	}
?>