<?php
error_reporting(0);

$mes =  $_GET["mes"];						//Este script recebe como parâmetro o mês para que seja construido o calendário de acordo com este mes.
$ano =  $_GET["ano"];		

if ($mes == "") $mes = date("m");			//Caso não seja informado o mes a função date() seta o mes para o mes corrente no servidor.
if ($ano == "") $ano = date("Y");			//O mesmo para o ano.

if ($mes == date("m")){								//Caso o mês a ser construido seja o mês corrente
	$hoje = mktime(0,0,0,date("m"),date("j"),date("Y"));		//a variável $hoje guardará o valor do timestamp do dia corrente para poder 	
}													//identifica-lo no calendário.
else $hoje = 0;
switch($mes){	//Monta o título do calendário informando o mês em português.
	case 1:
		$titulo_calendario = "Janeiro/" . $ano;
		break;
	case 2:
		$titulo_calendario = "Fevereiro/" . $ano;
		break;
	case 3:
		$titulo_calendario = "Março/" . $ano;
		break;
	case 4:
		$titulo_calendario = "Abril/" . $ano;
		break;
	case 5:
		$titulo_calendario = "Maio/" . $ano;
		break;
	case 6:
		$titulo_calendario = "Junho/" . $ano;
		break;
	case 7:
		$titulo_calendario = "Julho/" . $ano;
		break;
	case 8:
		$titulo_calendario = "Agosto/" . $ano;
		break;
	case 9:
		$titulo_calendario = "Setembro/" . $ano;
		break;
	case 10:
		$titulo_calendario = "Outubro/" . $ano;
		break;
	case 11:
		$titulo_calendario = "Novembro/" . $ano;
		break;
	case 12:
		$titulo_calendario = "Dezembro/" . $ano;
		break;
}


$primeiro_dia_mes = mktime(0,0,0,$mes,1,$ano);				//Timestamp para o primeiro dia do mes.
$primeiro_dia_mes_semana = date("w",$primeiro_dia_mes);		//O número do dia da semana que "cai" o primeiro dia do mês

$inicio_calendario = (($primeiro_dia_mes_semana) * 86400);				//A diferença entre o primeiro dia do mês para o primeiro dia a ser mostrado no calendário.
$primeiro_dia_calendario = $primeiro_dia_mes - $inicio_calendario;		//Subtraindo-se achamos o timestamp para o primeiro dia do calendário. (provavelmente do mês anterior)

$calendario = 	"<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"; //Inicia a construção da tabela do calendário.
	$calendario .=	"<tr>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">dom</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">seg</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">ter</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">qua</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">qui</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">sex</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">sab</td>";
	$calendario .=	"</tr>";
	
	//É construido em paralelo uma tabela para as setinhas laterais ao calendario que indicam as semanas do calendário.
	
	$dia = $primeiro_dia_calendario;		//A variavel dia é o timestamp do dia que o loop construtor do calendário estará tratando. 
	$ultimodia = "";						//A variavel ultimo dia guarda o ultimo dia em forma de string para comparar com a variavel dia para não repetir dias no calendário. 
	for($j = 0; $j <6 ; $j++){				//Da semana 0 até a semana seis
		if (($j == 0) || (($j != 0) && (date("m", $dia) == $mes))) { //verifica se o primeiro dia desta semana começará com um dia que ainda está no mês corrente.
			$primeiro_dia_n_semana = $dia;	//A variavel primeiro_dia_n_semana guarda o valor do timestamp da zero hora do primeiro dia desta semana para depois passá-lo como parâmetro na visualização de atividades semanal.
			$calendario .=	"<tr>";			//Adiciona a tabela a tag de nova linha.
			for($i = 0; $i < 7; $i++){		//Do primeiro ao sétimo dia da semana:
				if ($ultimodia != date("j",$dia)){	//Só continua se o dia for diferente do ultimo dia impresso.
					if($dia == $hoje) $calendario .= "<td class=\"hoje\">" . verifica_agendamento($dia) . "</td>";	//Caso o dia analizado seja o dia corrente no servidor ele será impresso no calendário em destaque.
					else {	//senão: se o dia estiver dentro do mês a ser construido ele será impresso em preto.
						if (date("m", $dia) == $mes) $calendario .= "<td class=\"interior\">" . verifica_agendamento($dia) . "</td>"; //A cada dia do mês é feita uma verificação no banco de dados para verificar a existência de alguma atividade agendada para aquele dia.
						else { //Senão será impresso em cinza:
							$calendario .= "<td class=\"outromes\">" . verifica_agendamento($dia) . "</td>";
						}
					}
				}
				else $i--; //Caso o ultimo dia for igual ao dia sendo analisado então a variavel $i vai voltar em uma unidade para poder fechar 7 dias na semana.
				$ultimodia = date("j",$dia); //aqui é gravado a informação na variavel ultimo dia.
				$ultimo_dia_n_semana = $dia; //O timestamp da zero hora do ultimo dia da semana antes de ser acrecentado mais um dia a variavel dia. (86400 segundos)
				$dia = $dia + 86400;
			}
			$calendario .=	"</tr>"; //A seta abaixo vai com a informação para executar a função em javascript ver_semana com o intervalo do primeiro ao ultimo dia da semana.
		}
	}
