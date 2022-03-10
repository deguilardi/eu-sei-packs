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
    "packageUrl" => "https://deguilardi.github.io/eu-sei-packs/assets/" . $pack . ".zip",
    "remoteVersionUrl" => "https://deguilardi.github.io/eu-sei-packs/assets/" . $pack . ".version",
    "remoteManifestUrl" => "https://deguilardi.github.io/eu-sei-packs/assets/" . $pack . ".manifest",
    "version" => "1.0.0",
    // "engineVersion" => "1.0.0",
    "assets" => array(
        "main" => array(
            "key" => "main",
            "md5" => md5_file($file),
            "compressed" => true,
            "size" => filesize($file)
        )
    ),
    "searchPaths" => array()
);

echo json_encode($output);
