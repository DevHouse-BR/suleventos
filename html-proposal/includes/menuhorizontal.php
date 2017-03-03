<?php if($HTTP_COOKIE_VARS["tipo_usuario_agenda"] == "professor"){ //Opções disponíveis para o usuário Professor
?>

<table width="775" border="0" cellpadding="0" cellspacing="0" class="menu" bgcolor="#3366FF">
	<tr align="center"><!-- Título de Cada Menu: Quando o mouse passa em cima do título é inserido no <div> respectivo uma tabela contendo o menu em sí -->
		<td height="22" width="11%" style="cursor: hand;" onMouseOver="mostramenu_agenda();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Agenda</font></strong></td>
		<td width="11%" style="cursor: hand;" onMouseOver="mostramenu_cursos();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Cursos</font></strong></td>
		<td width="11%" style="cursor: hand;" onMouseOver="mostramenu_grupos();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Grupos</font></strong></td>
		<td width="11%" style="cursor: hand;" onMouseOver="mostramenu_atividades();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Atividades</font></strong></td>
		<td width="20%" style="cursor: hand;" onMouseOver="mostramenu_dadospessoais();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Dados Pessoais</font></strong></td>
		<td width="11%" style="cursor: hand;" onMouseOver="mostramenu_contatos();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Contatos</font></strong></td>
		<td width="11%" style="cursor: hand;" onMouseOver="mostramenu_links();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Links</font></strong></td>
		<td width="11%" style="cursor: hand;" onClick="go(19);"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Dúvidas</font></strong></td>
	</tr>
	<tr>
		<td><div id="menuagenda" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td><!-- o div fica em branco (sem nenhum código HTML em seu interior) -->
		<td><div id="menucursos" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menugrupos" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menuatividades" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menudadospessoais" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menucontatos" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menulinks" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td></td>
	</tr>
</table>

<?php } ?>

<?php if($HTTP_COOKIE_VARS["tipo_usuario_agenda"] == "aluno"){ //Opções disponíveis para o usuário aluno
?>

<table width="775" border="0" cellpadding="0" cellspacing="0" class="menu" bgcolor="#3366FF">
	<tr align="center">
		<td height="22" width="11%" style="cursor: hand;" onMouseOver="mostramenu_agenda();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Agenda</font></strong></td>
		<td width="11%" style="cursor: hand;" onMouseOver="mostramenu_grupos();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Grupos</font></strong></td>
		<td width="11%" style="cursor: hand;" onClick="go(6);"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Tarefa</font></strong></td>
		<td width="20%" style="cursor: hand;" onMouseOver="mostramenu_dadospessoais();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Dados Pessoais</font></strong></td>
		<td width="11%" style="cursor: hand;" onMouseOver="mostramenu_contatos();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Contatos</font></strong></td>
		<td width="11%" style="cursor: hand;" onMouseOver="mostramenu_links();"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Links</font></strong></td>
		<td width="11%" style="cursor: hand;" onClick="go(19);"><strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Dúvidas</font></strong></td>
	</tr>
	<tr>
		<td><div id="menuagenda" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menugrupos" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menuatividades"></div></td>
		<td><div id="menudadospessoais" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menucontatos" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menulinks" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
		<td><div id="menucursos" style="z-index: 9999; text-align: center;" onMouseOver="start();" onMouseOut="saiu = 1;"></div></td>
	</tr>
</table>

<?php } ?>