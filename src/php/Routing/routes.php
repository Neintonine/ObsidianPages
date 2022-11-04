<?php
declare(strict_types=1);

use ObsidianPages\Routing\Routes\IndexRoute;
use ObsidianPages\Routing\Routes\VaultPageRoute;
use ObsidianPages\Routing\Routes\ResourceRoute;
use ObsidianPages\Routing\Routes\VaultResourceRoute;

return [
    IndexRoute::class,
    VaultResourceRoute::class,
    VaultPageRoute::class,
    ResourceRoute::class,
];