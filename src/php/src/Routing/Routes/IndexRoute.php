<?php
declare(strict_types=1);

namespace ObsidianPages\Routing\Routes;

use ObsidianPages\Routing\Route;
use ObsidianPages\Routing\Router;
use ObsidianPages\Template\TemplateEngine;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

final class IndexRoute implements Route
{

    public function execute(Router $router, ServerRequest $request): Response|string
    {
        $template = new TemplateEngine();
        return $template->render("pages::index");
    }
}