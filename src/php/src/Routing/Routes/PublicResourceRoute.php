<?php
declare(strict_types=1);

namespace ObsidianPages\Routing\Routes;

use Mimey\MimeTypes;
use ObsidianPages\Routing\Route;
use ObsidianPages\Routing\Router;
use ObsidianPages\Utils;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

final class PublicResourceRoute implements Route
{
    private false|string $path;

    public function filter(ServerRequest $request): bool {
        $this->path = realpath(PUBLIC_FOLDER . $request->getUri()->getPath());
        return $this->path !== false;
    }

    public function execute(Router $router, ServerRequest $request): Response|string
    {
        $mime = new MimeTypes;

        $fileStream = fopen($this->path, 'r');
        $response = new Response(
            $fileStream,
            headers: [
                'Content-Type' => $mime->getMimeType(pathinfo($this->path, PATHINFO_EXTENSION)),
                'Cache-Control' => 'public, max-age=604800',
            ]
        );

        return $response;
    }
}