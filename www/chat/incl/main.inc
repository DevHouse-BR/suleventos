<?php

$c_doc=$_SERVER['PHP_SELF'];
$my_ip=$_SERVER['REMOTE_ADDR'];

if(!stristr($c_doc,'aroom.php')){

if(isset($blab_time)){$timezone=(int)$blab_time;}

require_once 'lang/languages.inc';
if(isset($blab_lang)&&isset($lang_files[$blab_lang])){
$set_lang='lang/'.$lang_files[$blab_lang];}
else{$set_lang='lang/'.$lang_files[0];}

require_once $set_lang;
require_once 'incl/skin.inc';}

require_once 'incl/'.$db_type.'_functions.inc';

$random=mt_rand(1,999999);
$timestamp=time();
set_magic_quotes_runtime(0);
$queries=0;$gzip='2';

/* --- */

function show_time($a,$b,$c){
return gmdate($c,$a+$b*3600);}

function process_error($s){
global $lang,$error_log,$my_ip;
if(is_writeable($error_log)){
$s=date('Y-m-d H:i:s').' '.$my_ip.' '.$s;
$content=file($error_log);
$content=implode('',$content);
$content=trim($s."\n".$content);
$fd=fopen($error_log,"w");
$fout=fwrite($fd,$content);
fclose($fd);}
die('SQL error... Please check your error log file for details...');}

function show_pic($a,$b){
$c='';$a=explode('|',$a);
if(isset($a[0])&&isset($a[1])&&isset($a[2])&&isset($a[3])){
$c.= "<img class=\"i\" src=\"incl/$a[0]\" alt=\"$a[2]\" title=\"$a[2]\" ";
if(isset($a[1])&&strlen($a[1])>4){
$c.= "onmouseover=\"this.src='incl/$a[1]'\" onmouseout=\"this.src='incl/$a[0]'\"";}
if(isset($b)&&strlen($b)>3){$c.= " $b";}
if(isset($a[3])&&strlen($a[3])>3){$c.= " $a[3]";}
$c.= ' />';}
else{$a=implode('|',$a);$c.= $a;}
return $c;}

function redirect($url,$msg,$wait){
if(strlen($url)>1&&$wait=='0'){header("location:$url");die();}
else{global $lang,$title;
include 'incl/open_doc.inc';
print '<div class="x"></div><div class="y1">';
if(strlen($msg)>1){print $msg;}
if(strlen($url)>1){
print '<script type="text/javascript">url=\''.$url.'\';setTimeout(\'window.location=url\',3000);</script>';
print '<br /><br /><a href="info.php?why=link" onclick="return q05(\''.$url.'\')"><b>'.$lang['continue'].'</b></a>';
}print '</div><div class="z"></div></body></html>';die();}}

function output($a,$b){
$a=str_replace('&','&amp;',$a);
$a=str_replace('<','&lt;',$a);
$a=str_replace('>','&gt;',$a);
$a=str_replace('"','&quot;',$a);
switch($b){
case 1: print $a;break;  //forms
case 2: return $a;break; //no print
default:$a=str_replace("\r\n",'<br />',$a);print $a;break;   //default
}}

function bbcode($t) {
$t=eregi_replace('[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]','<a href="info.php?why=link" onclick="window.open(\'\\0\');return false">\\0</a>',$t);

$t=eregi_replace("\[b\]","<b>",$t);
$t=eregi_replace("\[/b\]","</b>",$t);
$t=eregi_replace("\[u\]","<u>",$t);
$t=eregi_replace("\[/u\]","</u>",$t);
$t=eregi_replace("\[i\]","<i>",$t);
$t=eregi_replace("\[/i\]","</i>",$t);

$t=eregi_replace("\[/c\]","</span>",$t);
$t=eregi_replace("\[c=([[:alnum:]#()\, ]+)\]","<span style=\"color:\\1\">",$t);

include 'incl/smilies.inc';
$emoticons=array_merge($emoticons,$aliases);
for($i=0;$i<count($emoticons);$i++){
$row=explode(' ',$emoticons[$i]);
$t=str_replace($row[0],"<img src=\"incl/smilies/$row[1]\"  title=\"$row[0]\" alt=\"$row[0]\" />",$t);
}

return $t;}

function escape($t){
$t=str_replace('"','&#34;',$t);
$t=str_replace("'",'&#39;',$t);
$t=str_replace('*','&#42;',$t);
$t=str_replace('^','&#94;',$t);
$t=str_replace('|','&#124;',$t);
return $t;}

/* --- */

if(isset($persistent_connection)&&$persistent_connection=='1'){
neutral_dbpconnect();}else{neutral_dbconnect();}

/* --- */

if($update<6){$update=6;}

if(isset($_SERVER['HTTP_USER_AGENT'])){$browser=$_SERVER['HTTP_USER_AGENT'];}else{$browser='';}
if(stristr($browser,'msie')&&!stristr($browser,'opera')){$msie='1';}else{$msie='0';}

if(function_exists('ob_gzhandler')&&($gzip=='1'||($gzip=='2'&&$msie=='0'))){ob_start('ob_gzhandler');}
elseif(function_exists('ob_start')){ob_start();}

if(!headers_sent()){
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Content-type: text/html; charset=UTF-8");}
?>