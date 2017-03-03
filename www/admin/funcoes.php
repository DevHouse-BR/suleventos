<?php
error_reporting  (E_ERROR | E_PARSE);

$pagina_inicial = "home.php";
$eventos = "eventos.php";
$quem_somos = "quem_somos.php";
$parceiros = "parceiros.php";
$fale_conosco = "fale_conosco.php";
$dicas = "dicas.php";

$pedacos = explode("/", $_SERVER['PATH_INFO']);
$localizacao = "";
for($i = 0; $i < count($pedacos)-1; $i++){
	$localizacao .= $pedacos[$i] . "/";
}

$LOCAL = "http://" . $_SERVER['HTTP_HOST'] . $localizacao;

#################################################################################################################

function constroi_menu_cabecalho($admin){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas; ?>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td align="right" valign="top">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="6"<? if(!$admin) echo(' background="../imagens/esquerdo_slogan.gif" height="93"'); else echo(' height="139"');?>></td>
						<td<? if(!$admin) echo(' background="../imagens/centro_slogan.gif"'); else echo(' bgcolor="#FF9900"');?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="../imagens/slogan.gif"><img src="../imagens/help.gif" align="right" style="cursor: pointer;" onClick="window.open('help.html', 'HELP', 'width=700,height=500,toolbar=no,status=no,resizable=yes,top=20,left=100,dependent=yes,alwaysRaised=yes,scrollbars=yes');"></td>
						<td<? if(!$admin) echo(' background="../imagens/direito_slogan.gif"')?> width="7"></td>
					</tr>
				</table>
			</td>
		</tr>
		<? if(!$admin){ ?>
			<tr>
				<td align="right" valign="bottom">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td background="../imagens/esquerdo_menu.gif" width="6" height="41"></td>
							<td background="../imagens/centro_menu.gif" align="center" valign="middle"><font class="menu"><a class="menu" href="<?=$pagina_inicial?>">Pagina Inicial</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$eventos?>">Eventos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$quem_somos?>">Quem Somos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$parceiros?>">Parceiros</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$fale_conosco?>">Fale Conosco</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menu" href="<?=$dicas?>">Dicas</a></font></td>
							<td background="../imagens/direito_menu.gif" width="6"></td>
						</tr>
					</table>
				</td>
			</tr>
		<? } ?>
	</table> <?
}

#################################################################################################################

function constroi_tabela_esq($codigo){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas; 
	$qtd = retorna_config("tam_enquete");
	?>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td valign="top" height="256">
				<?
				if ($codigo == -1) constroi_menu_esq();
				else constroi_ficha_tecnica($codigo);
				?>
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="666666">
				<table width="157" cellpadding="0" cellspacing="2" border="0">
					<tr>
						<td class="textonoazul" align="center"><b>Procure Eventos por Data</b>
							<iframe frameborder="0" src="../calendario.php" width="152" height="180" scrolling="no"></iframe>
						</td>
					</tr>
					<tr>
						<td>
							<hr color="#001238">
						</td>
					</tr>
					<tr>
						<td class="textonoazul" align="center"><b>Enquete</b>
							<iframe frameborder="0" src="../enquete.php" width="152" height="<?=$qtd?>" scrolling="no"></iframe>
							<a class="menu" href="javascript: void window.open('wizard_nova_enquete.php', 'ENQUETE', 'width=390,height=380,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Nova Enquete]</a><br>
							<a class="menu" href="javascript: void window.open('gerencia_enquetes.php', 'ENQUETE', 'width=450,height=380,status=no,resizable=yes,top=20,left=100,dependent=yes,alwaysRaised=yes,scrollbars=yes');">[Gerenciar Enquetes]</a>
							<div style="font-size:12px; color:#000000; background-color:#FFFFFF;">Tamanho Enquete<br><input type="text" size="3" maxlength="3" value="<?=$qtd?>" id="tam_enquete">&nbsp;Pixels&nbsp;<input type="button" onClick="window.open('salva_config.php?chave=tam_enquete&valor=' + document.all['tam_enquete'].value, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');" value="OK"></div>
						</td>
					</tr>
					<tr>
						<td>
							<hr color="#001238">
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

<?
}

#################################################################################################################

