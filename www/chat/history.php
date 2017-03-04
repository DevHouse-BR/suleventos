<?php
require_once 'config.php';
require_once 'incl/main.inc';

$format='Y-m-d H:i:s';

/* --- */

include 'incl/open_doc.inc';
print '<script type="text/javascript">document.body.style.overflow=\'auto\';</script><div style="padding:5px">';

$query='SELECT * FROM '.$prefix."_lines ORDER BY line_id asc";
$result=neutral_query($query);

while($row=neutral_fetch_array($result)){
$time=show_time($row['line_stamp'],$timezone,$format);

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

$time='<span class="s">['.$time.']</span> ';
$from='<span class="s"><b>'.$from.'</b></span>: ';

print $time.$from.$post.'<br />';}

?>
</div></body></html>