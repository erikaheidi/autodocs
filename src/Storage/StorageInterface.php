<?php

namespace Autodocs\Storage;

interface StorageInterface
{
    public function saveFile(string $path, string $content): void;
}