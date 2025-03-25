<?php

declare(strict_types=1);

require_once 'DotEnv.php';

// Carica le variabili d'ambiente
(new DotEnv(__DIR__.'/.env'))->load();

// Definisce le costanti di sistema
// \define('ROOT_DIR', \realpath('../../laravel'));
\define('ROOT_DIR', realpath(__DIR__.'/'.getenv('LARAVEL_DIR')));
\define('EXTRACT_DIRECTORY', ROOT_DIR.'/composer');
\define('HOME_DIRECTORY', ROOT_DIR.'/composer/home');
\define('COMPOSER_INSTALLED', \file_exists(ROOT_DIR.'/vendor'));

// Configurazione dell'ambiente
\set_time_limit(10000);
\ini_set('memory_limit', '-1');
\ini_set('display_errors', '1');
\putenv('COMPOSER_HOME='.HOME_DIRECTORY);
\putenv('HOME='.HOME_DIRECTORY);

// Configurazione degli errori
error_reporting(E_ALL);

// Include il file delle password
include 'password.php';

// Verifica la presenza della funzione richiesta
if (!isset($_POST['function'])) {
    die('È necessario specificare una funzione');
}

if (!\function_exists($_POST['function'])) {
    die('Funzione non trovata');
}

// Esegue la funzione richiesta
\call_user_func($_POST['function']);
