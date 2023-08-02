<?php

header("Content-type: application/json; charset=UTF-8");

$url = strtok($_SERVER["REQUEST_URI"], '?');
$truncurl = rtrim($url, "/");
$dir = dirname(__DIR__, 1) . $truncurl;
if (is_dir($dir)) {
    require dirname(__DIR__, 1) . $truncurl . "/index.php";
} else {
    if (is_file(dirname(__DIR__, 1) . $truncurl . ".php")) {
        require dirname(__DIR__, 1) . $truncurl . ".php";
    } else {
        $resdir = dirname(__DIR__, 1) . substr($truncurl, 0, strrpos($truncurl, "/"));
        $files = scandir($resdir);
        foreach ($files as $file) {
            if (str_starts_with($file, "[") && str_ends_with($file, "].php")) {
                require $resdir . "/$file";
            }
        }
    }
}
$controller = new Controller;
$controller->handler();
