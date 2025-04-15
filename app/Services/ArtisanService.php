<?php

namespace App\Services;

use App\Traits\CommandTrait;
use Illuminate\Support\Facades\Log;

class ArtisanService
{
    use CommandTrait;

    private string $laravelDir;

    public function __construct(array $config)
    {
        $this->laravelDir = $config['env']['LARAVEL_DIR'];
    }

    /**
     * Esegue un comando artisan
     */
    public function run(string $command, array $options = []): array
    {
        $artisanPath = $this->laravelDir . '/artisan';
        
        if (!file_exists($artisanPath)) {
            return [
                'success' => false,
                'output' => 'File artisan non trovato',
                'status' => 1
            ];
        }

        return $this->executeCommand('php ' . $artisanPath . ' ' . $command, $options);
    }
} 