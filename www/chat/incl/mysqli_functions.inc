<?php

if(!function_exists('mysqli_query')){
if(stristr(PHP_OS,'win')){dl('php_mysqli.dll');}
else{dl('mysqli.so');}}

$sqli_link=0;

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
global $sqli_link,$db_host,$db_user,$db_pass,$db_name;
$sqli_link=mysqli_connect($db_host,$db_user,$db_pass,$db_name) or process_error('Cannot connect to database. Please, check config.php...');
}

function neutral_dbpconnect(){
global $sqli_link,$db_host,$db_user,$db_pass,$db_name;
$sqli_link=mysqli_connect($db_host,$db_user,$db_pass,$db_name) or process_error('Cannot connect to database. Please, check config.php...');
}

function neutral_query($q){
global $sqli_link,$queries;$queries+=1;
$r=mysqli_query($sqli_link,$q) or process_error(mysqli_error($sqli_link));
return $r;}

function neutral_fetch_array($q){
$r=mysqli_fetch_array($q);return $r;}

function neutral_num_rows($q){
$r=mysqli_num_rows($q);return $r;}

$autoinc='NULL';


?>