<?php

declare(strict_types=1);

namespace Autodocs\DataFeed;

interface DataFeedInterface
{
    public function load(string $data): void;
    public function save(string $path): void;
}
