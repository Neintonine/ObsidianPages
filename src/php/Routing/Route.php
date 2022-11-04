<?php
declare(strict_types=1);
namespace ObsidianPages\Routing;

interface Route
{
    public function AppliesTo(RouteData $requestData): bool;
    public function Act(RouteData $requestData): RouteResult;
}