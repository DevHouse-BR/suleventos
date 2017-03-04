<?php
//sessoes de localizaчуo e globais
session_start();

header("Cache-control: private");

setlocale (LC_ALL, 'pt_BR');

error_reporting(E_ALL ^ E_NOTICE);

//conectar com o servidor
function conecta()
{
// local
// aqui coloque o usuario e senha para o banco de dados.
  $User2="suleventos";
  $Senha2="s28b06j15hh";
  $Servidor2="mysql.suleventos.com.br";

//banco - o codigo para criaчуo do banco estс em "db/chat.sql"
  $Banco="suleventos";
  $conn=mysql_connect($Servidor2,$User2,$Senha2);
  mysql_select_db ($Banco,$conn);
}


//**************************************************************

//**			FUNCAO PARA FORMATAR DATA                     **

//**************************************************************

function Mysql_Data($data, $item="")
{
	$separador = strlen($item)==0 || is_numeric($item) ? "/" : $item;
	// Separando data da hora.
	$data_frag = split(" ",$data);
	// Verificando se um horсrio foi especificado.
	if(isset($data_frag[1])){
	 	// Gravando a hora.
	 	$inverte['hora'] = $data_frag[1];
	}
	// Separando dia, mes e ano.
	$data_frag = split("-",$data_frag[0]);
	// Verificando se o valor da data щ vсlida . 20-02-2004
	if(checkdate ($data_frag[1], $data_frag[2], $data_frag[0]) or checkdate ($data_frag[1], $data_frag[0], $data_frag[2]) ) 
	{
		 // Gravando o dia.
		 $inverte['dia'] = $data_frag[2];
		 // Especificando os meses e gravando o mes.
		 $inverte['mes'] = array ("Janeiro", "Fevereiro", "Marчo", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro","Dezembro");
		 $inverte['mes'] = $inverte['mes'][($data_frag[1]-1)];
		 // Especificando o dia da semana e gravando o dia da semana (sem "-feira").
		 $inverte['semana'] = array ("Domingo", "Segunda", "Terчa", "Quarta", "Quinta", "Sexta", "Sсbado");
		 $inverte['semana'] =  $inverte['semana'][date ("w", mktime (0,0,0,$data_frag[1],$data_frag[2],$data_frag[0]))];
		 // Especificando o dia da semana e gravando o dia da semana (com "-feira").
		 $inverte['semana_extenso'] = array ("Domingo", "Segunda-feira", "Terчa-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sсbado");
		 $inverte['semana_extenso'] =  $inverte['semana_extenso'][date ("w", mktime (0,0,0,$data_frag[1],$data_frag[2],$data_frag[0]))];
		 // Gravando o ano.
		 $inverte['ano'] = $data_frag[0];
		 // Gravando 1К tipo de data: 11/08/1980
		 $inverte['data'] = $data_frag[2].$separador.$data_frag[1].$separador.$data_frag[0];
		 // Gravando 2К tipo de data: 11 de agosto de 1980
		 $inverte['data_extenso'] = $data_frag[2]." de ".strtolower ($inverte['mes'])." de ".$data_frag[0];
		 // Gravando 3К tipo de data: Segunda, 11 de agosto de 1980
		 $inverte['data_semana'] = $inverte['semana'].", ".$data_frag[2]." de ".strtolower ($inverte['mes'])." de ".$data_frag[0];
		 // Gravando 3К tipo de data: Segunda-feira, 11 de agosto de 1980
		 $inverte['data_semana_extenso'] = $inverte['semana_extenso'].", ".$data_frag[2]." de ".strtolower ($inverte['mes'])." de ".$data_frag[0];
		 // Calculando e gravando a idade
		 $inverte['idade'] = date('Y') - $data_frag[0];
		 if((date("m") < $data_frag[1]) || (date("d") < $data_frag[2]) && ($inverte['idade'] > 0)){
		  	$inverte['idade'] = $inverte['idade'] - 1;
		 }
		 
		 $inverte['quanto_falta_anos'] = ($data_frag[0] - date("Y")) > 0 ? $data_frag[0] - date("Y") : 0;
		 $inverte['quanto_falta_meses'] = ($data_frag[1] - date("m")) > 0 ? $data_frag[1] - date("m") : 0;
		 $inverte['quanto_falta_dias'] = ($data_frag[2] - date("d")) > 0 ? $data_frag[2] - date("d") : 0;
		 
		 // Verificando o tipo de informaчуo o usuсrio deseja.
		 if(is_numeric($item)){
		  if($item == 1){
		   	$inverte = $inverte['data_extenso'];
		  }else if($item == 2){
		   	$inverte = $inverte['data_semana'];
		  }else if($item == 3){
		   	$inverte = $inverte['data_semana_extenso'];
		  }
		 }else if($item == "idade"){
		  	$inverte = $inverte['idade'];
		 }else if($item == "hora"){
		  	$inverte = $inverte['hora'];
		 }else if(strlen($item) > 0){
		 	 $inverte = $inverte['data'];
		 }
		
		 return $inverte;
	 }else
	 {
	 	return false;
	}
}



// SOMAR DATAS
function somadata( $data, $nDias )
{
    if( !isset( $nDias ) )
    {
		$nDias = 1;
    }
    $aVet = Explode( "/",$data );
	$valorreal=date( "Y-m-d",mktime(0,0,0,$aVet[1],$aVet[0]+$nDias,$aVet[2])); 
	return $valorreal;
}



?>