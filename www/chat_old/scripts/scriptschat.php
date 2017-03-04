<?php include("conexao.php"); ?>
<?php

function buscausuarioschat($tem_codigo)
{
	$query= mysql_query ("select * from usuario where usu_apagado='N' and tem_codigo=$tem_codigo");
	return $query;
}

function buscamensagemchat($tem_codigo)
{
	$query= mysql_query ("select Top 20 mensagem.* from mensagem,usuario where usuario.apagado='N' and usuario.usu_codigo=mensagem.usu_codigo and mensagem.tem_codigo=".$tem_codigo." order by mensagem.mem_codigo desc");
	$rec=mysql_fetch_array($query);
	return $rec;
}

function buscatodasmensagenschat($tem_codigo,$hora,$data)
{
	$query= mysql_query ("select * from mensagem where tem_codigo=$tem_codigo and mem_hora>'$hora' and mem_data='$data' order by mem_codigo ");
	//echo "select * from mensagem where tem_codigo=$tem_codigo and mem_hora>'$hora' and mem_data='$data' order by mem_codigo ";
	return $query;
}

function enviamensagemchat($mensagem,$tem_codigo,$usu_codigo,$usu_codigo_destino,$reservado)
{
	if (is_null($usu_codigo_destino))
	{
		$usu_codigo_destino=0;
	}
	if (is_null($reservado))
	{
		$reservado="N";
	}
	$data=Mysql_Data( date("d-m-Y"),"-");
	$hora=date("H:i:s");
	$ip=getenv("REMOTE_ADDR"); 
	$query= mysql_query ("insert into mensagem (mem_mensagem,tem_codigo,usu_codigo_envio,usu_codigo_destino,mem_reservado,mem_data,mem_hora,mem_ip) values ('$mensagem',$tem_codigo,$usu_codigo,$usu_codigo_destino,'$reservado','$data','$hora','$ip')");
}

function enviausuariochat($nome,$tem_codigo)
{
	$data=Mysql_Data( date("d-m-Y"),"-");
	$hora=date("H:i:s");
	
	$_SESSION['hora']=$hora;
	$_SESSION['usu_nome']=$nome;
	$_SESSION['tem_codigo']=$tem_codigo;
	
	$query = mysql_query ("insert into usuario(usu_nome,usu_data,usu_hora,usu_apagado,tem_codigo) values ('$nome','$data','$hora','N',$tem_codigo)");
	$queryT = mysql_query ("select * from usuario order by usu_codigo DESC;");
	$rec=mysql_fetch_array($queryT);
	
	$_SESSION['usu_codigo']= $rec["usu_codigo"];
	
	enviamensagemchat("<font color=#990000> ".$nome." entrou no chat</font>" ,$_SESSION['tem_codigo'],$_SESSION['usu_codigo'],$usu_codigo_destino,$reservado);
	return $rec;
}

function buscausuariocodusuariochat($usu_codigo)
{
	$query= mysql_query ("select * from usuario where usu_codigo=$usu_codigo");
	return $query;
}

function buscausuariocodusuariochat2($usu_codigo)
{
	$query= mysql_query ("select * from usuario where apagado='N' and  usu_codigo=$usu_codigo");
	$rec=mysql_fetch_array($query);
	return $rec;
}

function limparusuarioschat()
{
	$diaantes=somadata( date("d/m/Y"),-1);
	$query= mysql_query ("update usuario set apagado='S' where data_hora<$diaantes");
}

function limparusuarioschatcodusuario($usu_codigo,$usu_nome)
{
	$diaantes=somadata( date("d/m/Y"),-1);
	$query= mysql_query ("update usuario set usu_apagado='S' where usu_codigo='$usu_codigo'");
	enviamensagemchat("<font color=#990000> ".$usu_nome." saiu do chat !</font>" ,$_SESSION['tem_codigo'],$_SESSION['usu_codigo'],$usu_codigo_destino,$reservado);
	limparusuarioschat(limpar);
}

function buscachat($tem_codigo)
{
	$query= mysql_query ("select * from tema where tem_codigo=$tem_codigo");
	$rec=mysql_fetch_array($query);
	return $rec;
}
/*
function filtra_palavra(retorno,filtra)
	filtra = Replace(filtra,"CARALHO","C*",1,-1,1) 
	filtra = Replace(filtra,"FILHOS DA PUTA", "F*",1,-1,1) 
	filtra = Replace(filtra,"FILHOS DAS PUTA", "F*",1,-1,1)
	filtra = Replace(filtra,"FILHOS DAS PUTAS", "F*",1,-1,1)
	filtra = Replace(filtra,"FILHAS DA PUTA", "F*",1,-1,1)
	filtra = Replace(filtra,"FILHAS DAS PUTA", "F*",1,-1,1)
	filtra = Replace(filtra,"FILHAS DAS PUTAS", "F*",1,-1,1)
	filtra = Replace(filtra,"FILHA DA PUTA", "F*",1,-1,1)
	filtra = Replace(filtra,"FILHO DA PUTA", "F*",1,-1,1)
	filtra = Replace(filtra,"VIADO", "V*",1,-1,1)
	filtra = Replace(filtra,"PUTAS QUE PARIU", "PQP",1,-1,1)
	filtra = Replace(filtra,"PUTAS QUE TE PARIU", "PQP",1,-1,1)
	filtra = Replace(filtra,"PUTA QUE TE PARIU", "PQP",1,-1,1)
	filtra = Replace(filtra,"PUTA MERDA", "P* M*",1,-1,1)
	filtra = Replace(filtra,"BOSTA", "M*",1,-1,1)
	filtra = Replace(filtra,"MERDA", "M*",1,-1,1)
	filtra = Replace(filtra,"PUTA QUE PARIU", "P*",1,-1,1)
	filtra = Replace(filtra,"PUTA", "P*",1,-1,1)
	filtra = Replace(filtra,"BUCETA", "B*",1,-1,1)
	filtra = Replace(filtra,"CARALHO", "C*",1,-1,1)
	filtra = Replace(filtra,"CUZÃO", "C*",1,-1,1)
	filtra = Replace(filtra,"CÚ", "C*",1,-1,1)
	filtra = Replace(filtra,"CU", "C*",1,-1,1)
	filtra = Replace(filtra,"PORRA", "P*",1,-1,1)
	retorno = filtra
}

*/

?>