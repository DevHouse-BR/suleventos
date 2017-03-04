<?PHP include "../scripts/scriptschat.php" ?>
<?PHP

conecta();
limparusuarioschat();

$PHPSESSID=$HTTP_POST_VARS["PHPSESSID"];
if (is_null($PHPSESSID))
{
	$PHPSESSID=$HTTP_GET_VARS["PHPSESSID"];
}

$nome=$HTTP_POST_VARS["nome"];
$tem_codigo=$_SESSION['tem_codigo'];
$mensagem=$HTTP_POST_VARS["mensagem"];
$enviamsg=$HTTP_POST_VARS["enviamsg"];
$reservado=$HTTP_POST_VARS["reservado"];
$cod_usuario_destino=$HTTP_POST_VARS["cod_usuario_destino"];
if ($cod_usuario_destino=="") 
{
	$cod_usuario_destino=0;
}
//filtra_palavra($mensagemret,$mensagem);
if ($enviamsg=="sim")
{
	enviamensagemchat($mensagem,$tem_codigo,$_SESSION['usu_codigo'],$cod_usuario_destino,$reservado);
}
$rec2=buscausuarioschat($_SESSION['tem_codigo']);
?>
<script language="JavaScript">
<!--
function valida(){
	if(enviamensagem.mensagem.value==""){
		alert("Digite alguma mensagem antes de enviar.");
		enviamensagem.mensagem.focus();
		return false;
	}
}
parent.conteudo.document.location.reload();
// -->
</script>
<link rel="stylesheet" href="../styles/chat.css" type="text/css">
<meta http-equiv="refresh" content="120">
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="enviamensagem.mensagem.focus();">
<table width="630" border="0" cellspacing="0" cellpadding="3">
  <form name="enviamensagem" method="post" action="chatenvio.php" onSubmit="return valida(this);">
    <tr> 
      <td height="20" width="74"><span  class="mensagemgeral" >Mensagem:</span></td>
      <td width="227"> <input type="text" name="mensagem" size="40" maxlength="250" class="textbox2"> 
        <input type="hidden" name="enviamsg" value="sim"> </td>
      <td width="89"> <div align="center"><span  class="mensagemgeral" >fala para</span></div></td>
      <td width="80">
        <select name="cod_usuario_destino"  class="textbox2">
          <option value="">Todos</option>
          <?PHP
		  while ($linha = mysql_fetch_row($rec2))
		  {
		   		if ($_SESSION['usu_codigo']!=$linha[0]) {?>
          <option value="<?PHP echo $linha[0]?>"
				 	<?PHP if ($cod_usuario_destino==$linha[0]) { ?>selected<?PHP }?>> 
          <?PHP
						echo substr($linha[2],0,10)?>
          </option>
          <?PHP
				}
			}
?>
        </select>
        </font></td>
      <td width="130"> 
        <input type="submit" name="Submit" class="botao" value="Enviar" title="Clique aqui para enviar a mensagem"></td>
    </tr>
    <tr> 
      <td height="20" width="74"><font color="#000000">&nbsp;</font></td>
      <td>&nbsp; </td>
      <td> <input type="hidden" name="PHPSESSID" value="<?php echo $PHPSESSID?>"> 
        <font color="#000000">&nbsp; </font> </td>
      <td><div align="right"></div></td>
      <td> <!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="18%"><font color="#000000">
              <input type="checkbox" name="reservado" value="S" <?PHP
			
			if( $reservado=="S") 
			{
				echo "checked";
			}?>  >
              </font></td>
            <td width="82%"><span class="textopadrao">Reservado</span></td>
          </tr>
        </table>-->
       </td>
    </tr>
  </form>
</table>
