<?php

if(!function_exists('pg_query')){
if(stristr(PHP_OS,'win')){dl('php_pgsql.dll');}
else{dl('php_pgsql.so');}}

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
$a=pg_escape_string($a);
}$a=trim($a);return $a;}


function neutral_dbconnect(){
global $db_host,$db_user,$db_pass,$db_name;
$conn_str="host=$db_host port=5432 dbname=$db_name user=$db_user password=$db_pass";
pg_connect($conn_str) or process_error('Cannot connect to database. Please, check config.php...');
}

function neutral_dbpconnect(){
global $db_host,$db_user,$db_pass,$db_name;
$conn_str="host=$db_host port=5432 dbname=$db_name user=$db_user password=$db_pass";
pg_pconnect($conn_str) or process_error('Cannot connect to database. Please, check config.php...');
}

function neutral_query($q){
global $queries;$queries+=1;
$r=pg_query($q) or process_error(pg_last_error());
return $r;}

function neutral_fetch_array($q){
$r=pg_fetch_array($q);return $r;}

function neutral_num_rows($q){
$r=pg_num_rows($q);return $r;}

$autoinc='DEFAULT';

?>