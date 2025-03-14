<?php

declare(strict_types=1);
define('LARAVEL_DIR', realpath('../../laravel'));

require_once LARAVEL_DIR.'/vendor/autoload.php';
use PHPUnit\Framework\TestSuite;
use PHPUnit\TextUI\TestRunner;

//require_once LARAVEL_DIR.'/vendor/phpunit/phpunit/src/Framework/TestSuite.php';
//require_once "/vendor/phpunit/phpunit/src/TextUI/TestRunner.php";

$suite = new TestSuite();
//$test = new \Modules\LU\Tests\Unit\ExampleTest('testBasicTest');
$test = \Modules\LU\Tests\Unit\ExampleTest::class;
//$suite->addTestSuite();
$suite->addTestSuite($test);

//$test = new \Modules\LU\Tests\Unit\ExampleTest('testBasicTest');

//dd([$test->run()]);
// run the test suite with TextUI_TestRunner
$testRunner = new TestRunner();
$testRunner->run($suite);
//$testRunner->run($test);

/*
$args=[];
$args['command']='bin/phpunit';
$args['--version']=true;

$cmd='test';

$input = new Symfony\Component\Console\Input\StringInput($cmd);
$output = new Symfony\Component\Console\Output\StreamOutput(\fopen('php://output', 'w'));
$app = new Composer\Console\Application();
$app->run($input, $output);
*/

//$input = new Symfony\Component\Console\Input\ArrayInput($args);
//$output = new Symfony\Component\Console\Output\StreamOutput(\tmpfile());

//Create the application and run it with the commands
//use Bowerphp\Console\Application;
//use Bowerphp\Command\UpdateCommand;
//$application = new Bowerphp\Console\Application();
//$application = new Illuminate\Foundation\Application();

//$application->setAutoExit(false);
//$application->setCatchExceptions(false);

//$tester = new Symfony\Component\Console\Tester\ApplicationTester($application);

/*
try {
    //Running commdand php.ini allow_url_fopen=1 && proc_open() function available
    $application->run($input, $output);
    echo 'Success';
} catch (\Exception $e) {
    echo 'Error: '.$e->getMessage()."\n";
}

\rewind($output->getStream());
$content = \stream_get_contents($output->getStream());
\fclose($output->getStream());
echo '<pre>['.\chr(13);
\print_r($content);
echo \chr(13).']</pre>';
*/

/*
Symfony\Component\Console\Tester\ApplicationTester

$application = new Application();
$application->setAutoExit(false);

$tester = new ApplicationTester($application);

*/