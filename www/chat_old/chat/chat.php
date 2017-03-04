<?PHP include "../scripts/scriptschat.php" ?>
<?PHP
conecta();
$tem_codigo=$_SESSION['tem_codigo'];
if  ($_SESSION['usu_codigo']=="" or $_SESSION['tem_codigo']=="")
{
	header("Location: "."loginchat.php");
}
$recNome=buscachat($tem_codigo);
?>

<html>
<head>
<title>.:: CHAT::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
<link rel="stylesheet" href="../styles/chat.css" type="text/css">
<script language="JavaScript">
<!--
	function MM_reloadPage(init) 
	{  
		//reloads the window if Nav4 resized
	  	if (init==true) with (navigator) 
		{
			if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
				document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; 
			}
		}
	  	else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
	}
	MM_reloadPage(true);
	// -->
	// desloga o usuário se ele clicar no X do navegador ou alt+f4
	function deslogar()
	{
		window.open('../chat/sairdochat.php?<?echo SID?>','chat2','width=100,height=100,menubar=0,scroolbars=0');
		alert("Obrigado e Volte Sempre!");
	}

	//self.resizeTo(630,569);
	telafinal=(screen.width-630)/2
	self.moveTo(telafinal,0);
</script>


</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onUnload="deslogar();">
<iframe src="../includes/chatenvio.php?<?echo SID;?>" id="rodape" style="position:absolute; left:0px; top:502px; width:630px; height:86px; z-index:3; background-color: #3399FF; layer-background-color: #678167; border: 1px none #000000 overflow; overflow: hidden; visibility: visible">Seu 
navegador não suporta frames ! </iframe> 
<iframe src="../includes/chatmensagem.php?<?echo SID;?>"  id="conteudo" style="position:absolute; left:-2px; top:95px; width:632px; height:418px; z-index:1; overflow: auto">Seu 
navegador não suporta frames ! </iframe> 
<table width="630" border="0" cellspacing="0" cellpadding="0" height="89%">
  <tr> 
    <td valign="top" height="66"> 
      <table width="630" border="0" cellspacing="0" cellpadding="0" height="66">
        <tr> 
          <td colspan="2"><img src="../imagens/topo.jpg" width="630" height="74" border="0" usemap="#Map"></td>
        </tr>
        <tr> 
          <td background="../figuras/chat/bgTitleChat.gif" height="10" class="mensagemgeral" style="border-top:solid; border-bottom:solid; border-width:1; border-color:#006633;" width="520">&nbsp;<b>SulEventos - O Portal do Evento</b></td>
          <td background="../figuras/chat/bgTitleChat.gif" height="10" style="border-top:solid; border-bottom:solid; border-width:1; border-color:#006633;">
            <div align="right"><a href="sairdochat.php?<?echo SID;?>" title="Clique aqui para fechar a janela do chat.">Sair</a></div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
