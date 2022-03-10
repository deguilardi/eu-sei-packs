<?
$pack = trim( $_REQUEST[ "pack" ] );
$file = '../packs/'.$pack.'.zip';

if (!is_file($file)) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo 'File not found';
    die();
}
else if (!is_readable($file)) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
    echo 'File not readable';
    die();
}

header('Content-Type: application/json');
$output = array(
    "packageUrl" => "http://server.jogoeusei.com.br/v9/assets/" . $pack . ".zip",
    "remoteVersionUrl" => "http://server.jogoeusei.com.br/v9/assets/" . $pack . ".version",
    "remoteManifestUrl" => "http://server.jogoeusei.com.br/v9/assets/" . $pack . ".manifest",
    "version" => "1.0.0"
);

echo json_encode($output);
