<?php
declare(strict_types=1);
namespace ObsidianPages\Routing;

use ObsidianPages\Templates\Template;

final class RouteResult
{
    private string $response;
    private int $httpCode;

    private string $mimeType;

    public function __construct()
    {
        $this->httpCode = 200;
        $this->response = '';
        $this->mimeType = '';
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }


    public function getMimeType(): string
    {
        return $this->mimeType;
    }
    public function setMimeType(string $mimeType): RouteResult
    {
        $this->mimeType = $mimeType;
        return $this;
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }


    /**
     * @param string $response
     * @return RouteResult
     */
    public function setResponse(string $response): RouteResult
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @param int $httpCode
     * @return RouteResult
     */
    public function setHttpCode(int $httpCode): RouteResult
    {
        $this->httpCode = $httpCode;
        return $this;
    }

    public static function Error404(): RouteResult {
        return (new RouteResult())->setHttpCode(404)->setResponse(Template::FetchSimple('errors/404.tpl'));
    }
    public static function Error403(): RouteResult {
        return (new RouteResult())->setHttpCode(403)->setResponse(Template::FetchSimple('errors/403.tpl'));
    }
    public static function Error500(): RouteResult {
        return (new RouteResult())->setHttpCode(500)->setResponse(Template::FetchSimple('errors/500.tpl'));
    }

    public static function Content200(string $content): RouteResult
    {
        return (new RouteResult())->setResponse($content);
    }
}