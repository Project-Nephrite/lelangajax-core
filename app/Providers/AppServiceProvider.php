<?php

namespace App\Providers;

use App\Services\StoragePathManager;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use League\Flysystem\AzureBlobStorage\AzureBlobStorageAdapter;
use League\Flysystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(StoragePathManager::class, function () {
            return new StoragePathManager('uploads');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Storage::extend('azure', function ($app, $config) {
            $client = BlobRestProxy::createBlobService($config['connection_string']);

            $adapter = new AzureBlobStorageAdapter(
                $client,
                $config['container']
            );
            $flysystem = new Filesystem($adapter);

            // Wrap the Flysystem instance with Laravel's adapter
            return new FilesystemAdapter($flysystem, $adapter, $config);
        });
        JsonResource::withoutWrapping();
    }
}
