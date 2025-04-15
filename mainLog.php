<?php

declare(strict_types=1);

include 'common.php';

function command() {
    $env_file = getenv('LARAVEL_DIR').'/.env';
    $env_file = str_replace(['/', '\\'], [DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $env_file);

    $command = $_POST['command'];
    $logs_path = getenv('LARAVEL_DIR').'/storage/logs';

    $logs = array_chunk(array_reverse(getLogs($logs_path)), 5);

    if (! isset($logs[0])) {
        $logs[0] = 'nessun errore nei log';
    }

    switch ($command) {
        case 'error:list':echo print_r($logs[0], true); break;
        case 'show:0': readLogN(0, $logs_path, $logs[0]); break;
        case 'show:1': readLogN(1, $logs_path, $logs[0]); break;
        case 'show:2': readLogN(2, $logs_path, $logs[0]); break;
        case 'show:3': readLogN(3, $logs_path, $logs[0]); break;
        case 'show:4': readLogN(4, $logs_path, $logs[0]); break;
        case 'show:5': readLogN(5, $logs_path, $logs[0]); break;
        case 'error:clear': foreach ($logs as $log) {
            foreach ($log as $lg) {
                $log_file = realpath($logs_path.'/'.$lg);
                unlink($log_file);
            }
            /*
            $log_file = realpath($logs_path.'/'.$log);
            unlink($log_file);
            */
        }
        echo 'cancellati';
    }
}

function readLogN($n, $logs_path, $logs) {
    if (isset($logs[$n])) {
        $log_file = realpath($logs_path.'/'.$logs[$n]);
        echo 'reading ['.$log_file.']';
        echo file_get_contents($log_file);
    } else {
        echo 'file non esistente';
    }
}

function getLogs($path) {
    $files = array_diff(scandir($path), ['..', '.', '.gitignore']);
    $files = array_values($files);

    return $files;
}
