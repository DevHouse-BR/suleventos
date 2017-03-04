<?php 
require_once 'config.php';

require_once 'lang/languages.inc';
$set_lang='lang/'.$lang_files[0];

require_once $set_lang;
require_once 'incl/skin.inc';
require_once 'incl/'.$db_type.'_functions.inc';

print '<?xml version="1.0" encoding="utf-8"?>';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>INSTALL BlaB! LITE 3.x</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="incl/style.css" />
</head><body class="y"><div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<?php 
if(isset($ff)&&$ff=='1'){

switch($db_type){
case 'sqlite'  :$heap_type='';break;
case 'postgre' :$heap_type='';break;
default        :$heap_type=' TYPE=HEAP MAX_ROWS=15000;';break;
}

$install=array();neutral_dbconnect();

/* ---- */

$install[]='CREATE TABLE '.$prefix.'_online(
usr_id integer NOT NULL,
usr_name varchar(64) NOT NULL,
usr_ip varchar(15) NOT NULL,
rtime integer NOT NULL)'.$heap_type;

/* ---- */

$install[]='CREATE TABLE '.$prefix.'_lines(
line_id integer NOT NULL,
from_id integer NOT NULL,
from_name varchar(64) NOT NULL,
line_stamp integer NOT NULL,
line_txt varchar(255) NOT NULL,
line_biu varchar(3) NOT NULL,
line_clr varchar(32) NOT NULL)'.$heap_type;

/* ---- */

for($i=0;$i<count($install);$i++){
neutral_query($install[$i]);}

print '<div class="y1"><b>Install completed!</b><br /><br />Remove <i>install.php</i> and <a href="info.php?why=link" onclick="window.location=\'index.php\';return false"><b>click here</b></a>.</div>';
print '<div class="z"></div></body></html>';
die();}


else{
print '<div class="y1"><b>Installing BlaB! LITE 3.x</b><br /><br />Preparing to install... <a href="info.php?why=link" onclick="window.location=\'install.php?ff=1\';return false"><b>Click here</b></a> to continue. If the install fails, open <i>config.php</i> by a text editor, make sure that all required variables are correct and re-upload <i>config.php</i>.</div>';
print '<div class="z"></div></body></html>';
die();}

?>