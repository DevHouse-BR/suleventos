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
<style type="text/css">
	a{
		font-family: Arial, Helvetica, sans-serif;
		font-size: 12px;
	}
</style>
<script language="JavaScript">
<!--
	function deslogar()
	{
		self.location = '../chat/sairdochat.php?<?echo SID?>';
	}
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onUnload="deslogar();">
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
</body>
</html>
