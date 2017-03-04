<?php
require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($blab_name)){redirect('login.php',0,5);}

$blab_name=str_replace("'",'',$blab_name);
$blab_name=str_replace('&','',$blab_name);
$blab_name=str_replace('+','',$blab_name);
$blab_name=str_replace('"','',$blab_name);
$blab_name=str_replace('\\','',$blab_name);
$blab_name=trim($blab_name);
$blab_name=neutral_escape($blab_name,64,'str');

$query='SELECT * FROM '.$prefix."_online WHERE usr_name='$blab_name' AND ($timestamp-rtime)<20";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){redirect('login.php',0,5);}

mt_srand((double)microtime()*999999);
$usr_id=mt_rand(1,999999);
$ajx_name=$blab_name;

include 'incl/open_doc.inc';
?>
<script type="text/javascript">

q04();sess=q10();

ajx_last=0;ajx_line='';ajx_sndd=1;
ajx_name='<?php print $ajx_name;?>';
ajx_zone=parseInt('<?php print $timezone;?>');
ajx_user=parseInt('<?php print $usr_id;?>');
set_refr=parseInt('<?php print $update;?>');
set_onle='<?php print $lang['online'];?>';
set_disc='<?php print $lang['disconnect'];?>';
set_clck='<?php print $lang['continue'];?>';
sup_errs=parseInt('<?php print $no_errs;?>');

txt='';stlB=0;stlI=0;stlU=0;stlC=0;
</script>

<div id="dvx" class="x">
<div style="float:right"><?php include 'banner.html';?></div>

<div style="float:left;margin:5px;white-space:nowrap">
<a href="info.php?why=link" onclick="q05('login.php?logout=1');return false"><?php $pic=show_pic($navi['exitt'],0);print $pic;?></a>
<? //<a href="info.php?why=link" onclick="q19();return false"><?php $pic=show_pic($navi['sound'],0);print $pic;</a> ?>
<? //<a href="info.php?why=link" onclick="q21();return false"><?php $pic=show_pic($navi['tzone'],0);print $pic;</a>?>
<a href="info.php?why=link" onclick="q18();return false"><?php $pic=show_pic($navi['color'],0);print $pic;?></a>
<a href="info.php?why=link" onclick="q20();return false"><?php $pic=show_pic($navi['smile'],0);print $pic;?></a>
</div>

<br style="clear:both" /></div>
<div class="y0"><span class="s">
<?php /* $version=file('version');$version=$version[0];

<!-- PLEASE KEEP A VISIBLE LINK TO HTTP://HOT-THINGS.NET -->
<a href="http://hot-things.net" onclick="window.open('http://hot-things.net');return false"><b>BlaB LITE</b></a>
<!-- PLEASE KEEP A VISIBLE LINK TO HTTP://HOT-THINGS.NET -->

[<a href="info.php?why=link" onclick="pp=window.open('history.php','history','width=400,height=200,resizable=1,scrollbars=1');pp.focus();return false"></a>]
</span>
*/ ?>
</div>
<div id="dvB" class="y1"></div>
<div id="dvC" class="y2"></div>
<div id="dvE" class="y4" style="display:none">
<script type="text/javascript">
<?php
include 'incl/smilies.inc';

