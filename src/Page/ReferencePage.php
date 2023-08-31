<?php

namespace Autodocs\Page;

use Autodocs\DataFeed;

abstract class ReferencePage
{
    public array $dataFeeds = [];

    public function registerDataFeed(DataFeed $dataFeed): void
    {
        $this->dataFeeds[] = $dataFeed;
    }

    public function getDataFeed(string $identifier): ?DataFeed
    {
        foreach ($this->dataFeeds as $dataFeed) {
            if ($dataFeed->identifier === $identifier) {
                return $dataFeed;
            }
        }
    }

    abstract public function loadData(): void;

    abstract public function getName(): string;

    abstract public function getSavePath(): string;

    abstract public function getContent(): string;
}