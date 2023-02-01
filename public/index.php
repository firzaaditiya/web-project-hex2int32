<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Z44\Hex2int\App\Router;
use Z44\Hex2int\Controller\{HomeController, ConvertController};

Router::add("GET", "/", HomeController::class, "index", []);
Router::add("POST", "/convert", ConvertController::class, "postConvert", []);

Router::run();