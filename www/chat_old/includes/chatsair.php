<?PHP include "../scripts/scriptschat.php" ?>
<?PHP
conecta();
sairusuarioschat($_SESSION['cod_usuario'],$_SESSION['tem_codigo']);

session_unset();
session_destroy();
?>

<script language="JavaScript">window.close();</script>
