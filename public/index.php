<?php
declare(strict_types=1);

use ObsidianPages\Routing\RouteHandler;
use ObsidianPages\SessionData;

require 'config.php';
require VENDOR_FOLDER . '/autoload.php';
$routes = require PHP_FOLDER . '/Routing/routes.php';

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", "1");
}

SessionData::createInstance();

$routeHandler = new RouteHandler($_SERVER);
$routeHandler->Add(...$routes);
$result = $routeHandler->Execute();

$mimeType = $result->getMimeType();

http_response_code($result->getHttpCode());
if ($mimeType !== '') {
    header('Content-Type: '.$mimeType);
}
echo $result->getResponse();