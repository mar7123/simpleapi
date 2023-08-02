<?php

$parts = explode("/", $_SERVER["REQUEST_URI"]);
$upOne = dirname(__DIR__, 1) . "/views";
if ($parts[1] == "api") {
    require __DIR__ . "/api.php";
} else if (str_ends_with(end($parts), ".jpg") || str_ends_with(end($parts), ".png")) {
    $req = $upOne . strtok($_SERVER["REQUEST_URI"], '?');
    require $req;
} else if ($parts[1] == "") {
    require $upOne . "/index.php";
} else {
    $req = $upOne . strtok($_SERVER["REQUEST_URI"], '?') . ".php";
    require $req;
}
