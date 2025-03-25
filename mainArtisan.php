<?php

declare(strict_types=1);

include 'common.php';

/**
 * Esegue un comando Artisan
 * 
 * @return void
 */
function command(): void
{
    $root_dir = '../../laravel';
    
    if (!file_exists(ROOT_DIR.'/vendor/autoload.php')) {
        $root_dir = '../..';
        
        if (!file_exists(ROOT_DIR.'/vendor/autoload.php')) {
            $error = [
                'error' => 'File non trovato',
                'file' => ROOT_DIR.'/vendor/autoload.php',
                'line' => __LINE__,
                'file_path' => __FILE__,
            ];
            
            die(print_r($error, true));
        }
    }

    require_once ROOT_DIR.'/vendor/autoload.php';
    $app = require_once ROOT_DIR.'/bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

    $command = $_POST['command'] ?? '';
    
    if (isset($_POST['package']) && 
        \mb_strlen(\trim($_POST['package'])) > 3 && 
        $command === 'exe'
    ) {
        $command = $_POST['package'];
    }

    $input = new Symfony\Component\Console\Input\StringInput($command);
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
