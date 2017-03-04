<?PHP include "../scripts/scriptschat.php" ?>
<?PHP
conecta();
$PHPSESSID=$HTTP_GET_VARS["PHPSESSID"];
if ($_SESSION['usu_codigo']!="")
{
	$usuarios1=buscausuariocodusuariochat($_SESSION['usu_codigo']);
	$usuarios1=mysql_fetch_array($usuarios1);
	$usu_nome=$usuarios1["usu_nome"];
	limparusuarioschatcodusuario($_SESSION['usu_codigo'],$usu_nome);
}
?>
<script language="JavaScript">window.close();</script>
