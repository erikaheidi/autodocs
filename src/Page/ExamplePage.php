<?php

namespace Autodocs\Page;

use Autodocs\DataFeed;

class ExamplePage extends ReferencePage
{
    public function loadData(): void
    {
        $datafeed = new DataFeed('example');
        $datafeed->loadFromArray([
            'title' => 'example',
            'description' => 'description'
        ]);
        $this->registerDataFeed($datafeed);
    }

    public function getName(): string
    {
        return "example";
    }

    public function getContent(): string
    {
        $data = $this->getDataFeed('example');
        if ($data == null) {
            return "";
        }

        return $data->json['title'] . ' - ' . $data->json['description'];
    }

    public function getSavePath(): string
    {
        return 'example.md';
    }
}
