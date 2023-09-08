<?php

namespace Autodocs\Storage;

class FileStorage implements StorageInterface
{
    public function createDir(string $path): void
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    public function hasDir(string $path): bool
    {
        return is_dir($path);
    }

    public function saveFile(string $path, string $content): void
    {
        file_put_contents($path, $content);
    }
}