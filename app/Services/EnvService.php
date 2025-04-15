<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class EnvService
{
    private string $envPath;

    public function __construct(array $config)
    {
        $this->envPath = $config['env']['LARAVEL_DIR'] . '/.env';
    }

    /**
     * Legge le variabili d'ambiente
     */
    public function read(): array
    {
        if (!file_exists($this->envPath)) {
            return [];
        }

        $lines = file($this->envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $env = [];

        foreach ($lines as $line) {
            if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
                list($key, $value) = explode('=', $line, 2);
                $env[trim($key)] = trim($value);
            }
        }

        return $env;
    }

    /**
     * Scrive le variabili d'ambiente
     */
    public function write(array $env): bool
    {
        try {
            $content = '';
            foreach ($env as $key => $value) {
                $content .= "{$key}={$value}\n";
            }

            return file_put_contents($this->envPath, $content) !== false;
        } catch (\Exception $e) {
            Log::error('Errore nella scrittura del file .env: ' . $e->getMessage());
            return false;
        }
    }
} 