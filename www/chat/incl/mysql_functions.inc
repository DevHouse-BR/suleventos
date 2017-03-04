<?php

if(!function_exists('mysql_query')){
if(stristr(PHP_OS,'win')){dl('php_mysql.dll');}
else{dl('mysql.so');}}

function neutral_escape($a,$b,$c){
if(strlen($a)>$b){$a='';}
if($c=='int'){$a=(int)$a;}
else{
if(!get_magic_quotes_gpc()){
$a=addslashes($a);}
if($c!='txt'){
$a=str_replace("\r",'',$a);
$a=str_replace("\n",' ',$a);}
$a=str_replace("\0",'',$a);
}$a=trim($a);return $a;}

function neutral_dbconnect(){
global $db_host,$db_user,$db_pass,$db_name;
mysql_connect($db_host,$db_user,$db_pass) or process_error('Cannot connect to database. Please, check config.php...');
mysql_select_db($db_name) or process_error(mysql_error());}

function neutral_dbpconnect(){
global $db_host,$db_user,$db_pass,$db_name;
mysql_pconnect($db_host,$db_user,$db_pass) or process_error('Cannot connect to database. Please, check config.php...');
mysql_select_db($db_name) or process_error(mysql_error());}

function neutral_query($q){
global $queries;$queries+=1;
$r=mysql_query($q) or process_error(mysql_error());
return $r;}

function neutral_fetch_array($q){
$r=mysql_fetch_array($q);return $r;}

function neutral_num_rows($q){
$r=mysql_num_rows($q);return $r;}

$autoinc='NULL';

?>