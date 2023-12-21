<?php

declare(strict_types=1);

namespace Autodocs\Storage;

interface StorageInterface
{
    public function hasDir(string $path): bool;

    public function createDir(string $path): void;

    public function saveFile(string $path, string $content): void;
}
