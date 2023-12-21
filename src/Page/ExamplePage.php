<?php

declare(strict_types=1);

namespace Autodocs\Page;

use Autodocs\DataFeed\JsonDataFeed;

class ExamplePage extends ReferencePage
{
    public JsonDataFeed $dataFeed;
    public function loadData(array $parameters = []): void
    {
        $this->dataFeed = new JsonDataFeed();
        $this->dataFeed->loadFromArray([
            'title' => 'example',
            'description' => 'description'
        ]);
    }

    public function getName(): string
    {
        return "example";
    }

    public function getContent(): string
    {
        return $this->dataFeed->json['title'].' - '.$this->dataFeed->json['description'];
    }

    public function getSavePath(): string
    {
        return 'example.md';
    }
}
