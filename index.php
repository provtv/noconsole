<?php
/**
 * https://github.com/CurosMJ/NoConsoleComposer.
 * ---.
 */
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 'true');
require_once 'DotEnv.php';
(new DotEnv(__DIR__.'/.env'))->load();

include 'password.php';

// die('['.__LINE__.']['.getenv('LARAVEL_DIR').']['.$_ENV['LARAVEL_DIR'].']');

// $base_path = realpath('../../laravel');
$base_path = realpath(__DIR__.'/'.getenv('LARAVEL_DIR'));

/*
die(print_r([
    'env'=>getenv('LARAVEL_DIR'),
    'dir'=>__DIR__,
    'base_path'=>$base_path
    ]
,true));
*/
$base_path = str_replace('\\', '\\\\', $base_path);

$cmds = [
    // 'NoConsole' => ['check'],
    'Composer' => ['require', 'remove', 'install', 'update', 'dump-autoload',
        'show', 'check', 'geoip:update', 'fund',
        // 'getStatus',//is a function not a command
    ],
    'Bower' => ['install', 'remove', 'update', 'list'],
    'Artisan' => ['exe',
        'route:list',
        'route:clear', 'view:clear', 'optimize:clear', 'cache:clear', 'config:clear',
        'config:cache',
        'migrate',
        'route:cache', 'vendor:publish',
    ],
    'Filament' => [
        'filament:upgrade',
    ],
    'Env' => [
        'debug:on', 'debug:off',
    ],
    'Log' => [
        'error:list', 'show:0', 'show:1', 'show:2', 'show:3', 'show:4', 'error:clear',
    ],
];
?>
<!DOCTYPE html>
<html>

<head>
	<title>NoConsole</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script type="text/javascript"
		src="js/script.js<?php echo '?rnd='.rand(1, 100); ?>">
	</script>
	<link href="css/style.css" media="all" rel="stylesheet" />
</head>

<body>
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
			<h1>NoConsole</h1>
			<hr />
			<div class="form-inline">
				<button onclick="check()">check</button>
				<button onclick="downloadComposer()">downloadComposer</button>
				<button onclick="extractComposer()">extractComposer</button>
				<?php
                    $html = '';
foreach ($cmds as $pack => $pack_cmds) {
    $html .= '<fieldset>
                    <legend>'.$pack.' Commands</legend>
                    <input type="text" class="form-input" name="package" id="'.$pack.'_text" style="width:100%">&nbsp;<br/>';
    foreach ($pack_cmds as $cmd) {
        $html .= '<button onclick="callPack(\''.$cmd.'\',\''.$pack.'\')" class="btn btn-success">'.$cmd.'</button>&nbsp;';
    }
    $html .= '</fieldset>';
}
echo $html;
?>

			</div>
			<h3>Console Output:</h3>
			<pre id="output" class="well"></pre>
		</div>
		<div class="col-lg-1"></div>
	</div>
</body>

</html>