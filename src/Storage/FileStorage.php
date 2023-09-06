<?php

namespace Autodocs\Storage;

class FileStorage implements StorageInterface
{
    public function saveFile(string $path, string $content): void
    {
        file_put_contents($path, $content);
    }
}