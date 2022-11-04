<?php
declare(strict_types=1);

// Server Configration
const BASE_FOLDER = '/var/www/html'; // this is the folder where the php folder is in.
const PHP_FOLDER = BASE_FOLDER . '/php';
const RESOURCE_FOLDER = BASE_FOLDER . '/resources';
const TEMPLATE_FOLDER = BASE_FOLDER . '/templates';

const SMARTY_CONFIG_FOLDER = BASE_FOLDER . '/smarty/config';
const SMARTY_COMPILE_FOLDER = BASE_FOLDER . '/smarty/config/compile';
const SMARTY_CACHE_FOLDER = BASE_FOLDER . '/smarty/cache';

const BASE_URL = '/vaults/'; // this changes the path to the vault selection and with it to each file
const VAULT_RESOURCE_FOLDERNAME = '.Resources';
