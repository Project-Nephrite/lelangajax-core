<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class AzureFileUrlsCast implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes): array
    {
        $base = config('filesystems.disks.azure.url');

        $paths = json_decode($value, true) ?? [];

        return collect($paths)
            ->map(fn($path) => rtrim($base, '/') . '/' . ltrim($path, '/'))
            ->all();
    }

    public function set($model, string $key, $value, array $attributes): string
    {
        // You may receive file names, not full URLs
        // Just store them as original relative paths
        return json_encode($value);
    }
}
