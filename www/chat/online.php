<?php 
require_once 'config.php';
require_once 'incl/main.inc';

print '<?xml version="1.0" encoding="utf-8"?>';
print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'; 
print '<html xmlns="http://www.w3.org/1999/xhtml"><head><title>...</title>';
print '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
print '<style type="text/css">body,p{margin:0px;padding:1px;font-family:verdana,sans-serif;font-size:11px}</style>';
print '</head><body onload="url=self.location.toString();setTimeout(\'self.location=url\',20000)">';

$separator=', ';

$query='SELECT usr_name FROM '.$prefix."_online WHERE ($timestamp-rtime)<20";
$result=neutral_query($query);

$online=array();
while($row=neutral_fetch_array($result)){
$online[]=output($row['usr_name'],2);}

sort($online);
$how_many=count($online);
$online=implode($separator,$online);


// print '<p>'.$how_many.'</p>';
print '<p>'.$online.'</p>';

print '</body></html>';
?>