$calendario .=	"</table>";
?>
<html>
	<head>
		<link href="includes/calendario.css" rel="stylesheet">
		<script language="JavaScript">
			var ano = <?=$ano?>;
			var mes = <?=$mes?>;
			var corantiga;				//Duas variáveis utilizadas para a mudança de cores quando o mouse passa por cima do nome dos meses.
			var novacor = "#0000FF";
			function muda_mes(novomes){		//Função que faz com que o próprio calendário seja carregado para o mês selecionado e também mostrando a tabela de atividades para o mês selecionado.
				self.location = "calendario.php?mes=" + novomes + "&ano=" + ano;
			}
			function ver_dia(data){		//Função que mostra a tabela de atividades para um dia selecionado.
				parent.location = "eventos.php?busca=data&data=" + data;
			}
			function muda_ano(direcao){
				novoano = ano + (direcao);
				self.location = "calendario.php?mes=" + mes + "&ano=" + novoano;
			}
		</script>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	</head>
	<body leftmargin="0" topmargin="0" bottommargin="0" rightmargin="0" marginwidth="0" marginheight="0" bgcolor="#F0F0F0">
		<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
			<tr>
				<td width="100%" align="left" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tabelacalendario">
					  <tr> 
						<td class="titulo">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td width="10%"><a href="javascript: muda_ano(-1);"><img border="0" src="imagens/bullet_blue2.gif"></a></td>
									<td width="80%" class="titulo"><?=$titulo_calendario?></td>
									<td width="10%"><a href="javascript: muda_ano(1);"><img border="0" src="imagens/bullet_blue.gif"></a></td>
								</tr>
							</table>
						</td>
					  </tr>
					  <tr> 
						<td align="left" valign="top">
						  <?=$calendario?><!-- Monta a tabela do calendário -->
						</td>
					  </tr>
					  <tr> 
						<td><table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr> 
							  <td class="mes" onClick="muda_mes(1);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">jan</td>
							  <td class="mes" onClick="muda_mes(2);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">fev</td>
							  <td class="mes" onClick="muda_mes(3);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">mar</td>
							  <td class="mes" onClick="muda_mes(4);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">abr</td>
							  <td class="mes" onClick="muda_mes(5);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">mai</td>
							  <td class="mes" onClick="muda_mes(6);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">jun</td>
							</tr>
							<tr> 
							  <td class="mes" onClick="muda_mes(7);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">jul</td>
							  <td class="mes" onClick="muda_mes(8);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">ago</td>
							  <td class="mes" onClick="muda_mes(9);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">set</td>
							  <td class="mes" onClick="muda_mes(10);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">out</td>
							  <td class="mes" onClick="muda_mes(11);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">nov</td>
							  <td class="mes" onClick="muda_mes(12);" onMouseOver="corantiga = this.style.color; this.style.color = novacor;" onMouseOut="this.style.color = corantiga;">dez</td>
							</tr>
						  </table></td>
					  </tr>
					</table>
					<div style=" padding: 5px 5px 5px 5px; font-family:'Lucida Sans Unicode', Verdana, Arial; vertical-align: middle; text-align: left; color: #000000; font-size:10px;">
						<BR><span style="width: 10px; font-size: 10px; background-color:#FF0000">&nbsp;</span>&nbsp;HOJE,&nbsp;<?=date("d/m/Y");?><BR>
						<span style="width: 10px; font-size: 10px; background-color:#FF9900">&nbsp;</span>&nbsp;DIA COM EVENTOS
					</div>
				</td>
			</tr>
		</table>
	</body>
</html>

<?php 
function verifica_agendamento($dia){
	require("includes/conectar_mysql.php");

	$query = "SELECT cd FROM eventos where data=" . mktime(0,0,0,date("m",$dia),date("d", $dia),date("Y",$dia));
	$result = mysql_query($query) or die("Erro ao acessar registros no Banco de dados: " . mysql_error());
	if(mysql_num_rows($result) != 0) return '<div class="diaocorrencia" onclick="ver_dia(\'' . $dia . '\')" title="Veja Eventos neste dia!">' . date("j",$dia) . '</div>';
	else return date("j",$dia);
	require("includes/desconectar_mysql.php");
}
?>