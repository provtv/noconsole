<?php

declare(strict_types=1);

namespace App\Services;

class ComposerService
{
    private string $laravelDir;
    private string $composerPath;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/app.php';
        $this->laravelDir = $config['env']['LARAVEL_DIR'];
        $this->composerPath = __DIR__ . '/../../composer.phar';
    }

    public function execute(string $command, ?string $package = null): array
    {
        if (!file_exists($this->composerPath)) {
            throw new \RuntimeException('Composer non installato');
        }

        $cmd = sprintf('php %s %s', $this->composerPath, $command);
        
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

    public function download(): array
    {
        $url = 'https://getcomposer.org/composer.phar';
        $output = [];
        $returnVar = 0;
        
        exec(sprintf('curl -sS %s > %s 2>&1', $url, $this->composerPath), $output, $returnVar);

        return [
            'status' => $returnVar,
            'output' => implode("\n", $output)
        ];
    }

    public function extract(): array
    {
        if (!file_exists($this->composerPath)) {
            throw new \RuntimeException('Composer non trovato');
        }

        $output = [];
        $returnVar = 0;
        exec(sprintf('php %s install 2>&1', $this->composerPath), $output, $returnVar);

        return [
            'status' => $returnVar,
            'output' => implode("\n", $output)
        ];
    }
} 