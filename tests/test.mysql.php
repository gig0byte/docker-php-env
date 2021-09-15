<?php
if (!function_exists('mysqli_connect')) {
    echo '<pre>mysql extension loaded: ', extension_loaded('mysql') ? 'yes' : 'no', "\r\n";
    $cf = get_cfg_var('cfg_file_path');
    echo 'ini file: ', $cf, "\r\n";
    if (!$cf || !file_exists($cf)) {
        echo "no config file\r\n";
    } else {
        echo "mysql config options:\r\n";
        $mc = array_filter(file($cf), function ($e) {
            return false !== stripos($e, 'mysql') && false !== stripos($e, 'extension');
        });
        echo join("", $mc);
    }
    die('no function mysqli_connect</pre>');
} else {
    $host = getenv("MYSQL_HOST");
    $user = getenv("MYSQL_USER");
    $pass = getenv("MYSQL_PASSWORD");
    $db = getenv("MYSQL_DATABASE");
    $port = getenv("MYSQL_TCP_PORT");


    $conn = mysqli_connect($host, $user, $pass, $db, $port);

    if ($conn) {
        $query = mysqli_query($conn, 'SHOW VARIABLES like "version"');
        $version = mysqli_fetch_array($query)[1];

        echo "MySQL version: ".$version;
    }
}


