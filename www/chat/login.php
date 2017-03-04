<?php

require_once 'config.php';
require_once 'incl/main.inc';

if(isset($blab_name)&&!headers_sent()){
setcookie('blab_name','',$timestamp,'/');
$blab_name=neutral_escape($blab_name,64,'str');
$query='DELETE FROM '.$prefix."_online WHERE usr_name='$blab_name'";
$result=neutral_query($query);
redirect('login.php?logout=1',0,0);}

if(isset($name)){
if(!isset($language)){$language=0;}$language=(int)$language;
if(!isset($offset)){$offset=0;}$offset=(int)$offset;

$name=str_replace("'",'',$name);
$name=str_replace('&','',$name);
$name=str_replace('+','',$name);
$name=str_replace('"','',$name);
$name=str_replace('\\','',$name);
$name=trim($name);
$name=neutral_escape($name,64,'str');

$query='SELECT * FROM '.$prefix."_online WHERE usr_name='$name' AND ($timestamp-rtime)<20";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){redirect('login.php',0,5);}

setcookie('blab_name',$name,time()+3600*24,'/');
setcookie('blab_lang',$language,time()+3600*24*365,'/');
setcookie('blab_time',$offset,time()+3600*24*365,'/');
redirect('blab.php',0,0);}



include 'incl/open_doc.inc';
?>
<div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<div class="y3">
<div style="width:290px;margin:auto">
<form action="login.php" method="post" id="fms" style="padding:0px;margin:0px" onsubmit="return q09('<?php print $lang['all_req'];?>')">
<table style="width:100%" cellspacing="0" class="a">
<tr><td class="b" colspan="4">
<div id="emms" class="s" style="float:right"></div>
<div style="float:left" class="u"><?php print $lang['login'];?></div></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr>
<tr class="c"><td>&nbsp;</td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['name'];?>:</span></td>
<td class="c"><input size="25" type="text" maxlength="16" name="name" /></td>
<td class="c">&nbsp;</td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['lang'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="language">
<?php

require_once 'lang/languages.inc';
for($i=0;$i<count($lang_files);$i++){
if(isset($blab_lang)&&$i==$blab_lang){$sel=' selected="selected"';}else{$sel='';}
$the_lang=explode('.',$lang_files[$i]);$the_lang=ucfirst($the_lang[0]);
print '<option value="'.$i.'"'.$sel.'>'.$the_lang.'</option>';
}
?>
</select>
</td><td></td></tr>

<tr class="c"><td></td>
<td class="c" style="text-align:right"><span class="s"><?php print $lang['timezone'];?>:</span></td>
<td class="c">
<select style="width:100%;font-size:10px" name="offset">
<?php 
if(!isset($blab_time)){$blab_time=$timezone;}
for($i=-12;$i<=13;$i++){if($i!=0){$gmt='';}else{$gmt=' GMT';}
if($i==$blab_time){$sel=' selected="selected"';}else{$sel='';}
$show_time=gmdate('Y-m-d H:i',time()+$i*3600);
print '<option value="'.$i.'"'.$sel.'>'.$show_time.$gmt.'</option>';}?></select>
</td><td></td></tr>

<tr class="c"><td colspan="2"></td>
<td class="c" style="text-align:right"><input type="submit" value="<?php print $lang['ok'];?>" /></td>
<td></td></tr>
<tr class="c"><td class="s" colspan="4">&nbsp;</td></tr></table>
</form>
<?php $version=file('version');$version=$version[0];
/*
<!-- PLEASE KEEP A VISIBLE LINK TO HTTP://HOT-THINGS.NET -->
<div class="s" style="text-align:right">Powered by <a href="http://hot-things.net" onclick="window.open('http://hot-things.net');return false"><b>BlaB Lite  print $version;</b></a></div>
<!-- PLEASE KEEP A VISIBLE LINK TO HTTP://HOT-THINGS.NET -->
*/
?>
</div></div>
<div class="z"></div></body></html>