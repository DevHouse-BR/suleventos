<?PHP include "../scripts/scriptschat.php" ?>
<?PHP
conecta();
$tem_codigo=$HTTP_POST_VARS["tem_codigo"];
if (is_null($tem_codigo))
{
	$tem_codigo=$HTTP_GET_VARS["tem_codigo"];
}
$gravar=$HTTP_POST_VARS["gravar"];
if (is_null($gravar))
{
	$gravar=$HTTP_GET_VARS["gravar"];
}
$nome=$HTTP_POST_VARS["nome"];
if (is_null($nome))
{
	$nome=$HTTP_GET_VARS["nome"];
}
$_SESSION['tem_codigo']=$tem_codigo;
if ($gravar=="sim")
{
	enviausuariochat($nome,$tem_codigo);
	header("Location: "."chat.php?usu_codigo=".$_SESSION['usu_codigo']."&tem_codigo=".$_SESSION['tem_codigo']."&".SID);
}
?>

<html>
<head>
<title>.:: CHAT::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../styles/chat.css" type="text/css">
<script language="JavaScript">
	//window.resizeTo(630,569);
</script>
<script language="JavaScript">
function valida(){
	if(loginchat.nome.value==""){
		alert("Informe um nome para entrar no chat. Informação necessária.");
		loginchat.nome.focus();
		return false;
	}
}
</script>
<script language="JavaScript">
	//self.resizeTo(630,569);
	telafinal=(screen.width-630)/2
	self.moveTo(telafinal,-25);
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="loginchat.nome.focus();">
<table width="630" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr> 
    <td valign="top" height="66"> 
      <table width="630" border="0" cellspacing="0" cellpadding="0" height="66">
        <tr> 
          <td><img src="../imagens/topo.jpg"></td>
        </tr>
        <tr> 
          <td background="../figuras/chat/bgTitleChat.gif" height="23" style="border-top:solid; border-bottom:solid; border-width:1; border-color:#006633;">
		  		<div align="right"><a href="sairdochat.php" title="Clique aqui para fechar a janela do chat.">Sair 
              do chat</a></div>
		  </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td> 
      <table width="274" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td background="../figuras/chat/cxLogin.gif" height="187"> 
            <table width="274" border="0" cellspacing="0" cellpadding="0">
              <form name="loginchat" method="post" action="loginchat.php" onSubmit="return valida(this);">
                <tr> 
                  <td width="44" height="25">&nbsp;</td>
                  <td>
                    <table width="230" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td height="25" width="80"><font face="Arial, Helvetica, sans-serif" size="2"><b>Seu Nome:</b></font></td>
                        <td>
                          <input type="text" name="nome" size="15" maxlength="25" class="textbox2">
                        </td>
                      </tr>
                      <tr>
                        <td height="25" width="80">&nbsp;</td>
                        <td>
						  <input type="hidden" name="tem_codigo" value="<?PHP echo $tem_codigo?>">
						  <input type="hidden" name="gravar" value="sim">
                          <input type="submit" name="Submit" class="botao" value="Entrar" title="Clique aqui para enviar a mensagem">
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </form>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr> 
    <td height="45" bgcolor="#FF9900">&nbsp;</td>
  </tr>
</table>
</body>
</html>