$sm_tag=array();
$sm_img=array();
$colors="'000000','000033','000066','000099','0000CC','0000FF','003300','003333','003366','003399','0033CC','0033FF','006600','006633','006666','006699','0066CC','0066FF','009900','009933','009966','009999','0099CC','0099FF','00CC00','00CC33','00CC66','00CC99','00CCCC','00CCFF','00FF00','00FF33','00FF66','00FF99','00FFCC','00FFFF','330000','330033','330066','330099','3300CC','3300FF','333300','333333','333366','333399','3333CC','3333FF','336600','336633','336666','336699','3366CC','3366FF','339900','339933','339966','339999','3399CC','3399FF','33CC00','33CC33','33CC66','33CC99','33CCCC','33CCFF','33FF00','33FF33','33FF66','33FF99','33FFCC','33FFFF','660000','660033','660066','660099','6600CC','6600FF','663300','663333','663366','663399','6633CC','6633FF','666600','666633','666666','666699','6666CC','6666FF','669900','669933','669966','669999','6699CC','6699FF','66CC00','66CC33','66CC66','66CC99','66CCCC','66CCFF','66FF00','66FF33','66FF66','66FF99','66FFCC','66FFFF','990000','990033','990066','990099','9900CC','9900FF','993300','993333','993366','993399','9933CC','9933FF','996600','996633','996666','996699','9966CC','9966FF','999900','999933','999966','999999','9999CC','9999FF','99CC00','99CC33','99CC66','99CC99','99CCCC','99CCFF','99FF00','99FF33','99FF66','99FF99','99FFCC','99FFFF','CC0000','CC0033','CC0066','CC0099','CC00CC','CC00FF','CC3300','CC3333','CC3366','CC3399','CC33CC','CC33FF','CC6600','CC6633','CC6666','CC6699','CC66CC','CC66FF','CC9900','CC9933','CC9966','CC9999','CC99CC','CC99FF','CCCC00','CCCC33','CCCC66','CCCC99','CCCCCC','CCCCFF','CCFF00','CCFF33','CCFF66','CCFF99','CCFFCC','CCFFFF','FF0000','FF0033','FF0066','FF0099','FF00CC','FF00FF','FF3300','FF3333','FF3366','FF3399','FF33CC','FF33FF','FF6600','FF6633','FF6666','FF6699','FF66CC','FF66FF','FF9900','FF9933','FF9966','FF9999','FF99CC','FF99FF','FFCC00','FFCC33','FFCC66','FFCC99','FFCCCC','FFCCFF','FFFF00','FFFF33','FFFF66','FFFF99','FFFFCC','FFFFFF'";

for($i=0;$i<count($emoticons);$i++){
$csm=explode(' ',$emoticons[$i]);
if(isset($csm[1])&&is_file("incl/smilies/$csm[1]")){
$sm_tag[]="'$csm[0]'";$sm_img[]="'$csm[1]'";}}

$sm_tag=implode(',',$sm_tag);
$sm_img=implode(',',$sm_img);

print 'smiles=new Array('.$sm_tag.');';
print 'sfiles=new Array('.$sm_img.');';
print 'colors=new Array('.$colors.');';
?>q01();</script></div>
<div id="dvF" class="y4" style="display:none"><script type="text/javascript">q02();</script></div>

<div id="dvG" class="y5" style="display:none">
<div class="s" style="text-align:center;font-weight:bold">
&laquo;<script type="text/javascript">q03();</script>&raquo;</div></div>

<div id="dvH" class="y4" style="display:none">
<div class="s" style="text-align:center;font-weight:bold">
<a href="info.php?why=link" style="text-decoration:none" onclick="q17(1);return false"><?php print $lang['on'];?></a> / 
<a href="info.php?why=link" style="text-decoration:none" onclick="q17(0);return false"><?php print $lang['off'];?></a></div></div>

<div id="dvz" class="z">
<form action="blab.php" style="margin:0px;padding:0px" onsubmit="q14();return false">
<table cellspacing="1" id="inpt" style="float:left;margin:1px;padding-top:2px;width:100%">
<tr><td style="width:80%"><input type="text" size="25" style="width:100%" id="ln" value="" maxlength="127" /></td>
<td><input type="submit" value="<?php print $lang['ok'];?>" onclick="q14();return false" /></td>
<td>&nbsp;&nbsp;</td>
<td style="text-align:right;white-space:nowrap">
<input class="m" type="button" value=" N " onclick="r=document.getElementById('ln');if(this.className=='m'){this.className='n';r.style.fontWeight='bold';stlB=1}else{this.className='m';r.style.fontWeight='normal';stlB=0};q00();return false" />
<input class="m" type="button" value=" I " onclick="r=document.getElementById('ln');if(this.className=='m'){this.className='n';r.style.fontStyle='italic';stlI=1}else{this.className='m';r.style.fontStyle='normal';stlI=0};q00();return false" />
<input class="m" type="button" value=" S " onclick="r=document.getElementById('ln');if(this.className=='m'){this.className='n';r.style.textDecoration='underline';stlU=1}else{this.className='m';r.style.textDecoration='none';stlU=0};q00();return false" />
<input class="m" type="button" value=" &nbsp; " onclick="q18();return false" id="cl" />
&nbsp;</td></tr></table></form>

</div>
<script type="text/javascript">
lock=0;q25();q22();
if(navigator.userAgent.indexOf('Opera/8')!=-1){dvB.style.overflow='auto'}
</script></body></html>