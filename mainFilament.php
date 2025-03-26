<?php

declare(strict_types=1);
/*
declare(strict_types=1);

\define('ROOT_DIR', \realpath('../../laravel'));
\set_time_limit(10000);
\ini_set('memory_limit', '-1');  //could be forbidden on server
\ini_set('display_errors', '1');  //could be forbidden on server
error_reporting(E_ALL);

include 'password.php';
if (! isset($_POST['function'])) {
    die('You must specify a function');
}
if (! \function_exists($_POST['function'])) {
    die('Function not found');
} else {
    \call_user_func($_POST['function']);
}
*/
include 'common.php';

function command()
{
    $root_dir = '../../laravel';
    if (! file_exists(ROOT_DIR.'/vendor/autoload.php')) {
        $root_dir = '../..';
        if (! file_exists(ROOT_DIR.'/vendor/autoload.php')) {
            exit(print_r([
                'error ' => 'file not exists',
                'file' => ROOT_DIR.'/vendor/autoload.php',
                'line' => __LINE__,
                'file' => __FILE__,
            ], true));
        }
    }
    require_once ROOT_DIR.'/vendor/autoload.php';
    $app = require_once ROOT_DIR.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

    // $vars = [$_POST['command']];
    // $input = new Symfony\Component\Console\Input\ArrayInput($vars);

    $command = $_POST['command'];
    if (isset($_POST['package']) && \mb_strlen(\trim($_POST['package'])) > 3 && 'exe' == $command) {
        $command = $_POST['package'];
    }
    $input = new Symfony\Component\Console\Input\StringInput($command);
    // $output = new Symfony\Component\Console\Output\ConsoleOutput();
    $output = new Symfony\Component\Console\Output\StreamOutput(\tmpfile());
    $status = $kernel->handle($input, $output);

    $kernel->terminate($input, $status);

    \rewind($output->getStream());
    $content = \stream_get_contents($output->getStream());
    \fclose($output->getStream());
    echo '<pre>['.\chr(13);
    \print_r($content);
    echo \chr(13).']</pre>';

    echo 'status:[<pre>'.print_r($status, true).'</pre>]';
    exit($status);
}
