<?php

declare(strict_types=1);

namespace Autodocs\DataFeed;

use Autodocs\Exception\JsonException;
use Autodocs\Exception\NotFoundException;

class JsonDataFeed implements DataFeedInterface
{
    public string $data;
    public array $json = [];

    /**
     * @throws NotFoundException
     */
    public function loadFile(string $file): void
    {
        if ( ! is_file($file)) {
            throw new NotFoundException("Data feed file {$file} not found.");
        }

        $this->data = file_get_contents($file);

        if ( ! $this->data) {
            throw new JsonException("JSON file is empty.");
        }

        $json = json_decode($this->data, true);
        if ( ! is_array($json)) {
            throw new JsonException("Unable to decode JSON file.");
        }

        $this->json = $json;

    }

    public function load(string $data): void
    {
        $this->data = $data;
        $this->json = json_decode($this->data, true);
    }

    public function loadFromArray(array $data): void
    {
        $this->json = $data;
        $this->data = json_encode($data);
    }

    public function save(string $path): void
    {
        file_put_contents($path, $this->data);
    }
}
