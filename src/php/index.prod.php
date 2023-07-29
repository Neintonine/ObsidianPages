<?php
declare(strict_types=1);

use ObsidianPages\System\Startup;

const PUBLIC_FOLDER = __DIR__;
const BASE_PHP_FOLDER = __DIR__ . '/../src/php';

require BASE_PHP_FOLDER . '/vendor/autoload.php';

const PROD = true;

Startup::Run();