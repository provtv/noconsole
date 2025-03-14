<?php
/**
 * https://stackoverflow.com/questions/17608822/phpunit-how-to-run-tests-from-browser.
 * /**
 * https://stackoverflow.com/questions/17608822/phpunit-how-to-run-tests-from-browser.
 * https://odino.org/launching-phpunit-tests-from-a-browser-with-symfony2/
 * https://github.com/VisualPHPUnit/VisualPHPUnit.
 */

declare(strict_types=1);
define('LARAVEL_DIR', realpath('../../laravel'));
require_once LARAVEL_DIR.'/vendor/autoload.php';

echo rand(1, 100).'<hr />';
/*
$argv = [
    '--configuration', LARAVEL_DIR.'/phpunit.xml',
    //'./unit',
];

*/
$argv = [
    'c:/xampp/htdocs/lara/ptvx/laravel/Modules/Xot/Tests/Feature/PanelCrudTest.php',
    '--filter', '^.*::testUpdateAreas',
    '--configuration', 'c:/xampp/htdocs/lara/ptvx/laravel/phpunit.xml',
];

$_SERVER['argv'] = $argv;
