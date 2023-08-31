<?php

namespace Autodocs;

class Storage
{
    public function saveFile(string $path, string $content): void
    {
        file_put_contents($path, $content);
    }
}