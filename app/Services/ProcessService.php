<?php

declare(strict_types=1);

namespace App\Services;

use React\EventLoop\Factory;
use React\ChildProcess\Process;

class ProcessService
{
    private string $laravelDir;
    private array $processes = [];

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/app.php';
        $this->laravelDir = $config['env']['LARAVEL_DIR'];
    }

    public function start(string $command): array
    {
        if (!class_exists('React\EventLoop\Factory')) {
            throw new \RuntimeException('ReactPHP non installato');
        }

        $loop = Factory::create();
        $process = new Process($command, $this->laravelDir);
        
        $process->on('exit', function($exitCode, $termSignal) use ($command) {
            unset($this->processes[$command]);
        });

        $process->start($loop);
        $this->processes[$command] = $process;

        return [
            'status' => 0,
            'output' => "Processo avviato: {$command}"
        ];
    }

    public function stop(string $command): array
    {
        if (isset($this->processes[$command])) {
            $this->processes[$command]->terminate();
            unset($this->processes[$command]);
            return [
                'status' => 0,
                'output' => "Processo fermato: {$command}"
            ];
        }

        return [
            'status' => 1,
            'output' => "Processo non trovato: {$command}"
        ];
    }

    public function list(): array
    {
        return array_keys($this->processes);
    }
} 