<?php

/* PLEASE DO NOT ALLOW EVEN ONE BLANK SPACE/LINE IN THIS FILE OUTSIDE '<?php' AND '?>' */

error_reporting(1);import_request_variables('gpc');error_reporting(8);


// --------------------------------- //


$db_type='mysql';                    // database type, *lowercase* ( options: mysql, mysqli, postgre, sqlite )

$db_host='mysql.suleventos.com.br';                // database host ( in most cases 'localhost' )
$db_user='suleventos';                         // database user (not used with sqlite)
$db_pass='s28b06j15hh';                         // database password  (not used  with sqlite)
$db_name='suleventos';                         // Database [mysql, postgre]. Note that the installation script cannot create a database for you!
$db_sqlite='sqlite/blablite.dat';    // Database [sqlite]: 'path/filename', the file must be CHMODed to 777! )

$prefix='blte';                      // Table prefix
$error_log='sql_errors.txt';         // CHMODed to 777 file to store sql errors
$persistent_connection='0';          // [0 or 1] Establishes a persistent connection to the SQL server. If you are not sure leave it '0'


$title='BlaB! Lite';

$format='H:i:s';     // Time format
$timezone=-3;         // 0=GMT [default]

$update=6;           // seconds, greater than 5
$history=20;         // minutes

$no_errs=1;          /* suppress http errors caused by network lags etc 
                     [0 = sometimes errors & error info, 1 = no errors & no info] */

?>