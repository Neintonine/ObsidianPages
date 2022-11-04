<?php
declare(strict_types=1);

use ObsidianPages\Routing\RouteData;
use ObsidianPages\Routing\RouteHandler;
use ObsidianPages\Routing\RouteResult;
use ObsidianPages\SessionData;

require 'config.php';
require '../vendor/autoload.php';
$routes = require './Routing/routes.php';

error_reporting(E_ALL);
ini_set("display_errors", "1");

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