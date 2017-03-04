<?php

if(!function_exists('sqlite_query')){
if(stristr(PHP_OS,'win')){dl('php_sqlite.dll');}
else{dl('sqlite.so');}}

$db=0;

function neutral_escape($a,$b,$c){
if(strlen($a)>$b){$a='';}
if($c=='int'){$a=(int)$a;}
else{
if(get_magic_quotes_gpc()){
$a=stripslashes($a);}
if($c!='txt'){
$a=str_replace("\r",'',$a);
$a=str_replace("\n",' ',$a);}
$a=str_replace("\0",'',$a);
$a=sqlite_escape_string($a);
}$a=trim($a);return $a;}

function neutral_dbconnect(){
global $db,$db_sqlite;
$db=sqlite_open($db_sqlite) or process_error('Cannot open database. Please, check config.php...');}

function neutral_dbpconnect(){
global $db,$db_sqlite;
$db=sqlite_popen($db_sqlite) or process_error('Cannot open database. Please, check config.php...');}

function neutral_query($q){
global $db,$queries;$queries+=1;
$r=sqlite_query($db,$q) or process_error(sqlite_error_string(sqlite_last_error($db)));
return $r;}

function neutral_fetch_array($q){
$r=sqlite_fetch_array($q);return $r;}

function neutral_num_rows($q){
$r=sqlite_num_rows($q);return $r;}

$autoinc='NULL';


?>