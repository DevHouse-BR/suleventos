<?php
error_reporting(0);

$mes =  $_GET["mes"];						//Este script recebe como par�metro o m�s para que seja construido o calend�rio de acordo com este mes.
$ano =  $_GET["ano"];		

if ($mes == "") $mes = date("m");			//Caso n�o seja informado o mes a fun��o date() seta o mes para o mes corrente no servidor.
if ($ano == "") $ano = date("Y");			//O mesmo para o ano.

if ($mes == date("m")){								//Caso o m�s a ser construido seja o m�s corrente
	$hoje = mktime(0,0,0,date("m"),date("j"),date("Y"));		//a vari�vel $hoje guardar� o valor do timestamp do dia corrente para poder 	
}													//identifica-lo no calend�rio.
else $hoje = 0;
switch($mes){	//Monta o t�tulo do calend�rio informando o m�s em portugu�s.
	case 1:
		$titulo_calendario = "Janeiro/" . $ano;
		break;
	case 2:
		$titulo_calendario = "Fevereiro/" . $ano;
		break;
	case 3:
		$titulo_calendario = "Mar�o/" . $ano;
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
$primeiro_dia_mes_semana = date("w",$primeiro_dia_mes);		//O n�mero do dia da semana que "cai" o primeiro dia do m�s

$inicio_calendario = (($primeiro_dia_mes_semana) * 86400);				//A diferen�a entre o primeiro dia do m�s para o primeiro dia a ser mostrado no calend�rio.
$primeiro_dia_calendario = $primeiro_dia_mes - $inicio_calendario;		//Subtraindo-se achamos o timestamp para o primeiro dia do calend�rio. (provavelmente do m�s anterior)

$calendario = 	"<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">"; //Inicia a constru��o da tabela do calend�rio.
	$calendario .=	"<tr>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">dom</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">seg</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">ter</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">qua</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">qui</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">sex</td>";
		$calendario .=	"<td class=\"calendario\" width=\"14%\">sab</td>";
	$calendario .=	"</tr>";
	
	//� construido em paralelo uma tabela para as setinhas laterais ao calendario que indicam as semanas do calend�rio.
	
	$dia = $primeiro_dia_calendario;		//A variavel dia � o timestamp do dia que o loop construtor do calend�rio estar� tratando. 
	$ultimodia = "";						//A variavel ultimo dia guarda o ultimo dia em forma de string para comparar com a variavel dia para n�o repetir dias no calend�rio. 
	for($j = 0; $j <6 ; $j++){				//Da semana 0 at� a semana seis
		if (($j == 0) || (($j != 0) && (date("m", $dia) == $mes))) { //verifica se o primeiro dia desta semana come�ar� com um dia que ainda est� no m�s corrente.
			$primeiro_dia_n_semana = $dia;	//A variavel primeiro_dia_n_semana guarda o valor do timestamp da zero hora do primeiro dia desta semana para depois pass�-lo como par�metro na visualiza��o de atividades semanal.
			$calendario .=	"<tr>";			//Adiciona a tabela a tag de nova linha.
			for($i = 0; $i < 7; $i++){		//Do primeiro ao s�timo dia da semana:
				if ($ultimodia != date("j",$dia)){	//S� continua se o dia for diferente do ultimo dia impresso.
					if($dia == $hoje) $calendario .= "<td class=\"hoje\">" . verifica_agendamento($dia) . "</td>";	//Caso o dia analizado seja o dia corrente no servidor ele ser� impresso no calend�rio em destaque.
					else {	//sen�o: se o dia estiver dentro do m�s a ser construido ele ser� impresso em preto.
						if (date("m", $dia) == $mes) $calendario .= "<td class=\"interior\">" . verifica_agendamento($dia) . "</td>"; //A cada dia do m�s � feita uma verifica��o no banco de dados para verificar a exist�ncia de alguma atividade agendada para aquele dia.
						else { //Sen�o ser� impresso em cinza:
							$calendario .= "<td class=\"outromes\">" . verifica_agendamento($dia) . "</td>";
						}
					}
				}
				else $i--; //Caso o ultimo dia for igual ao dia sendo analisado ent�o a variavel $i vai voltar em uma unidade para poder fechar 7 dias na semana.
				$ultimodia = date("j",$dia); //aqui � gravado a informa��o na variavel ultimo dia.
				$ultimo_dia_n_semana = $dia; //O timestamp da zero hora do ultimo dia da semana antes de ser acrecentado mais um dia a variavel dia. (86400 segundos)
				$dia = $dia + 86400;
			}
			$calendario .=	"</tr>"; //A seta abaixo vai com a informa��o para executar a fun��o em javascript ver_semana com o intervalo do primeiro ao ultimo dia da semana.
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
			var corantiga;				//Duas vari�veis utilizadas para a mudan�a de cores quando o mouse passa por cima do nome dos meses.
			var novacor = "#0000FF";
			function muda_mes(novomes){		//Fun��o que faz com que o pr�prio calend�rio seja carregado para o m�s selecionado e tamb�m mostrando a tabela de atividades para o m�s selecionado.
				self.location = "calendario.php?mes=" + novomes + "&ano=" + ano;
			}
			function ver_dia(data){		//Fun��o que mostra a tabela de atividades para um dia selecionado.
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
						  <?=$calendario?><!-- Monta a tabela do calend�rio -->
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