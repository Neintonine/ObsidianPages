<?php
declare(strict_types=1);

namespace ObsidianPages\Routing;

use Aura\Router\Exception;
use Aura\Router\Generator;
use Aura\Router\Matcher;
use Aura\Router\RouterContainer;
use ObsidianPages\Routing\Routes\IndexRoute;
use ObsidianPages\Routing\Routes\PublicResourceRoute;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequestFactory;

final class Router
{
    private readonly RouterContainer $container;

    public function __construct()
    {
        $this->container = new RouterContainer();
    }

    public function setRoutes() {
        $map = $this->container->getMap();
        $map->get('index', '/', new IndexRoute);

        $resourceRoute = new PublicResourceRoute;
        $map->get('publicResources', '/', $resourceRoute)
            ->wildcard('url')
            ->special($resourceRoute->filter(...));
    }

    /**
     * @throws Exception
     */
    public function getRoute(): Response {
        $request = ServerRequestFactory::fromGlobals(
            $_SERVER,
            $_GET,
            $_POST,
            $_COOKIE,
            $_FILES
        );

        $matcher = $this->container->getMatcher();
        $route = $matcher->match($request);
        if (!$route) {
            return $this->handleMissingRoute($matcher);
        }

        // add route attributes to the request
        foreach ($route->attributes as $key => $val) {
            $request = $request->withAttribute($key, $val);
        }

        if (!($route->handler instanceof Route)) {
            throw new Exception("Route-Handler for '$route->name' does not implement '" . Route::class . "'");
        }

        $response = $route->handler->execute($this, $request);
        if (is_string($response)) {
            $response = $this->createResponseByString($response);
        }
        return $response;
    }

    public function applyResponse(Response $response): void
    {
        foreach ($response->getHeaders() as $name => $values) {
            foreach ($values as $value) {
                header(sprintf('%s: %s', $name, $value), false);
            }
        }

        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }

    private function handleMissingRoute(Matcher $matcher): Response
    {
        $failedRoute = $matcher->getFailedRoute();
        $statusCode = match ($failedRoute->failedRule) {
            'Aura\Router\Rule\Allows' => 405,
            'Aura\Router\Rule\Accepts' => 406,
            default => 404,
        };

        return new Response(status: $statusCode);
    }

    public function getGenerator(): Generator {
        return $this->container->getGenerator();
    }

    private function createResponseByString(string $responseText): Response
    {
        $response = new Response();
        $response->getBody()->write($responseText);
        return $response;
    }
}