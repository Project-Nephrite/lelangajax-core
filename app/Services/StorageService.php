<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    protected string $disk = 'azure';

    /**
     * Upload a file to Azure Blob Storage.
     *
     * @param UploadedFile $file The file to upload.
     * @param string $filepath target path in the storage.
     * @return string The stored file path.
     */
    public function upload(string $filepath, UploadedFile $file): string
    {
        return Storage::disk($this->disk)->putFile($filepath, $file);
    }

    /**
     * Get the public URL of a file if supported.
     *
     * @param string $path
     * @return string|null
     */
    public function url(string $path): ?string
    {
        return Storage::disk($this->disk)->url($path);
    }

    /**
     * Delete a file or array of files from Azure storage.
     *
     * @param string|array $paths
     * @return bool
     */
    public function delete(string|array $paths): bool
    {
        return Storage::disk($this->disk)->delete($paths);
    }
}
