<?php
declare(strict_types=1);

namespace ObsidianPages\System;

use Aura\Router\Exception;
use ObsidianPages\Routing\Router;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

final class Startup
{
    /**
     * @throws Exception
     */
    public static function Run(): void
    {
        if (!PROD) {
            self::SetupErrorHandler();
        }

        $router = new Router();
        $router->setRoutes();
        $response = $router->getRoute();
        $router->applyResponse($response);
    }

    private static function SetupErrorHandler()
    {
        error_reporting(E_ALL);
        ini_set("display_errors", "1");

        $whoops = new Run;
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();
    }
}