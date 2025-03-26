<!DOCTYPE html>
<html>
<head>
    <title>NoConsole</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/noconsole/js/script.js<?php echo '?rnd='.rand(1, 100); ?>">
    </script>
    <link href="/noconsole/css/style.css" media="all" rel="stylesheet" />
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">NoConsole</h1>
            <?php echo $content; ?>
        </div>
    </div>
</body>
</html> 