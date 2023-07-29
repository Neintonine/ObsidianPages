<?php
declare(strict_types=1);

namespace ObsidianPages\Routing;

use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

interface Route
{
    public function execute(Router $router, ServerRequest $request): Response|string;
}