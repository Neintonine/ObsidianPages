<?php
declare(strict_types=1);

namespace ObsidianPages\Routing\Routes;

use ObsidianPages\Lib\Utils;
use ObsidianPages\Routing\RouteData;
use ObsidianPages\Routing\RouteResult;

final class VaultResourceRoute extends ResourceRoute
{

    public function AppliesTo(RouteData $requestData): bool
    {
        return Utils::str_starts_with($requestData->uri, '/vaultresource/') && parent::AppliesTo($requestData);
    }

    public function Act(RouteData $requestData): RouteResult
    {
        $currentVault = explode('/', $requestData->uri)[2];

        return parent::HandleContentProvider(substr($requestData->uri, strlen("/vaultresource")));
    }
}