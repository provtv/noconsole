<?php

declare(strict_types=1);
$password = 'admin123';
//$password = getenv('pwd');
if (! isset($_SERVER['PHP_AUTH_USER']) || $_SERVER['PHP_AUTH_PW'] !== $password) {
    \header('WWW-Authenticate: Basic realm="NoConsoleComposer"');
    \header('HTTP/1.0 401 Unauthorized');
    exit;
}