<?php
declare(strict_types=1);

use ObsidianPages\Authentication\AuthenticationHandler;
use ObsidianPages\Authentication\Authentications\StaticAuthentication;
use ObsidianPages\Configuration\ConfigurationHandler;
use ObsidianPages\Configuration\Configurations\BasicConfiguration;
use ObsidianPages\Configuration\Configurations\SmartyConfiguration;
use ObsidianPages\Exceptions\ErrorHandler;
use ObsidianPages\Routing\RouteHandler;
use ObsidianPages\SessionData;

const BASE_FOLDER = __DIR__ . '/..'; // this is the folder where the php folder is in.
const VENDOR_FOLDER = BASE_FOLDER . '/vendor';

require VENDOR_FOLDER . '/autoload.php';

if (ConfigurationHandler::DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", "0");
    set_error_handler([ErrorHandler::class, 'HandleWarning'], E_WARNING);
    set_error_handler([ErrorHandler::class, 'HandleError'], E_ERROR);
    register_shutdown_function([ErrorHandler::class, 'ShutdownFunction']);
}

$configInstance = ConfigurationHandler::Instance();
$configInstance->AddDefaults();
$routes = require $configInstance->Get(BasicConfiguration::class)->getPhpFolder() . '/Routing/routes.php';

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