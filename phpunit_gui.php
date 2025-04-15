<?php

declare(strict_types=1);
include 'password.php';
define('LARAVEL_DIR', realpath('../../laravel'));
require_once LARAVEL_DIR.'/vendor/autoload.php';

$path = LARAVEL_DIR.'/Modules';
$handle = opendir($path);
$html = '';
$html .= '<table class="table table-bordered" border="1" width="100%">
<tr>
<td>';
$html .= '<ul>';
while (false !== ($entry = readdir($handle))) {
    if ('.' != $entry[0]) {
        //$html.='<pre>'.print_r($entry, true).is_dir($path.'/'.$entry).'</pre>';
        $html .= '<li>'.$entry;
        $html .= '<ul>';
        $path_tests = $path.'/'.$entry.'/Tests';
        $handle_tests = opendir($path_tests);
        while (false !== ($entry_test = readdir($handle_tests))) {
            if ('.' != $entry_test[0]) {
                $html .= '<li>'.$entry_test;
                $html .= '<ul>';
                $path_file_tests = $path_tests.'/'.$entry_test;
                $handle_file_tests = opendir($path_file_tests);
                while (false !== ($entry_file_test = readdir($handle_file_tests))) {
                    $file = $path_file_tests.'/'.$entry_file_test;
                    $file_info = pathinfo($file);
                    $file_info['file'] = $file;
                    if ('php' == $file_info['extension']) {
                        $html .= '<li>'.$entry_file_test;
                        $html .= '<ul>';
                        $input = file_get_contents($file);
                        //die($input);
                        $pattern = '/function(.*?)[(]/';
                        preg_match_all($pattern, $input, $matches);
                        foreach ($matches[1] as $match) {
                            $str = 'test';
                            $match = trim($match);
                            if (substr($match, 0, strlen($str)) == $str) {
                                $html .= '<li>';
                                //$html.=$match;
                                $html .= '<form method="POST" action="">
                                    <input type="hidden" name="file" value="'.$file.'">
                                    <input type="hidden" name="func" value="'.$match.'">
                                    <button type="submit" class="btn btn-info btn-xs">'.substr($match, strlen($str)).'</button>
                                </form>';
                                $html .= '</li>';
                            }
                        }
                        $html .= '</ul>';
                        $html .= '</li>';
                    }
                }
                $html .= '</ul>';
                $html .= '</li>';
            }
        }
        $html .= '</ul>';
        $html .= '</li>';
    }
}
$html .= '</ul>';
$html .= '</td>';
$html .= '<td valign="top">';

$html .= result();
$html .= '</td>';

$html .= '</tr>';
$html .= '</table>';
closedir($handle);

function result(): string {
    $html = '';
    if (! isset($_POST['file']) || ! isset($_POST['func'])) {
        $html .= 'perform an action';

        return $html;
    }

    $argv = [
        $_POST['file'],
        '--filter', '^.*::'.$_POST['func'],
        '--configuration', LARAVEL_DIR.'/phpunit.xml',
    ];

    $_SERVER['argv'] = $argv;
    ob_start();

    PHPUnit\TextUI\Command::main(false);
    $html .= ob_get_contents();
    ob_end_clean();
    $html = nl2br($html);
    $html = str_replace(', Memory:', '<br/>Memory:', $html);

    $html .= '<br/> file: '.$_POST['file'];
    $html .= '<br/> function: '.$_POST['func'];
    $html .= '<br/>';

    return $html;
}
?>
<html>

<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <?php
    echo $html;
?>
</body>

</html>