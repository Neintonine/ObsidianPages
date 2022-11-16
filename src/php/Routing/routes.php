<?php
declare(strict_types=1);

use ObsidianPages\Routing\Routes\IndexRoute;
use ObsidianPages\Routing\Routes\LoginRoute;
use ObsidianPages\Routing\Routes\VaultPageRoute;
use ObsidianPages\Routing\Routes\ResourceRoute;
use ObsidianPages\Routing\Routes\VaultResourceRoute;

return [
    IndexRoute::class,
    LoginRoute::class,
    VaultResourceRoute::class,
    VaultPageRoute::class,
    ResourceRoute::class,
];