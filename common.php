<?php

declare(strict_types=1);
require_once 'DotEnv.php';
(new DotEnv(__DIR__.'/.env'))->load();

// \define('ROOT_DIR', \realpath('../../laravel'));
\define('ROOT_DIR', realpath(__DIR__.'/'.getenv('LARAVEL_DIR')));
\define('EXTRACT_DIRECTORY', ROOT_DIR.'/composer'); // /storage/composer
\define('HOME_DIRECTORY', ROOT_DIR.'/composer/home');
\define('COMPOSER_INSTALLED', \file_exists(ROOT_DIR.'/vendor'));
\set_time_limit(10000);
\ini_set('memory_limit', '-1');  // could be forbidden on server
\ini_set('display_errors', '1');  // could be forbidden on server

\putenv('COMPOSER_HOME='.HOME_DIRECTORY);
\putenv('HOME='.HOME_DIRECTORY);
error_reporting(E_ALL);

include 'password.php';
if (! isset($_POST['function'])) {
    exit('You must specify a function');
}
if (! \function_exists($_POST['function'])) {
    exit('Function not found');
} else {
    \call_user_func($_POST['function']);
}
