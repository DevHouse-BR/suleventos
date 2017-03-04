<?php
error_reporting  (E_ERROR | E_PARSE);

$pagina_inicial = "home.php";
$eventos = "eventos.php";
$quem_somos = "quem_somos.php";
$parceiros = "parceiros.php";
$fale_conosco = "fale_conosco.php";
$dicas = "dicas.php";
$cartorios = "cartorios.php";
$igrejas = "igrejas.php";
$anunciantes = "anunciantes.php";
$cartao_fidelidade = "cartao_fidelidade.php";

$pedacos = explode("/", $_SERVER['PATH_INFO']);
$localizacao = "";
for($i = 0; $i < count($pedacos)-1; $i++){
	$localizacao .= $pedacos[$i] . "/";
}

$LOCAL = "http://" . $_SERVER['HTTP_HOST'] . $localizacao;

#################################################################################################################

function constroi_menu_cabecalho($admin){
	?>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="601" height="139" id="Novo Cabecalho" align="middle">
		<param name="allowScriptAccess" value="sameDomain" />
		<param name="movie" value="../imagens/cabecalho.swf" />
		<param name="quality" value="high" />
		<param name="bgcolor" value="#000000" />
		<embed src="../imagens/cabecalho.swf" quality="high" bgcolor="#000000" width="601" height="139" name="Novo Cabecalho" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
	<?
}

#################################################################################################################

function constroi_tabela_esq($codigo){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas; 
	$qtd = retorna_config("tam_enquete");
	?>
	<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td valign="top">
				<? constroi_menu_esq();	?>
			</td>
		</tr>
		<tr>
			<td style="font-size: 5px;">&nbsp;</td>
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
		<tr>
			<td bgcolor="666666" height="100%">&nbsp;</td>
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
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas, $cartorios, $igrejas, $anunciantes; ?>
	<table width="100%" height="65" bgcolor="#E6E6E6" border="0">
		<tr>
			<td align="center" valign="middle"><font class="menurodape"><a class="menurodape" href="<?=$pagina_inicial?>">Pagina Inicial</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$eventos?>">Eventos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$quem_somos?>">Quem Somos</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$parceiros?>">Parceiros</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$anunciantes?>">Anunciantes</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$fale_conosco?>">Fale Conosco</a><br><a class="menurodape" href="<?=$dicas?>">Dicas e Curiosidades</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$cartorios?>">Cartórios</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a class="menurodape" href="<?=$igrejas?>">Igrejas</a>
				<br><br>
				<font style="font-size:9px; font-weight:normal">Copyright&copy; Century Eventos Ltda. - Todos os direitos reservados</font></font><br>
				<a class="menurodape" style="font-size:9px; font-weight:normal" href="mailto: llv@brturbo.com">Webmaster: Leonardo Vasconcellos</a>
			</td>
		</tr>
	</table>
<?
}

#################################################################################################################

