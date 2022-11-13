<?php
declare(strict_types=1);

namespace ObsidianPages\Routing\Routes;

use ObsidianPages\Configuration\ConfigurationHandler;
use ObsidianPages\Configuration\Configurations\BasicConfiguration;
use ObsidianPages\Content\ContentHandler;
use ObsidianPages\Lib\MIMETypes;
use ObsidianPages\Routing\RouteData;
use ObsidianPages\Routing\RouteResult;
use ObsidianPages\Routing\Route;

class ResourceRoute implements Route
 {
    protected string $mimeType;

    public function AppliesTo(RouteData $requestData): bool
    {
        $this->mimeType = MIMETypes::getMimeType(pathinfo($requestData->uri, PATHINFO_EXTENSION));
        return $this->mimeType !== '';
    }

    public function Act(RouteData $requestData): RouteResult
    {
        $resourcePath = ConfigurationHandler::Instance()->Get(BasicConfiguration::class)->getResourceFolder() . $requestData->uri;

        return $this->HandleRouting($resourcePath);
    }
    protected function HandleRouting(string $path): RouteResult
    {
        if (!file_exists($path))
            return RouteResult::Error404();

        $file = file_get_contents($path);
        return (new RouteResult())
            ->setMimeType($this->mimeType)
            ->setResponse($file);
    }
    protected function HandleContentProvider(string $path): RouteResult
    {
        $contentProvider = ContentHandler::getContentProvider();

        if (!$contentProvider->hasFile($path))
            return RouteResult::Error404();

        $file = $contentProvider->getResource($path);

        return (new RouteResult())
            ->setMimeType($this->mimeType)
            ->setResponse($file);
    }
 }