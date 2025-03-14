<?php

declare(strict_types=1);
/**
 * https://www.reddit.com/r/laravel/comments/cexq36/reactphp_and_laravel_eloquent/.
 */
require __DIR__.'/../../../vendor/autoload.php';

use App\Console\Kernel;
use Dotenv\Dotenv;
use React\EventLoop\Factory;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;

Dotenv::create(__DIR__.'/../../../')->load();

$app = require_once __DIR__.'/../../../bootstrap/app.php';

/** @var Kernel $kernel */
$kernel = $app->make(Kernel::class);
$loop = Factory::create();

$loop->addPeriodicTimer(10, function () use ($kernel) {
    $kernel->handle(
        new ArrayInput([
            'command' => 'task:clean',
            'force' => true,
        ]),
        new ConsoleOutput()
    );
});

$loop->run();
