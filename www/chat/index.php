<?php
require_once 'config.php';
require_once 'incl/main.inc';

if(isset($language)&&!headers_sent()){$language=(int)$language;
setcookie('blab_lang',$language,time()+3600*24*365,'/');}

if(isset($offset)&&!headers_sent()){$offset=(int)$offset;
setcookie('blab_time',$offset,time()+3600*24*365,'/');}

redirect('login.php',0,0);
?>