function constroi_destaque_eventos($numerodedestaques, $colunas){
	$contador_de_colunas = 0;

	$query = "SELECT * FROM eventos WHERE (DATA < " . mktime() . ") AND (status = 0) ORDER BY data DESC LIMIT " . $numerodedestaques;
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
						<td class="celula" valign="top">
							<?
							if(strlen($evento["pginicial"] == 0)) echo(substr($evento["descricao"], 0, 150) . "...");
							else echo(substr($evento["pginicial"], 0, 150) . "...");
							?>
						</td>
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
	<?
		if(($evento["status"] == 1) && (strlen($evento["listadecasamento"]) != 0)){
			?>
			<div class="titulosecao">Lista de Presentes:<br><a href="<?=$evento["listadecasamento"]?>"><?=$evento["listadecasamento"]?></a></div><br>
			<?
		}
	?>
	<hr size="8" align="center" color="#FD9800">
	<div class="titulosecao"><img align="bottom" src="../imagens/bullet_red.gif">&nbsp;Clique na foto para ampliar</div><br>
	<table width="100%" cellspacing="5" cellpadding="0" border="0"><tr>
	<?
	$query = "SELECT cd, path, path_thumb FROM fotos WHERE cd_evento=" . $codigo_evento . " ORDER BY cd";
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

function constroi_menu_esq_old(){
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
						<td background="../imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$dicas?>">Dicas e Curiosidades</a></td>
						<td background="../imagens/direito_menu.gif" width="6"></td>
					</tr>
					<tr>
						<td colspan="3" height="2"></td>
					</tr>
					<tr>
						<td background="../imagens/esquerdo_menu.gif" width="6" height="41"></td>
						<td background="../imagens/centro_menu.gif" align="center" valign="middle"><a class="menu" href="<?=$dicas?>">Cartórios</a></td>
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


function constroi_tabela_igrejas(){
	global $pagina_inicial, $parceiros;
	require("../includes/conectar_mysql.php");
	$query = "SELECT * FROM igrejas";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<a href="javascript: void window.open('wizard_nova_igreja.php', 'IGREJA', 'width=400,height=270,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Nova Igreja]</a>
	<hr>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar esta igreja?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=igrejas&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<table width="100%" class="conteudo"> <?
	while($igreja = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
			<tr>
				<td align="left" valign="bottom"><a name="<?=$igreja["cd"]?>"><span class="menurodape"><?=$igreja["nome"]?></a></td>
			</tr>
			<tr>
				<td colspan="2"><?=$igreja["descricao"]?></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><font size="-2"><? if(strlen($igreja["telefone"]) != 0) echo($igreja["telefone"]); if(strlen($igreja["email"]) != 0) echo("&nbsp;-&nbsp;" . $igreja["email"]); if(strlen($igreja["endereco"]) != 0) echo("&nbsp;-&nbsp;" . $igreja["endereco"]); ?></font></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<a href="javascript: apagar(<?=$igreja["cd"]?>);">[Apagar Igreja]</a>&nbsp;&nbsp;
					<a href="javascript: void window.open('wizard_nova_igreja.php?modo=update&cd=<?=$igreja["cd"]?>', 'Igreja', 'width=400,height=270,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Edita Igreja]</a>&nbsp;&nbsp;
				</td>
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

function constroi_menu_esq(){
	global $pagina_inicial, $eventos, $quem_somos, $parceiros, $fale_conosco, $dicas, $cartorios, $igrejas, $anunciantes, $cartao_fidelidade;
	?>
	<script language="javascript" type="text/javascript">
		var saiu = 0;
		var intervalo;
		var count = 0;
		var intervalofade;
		
		function start(){
			count = 0;
			saiu = 0;
			intervalo = setInterval(checamouse, 500);
		}
		function checamouse(){
			if (saiu != 0){
				escondemenu();
				clearInterval(intervalo);
				saiu = 0;
				count = 0;
			}
		}
		function escondemenu(){
			document.all["menu_1"].innerHTML = "";
			document.all["menu_1"].style.visibility = "hidden";
			document.all["menu_2"].innerHTML = "";
			document.all["menu_2"].style.visibility = "hidden";
			document.all["menu_3"].innerHTML = "";
			document.all["menu_3"].style.visibility = "hidden";
			document.all["menu_4"].innerHTML = "";
			document.all["menu_4"].style.visibility = "hidden";
			document.all["menu_5"].innerHTML = "";
			document.all["menu_5"].style.visibility = "hidden";
			<?
			$counter = 6;
			require("../includes/conectar_mysql.php");
			$result = mysql_query("SELECT cd FROM nomedesecao");
			while($secao = mysql_fetch_assoc($result)){
				?>
				document.all["menu_<?=$counter?>"].innerHTML = "";
				document.all["menu_<?=$counter?>"].style.visibility = "hidden";
				<?
				$counter++;
			}
			?>
		}
		function mostramenu1(){
			escondemenu();		
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("../includes/conectar_mysql.php");
			$result = mysql_query("SELECT DISTINCT parceiros.tipo as tipo1, tipodeparceiro.tipo as tipo2 FROM parceiros, tipodeparceiro WHERE parceiros.tipo=tipodeparceiro.cd ORDER BY tipodeparceiro.tipo");
			while($tipos = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"parceiros.php?tipo=" . $tipos["tipo1"] . "\">" . $tipos["tipo2"] . "</a></li></td></tr>'" . chr(10));
			require("../includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_1"].innerHTML = html;
			document.all["menu_1"].style.position = "absolute";
			document.all["menu_1"].style.zIndex = "99999";
			document.all["menu_1"].style.visibility = "visible";
			document.all["menu_1"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		function mostramenu2(){
			escondemenu();		
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("../includes/conectar_mysql.php");
			$result = mysql_query("SELECT cd, dica FROM dicas ORDER BY dica");
			while($dica = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"dicas.php#" . $dica["cd"] . "\">" . ucwords(strtolower($dica["dica"])) . "</a></li></td></tr>'" . chr(10));
			require("../includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_2"].innerHTML = html;
			document.all["menu_2"].style.position = "absolute";
			document.all["menu_2"].style.zIndex = "99999";
			document.all["menu_2"].style.visibility = "visible";
			document.all["menu_2"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		function mostramenu3(){
			escondemenu();		
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("../includes/conectar_mysql.php");
			$result = mysql_query("SELECT DISTINCT anunciantes.tipo as tipo1, tipodeanunciante.tipo as tipo2 FROM anunciantes, tipodeanunciante WHERE anunciantes.tipo=tipodeanunciante.cd ORDER BY tipodeanunciante.tipo");
			while($tipos = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"anunciantes.php?tipo=" . $tipos["tipo1"] . "\">" . $tipos["tipo2"] . "</a></li></td></tr>'" . chr(10));
			require("../includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_3"].innerHTML = html;
			document.all["menu_3"].style.position = "absolute";
			document.all["menu_3"].style.zIndex = "99999";
			document.all["menu_3"].style.visibility = "visible";
			document.all["menu_3"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		function mostramenu4(){
			escondemenu();		
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("../includes/conectar_mysql.php");
			$result = mysql_query("SELECT cd, nome FROM igrejas ORDER BY nome");
			while($igreja = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"igrejas.php#" . $igreja["cd"] . "\">" . ucwords(strtolower($igreja["nome"])) . "</a></li></td></tr>'" . chr(10));
			require("../includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_4"].innerHTML = html;
			document.all["menu_4"].style.position = "absolute";
			document.all["menu_4"].style.zIndex = "99999";
			document.all["menu_4"].style.visibility = "visible";
			document.all["menu_4"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		function mostramenu5(){
			escondemenu();		
			var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
			<?
			require("../includes/conectar_mysql.php");
			$result = mysql_query("SELECT cd, cartorio FROM cartorios ORDER BY cartorio");
			while($cartorio = mysql_fetch_assoc($result)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"cartorios.php#" . $cartorio["cd"] . "\">" . ucwords(strtolower($cartorio["cartorio"])) . "</a></li></td></tr>'" . chr(10));
			require("../includes/desconectar_mysql.php");
			?>
				+ '</table>';
			document.all["menu_5"].innerHTML = html;
			document.all["menu_5"].style.position = "absolute";
			document.all["menu_5"].style.zIndex = "99999";
			document.all["menu_5"].style.visibility = "visible";
			document.all["menu_5"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
		}
		<?	
		$counter = 6;
		require("../includes/conectar_mysql.php");
		$result = mysql_query("SELECT * FROM nomedesecao ORDER BY nome");
		while($secao = mysql_fetch_assoc($result)){
			?>
			function mostramenu<?=$counter?>(){
				escondemenu();		
				var html = 	'<table border="0" width="190" bgcolor="#E5E5E5">'
				<?
				require("../includes/conectar_mysql.php");
				$result2 = mysql_query("SELECT cd, titulo FROM secoes WHERE nomedesecao=" . $secao["cd"] . " ORDER BY titulo");
				while($subsecao = mysql_fetch_assoc($result2)) echo("+ '<tr><td width=\"5\">&nbsp;</td><td><li><a class=\"menuesquerdo\" href=\"secao.php?secao=" . $secao["cd"] . "#" . $subsecao["cd"] . "\">" . ucwords(strtolower($subsecao["titulo"])) . "</a></li></td></tr>'" . chr(10));
				require("../includes/desconectar_mysql.php");
				if(mysql_num_rows($result2) != 0) echo('document.all["menu_' . $counter . '"].innerHTML = html;');
				?>
				document.all["menu_<?=$counter?>"].style.position = "absolute";
				document.all["menu_<?=$counter?>"].style.zIndex = "99999";
				document.all["menu_<?=$counter?>"].style.visibility = "visible";
				document.all["menu_<?=$counter?>"].style.filter = "progid:DXImageTransform.Microsoft.Shadow(color=#333333, Direction=135, Strength=5), filter: progid:DXImageTransform.Microsoft.Alpha(style=0,opacity=88)";
			}
			<?
			$counter++;
		}
		require("../includes/desconectar_mysql.php");
	?>
	</script>
	<table width="159" cellpadding="0" cellspacing="0" border="1">
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$pagina_inicial?>">Pagina Inicial</a></td>
						<td width="10">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$eventos?>">Agenda e Eventos</a></td>
						<td width="10">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$quem_somos?>">Quem Somos</a></td>
						<td width="10">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="mostramenu1();"><a class="menuesquerdo" href="<?=$parceiros?>">Profissionais</a></td>
						<td width="10"><div id="menu_1" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="mostramenu3();"><a class="menuesquerdo" href="<?=$anunciantes?>">Serviços Especiais</a></td>
						<td width="10"><div id="menu_3" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$cartao_fidelidade?>">Cartão Fidelidade</a></td>
						<td width="10">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="escondemenu();"><a class="menuesquerdo" href="<?=$fale_conosco?>">Fale Conosco</a></td>
						<td width="10">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="mostramenu2();"><a class="menuesquerdo" href="<?=$dicas?>">Dicas/Curiosidades</a></td>
						<td width="10"><div id="menu_2" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="mostramenu5();"><a class="menuesquerdo" href="<?=$cartorios?>">Cartórios</a></td>
						<td width="10"><div id="menu_5" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="mostramenu4();"><a class="menuesquerdo" href="<?=$igrejas?>">Igrejas</a></td>
						<td width="10"><div id="menu_4" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
					</tr>
				</table>
			</td>
		</tr>
		<?	
		$counter = 6;
		require("../includes/conectar_mysql.php");
		$result = mysql_query("SELECT * FROM nomedesecao ORDER BY nome");
		while($secao = mysql_fetch_assoc($result)){
			?>
			<tr>
				<td width="100%" background="../imagens/menu.jpg">
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td width="30">&nbsp;</td>
							<td onMouseOver="mostramenu<?=$counter?>();"><a class="menuesquerdo" href="secao.php?secao=<?=$secao["cd"]?>"><?=$secao["nome"]?></a></td>
							<td width="10"><div id="menu_<?=$counter?>" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
						</tr>
					</table>
				</td>
			</tr>
			
			<?
			$counter++;
		}
		?>
		<tr>
			<td width="100%" background="../imagens/menu.jpg">
				<table cellpadding="0" cellspacing="0" border="0" width="100%">
					<tr>
						<td width="30">&nbsp;</td>
						<td onMouseOver="escondemenu();"><a class="menuesquerdo" href="secoes.php">Gerenciar Seções</a></td>
						<td width="10">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table><?
}

#################################################################################################################

function constroi_ficha_tecnica($codigo_evento){
	require("../includes/conectar_mysql.php");
	$query = "SELECT * FROM eventos WHERE cd=" . $codigo_evento;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$evento = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<br><br>
	<center>
	<table width="80%" style="border: thin solid #43577C; background-color: #001238; color:#FFFFFF; text-align:center;" class="menu">
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
	</center><br><br>
	<?
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_parceiro_em_destaque(){
	
	require("../includes/conectar_mysql.php");
	$query = "SELECT cd, path_thumb, nome FROM parceiros ORDER BY RAND() LIMIT 2,1";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$parceiro = mysql_fetch_array($result, MYSQL_ASSOC);
	if(mysql_num_rows($result) == 0) echo('<table width="100%" bgcolor="#E6E6E6" border="0" class="menurodape" height="100"><tr><td valign="top"><img src="../imagens/bullet_red.gif">Não Há Parceiros Cadastrados</td></tr></table>');
	else {
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
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_outros_eventos(){
	$qtd = retorna_config("qtd_outros_eventos");
	if(strlen($qtd) == 0) $qtd = 6;
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
	?><a href="javascript: void window.open('wizard_novo_evento.php', 'EVENTO', 'width=450,height=500,status=no,resizable=yes,top=20,left=100,dependent=no,alwaysRaised=yes');">[Novo Evento]</a><hr><?

	$query = "SELECT eventos.cd, eventos.nomes, eventos.data, eventos.imagem_destaque, eventos.status, tipodeevento.tipo FROM eventos, tipodeevento WHERE eventos.tipo=tipodeevento.cd " . $filtro . " ORDER BY data DESC" . $query_limit;
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
			$desativado = "Desativado: ";
			if (($evento["status"] == 1) && ($evento["data"] < mktime())){
				$style = ' style="color: #FF0000;"';
				$desativado = "Agenda com Data Antiga: ";
			} 
			elseif (($evento["status"] == 0) && ($evento["data"] > mktime())) {
				$style = ' style="color: #FF0000;"';
				$desativado = "Evento com Data Adiantada: ";
			}
			elseif ($evento["status"] == 2) {
				$style = ' style="color: #FF0000;"';
				$desativado = "Desativado: ";
			}
			elseif ($evento["status"] == 3){
				$style = ' style="color: #FF0000;"';
				$desativado = "Em Aprovação: ";
			}
			else {
				$desativado = "";
				$style = "";
			}
			?>
			<td width="33%" align="center" valign="top">
				<table width="100%" height="200" border="0">
					<tr>
						<td align="center" valign="top" height="50%"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" src="../<?=$imagem[0]?>"></a></td>
					</tr>
					<tr>
						<td class="celula" valign="top"<?=$style?>><center><?=$desativado?><?=$evento["tipo"]?>&nbsp;de&nbsp;<b><?=$evento["nomes"]?></b><br><?=date("d/m/Y", $evento["data"])?></center></td>
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

function constroi_tabela_parceiros($tipo){
	global $pagina_inicial, $parceiros;
	require("../includes/conectar_mysql.php");
	$query = "SELECT tipo FROM tipodeparceiro WHERE cd=" . $tipo;
	$result = mysql_query($query);
	$tipodeparceiro = mysql_fetch_row($result);
	$query = "SELECT parceiros.cd, parceiros.path, parceiros.path_thumb, parceiros.nome, parceiros.descricao, parceiros.site, parceiros.email, parceiros.telefone, parceiros.endereco, tipodeparceiro.tipo FROM parceiros, tipodeparceiro WHERE parceiros.tipo=tipodeparceiro.cd AND parceiros.tipo=" . $tipo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<a style="font-weight: normal;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal;" class="menurodape" href="<?=$parceiros?>">[PARCEIROS]</a>&nbsp;-&nbsp;[<?=$tipodeparceiro[0]?>]
	<hr>
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
				<td colspan="2" align="right">
					<a href="javascript: apagar(<?=$parceiro["cd"]?>);">[Apagar Parceiro]</a>&nbsp;&nbsp;
					<a href="javascript: void window.open('wizard_novo_parceiro.php?modo=update&cd=<?=$parceiro["cd"]?>', 'PARCEIRO', 'width=400,height=510,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Edita Parceiro]</a>&nbsp;&nbsp;
					<?
					if (verifica_pagina_parceiro($parceiro["cd"])) echo('<a href="ver_pagina_parceiro.php?cd=' . $parceiro["cd"] . '" class="menurodape">Veja&nbsp;+&nbsp;<img border="0" src="../imagens/bullet_green.gif" align="bottom"></a>');
					else echo('<a href="javascript: void window.open(\'wizard_pagina_parceiro.php?cd_parceiro=' . $parceiro["cd"] . '\', \'PARCEIRO\', \'width=500,height=480,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes\');">[Cria Pagina do Parceiro]</a>');
					?>
				</td>
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

function constroi_tabela_anunciantes($tipo){
	global $pagina_inicial, $anunciantes;
	require("../includes/conectar_mysql.php");
	$query = "SELECT tipo FROM tipodeanunciante WHERE cd=" . $tipo;
	$result = mysql_query($query);
	$tipodeanunciante = mysql_fetch_row($result);
	$query = "SELECT anunciantes.cd, anunciantes.path, anunciantes.path_thumb, anunciantes.nome, anunciantes.descricao, anunciantes.site, anunciantes.email, anunciantes.telefone, anunciantes.endereco, tipodeanunciante.tipo FROM anunciantes, tipodeanunciante WHERE anunciantes.tipo=tipodeanunciante.cd AND anunciantes.tipo=" . $tipo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<a style="font-weight: normal;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal;" class="menurodape" href="<?=$anunciantes?>">[Anunciantes]</a>&nbsp;-&nbsp;[<?=$tipodeanunciante[0]?>]
	<hr>
	<a href="javascript: void window.open('wizard_novo_anunciante.php', 'anunciantes', 'width=400,height=470,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Novo A0nunciante]</a>
	<hr>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar este anunciante?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=anunciantes&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<table width="100%" class="conteudo"> <?
	while($anunciante = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
			<tr>
				<td width="10%"><a name="<?=$anunciante["cd"]?>"><img border="0" src="../<?=$anunciante["path_thumb"]?>" onClick="javascript: void window.open('../<?=$anunciante["path"]?>', 'Fotografia', 'width=320,height=240,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" style="cursor: pointer;"></a></td>
				<td align="left" valign="bottom">
					<?
					if(strlen($anunciante["site"]) != 0) echo('<a class="menurodape" href="javascript: void window.open(\'http://' . $anunciante["site"] . '\')">' . $anunciante["nome"] . '</a>');
					else echo('<span class="menurodape">' . $anunciante["nome"] . "</span>");
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2"><?=$anunciante["descricao"]?></td>
			</tr>
			<tr>
				<td colspan="2" align="right"><font size="-2"><? if(strlen($anunciante["telefone"]) != 0) echo($anunciante["telefone"]); if(strlen($anunciante["email"]) != 0) echo("&nbsp;-&nbsp;" . $anunciante["email"]); if(strlen($anunciante["endereco"]) != 0) echo("&nbsp;-&nbsp;" . $anunciante["endereco"]); ?></font></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<a href="javascript: apagar(<?=$anunciante["cd"]?>);">[Apagar Anunciante]</a>&nbsp;&nbsp;
					<a href="javascript: void window.open('wizard_novo_anunciante.php?modo=update&cd=<?=$anunciante["cd"]?>', 'anunciantes', 'width=400,height=480,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Edita Anunciante]</a>&nbsp;&nbsp;
					<?
					if (verifica_pagina_anunciante($anunciante["cd"])) echo('<a href="ver_pagina_anunciante.php?cd=' . $anunciante["cd"] . '" class="menurodape">Veja&nbsp;+&nbsp;<img border="0" src="../imagens/bullet_green.gif" align="bottom"></a>');
					else echo('<a href="javascript: void window.open(\'wizard_pagina_anunciante.php?cd_anunciante=' . $anunciante["cd"] . '\', \'anunciantes\', \'width=500,height=480,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes\');">[Cria Pagina do Anunciante]</a>');
					?>
				</td>
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

function constroi_tabela_secao($codigo){
	require("../includes/conectar_mysql.php");
	$query = "SELECT * FROM secoes WHERE nomedesecao=" . $codigo . " ORDER BY titulo";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?> 
	<a href="javascript: void window.open('wizard_novo_texto_secao.php?secao=<?=$codigo?>', 'TEXTO', 'width=520,height=500,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Novo Texto]</a>
	<hr>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar este texto?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=secoes&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<table width="100%" class="conteudo"> <?
	while($subsecao = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<tr>
			<td><a name="<?=$subsecao["cd"]?>">&nbsp;</a></td>
		</tr>
		<tr>
			<td><?=$subsecao["texto"]?></td>
		</tr>
		<tr>
			<td><a href="javascript: apagar(<?=$subsecao["cd"]?>);">[Apagar Texto]</a>&nbsp;&nbsp;<a href="javascript: void window.open('wizard_novo_texto_secao.php?modo=update&cd=<?=$subsecao["cd"]?>', 'DICA', 'width=520,height=500,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Edita Texto]</a></td>
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
	require("../includes/conectar_mysql.php");
	$query = "SELECT dica, descricao FROM dicas ORDER BY RAND() LIMIT 2,1";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$dica = mysql_fetch_array($result, MYSQL_ASSOC);
	require("../includes/desconectar_mysql.php");
	if(mysql_num_rows($result) == 0) echo('<div width="100%" class="conteudo">Não há dicas cadastradas</div>');
	else {
		?>
		<div class="titulosecao"><img align="bottom" src="../imagens/bullet_red.gif">&nbsp;Dicas</div><br>
		<p><?=$dica["dica"]?></p>
		<p><?=$dica["descricao"]?></p>
		<p align="right"><a href="dicas.php"><img border="0" src="../imagens/veja.gif"></a></p>
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

function altera_valor($chave, $valor){
	require("../includes/conectar_mysql.php");
	$query = "UPDATE config SET valor='" . $valor . "' WHERE chave='" . $chave . "'";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	require("../includes/desconectar_mysql.php");
}
function retorna_config($chave){
	require("../includes/conectar_mysql.php");
	$query = "SELECT valor FROM config WHERE chave='" . $chave . "'";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$valor = mysql_fetch_assoc($result);
	return $valor["valor"];
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function verifica_eventos_antigos(){

	$prazo = mktime( 0, 0, 0, date("m")-3, date("d"), date("Y"));
	require("../includes/conectar_mysql.php");
	$query = "SELECT cd FROM eventos WHERE data < " . $prazo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$qtd = mysql_num_rows($result);
	
	if($qtd > 0){
		while($evento = mysql_fetch_row($result)){
			$query = "SELECT cd, path, path_thumb FROM fotos WHERE cd_evento = " . $evento[0];
			$result2 = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
			while($foto = mysql_fetch_array($result2, MYSQL_ASSOC)){
				unlink("../" . $foto["path"]);
				unlink("../" . $foto["path_thumb"]);
				$result3 = mysql_query("DELETE FROM fotos WHERE cd = " . $foto["cd"]);
			}
			$result3 = mysql_query("DELETE FROM eventos WHERE cd = " . $evento[0]);
		}
	}
	
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_tipo_parceiros(){
	global $pagina_inicial, $parceiros;
	require("../includes/conectar_mysql.php");
	$query = "SELECT DISTINCT parceiros.tipo as tipo1, tipodeparceiro.tipo as tipo2 FROM parceiros, tipodeparceiro WHERE parceiros.tipo=tipodeparceiro.cd ORDER BY tipodeparceiro.tipo";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<a href="javascript: void window.open('wizard_novo_parceiro.php', 'PARCEIRO', 'width=400,height=470,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Novo Parceiro]</a>
	<hr>
	<table width="100%" border="0">
		<tr>
		<?
		$contador = 0;
		while($parceiro = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT COUNT(*) FROM parceiros WHERE tipo = " . $parceiro["tipo1"];
			$result2 = mysql_query($query);
			$resposta = mysql_fetch_row($result2);
			$qtd = $resposta[0];
			$query = "SELECT path_thumb FROM parceiros  WHERE tipo=" . $parceiro["tipo1"] . " order by rand() Limit 1";
			$result3 = mysql_query($query);
			$resposta = mysql_fetch_row($result3);
			$imagem = $resposta[0];
			?><td valign="bottom">
				<table width="100%">
					<tr>
						<td><img src="../<?=$imagem?>"></td>
					</tr>
					<tr>
						<td class="menurodape"><a class="menurodape" href="parceiros.php?tipo=<?=$parceiro["tipo1"]?>"><?=$parceiro["tipo2"]?></a>&nbsp;(<?=$qtd?>)</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
				</table>
			<?
			$contador++;
			if($contador == 2){
				$contador = 0;
				echo("</tr><tr>");
			}
		}
		?>
		</tr>
	</table>
	<?
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_tabela_tipo_anunciantes(){
	global $pagina_inicial, $anunciantes;
	require("../includes/conectar_mysql.php");
	$query = "SELECT DISTINCT anunciantes.tipo as tipo1, tipodeanunciante.tipo as tipo2 FROM anunciantes, tipodeanunciante WHERE anunciantes.tipo=tipodeanunciante.cd ORDER BY tipodeanunciante.tipo";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?>
	<a href="javascript: void window.open('wizard_novo_anunciante.php', 'anunciantes', 'width=400,height=470,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Novo Anunciante]</a>
	<hr>
	<table width="100%" border="0">
		<tr>
		<?
		$contador = 0;
		while($anunciante = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT COUNT(*) FROM anunciantes WHERE tipo = " . $anunciante["tipo1"];
			$result2 = mysql_query($query);
			$resposta = mysql_fetch_row($result2);
			$qtd = $resposta[0];
			$query = "SELECT path_thumb FROM anunciantes  WHERE tipo=" . $anunciante["tipo1"] . " order by rand() Limit 1";
			$result3 = mysql_query($query);
			$resposta = mysql_fetch_row($result3);
			$imagem = $resposta[0];
			?><td valign="bottom">
				<table width="100%">
					<tr>
						<td><img src="../<?=$imagem?>"></td>
					</tr>
					<tr>
						<td class="menurodape"><a class="menurodape" href="anunciantes.php?tipo=<?=$anunciante["tipo1"]?>"><?=$anunciante["tipo2"]?></a>&nbsp;(<?=$qtd?>)</td>
					</tr>
					<tr><td>&nbsp;</td></tr>
				</table>
			<?
			$contador++;
			if($contador == 2){
				$contador = 0;
				echo("</tr><tr>");
			}
		}
		?>
		</tr>
	</table>
	<?
	require("../includes/desconectar_mysql.php");
}


#################################################################################################################

function verifica_pagina_parceiro($codigo){
	require("../includes/conectar_mysql.php");
	$query = "select cd from pagina_parceiro where cd_parceiro=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$qtd = mysql_num_rows($result);
	require("../includes/desconectar_mysql.php");
	
	if ($qtd > 0) return true;
	else return false;
}

#################################################################################################################

function verifica_pagina_anunciante($codigo){
	require("../includes/conectar_mysql.php");
	$query = "select cd from pagina_anunciante where cd_parceiro=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$qtd = mysql_num_rows($result);
	require("../includes/desconectar_mysql.php");
	
	if ($qtd > 0) return true;
	else return false;
}

#################################################################################################################

function verifica_cd_pagina_parceiro($codigo){
	require("../includes/conectar_mysql.php");
	$query = "select cd from pagina_parceiro where cd_parceiro=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$pagina = mysql_fetch_row($result);
	require("../includes/desconectar_mysql.php");
	return $pagina[0];
}

#################################################################################################################

function verifica_cd_pagina_anunciante($codigo){
	require("../includes/conectar_mysql.php");
	$query = "select cd from pagina_anunciante where cd_parceiro=" . $codigo;
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$pagina = mysql_fetch_row($result);
	require("../includes/desconectar_mysql.php");
	return $pagina[0];
}

#################################################################################################################

function constroi_pagina_parceiro($codigo, $colunas){
	global $parceiros, $pagina_inicial;
	require("../includes/conectar_mysql.php");
	$query = "SELECT tipodeparceiro.tipo, parceiros.tipo as codigotipo, parceiros.nome, parceiros.telefone, parceiros.site, parceiros.email, parceiros.endereco, pagina_parceiro.cd, pagina_parceiro.texto FROM tipodeparceiro, parceiros, pagina_parceiro WHERE tipodeparceiro.cd=parceiros.tipo AND parceiros.cd=" . $codigo . " AND parceiros.cd=pagina_parceiro.cd_parceiro";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$pagina = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar esta imagem?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=pagina_parceiro_fotos&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$parceiros?>">[PARCEIROS]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;" href="parceiros.php?tipo=<?=$pagina["codigotipo"]?>">[<?=$pagina["tipo"]?>]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;">[<?=$pagina["nome"]?>]</a>
	<hr color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="../imagens/bullet_blue3.gif">&nbsp;<?=$pagina["nome"]?></div><br><br>
	<table width="100%" class="conteudo">
		<tr>
			<td><?=$pagina["texto"]?></td>
		</tr>
	 </table>
	 <?
	$contador_de_colunas = 0;
	?>
	<br>
	<hr align="center" color="#FD9800">
	<div class="titulosecao"><img align="bottom" src="../imagens/telefone.gif">&nbsp;Contato</div>
	<div class="conteudo">
		<?
		if (strlen($pagina["endereco"]) > 0) echo('Endereço: ' . $pagina["endereco"] . "<br>");
		if (strlen($pagina["telefone"]) > 0) echo('Telefone: ' . $pagina["telefone"] . "<br>");
		if (strlen($pagina["email"]) > 0) echo('Email: ' . $pagina["email"] . "<br>");
		if (strlen($pagina["site"]) > 0) echo('Site: ' . $pagina["site"] . "<br>");
		?>
	</div>
	<br>
	<hr align="center" color="#FD9800">
	<div class="titulosecao"><img align="bottom" src="../imagens/bullet_silver.gif">&nbsp;Clique na foto para ampliar</div><br>
	<table width="100%" cellspacing="5" cellpadding="0" border="0"><tr>
	<?
	$query = "SELECT cd, path, path_thumb, descricao FROM pagina_parceiro_fotos WHERE cd_pagina=" . $pagina["cd"];
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<td align="center" valign="top" class="conteudo">
			<img style="cursor:pointer;" onClick="javascript: void window.open('../<?=$foto["path"]?>', 'Fotografia', 'width=640,height=480,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="../<?=$foto["path_thumb"]?>"><br>
			<?=$foto["descricao"]?><br>
			<a href="javascript: apagar(<?=$foto["cd"]?>);">[Apagar Foto]</a>
		</td>
		<?
		$contador_de_colunas++;
		if($contador_de_colunas >= $colunas){
			echo("</tr><tr>");
			$contador_de_colunas = 0;
		}
	}
	?></tr></table><?
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_pagina_anunciante($codigo, $colunas){
	global $anunciantes, $pagina_inicial;
	require("../includes/conectar_mysql.php");
	$query = "SELECT tipodeanunciante.tipo, anunciantes.tipo as codigotipo, anunciantes.nome, anunciantes.telefone, anunciantes.site, anunciantes.email, anunciantes.endereco, pagina_anunciante.cd, pagina_anunciante.texto FROM tipodeanunciante, anunciantes, pagina_anunciante WHERE tipodeanunciante.cd=anunciantes.tipo AND anunciantes.cd=" . $codigo . " AND anunciantes.cd=pagina_anunciante.cd_parceiro";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	$pagina = mysql_fetch_array($result, MYSQL_ASSOC);
	?>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar esta imagem?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=pagina_anunciante_fotos&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
	</script>
	<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$pagina_inicial?>">[HOME]</a>&nbsp;-&nbsp;<a style="font-weight: normal; font-size: 11px;" class="menurodape" href="<?=$anunciantes?>">[ANUNCIANTES]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;" href="parceiros.php?tipo=<?=$pagina["codigotipo"]?>">[<?=$pagina["tipo"]?>]</a>&nbsp;-&nbsp;<a class="menurodape" style="font-weight: normal; font-size: 11px;">[<?=$pagina["nome"]?>]</a>
	<hr color="#001238" size="1">
	<div class="titulosecao"><img align="bottom" src="../imagens/bullet_blue3.gif">&nbsp;<?=$pagina["nome"]?></div><br><br>
	<table width="100%" class="conteudo">
		<tr>
			<td><?=$pagina["texto"]?></td>
		</tr>
	 </table>
	 <?
	$contador_de_colunas = 0;
	?>
	<br>
	<hr align="center" color="#FD9800">
	<div class="titulosecao"><img align="bottom" src="../imagens/telefone.gif">&nbsp;Contato</div>
	<div class="conteudo">
		<?
		if (strlen($pagina["endereco"]) > 0) echo('Endereço: ' . $pagina["endereco"] . "<br>");
		if (strlen($pagina["telefone"]) > 0) echo('Telefone: ' . $pagina["telefone"] . "<br>");
		if (strlen($pagina["email"]) > 0) echo('Email: ' . $pagina["email"] . "<br>");
		if (strlen($pagina["site"]) > 0) echo('Site: ' . $pagina["site"] . "<br>");
		?>
	</div>
	<br>
	<hr align="center" color="#FD9800">
	<div class="titulosecao"><img align="bottom" src="../imagens/bullet_silver.gif">&nbsp;Clique na foto para ampliar</div><br>
	<table width="100%" cellspacing="5" cellpadding="0" border="0"><tr>
	<?
	$query = "SELECT cd, path, path_thumb, descricao FROM pagina_anunciante_fotos WHERE cd_pagina=" . $pagina["cd"];
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	while($foto = mysql_fetch_array($result, MYSQL_ASSOC)){
		?>
		<td align="center" valign="top" class="conteudo">
			<img style="cursor:pointer;" onClick="javascript: void window.open('../<?=$foto["path"]?>', 'Fotografia', 'width=640,height=480,status=no,resizable=yes,top=30,left=100,dependent=yes,alwaysRaised=yes');" src="../<?=$foto["path_thumb"]?>"><br>
			<?=$foto["descricao"]?><br>
			<a href="javascript: apagar(<?=$foto["cd"]?>);">[Apagar Foto]</a>
		</td>
		<?
		$contador_de_colunas++;
		if($contador_de_colunas >= $colunas){
			echo("</tr><tr>");
			$contador_de_colunas = 0;
		}
	}
	?></tr></table><?
	require("../includes/desconectar_mysql.php");
}


#################################################################################################################

function constroi_tabela_cartorios(){
	require("../includes/conectar_mysql.php");
	$query = "SELECT * FROM cartorios";
	$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
	?> 
	<a href="javascript: void window.open('wizard_novo_cartorio.php', 'CARTORIO', 'width=520,height=500,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Novo Cartório]</a>
	<hr>
	<?
	if(mysql_num_rows($result) == 0) { ?>
		<table width="100%" class="conteudo">
			<tr>
				<td>Não há itens cadastrados.</td>
			</tr>
		</table>
	<?
	}
	else { ?>
		<script language="javascript" type="text/javascript">
			function apagar(codigo){
				if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar este cartorio?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
					void window.open('delete.php?oque=cartorios&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
				}
			}
		</script>
		<table width="100%" class="conteudo"> <?
		while($cartorio = mysql_fetch_array($result, MYSQL_ASSOC)){
			?>
			<tr>
				<td><a name="<?=$cartorio["cd"]?>">&nbsp;</a></td>
			</tr>
			<tr>
				<td><?=$cartorio["descricao"]?></td>
			</tr>
			<tr>
				<td><a href="javascript: apagar(<?=$cartorio["cd"]?>);">[Apagar Cartório]</a>&nbsp;&nbsp;<a href="javascript: void window.open('wizard_novo_cartorio.php?modo=update&cd=<?=$cartorio["cd"]?>', 'CARTORIO', 'width=520,height=500,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');">[Edita Cartório]</a></td>
			</tr>
			<?
		}
	?> </table> <?
	}
	require("../includes/desconectar_mysql.php");
}

#################################################################################################################

function constroi_destaque_cadastro_casamento(){
	?>
	<table width="100%" style="border: 1px solid #8A91A1;" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top" align="center">
				<table width="100%">
					<tr>
						<td colspan="2" align="center" valign="top"><img src="../imagens/teste.jpg"></td>
					</tr>
					<tr>
						<td align="left" valign="top"><img src="../imagens/bullet_orange.gif"></td>
						<td align="center" valign="top"><a class="menu" style="font-size:10px; font-weight:bold;" href="divulgue.php">Divulgue Seu Evento!</a></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<?
}

#################################################################################################################
function constroi_admin_secoes(){	?>
	<script language="javascript" type="text/javascript">
		function apagar(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar este texto?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=secoes&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
		function apagar_secao(codigo){
			if (window.showModalDialog('confirmacao.html',['Confirme!','Deseja apagar esta seção e todos os seus textos?','Sim','Não'],'dialogWidth:320px;dialogHeight:100px;status:no;') == "1"){
				void window.open('delete.php?oque=nomedesecao&cd=' + codigo, 'CONFIG', 'width=100,height=50,toolbar=no,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
			}
		}
		function edita_texto(secao, codigo, update){
			var complemento = "";
			if (update) complemento = "&modo=update";
			window.open('wizard_novo_texto_secao.php?secao=' + secao + '&cd=' + codigo + complemento, 'TEXTO', 'width=520,height=500,status=no,resizable=no,top=20,left=100,dependent=yes,alwaysRaised=yes');
		}
	</script>
	<table width="100%" class="conteudo">
		<tr>
			<td>
				<table width="80%">
					<form action="secoes.php" name="novasecao" method="post">
					<tr>
						<td class="menurodape">Nova Seção</td>
						<td width="50%"><input type="text" name="secao" style="width: 100%;"></td>
						<td><input type="submit" value="OK"></td>
					</tr>
					<input type="hidden" name="modo" value="novasecao">
					</form>
				</table>
				<hr>
			</td>
		</tr>
		<tr>
			<td>
				<?
				require("../includes/conectar_mysql.php");
				$query = "SELECT * FROM nomedesecao ORDER BY nome";
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				while($nomedesecao = mysql_fetch_assoc($result)){ 
					if ($nomedesecao["pgseparadas"] == "s") $checked = " checked";
					else $checked = "";
				?>
					<table width="100%" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<form action="secoes.php" method="post">
							<td height="30" valign="bottom" width="35"><a href="javascript: mostra_conteudo_<?=$nomedesecao["cd"]?>();"><img border="0" src="../imagens/pastadocumento.gif"></a></td>
							<td align="left" valign="middle" class="menurodape"><input type="text" name="nomedesecao" value="<?=$nomedesecao["nome"]?>" style="width: 116px; font-family:'Lucida Sans Unicode', Verdana, Arial; font-weight: bold;">&nbsp;&nbsp;<input type="checkbox" name="pgseparadas"<?=$checked?>>&nbsp;Paginas Separadas&nbsp;&nbsp;<input type="submit" value="OK">&nbsp;&nbsp;<a href="javascript: apagar_secao(<?=$nomedesecao["cd"]?>);"><img border="0" src="../imagens/button_drop.png"></a></td>
							<input type="hidden" name="cd" value="<?=$nomedesecao["cd"]?>">
							<input type="hidden" name="modo" value="mudanomesecao">
							</form>
						</tr>
						<tr>
							<td colspan="2">
							<script language="javascript" type="text/javascript">
								function mostra_conteudo_<?=$nomedesecao["cd"]?>(){
									if (document.all['<?=str_replace(" ", "", $nomedesecao["nome"]) . $nomedesecao["cd"]?>'].innerHTML == ""){
										document.all['<?=str_replace(" ", "", $nomedesecao["nome"]) . $nomedesecao["cd"]?>'].innerHTML = <?=str_replace(" ", "", $nomedesecao["nome"])?>;
									}
									else document.all['<?=str_replace(" ", "", $nomedesecao["nome"]) . $nomedesecao["cd"]?>'].innerHTML = "";
								}
								var <?=str_replace(" ", "", $nomedesecao["nome"])?> = '<table cellpadding="0" cellspacing="0"><?
								$query = "SELECT * FROM secoes WHERE nomedesecao = " . $nomedesecao["cd"] . " ORDER BY titulo";
								$result2 = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
								while($secao = mysql_fetch_assoc($result2)){
									echo('<tr><td width="10">&nbsp;</td><td width="50"><img src="../imagens/arquivo.gif"></td><td class="celula"><a href="javascript: edita_texto(' . $nomedesecao["cd"] . ', ' . $secao["cd"] . ', true)">' . $secao["titulo"] . '&nbsp;&nbsp;<a href="javascript: apagar(' . $secao["cd"] . ');"><img border="0" src="../imagens/button_drop.png"></a></tr>');
								}
								?><tr><td>&nbsp;</td><td><img src="../imagens/arquivo2.gif"></td><td><input type="button" value="Novo Texto da Seção" onClick="Javascript: edita_texto(<?=$nomedesecao["cd"]?>, 0, false);"></td></tr></table>';
							</script>
							<div id="<?=str_replace(" ", "", $nomedesecao["nome"]) . $nomedesecao["cd"]?>"></div>
							</td>
						</tr>
					</table>
					<br><br>
					<?
				}
				require("../includes/conectar_mysql.php");
				?>
			</td>
		</tr>
	</table>
<?

}

#################################################################################################################

function constroi_destaque_agenda($numerodedestaques, $colunas){
	$contador_de_colunas = 0;

	$query = "SELECT * FROM eventos WHERE (DATA > " . mktime() . ") AND (status = 1) ORDER BY data ASC LIMIT " . $numerodedestaques;
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
		?><table width="100%" cellspacing="5" border="0"><tr><?
		while($evento = mysql_fetch_array($result, MYSQL_ASSOC)){
			$query = "SELECT path_thumb FROM fotos WHERE cd=" . $evento["imagem_destaque"];
			$result2 = mysql_query($query);
			$imagem = mysql_fetch_row($result2);
			if($contador_de_colunas == $colunas-1) $style = "";
			elseif (mysql_num_rows($result) == 1) $style = "";
			else $style = 'style="border-right: 1px solid #001238;"';
			?>
			<td width="33%" align="center" valign="top" <?=$style?>>
				<table width="100%" border="0" height="240">
					<tr>
						<td height="93" align="center" valign="top"><a href="ver_evento.php?cd=<?=$evento["cd"]?>"><img border="0" src="../<?=$imagem[0]?>"></a></td>
					</tr>
					<tr>
						<td class="celula" valign="top">
							<b><?=date("d/m/Y", $evento["data"])?></b><br>
							<?
							if(strlen($evento["pginicial"] == 0)) echo(substr($evento["descricao"], 0, 150) . "...");
							else echo(substr($evento["pginicial"], 0, 150) . "...");
							?>
						</td>
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
?>