function constroi_form_busca(){ ?>
	<form method="post" name="busca">
		<div style="vertical-align:middle; width: 100%; text-align:center;">Busca:&nbsp;<input type="text">&nbsp;
			<select>
				<option>Eventos</option>
				<option>Pessoas</option>
				<option>Data</option>
			</select>&nbsp;
			<img src="../imagens/busca.gif">
		</div>
	</form> <?
}

#################################################################################################################

function constroi_rodape(){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas; ?>
	<table width="100%" height="65" bgcolor="#E6E6E6" border="0">
		<tr>
			<td align="center" valign="middle"><font class="menurodape"><a class="menurodape" href="<?=$pagina_inicial?>">Pagina Inicial</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$eventos?>">Eventos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$quem_somos?>">Quem Somos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$parceiros?>">Parceiros</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$fale_conosco?>">Fale Conosco</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$dicas?>">Dicas</a>
				<br><br>
				<font style="font-size:9px; font-weight:normal">Copyright&copy; Century Eventos Ltda. - Todos os direitos reservados</font></font><br>
				<a class="menurodape" style="font-size:9px; font-weight:normal" href="mailto: llvasconcellos@hotmail.com">Webmaster: Leonardo Vasconcellos</a>
			</td>
		</tr>
	</table>
<?
}

#################################################################################################################

function constroi_destaque_eventos($numerodedestaques, $colunas){
	$contador_de_colunas = 0;

	$query = "SELECT * FROM eventos ORDER BY data DESC LIMIT " . $numerodedestaques;
	require("../includes/conectar_mysql.php");
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0){ 
		?>
		<table width="100%" cellspacing="5">
			<tr>
				<td align="center" valign="middle">Não há nenhum evento cadastrado.</td>
			</tr>
		</table>
		<?
	}
	else{
		?><table width="100%" cellspacing="5"><tr><?
		while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT path_thumb FROM fotos WHERE cd=" . $evento["imagem_destaque"];
			$result2 = mysql_query($query);
			$imagem = mysql_fetch_row($result2);
			if($contador_de_colunas == $colunas-1) $style = "";
			else $style = 'style="border-right: 1px solid #001238;"';
			?>
			<td width="33%" align="center" valign="top" <?=$style?>>
				<table width="100%" height="300" border="0">
					<tr>
						<td height="35%" align="center" valign="top"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" src="../<?=$imagem[0]?>"></a></td>
					</tr>
					<tr>
						<td class="celula" valign="top"><?=substr($evento["descricao"], 0, 150) . "...";?></td>
					</tr>
					<tr>
						<td align="center" valign="bottom"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" align="bottom" src="../imagens/veja.gif"></a></td>
					</tr>
				</table>
			</td>
			<?
			$contador_de_colunas++;
			if($contador_de_colunas >= $colunas){
				echo("</tr><tr>");
				$contador_de_colunas = 0;
			}
		}
		?></tr></table><?
	}
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_fotos_evento($codigo_evento, $colunas){
	global $pagina_inicial, $eventos;
	$contador_de_colunas = 0;
		
	require("../includes/conectar_mysql.php");
	$query = "SELECT * FROM eventos, tipodeevento WHERE eventos.tipo=tipodeevento.cd AND eventos.cd=" . $codigo_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar esta imagem?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=fotos&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<a style="font-weight: normal;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal;" class="menurodape" href="<?=$eventos?>">[EVENTOS]</a>&nbsp;-&nbsp;[<?=$evento["tipo"]?>&nbsp;de&nbsp;<?=$evento["nomes"]?>]
	<hr color="#001238" size="1">
	<div><?=$evento["descricao"]?></div>
	<hr size="8" align="center" color="#FD9800">
	<div class="titulosecao"><img align="bottom" src="../imagens/bullet_red.gif">&nbsp;Clique na foto para ampliar</div><br>
	<table width="100%" cellspacing="5" cellpadding="0" border="0"><tr>
	<?
	$query = "SELECT cd, path, path_thumb FROM fotos WHERE cd_evento=" . $codigo_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<td align="center" valign="top" class="conteudo">
			<img style="cursor:pointer;" onClick="javascript: void window.open('../<?=$foto["path"]?>', 'Fotografia', 'width=512,height=384,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="../<?=$foto["path_thumb"]?>">
			<br><a href="javascript: apagar(<?=$foto["cd"]?>);">[Apagar Foto]</a>
		</td>
		<?
		$contador_de_colunas++;
		if($contador_de_colunas >= $colunas){
			echo("</tr><tr>");
			$contador_de_colunas = 0;
		}
	}
	?></tr></table>
	<hr size="8" align="center" color="#FD9800">
	<?
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_menu_esq(){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas;
	?>
	<table width="157" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td>
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td background="../imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="../imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$pagina_inicial?>">Pagina Inicial</a></td>
						<td background="../imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="../imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="../imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$eventos?>">Eventos</a></td>
						<td background="../imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="../imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="../imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$quem_somos?>">Quem Somos</a></td>
						<td background="../imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="../imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="../imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$parceiros?>">Parceiros</a></td>
						<td background="../imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="../imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="../imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$fale_conosco?>">Fale Conosco</a></td>
						<td background="../imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="../imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="../imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$dicas?>">Dicas</a></td>
						<td background="../imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?
}

