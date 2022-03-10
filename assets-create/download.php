<?
$pack = trim( $_REQUEST[ "pack" ] );
$file = '../packs/'.$pack.'.zip';

if (!is_file($file)) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo 'File not found';
}
else if (!is_readable($file)) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
    echo 'File not readable';
}

header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK');
header("Content-Type: application/zip");
header("Content-Transfer-Encoding: Binary");
header("Content-Length: " . filesize($file));
header("Content-Disposition: attachment; filename=\"" . basename($file) . "\"");
readfile($file);

error_reporting(0);
$today = date("Y-m-d");
include "../connect.php" ;
mysql_select_db( "jogoeuseiv9" );
$update = mysql_query("UPDATE stats_downloads SET count = count+1 WHERE pack = '".$pack."' AND date = '".$today."'");
if(!$update || mysql_affected_rows() <= 0){
    mysql_query("INSERT INTO stats_downloads (pack, date, count) VALUES ('".$pack."', '".$today."', 1)");
}