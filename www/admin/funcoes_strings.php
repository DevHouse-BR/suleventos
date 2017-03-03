<?php
	function verifica_nome_arquivo($teste){
		$CARACTERES_SEM_PERMISSAO = "γυρΓΥΡαινσϊΑΙΝΣΪόάηΗ@#$%&*ͺΊ°?§' "; //caracteres que deverγo ser substituidos
		$TRADUZIDOS_PARA = "aonaonaeiouaeiouuucc_____________"; //por estes caracteres.
		
		return strtolower(strtr($teste,$CARACTERES_SEM_PERMISSAO, $TRADUZIDOS_PARA));
	}
?>