#################################################################################################################

function constroi_ficha_tecnica($codigo_evento){
	require("../includes/conectar_mysql.php");
	$query = "SELECT * FROM eventos WHERE cd=" . $codigo_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<table width="157" style="border: thin solid #43577C; background-color: #001238; color:#FFFFFF; text-align:center;" class="menu">
		<tr>
			<td>Ficha Técnica</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>Nomes</td>
		</tr>
		<tr>
			<td style="color:#999999;"><?=$evento["nomes"]?></td>
		</tr>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td>Data</td>
		</tr>
		<tr>
			<td style="color:#999999;"><?=date("d/m/Y", $evento["data"])?></td>
		</tr>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td>Local</td>
		</tr>
		<tr>
			<td style="color:#999999;"><?=$evento["local"]?></td>
		</tr>
	<?
	$query = "SELECT parceiros.cd, parceiros.nome, tipodeparceiro.tipo from parceiro_evento, parceiros, tipodeparceiro where tipodeparceiro.cd=parceiros.tipo and parceiro_evento.parceiro=parceiros.cd and parceiro_evento.evento=" . $codigo_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$qtd = mysql_num_rows($result);
	$contador = 0;
	while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<tr>
			<td><hr></td>
		</tr>
		<tr>
			<td><?=$evento["tipo"]?></td>
		</tr>
		<tr>
			<td><a class="fichaparceiro" href="parceiros.php#<?=$evento["cd"]?>"><?=$evento["nome"]?></a></td>
		</tr>
		<?
		$contador++;
		if($contador == $qtd) echo('<tr><td>&nbsp;</td></tr>');
	}
	?>
	</table>
	<?
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_parceiro_em_destaque(){
	
	require("../includes/conectar_mysql.php");
	$query = "SELECT count( * ) FROM parceiros";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$registros = mysql_fetch_row($result);
	if($registros[0] == 0) echo('<table width="100%" bgcolor="#E6E6E6" border="0" class="menurodape" height="100"><tr><td valign="top"><img src="../imagens/bullet_red.gif">Não Há Parceiros Cadastrados</td></tr></table>');
	else {
		if($registros[0] == 1) $query = "SELECT cd, path_thumb, nome from parceiros LIMIT 1";
		else $query = "SELECT cd, path_thumb, nome from parceiros LIMIT " . mt_rand(1, $registros[0]-1) . ",1";
		$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
		$parceiro = mysql_fetch_array($result, MYSQL_ASSOC);
		require("../includes/desconectar_mysql.php");
		?>
		<table width="100%" bgcolor="#E6E6E6" border="0">
			<tr>
				<td valign="top" align="center">
					<table width="100%">
						<tr>
							<td align="left" valign="top"><img src="../imagens/bullet_red.gif"></td>
							<td style="font-size:11px; font-family:'Lucida Sans Unicode', Verdana, Arial; vertical-align:top; text-align: left; font-weight:bold;">Parceiro em Destaque</td>
						</tr>
						<tr>
							<td colspan="2" align="center" valign="top"><img src="../<?=$parceiro["path_thumb"]?>"></td>
						</tr>
						<tr>
							<td colspan="2" align="center" class="conteudo"><a class="menurodape" href="parceiros.php#<?=$parceiro["cd"]?>"><?=$parceiro["nome"]?></a></td>
						</tr>
						<tr>
							<td colspan="2" align="center" valign="top"><img src="../imagens/veja.gif"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?
	}
}

#################################################################################################################

