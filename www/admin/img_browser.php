<?php
require("permissao_documento.php");
error_reporting  (E_ERROR | E_PARSE);
$modo = $_GET["modo"];
$pagina = $_POST["pagina"];
$qtd = $_POST["qtd"];
$linha = $_POST["linha"];

if ($pagina < 1 || $pagina == ""){
	$pagina = 1;
}
if ($qtd == ""){
	$qtd = 12;
}
if ($linha == ""){
	$linha = 4;
}

require("../includes/conectar_mysql.php");

$limite = ($qtd * ($pagina -1));

$query_limit = " LIMIT " . $limite . "," . $qtd;


if ($filtro != "") $result = mysql_query("SELECT * FROM imagens" . $filtro_sql . $query_limit) or die("Erro ao acessar registros no Banco de dados: " . mysql_error());	
else $result = mysql_query("SELECT * FROM imagens order by nome" . $query_limit) or die("Erro ao acessar registros no Banco de dados: " . mysql_error());	
$query = "SELECT COUNT(*) FROM imagens";
if ($filtro != ""){
	$query .= $filtro_sql;
}
$tmp = mysql_fetch_row(mysql_query($query));
$eof = $tmp[0];
?>
<html>
	<head>
		<title><?php if($modo == "editor") echo("Escolha Uma Imagem Para Ser Inserida no Texto."); else echo("Imagens");?></title>
		<style type="text/css">
			.label{ font-family:Arial, Helvetica, sans-serif; font-size:10px;
			}
			.textfield{ font-family:Arial, Helvetica, sans-serif; font-size:10px;
			}
			.botao{ font-family:Arial, Helvetica, sans-serif; font-size:10px;
			}
		</style>
		<script language="JavaScript" type="text/javascript">
			function nova(){
				window.open('img_form.php', 'Nova_Imagem', 'width=410,height=60,status=no,resizable=no,top=20,left=20,dependent=yes,alwaysRaised=yes');
			}
			function edita_img(codigo){
				window.open('edita_img.php?cd=' + codigo, 'Edita_Imagem', 'width=800,height=550,status=no,resizable=yes,top=0,left=0,dependent=yes,alwaysRaised=yes,scrollbars=yes');
			}
			function mudapagina(direcao){
				var pagina = 0;
				pagina = document.all["paginacao"].pagina.value;
				if (direcao == "next") pagina++;
				else pagina--;
				if (direcao == "") pagina = 1;
				document.all["paginacao"].pagina.value = pagina;
				document.all["paginacao"].submit();
			}
			function mudapagina2(direcao){
				var pagina = 0;
				pagina = document.all["paginacao2"].pagina.value;
				if (direcao == "next") pagina++;
				else pagina--;
				if (direcao == "") pagina = 1;
				document.all["paginacao2"].pagina.value = pagina;
				document.all["paginacao2"].submit();
			}
		<?php
			if($modo == "editor"){ ?>
			function insere_img(caminho, tamanho){
				var alinhamento = paginacao.alinhar.value;
				var sel = opener.EditBox.document.selection;
				if (sel!=null) {
					var rng = sel.createRange();
					if (rng!=null)
						if(document.all["paginacao"].coloca_thumb.checked){
							var dimensoes = tamanho.split("X");
							var width = dimensoes[0];
							var height = dimensoes[1];
							var tmp = caminho.split("/")
							var nome = tmp[tmp.length - 1];
							var chaminho_thumb = tmp.join("/")
							chaminho_thumb = chaminho_thumb.replace(nome, "thumb/thumb_" + nome);
							rng.pasteHTML("<a href=\"" + caminho + "\" target=\"_blank\"><IMG border=\"0\" src=\"" + chaminho_thumb + "\" align=\"" + alinhamento + "\"></a>");
						}
						else rng.pasteHTML("<IMG src=\"" + caminho + "\" align=\"" + alinhamento + "\">");
				}
				self.close();
			}
		<?php }
			if($modo == "caminho"){ 
			$onde = $_GET["onde"]; ?>
			function insere_img(caminho){
				opener.<?=$onde?>.value = caminho;
				self.close();
			}
		<?php } ?>
		</script>
	</head>
	<body bottommargin="0" leftmargin="0" rightmargin="0" topmargin="0">
		<table class="tabela" width="100%">
		<FORM name="paginacao" action="img_browser.php<?php if($modo == "editor") echo("?modo=editor"); if ($modo == "caminho") echo("?modo=caminho&onde=" . $_GET["onde"]);?>" method="post">
			<tr>
				<td class="label" width="10%"><input type="button" class="botao" onClick="javascript: nova();" value="Nova" style="width: 100%;"></td>
					<input type="hidden" name="pagina" value="<?=$pagina?>">
				<?php if($modo == "editor") echo("<td class=\"label\"><input type=\"checkbox\" class=\"checkbox\" name=\"coloca_thumb\" id=\"coloca_thumb\">Insere o Thumbnail no texto.</td><td class=\"label\">Alinhamento: <select name=\"alinhar\" class=\"textfield\"><option value=\"right\">Direita</option><option value=\"left\">Esquerda</option><option value=\"center\">Centralizado</option></td>"); ?>
				<td class="label" align="center">Imagens/Pagina:&nbsp;<input type="text" class="textfield" name="qtd" value="<?=$qtd?>" onBlur="mudapagina('');" size="3" maxlength="3" alt="Digite a quantidade de imagens por página a serem mostradas."></td>
				<td class="label" align="center">Imagens/Linha:&nbsp;<input type="text" class="textfield" name="linha" value="<?=$linha?>" onBlur="mudapagina('');" size="3" maxlength="3" alt="Digite a quantidade de imagens por linha a serem mostradas."></td>
				<?php if($modo != "editor") { ?> <td class="label" align="center"><?=$eof?>&nbsp;imagens cadastradas.</td><?php } ?>				
			</tr>
		</form>
		</table>
		<table class="tabela" width="100%">
			<tr>
			<?php
				$j = 0; 
				for($i = 0; $i < $qtd; $i++){
					$img = mysql_fetch_row($result); ?>
					<td class="textfield" align="center">
					<?php if($img[4] != ""){ ?>
						<img border="0" src="<?="../" . $img[4]?>" style="cursor: hand;" onClick="edita_img('<?=$img[0]?>');"><br>
						<b>
							<?php
								if(trim($modo) == "caminho") echo("<a href=\"javascript: insere_img('" . $img[3] . "')\">" . $img[1] . "</a>");
								elseif(trim($modo) == "editor") echo("<a href=\"javascript: insere_img('" . $img[3] . "', '" . $img[2] . "')\">" . $img[1] . "</a>");
								else echo($img[1]);
							?>
						</b><br>
						<?=$img[2]?>&nbsp;Pixels
					<?php }
						else echo("&nbsp;");
					?>
					</td>
				<?php 
					$j++;
					if ($j == $linha){
						if ($i == ($qtd-1)) echo("</tr>");
						else echo("</tr><tr>");
						$j = 0;
					}
				} 
			?>
		</table>
		<table class="tabela" width="100%">
		<FORM name="paginacao2" action="img_browser.php<?php if($modo == "editor") echo("?modo=editor"); if ($modo == "caminho") echo("?modo=caminho&onde=" . $_GET["onde"]);?>" method="post">
			<tr>
				<td width="70%">&nbsp;</td>
				<input type="hidden" name="pagina" value="<?=$pagina?>">
				<?php if($modo != "editor") { ?> <td class="label" align="center"><?=$eof?>&nbsp;imagens cadastradas.</td><?php } ?>
				<td class="label" width="15%"><input type="button" style="width: 100%;" class="botao" name="back" value="<" onclick="mudapagina2('back');" <?php if($pagina == 0 || $pagina == 1) echo("disabled");?>></td>
				<td class="label" width="15%"><input type="button" style="width: 100%;" class="botao" name="next" value=">" onclick="mudapagina2('next');" <?php if($limite + $qtd >= $eof) echo("disabled");?>></td>				
			</tr>
		</form>
		</table>
	</body>
</html>
<?php require("../includes/desconectar_mysql.php"); ?>