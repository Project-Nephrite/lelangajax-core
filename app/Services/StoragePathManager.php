<?php

namespace App\Services;

use Illuminate\Support\Str;

class StoragePathManager
{
    protected string $baseDir;

    public function __construct(string $baseDir)
    {
        $this->baseDir = trim($baseDir, "/");
    }

    protected function makePath(string $category, string $type, string $filename = null): string
    {
        $path = $this->baseDir . '/' . trim($type, '/');

        if ($filename) {
            $filename = Str::slug(pathinfo($filename, PATHINFO_FILENAME)) . pathinfo($filename, PATHINFO_EXTENSION);
            $path .= trim($category, '/') . '/' . $filename;
        }
        return $path;
    }

    protected function userPath(string $type, string $filename = null): string
    {
        return $this->makePath("user_contents", $type, $filename);
    }


    public function listingPath(string $filename = null): string
    {
        return $this->userPath("listing", $filename);
    }

    public function userKtpPath(string $filename = null): string
    {
        return $this->userPath('document', $filename);
    }

    public function userPicturePath(string $filename = null): string
    {
        return $this->userPath('picture', $filename);
    }
}
