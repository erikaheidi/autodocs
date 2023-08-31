<?php

namespace Autodocs\Page;

use Autodocs\DataFeed;

class TestPage extends ReferencePage
{
    public function loadData(): void
    {
        $datafeed = new DataFeed('test');
        $datafeed->loadFile(__DIR__ . '/../../tests/Resources/images-tags.json');
        $this->registerDataFeed($datafeed);
    }

    public function getName(): string
    {
        return "test";
    }

    public function getContent(): string
    {
        $content = "";
        $data = $this->getDataFeed('test');
        if ($data == null) {
            return "";
        }

        foreach ($data->json as $item) {
            $content .= "Image Name: " . $item['repo']['name'] . "\n";
        }

        return $content;
    }

    public function getSavePath(): string
    {
        return 'test.md';
    }
}
