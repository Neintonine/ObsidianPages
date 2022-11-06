<?php
declare(strict_types=1);

const DEBUG = true;

// Server Configration
const BASE_FOLDER = '/var/www/html'; // this is the folder where the php folder is in.
const PHP_FOLDER = BASE_FOLDER . '/php';
const RESOURCE_FOLDER = BASE_FOLDER . '/resources';
const TEMPLATE_FOLDER = BASE_FOLDER . '/templates';
const PAGES_FOLDER = BASE_FOLDER . '/pages'; // this folder is used primary (and should only be used) in the FileContentProvider and defines where the pages are placed.

const BASE_URL = '/'; // this changes the path to the vault selection and with it to each file

// Smarty Configuration
const SMARTY_CONFIG_FOLDER = BASE_FOLDER . '/smarty/config';
const SMARTY_CACHE_FOLDER = BASE_FOLDER . '/smarty/cache';
const SMARTY_COMPILE_FOLDER = BASE_FOLDER . '/smarty/cache/compile';

const THEME = 'default';
const USE_TINTED_NAVIGATION = false;