<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait CommandTrait
{
    /**
     * Esegue un comando e gestisce gli errori
     */
    protected function executeCommand(string $command, array $options = []): array
    {
        try {
            $output = [];
            $status = 0;
            
            exec($command . ' ' . implode(' ', $options) . ' 2>&1', $output, $status);
            
            return [
                'success' => $status === 0,
                'output' => implode("\n", $output),
                'status' => $status
            ];
        } catch (\Exception $e) {
            Log::error('Errore nell\'esecuzione del comando: ' . $e->getMessage());
            
            return [
                'success' => false,
                'output' => $e->getMessage(),
                'status' => 1
            ];
        }
    }

    /**
     * Verifica se un comando è installato
     */
    protected function isCommandInstalled(string $command): bool
    {
        $result = $this->executeCommand("which {$command}");
        return $result['success'] && !empty($result['output']);
    }
} 