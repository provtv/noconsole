<?php

namespace App\Services;

use App\Traits\CommandTrait;
use Illuminate\Support\Facades\Log;

class BowerService
{
    use CommandTrait;

    private string $laravelDir;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/app.php';
        $this->laravelDir = $config['env']['LARAVEL_DIR'];
    }

    /**
     * Esegue un comando bower
     */
    public function run(string $command, array $options = []): array
    {
        if (!$this->isCommandInstalled('bower')) {
            return [
                'success' => false,
                'output' => 'Bower non è installato',
                'status' => 1
            ];
        }

        return $this->executeCommand('bower ' . $command, $options);
    }

    public function execute(string $command, ?string $package = null): array
    {
        if (!file_exists($this->laravelDir . '/node_modules/.bin/bower')) {
            throw new \RuntimeException('Bower non installato');
        }

        $cmd = sprintf('cd %s && ./node_modules/.bin/bower %s', 
            escapeshellarg($this->laravelDir),
            $command
        );
        
        if ($package) {
            $cmd .= ' ' . escapeshellarg($package);
        }

        $output = [];
        $returnVar = 0;
        exec($cmd . ' 2>&1', $output, $returnVar);

        return [
            'status' => $returnVar,
            'output' => implode("\n", $output)
        ];
    }
} 