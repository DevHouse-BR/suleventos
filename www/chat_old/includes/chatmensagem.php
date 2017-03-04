<?PHP include "../scripts/scriptschat.php" ?>
<script>
function scrollIt() {
	if( document.body && document.body.clientHeight ) 
	{
		window.innerHeight = document.body.clientHeight
	}
	window.scrollTo( 0, (window.innerHeight*2) );
}
</script>
<meta http-equiv="refresh" content="10">
<link rel="stylesheet" href="../styles/chat.css" type="text/css">
<body onload="scrollIt();">
<?PHP

conecta();
$usuaTibrios0=buscatodasmensagenschat($_SESSION['tem_codigo'],$_SESSION['hora'],Mysql_Data( date("d-m-Y"),"-"));
while ($Tiblinha = mysql_fetch_row($usuaTibrios0))
{

	$usuaTibrios=buscausuariocodusuariochat($Tiblinha[3]);
	$usuaTibrios=mysql_fetch_array($usuaTibrios);
	if ($_SESSION['usu_codigo']===$usuaTibrios["usu_codigo"] and $Tiblinha[7]=="N") 
	{
		$classe="class=mensagempessoa";
	}
	else
	{
		if ($Tiblinha[2]===$_SESSION['usu_codigo'] and $Tiblinha[7]=="N")
		{
			$classe="class=mensagempessoareservado";
		}
		else
		{
			$italico="";
			$fechatagitalico="";
			if (($_SESSION['usu_codigo']===$usuaTibrios["usu_codigo"] and $Tiblinha[7]=="S") or ($Tiblinha[2]===$_SESSION['usu_codigo'] and $Tiblinha[7]=="S"))
			{
				$classe="class=mensagempessoareservado";
				$italico="<em>";
				$fechatagitalico="</em>";
			}
			else
			{
				$classe="class=mensagemgeral ";
			}
		}
	}
	// mensagem
	$mensagem=$Tiblinha[4];
	// hora da mensagem
	$horamen="(".$Tiblinha[6].")";
	// formatação da linha das mensagens
	$Tibcontrole="NAO";
	if (strpos($Tiblinha[4],'font color=#990000')) 
	{
		$Tibcontrole="SIM";
		echo strtoupper($Tiblinha[4])."<br>";
	}
	else
	{
		if (($_SESSION['usu_codigo']==$Tiblinha[3] and $Tiblinha[7]=="S") or ( $Tiblinha[7]=="S" and   $_SESSION['usu_codigo']==$Tiblinha[3])) 
		{
			$usuarios2=buscausuariocodusuariochat($Tiblinha[2]);
			$rec2=mysql_fetch_array($usuarios2);
			$nome = $rec2["usu_nome"];
			$Tibcontrole="SIM";
			$TmensagemqapareceT=$italico.$horamen." ".$usuaTibrios["usu_nome"]." fala reservadamente para ". $rec2["usu_nome"] .$fechatagitalico.":". $mensagem;
		}
		else
		{
			if ($Tiblinha[7]=="N" and $Tiblinha[2]==0) 
			{
					$Tibcontrole="SIM";
					$TmensagemqapareceT=$horamen." ".$usuaTibrios["usu_nome"]." fala:<br>".$mensagem;			
			}
			else
			{
				if ($Tiblinha[7]=="N")
				{
					$usuarios2=buscausuariocodusuariochat($Tiblinha[2]);
					$usuarios2=mysql_fetch_array($usuarios2);
					$nome=$usuarios2["usu_nome"];
					if ($usuarios2["usu_nome"]=="")
					{
						$nome="todos";
					}
						$Tibcontrole="SIM";
						$TmensagemqapareceT=$horamen." ".$usuaTibrios["usu_nome"]." fala para ".$usuarios2["usu_nome"].":<br>".$mensagem;?>
				<?PHP
			    }
			}
		}
	}
	if ($Tibcontrole==="SIM")
	{
		echo "<span ".$classe.">".$TmensagemqapareceT."</span><br>";
	}
}
?>
</body>