function constroi_outros_eventos(){
	$qtd = retorna_config("qtd_outros_eventos");
	?>
	<table width="100%" style="border: 1px solid #8A91A1;" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<table width="100%" bgcolor="#FFFFFF">
					<tr>
						<td style="font:Arial, Helvetica, sans-serif; font-size: 12px;">Quantidade de Destaques&nbsp;<input type="text" size="2" maxlength="2" value="<?=$qtd?>" id="qtd_outros">&nbsp;<input type="button" onClick="window.open('salva_config.php?chave=qtd_outros_eventos&valor=' + document.all['qtd_outros'].value, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');" value="OK"></td>
					</tr>
				</table>
				<table cellpadding="2" cellspacing="0" border="0">
					<tr>
						<td colspan="2">
							<table width="100%" cellpadding="0" cellspacing="0">
								<td align="left" valign="top"><img src="../imagens/bullet_orange.gif"></td>
								<td style="font-size:10px; font-family:'Lucida Sans Unicode', Verdana, Arial; vertical-align:top; text-align: left; font-weight:bold; color: #FFFFFF;">Outros Eventos</td>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" valign="top" style="font-size:6px;">&nbsp;</td>
					</tr>
					<?
					require("../includes/conectar_mysql.php");
					$query = "SELECT eventos.cd, eventos.nomes, eventos.data, tipodeevento.tipo FROM eventos, tipodeevento WHERE eventos.tipo=tipodeevento.cd ORDER BY eventos.data DESC LIMIT " . $qtd;
					$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
					$contador = 0;
					$numero_registros = mysql_num_rows($result);
					if($numero_registros == 0) {
						echo('<tr><td colspan="2" class="textonoazul">Não Há Eventos Cadastrados</td></tr>');
					}
					while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
						?>
						<tr>
							<td align="left" valign="top" class="menu" style="font-size:10px;" width="8">*</td>
							<td class="textonoazul"><a style="font-size: 10px; font-weight: normal;" class="menu" href="ver_evento.php?cd=<?=$evento["cd"]?>"><?=$evento["tipo"]?>&nbsp;de<br><?=$evento["nomes"]?><br><?=date("d/m/Y", $evento["data"])?></a></td>
						</tr>
						<?
						$contador++;
						if ($contador < $numero_registros) echo('<tr><td colspan="2"><hr></td></tr>');
					}
	?>
				</table>
			</td>
		</tr>
	</table>
	<?
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_eventos($numerodedestaques, $colunas, $pagina){
	$contador_de_colunas = 0;
	
	$limite = ($numerodedestaques * ($pagina -1));
	$query_limit = " LIMIT " . $limite . "," . $numerodedestaques;
	
	if($_GET["busca"] == "data") {
		$data = $_GET["data"];
		$filtro = "AND eventos.data=" . $data;
	}
	?><a href="javascript: void window.open('wizard_novo_evento.php', 'EVENTO', 'width=450,height=470,status=no,resizable=no,top=20,left=100,dependent=no,alwaysRaised=yes');">[Novo Evento]</a><hr><?

	$query = "SELECT eventos.cd, eventos.nomes, eventos.data, eventos.imagem_destaque, tipodeevento.tipo FROM eventos, tipodeevento WHERE eventos.tipo=tipodeevento.cd " . $filtro . " ORDER BY data DESC" . $query_limit;
	require("../includes/conectar_mysql.php");
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	if(mysql_num_rows($result) == 0){ 
		?>
		<table width="100%" cellspacing="5">
			<tr>
				<td align="center" valign="middle">Não há nenhum evento cadastrado.</td>
			</tr>
		</table>
		<?
	}
	else{
		?><table width="100%" cellspacing="5"><tr><?
		if($_GET["busca"] == "data") {
			$data = $_GET["data"];
			$filtro = "WHERE data=" . $data;
		}
		$query = "SELECT COUNT(*) FROM eventos " . $filtro;
		$tmp = mysql_fetch_row(mysql_query($query));
		$eof = $tmp[0];
		
		while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT path_thumb FROM fotos WHERE cd=" . $evento["imagem_destaque"];
			$result2 = mysql_query($query);
			$imagem = mysql_fetch_row($result2);
			?>
			<td width="33%" align="center" valign="top">
				<table width="100%" height="200" border="0">
					<tr>
						<td align="center" valign="top" height="50%"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" src="../<?=$imagem[0]?>"></a></td>
					</tr>
					<tr>
						<td class="celula" valign="top"><center><?=$evento["tipo"]?>&nbsp;de&nbsp;<b><?=$evento["nomes"]?></b><br><?=date("d/m/Y", $evento["data"])?></center></td>
					</tr>
				</table>
			</td>
			<?
			$contador_de_colunas++;
			if($contador_de_colunas >= $colunas){
				echo("</tr><tr>");
				$contador_de_colunas = 0;
			}
		}
		?></tr>
		<tr>
			<td align="left">
				<? 
				if($_GET["busca"] == "data") $busca = "&busca=data&data=" . $data;
				else $busca="";
				if($pagina != 1) echo('<a href="eventos.php?pagina=' . ($pagina-1) . $busca . '"><img border="0" src="../imagens/voltar.gif"></a>'); ?>
			</td>
			<td></td>
			<td align="right">
				<? if($limite + $numerodedestaques < $eof) echo('<a href="eventos.php?pagina=' . ($pagina+1) . $busca . '"><img border="0" src="../imagens/avancar.gif"></a>'); ?>
			</td>
		</tr>
		</table><?
	}
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_parceiros(){
	require("../includes/conectar_mysql.php");
	$query = "SELECT parceiros.cd, parceiros.path, parceiros.path_thumb, parceiros.nome, parceiros.descricao, parceiros.site, parceiros.email, parceiros.telefone, parceiros.endereco, tipodeparceiro.tipo FROM parceiros, tipodeparceiro WHERE parceiros.tipo=tipodeparceiro.cd";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<a href="javascript: void window.open('wizard_novo_parceiro.php', 'PARCEIRO', 'width=400,height=470,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Novo Parceiro]</a>
	<hr>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar este parceiro?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=parceiros&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<table width="100%" class="conteudo"> <?
	while($parceiro = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
			<tr>
				<td width="10%"><a name="<?=$parceiro["cd"]?>"><img border="0" src="../<?=$parceiro["path_thumb"]?>" onClick="javascript: void window.open('../<?=$parceiro["path"]?>', 'Fotografia', 'width=640,height=480,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" style="cursor: pointer;"></a></td>
				<td align="left" valign="bottom">
					<?
					if(strlen($parceiro["site"]) != 0) echo('<a class="menurodape" href="javascript: void window.open(\'http://' . $parceiro["site"] . '\')">' . $parceiro["nome"] . '</a>');
					else echo('<span class="menurodape">' . $parceiro["nome"] . "</span>");
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2"><?=$parceiro["descricao"]?></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><font size="-2"><? if(strlen($parceiro["telefone"]) != 0) echo($parceiro["telefone"]); if(strlen($parceiro["email"]) != 0) echo("&nbsp;-&nbsp;" . $parceiro["email"]); if(strlen($parceiro["endereco"]) != 0) echo("&nbsp;-&nbsp;" . $parceiro["endereco"]); ?></font></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><a href="javascript: apagar(<?=$parceiro["cd"]?>);">[Apagar Parceiro]</a>&nbsp;&nbsp;<a href="javascript: void window.open('wizard_novo_parceiro.php?modo=update&cd=<?=$parceiro["cd"]?>', 'PARCEIRO', 'width=400,height=480,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Edita Parceiro]</a></td>
			</tr>
			<tr>
				<td colspan="2" align="right">&nbsp;</td>
			</tr>
		<?
	}
	?> </table> <?
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_dicas(){
	require("../includes/conectar_mysql.php");
	$query = "SELECT * FROM dicas";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?> 
	<a href="javascript: void window.open('wizard_nova_dica.php', 'DICA', 'width=520,height=500,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Nova Dica]</a>
	<hr>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar esta dica?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=dicas&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<table width="100%" class="conteudo"> <?
	while($dica = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<tr>
			<td><b><?=$dica["dica"]?></b></td>
		</tr>
		<tr>
			<td><?=$dica["descricao"]?></td>
		</tr>
		<tr>
			<td><a href="javascript: apagar(<?=$dica["cd"]?>);">[Apagar Dica]</a>&nbsp;&nbsp;<a href="javascript: void window.open('wizard_nova_dica.php?modo=update&cd=<?=$dica["cd"]?>', 'DICA', 'width=520,height=500,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Edita Dica]</a></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<?
	}
	?> </table> <?
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_dicas_destaque(){
	require("includes/conectar_mysql.php");
	$query = "SELECT count( * ) FROM dicas";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$registros = mysql_fetch_row($result);
	$qtd = $registros[0];
	if(($qtd == 0) || ($qtd == 1)){
		$query = "SELECT * FROM dicas";
	}
	else $query = "SELECT * FROM dicas LIMIT " . mt_rand(1, $qtd-1) . ",1";
	
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$dica = mysql_fetch_array($result, MYSQL_ASSOC);
	require("includes/desconectar_mysql.php");
	if($registros[0] == 0) echo('<div width="100%" class="conteudo">Não há dicas cadastradas</div>');
	else {
		?>
		<div class="titulosecao"><img align="bottom" src="imagens/bullet_red.gif">&nbsp;Dicas</div><br>
		<p><?=$dica["dica"]?></p>
		<p><?=$dica["descricao"]?></p>
		<p align="right"><a href="dicas.php"><img border="0" src="imagens/veja.gif"></a></p>
		<?
	}
}
#################################################################################################################

function constroi_faleconosco(){
	$config = retorna_config("email");
	?>
	<div class="titulosecao"><img align="bottom" src="../imagens/bullet_red.gif">&nbsp;Fale Conosco!</div><br>
	<table width="100%" class="conteudo">
		<form action="fale_conosco.php?modo=enviar" method="post">
		<tr>
			<td align="right" valign="top" width="20%">Nome</td>
			<td><input style="width:100%" type="text" name="nome"></td>
		</tr>
		<tr>
			<td align="right" valign="top">Telefone</td>
			<td><input style="width:100%" type="text" name="telefone"></td>
		</tr>
		<tr>
			<td align="right" valign="top">Email</td>
			<td><input style="width:100%" type="text" name="email"></td>
		</tr>
		<tr>
			<td align="right" valign="top">Mensagem</td>
			<td><textarea style="width:100%" cols="40" rows="15" name="mensagem"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="right" valign="top"><input type="submit" value="enviar"></td>
		</tr>
		</form>
	</table><br><hr>
	Email de Recebimento:&nbsp;<input type="text" maxlength="255" value="<?=$config?>" id="config">&nbsp;<input type="button" onClick="window.open('salva_config.php?chave=email&valor=' + document.all['config'].value, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');" value="OK">
	<?
}

#################################################################################################################

function envia_mensagem(){
	$nome = $_POST["nome"];
	$telefone = $_POST["telefone"];
	$email = $_POST["email"];
	$mensagem = $_POST["mensagem"];
	$destino = retorna_config("email");
	?>
	<div class="titulosecao"><img align="bottom" src="../imagens/bullet_red.gif">&nbsp;Fale Conosco!</div><br>
	<?
	if(mail($destino, "Formulário Fale Conosco - Ferr-eventos.com", $mensagem . "\n\n\nNome: " . $nome . "\nTelefone: " . $telefone, "From: " . $nome . " <" . $email . ">")){ ?>
		<table width="100%" class="conteudo">
			<tr>
				<td>A mensagem foi enviada com sucesso!</td>
			</tr>
			<tr>
				<td><br><br><br><br><br><a href="fale_concosco.php">[Nova Mensagem]</a></td>
			</tr>
		</table>
<?	}
	else{ ?>
		<table width="100%" class="conteudo">
			<tr>
				<td>Problemas no envio da mensagem</td>
			</tr>
			<tr>
				<td><br><br><br><br><br><a href="javascript: history.back();">[Tentar Novamente]</a></td>
			</tr>
		</table>
<?	}
}

#################################################################################################################

function carrega_config(){
	global $CONFIG;
	$handle = fopen ("config.csv","r");
	while ($data = fgetcsv ($handle, 1000, ";")) {
		$CONFIG[$data[0]] = $data[1];
	}
}
function salva_config(){
	global $CONFIG;
	if (!$handle = fopen("config.csv", 'w')) {
         print "Erro abrindo arquivo ($filename)";
         exit;
    }
	foreach ($CONFIG as $key => $value) {
		if (!fwrite($handle, $key . ";" . $value . "\r\n")) {
			print "Erro escrevendo no arquivo (config.csv)";
			exit;
		}
	}
	fclose($handle);
}
function altera_valor($chave, $valor){
	global $CONFIG;
	carrega_config();
	$CONFIG[$chave] = $valor;
	salva_config();
}
function retorna_config($chave){
	global $CONFIG;
	carrega_config();
	$CONFIG = array_flip($CONFIG);
	return array_search($chave, $CONFIG);
}

#################################################################################################################

?>