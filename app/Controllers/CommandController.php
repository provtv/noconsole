<?php

declare(strict_types=1);

namespace App\Controllers;

class CommandController
{
    private array $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../config/app.php';
    }

    public function getCommands(): array
    {
        return $this->config['commands'];
    }

    public function executeCommand(string $type, string $command, ?string $package = null): array
    {
        $className = "\\App\\Services\\{$type}Service";
        if (!class_exists($className)) {
            throw new \RuntimeException("Service {$type} non trovato");
        }

        $service = new $className();
        return $service->execute($command, $package);
    }

    public function check(): array
    {
        return [
            'status' => 'ok',
            'composer_installed' => file_exists($this->config['env']['LARAVEL_DIR'] . '/vendor/autoload.php'),
            'version' => $this->config['version']
        ];
    }
} 