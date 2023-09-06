<?php

namespace Autodocs\Page;

use Autodocs\DataFeed\JsonDataFeed;

class TestPage extends ReferencePage
{
    public function loadData(array $parameters = []): void
    {
        //
    }

    public function getName(): string
    {
        return "test";
    }

    public function getContent(): string
    {
        $content = "";
        $dataFeed = $this->autodocs->getDataFeed('images-tags.json');
        foreach ($dataFeed->json as $item) {
            $content .= "Image Name: " . $item['repo']['name'] . "\n";
        }

        return $content;
    }

    public function getSavePath(): string
    {
        return 'test.md';
    }
}
