<?php
// Insere este código em HTML para exibir o Titulo da janela que o usuario está.
?>
<table width="100%" cellpadding="0" cellspacing="0">
	<tr> 
	  <td width="720" height="24" align="center" bgcolor="#3399FF" style="border-bottom-width: thin; border-bottom-style: solid; border-bottom-color: #0071E1;"><font size="2" face="Arial, Helvetica, sans-serif" color="#66FFFF"><strong><?=$TITULO_PG?></strong></font></td>
	  <td bgcolor="#3399FF" style="border-bottom-width: thin; border-bottom-style: solid; border-bottom-color: #0071E1;"><input name="sair" type="button" id="sair" value="Sair" class="botao" style="width:100%" onClick="javascript: <?php if($TITULO_PG == "Agenda") echo("sair();"); else echo("location = 'agenda.php';"); ?>"></td>
	</tr>
</table>