<?php
/**
 * https://github.com/CurosMJ/NoConsoleComposer.
 * ---
 */
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'true');
require_once 'DotEnv.php';
(new DotEnv(__DIR__ . '/.env'))->load();

include 'password.php';

$base_path = realpath(__DIR__.'/'.getenv('LARAVEL_DIR'));
$base_path = str_replace('\\', '\\\\', $base_path);

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\CommandController;

$controller = new CommandController();
$commands = $controller->getCommands();

ob_start();
require __DIR__ . '/app/Views/commands.php';
$content = ob_get_clean();

require __DIR__ . '/app/Views/layout.php';