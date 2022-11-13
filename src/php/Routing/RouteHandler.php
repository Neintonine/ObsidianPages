<?php
declare(strict_types=1);

namespace ObsidianPages\Routing;

use Error;
use Exception;

final class RouteHandler
{

    private RouteData $routeData;

    /**
     * @var array<Route>
     */
    private array $routes;

    public function __construct(array $serverData)
    {
        $this->routeData = new RouteData($serverData);
        $this->routes = [];
    }

    public function Add(string ...$arrays): void {
        foreach ($arrays as $class) {
            $classInstance = new $class();
            if (!($classInstance instanceof Route)) {
                throw new Exception('The route "' . $class . '" does not implement the Route interface.');
            }

            $this->routes[] = $classInstance;
        }
    }

    public function Execute(): RouteResult
    {
        if ($this->routeData->checkError()) {
            return RouteResult::Error500();
        }

        foreach ($this->routes as $route) {
            if (!$route->AppliesTo($this->routeData)) {
                continue;
            }

            return $route->Act($this->routeData);
        }

        return RouteResult::Error404();
    }

}