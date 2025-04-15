<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class LogService
{
    private string $logPath;

    public function __construct(array $config)
    {
        $this->logPath = $config['env']['LARAVEL_DIR'] . '/storage/logs';
    }

    /**
     * Legge le ultime righe del log
     */
    public function read(string $file = 'laravel.log', int $lines = 100): array
    {
        $logFile = $this->logPath . '/' . $file;
        
        if (!file_exists($logFile)) {
            return [];
        }

        $content = [];
        $handle = fopen($logFile, 'r');
        $currentLine = 0;
        $lines = array_reverse(file($logFile));
        
        foreach ($lines as $line) {
            if ($currentLine >= $lines) {
                break;
            }
            $content[] = $line;
            $currentLine++;
        }
        
        fclose($handle);
        
        return array_reverse($content);
    }

    /**
     * Pulisce il file di log
     */
    public function clear(string $file = 'laravel.log'): bool
    {
        $logFile = $this->logPath . '/' . $file;
        
        if (!file_exists($logFile)) {
            return false;
        }

        try {
            return file_put_contents($logFile, '') !== false;
        } catch (\Exception $e) {
            Log::error('Errore nella pulizia del file di log: ' . $e->getMessage());
            return false;
        }
    }
} 