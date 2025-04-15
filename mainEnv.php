<?php

declare(strict_types=1);

include 'common.php';

function command() {
    $env_file = getenv('LARAVEL_DIR').'/.env';
    $env_file = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $env_file);
    $content = file_get_contents($env_file);
    $command = $_POST['command'];
    $write = false;
    echo 'env :'.$env_file.' '.chr(13);
    switch ($command) {
        case 'debug:on':
            $write = true;
            $content = str_replace('APP_DEBUG=false', 'APP_DEBUG=true', $content);
        break;
        case 'debug:off':
            $write = true;
            $content = str_replace('APP_DEBUG=true', 'APP_DEBUG=false', $content);
        break;
    }

    if ($write) {
        file_put_contents($env_file, $content);
        echo '+Done';
    }
    echo '.';
    //echo $content;
    //APP_DEBUG=true
}