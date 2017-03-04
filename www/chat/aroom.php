<?php
//print 'abra ca dabra';die();
require_once 'config.php';
require_once 'incl/main.inc';

if(!isset($ajx_user)){die('1');}     else{$ajx_user=(int)$ajx_user;}
if(!isset($ajx_name)){die('2');}

if(!isset($ajx_last)){$ajx_last=0;} else{$ajx_last=(int)$ajx_last;}
if(!isset($ajx_zone)){$zone=0;} else{$zone=(int)$ajx_zone;}
if(!isset($ajx_lbiu)){$ajx_lbiu='';} else{$ajx_lbiu=neutral_escape($ajx_lbiu,3,'str');}
if(!isset($ajx_lclr)){$ajx_lclr='';} else{$ajx_lclr=neutral_escape($ajx_lclr,32,'str');}

/* --- */

if(isset($ajx_line)){

$bad_words=file('badwords.txt');
$bad_words=explode(',',$bad_words[0]);
if(count($bad_words)>1){
for($i=0;$i<count($bad_words);$i++){
$ajx_line=eregi_replace($bad_words[$i],'***',$ajx_line);}}
$ajx_line=neutral_escape($ajx_line,255,'str');
$a=substr($timestamp,4,6);$b=microtime();$b=substr($b,2,3);$c=$a.$b;$c=(int)$c;
$query='INSERT INTO '.$prefix."_lines VALUES($c,$ajx_user,'$ajx_name',$timestamp,'$ajx_line','$ajx_lbiu','$ajx_lclr')";
neutral_query($query);}


$query='SELECT MAX(line_id) FROM '.$prefix.'_lines';
$result=neutral_query($query);
if(neutral_num_rows($result)>0){
$the_last=neutral_fetch_array($result);
$the_last=$the_last[0];$the_last=(int)$the_last;}
else{$the_last=0;}

if($the_last<1){$the_last=1;}

$lines=array();


if($ajx_last<$the_last&&$ajx_last>0){
$query='SELECT * FROM '.$prefix."_lines WHERE line_id>$ajx_last ORDER BY line_id asc";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
while($row=neutral_fetch_array($result)){

$time=show_time($row['line_stamp'],$zone,$format);

$from=output($row['from_name'],2);
$from=escape($from);

$post=output($row['line_txt'],2);
$post=escape($post);

$post=bbcode($post);

$style='';
$biu=output($row['line_biu'],2);$biu=escape($biu);
$clr=output($row['line_clr'],2);$clr=escape($clr);
if(strlen($biu)==3){
if(substr($biu,0,1)=='1'){$style.='font-weight:bold;';}
if(substr($biu,1,1)=='1'){$style.='font-style:italic;';}
if(substr($biu,2,1)=='1'){$style.='text-decoration:underline;';}}
if(strlen($clr)>5){$style.='color:'.$clr;}
if($style!=''){$post='<span style="'.$style.'">'.$post.'</span>';}

$lines[]=$time.'*'.$from.'*'.$post;
}}}

$lines=implode('|',$lines);

$keep_time=$update*2;
$query='DELETE FROM '.$prefix."_online WHERE usr_id=$ajx_user OR ($timestamp-rtime)>$keep_time";
neutral_query($query);

$keep_time=$history*60;
$query='DELETE FROM '.$prefix."_lines WHERE ($timestamp-line_stamp)>$keep_time";
neutral_query($query);

$query='INSERT INTO '.$prefix."_online VALUES($ajx_user,'$ajx_name','$my_ip',$timestamp)";
neutral_query($query);

$query='SELECT usr_id,usr_name FROM '.$prefix."_online WHERE ($timestamp-rtime)<20";
$result=neutral_query($query);

$online=array();
while($row=neutral_fetch_array($result)){
$id=(int)$row['usr_id'];
$name=output($row['usr_name'],2);
$name=escape($name);
$online[]=$name.'*'.$id;
}

sort($online);
$online=implode('|',$online);

$alls=$the_last.'^'.$lines.'^'.$online;

print $alls;
?>