<html>
	<head>
	<title>Impressão de Parceiros Credenciados</title>
	<style type="text/css" media="screen">
	.linhaembranco {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		color: #666666;
		background-color: #FFFFFF;
	}
	.linhaemcinza {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		color: #666666;
		background-color: #EEEEEE;
	}
	.linhaemazul {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		color: #FFFFFF;
		background-color: #809CD0;
		text-decoration: underline;
		font-weight: bold;
	}
    </style>
	<style type="text/css" media="print">
	.linhaembranco {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		color: #666666;
	}
	.linhaemcinza {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		color: #666666;
	}
	.linhaemazul {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
		text-decoration: underline;
		font-weight: bold;
	}
    </style>
	</head>
	<body>
	<table width="100%">
		<tr>
			<td align="center">
			<div style="width: 600px;">
				<p align="center"><b><font face="MS Sans Serif" size="3" color="#809CD0">Cartão Fidelidade Sul Eventos</font></b></p>
				<p align="center"><font size="2" face="MS Sans Serif">Confira aqui a Lista dos Participantes Credenciados ao Sul Eventos, somente para a cidade de Joinville e Região. Em breve estaremos mais próximos de você!</font></p>
			</div><br><br>
			<?
			require("includes/conectar_mysql.php");
				$query = "SELECT * FROM tipodeparceiro";
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				?>
				<table cellpadding="1" cellspacing="1" width="600">
				<?
				while($tipodeparceiro = mysql_fetch_assoc($result)){
					$query = "SELECT nome, telefone FROM parceiros WHERE tipo=" . $tipodeparceiro["cd"];
					$result2 = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
					if(mysql_num_rows($result2) > 0){
						$i = 0;
						?>
						<tr class="linhaemazul">
							<td colspan="2"><?=ucwords(strtolower($tipodeparceiro["tipo"]))?></td>
						</tr>
						<tr class="linhaembranco">
							<td colspan="2">&nbsp;</td>
						</tr>
						<?
						while($parceiro = mysql_fetch_assoc($result2)){
							if($i == 0) {
								$class = ' class="linhaemcinza"';
								$i = 1;
							}
							else{
								$class = ' class="linhaembranco"';
								$i = 0;
							}
							?>
							<tr<?=$class?>>
								<td><?=$parceiro["nome"]?></td>
								<td><?=$parceiro["telefone"]?></td>
							</tr>
							<?
						}
						?>
						<tr class="linhaembranco">
							<td colspan="2">&nbsp;</td>
						</tr>
						<?
					}
				}
				?>
				</table>
				<?
				$query = "SELECT * FROM tipodeanunciante";
				$result = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
				?>
				<table cellpadding="1" cellspacing="1" width="600">
				<?
				while($tipodeanunciante = mysql_fetch_assoc($result)){
					$query = "SELECT nome, telefone FROM anunciantes WHERE tipo=" . $tipodeanunciante["cd"];
					$result2 = mysql_query($query) or die("Erro de conexão ao banco de dados: " . mysql_error());
					if(mysql_num_rows($result2) > 0){
						$i = 0;
						?>
						<tr class="linhaemazul">
							<td colspan="2"><?=ucwords(strtolower($tipodeanunciante["tipo"]))?></td>
						</tr>
						<tr class="linhaembranco">
							<td colspan="2">&nbsp;</td>
						</tr>
						<?
						while($anunciante = mysql_fetch_assoc($result2)){
							if($i == 0) {
								$class = ' class="linhaemcinza"';
								$i = 1;
							}
							else{
								$class = ' class="linhaembranco"';
								$i = 0;
							}
							?>
							<tr<?=$class?>>
								<td><?=$anunciante["nome"]?></td>
								<td><?=$anunciante["telefone"]?></td>
							</tr>
							<?
						}
						?>
						<tr class="linhaembranco">
							<td colspan="2">&nbsp;</td>
						</tr>
						<?
					}
				}
				?>
				</table>
				<?
			require("includes/desconectar_mysql.php");
			?>
			</td>
		</tr>
	</table>
	</body>
</html>