<?php

use Autodocs\DataFeed\JsonDataFeed;

it('loads JSON file', function () {

    $datafeed = new JsonDataFeed('test');
    $datafeed->loadFile(__DIR__ . '/../Resources/images-tags.json');

    $this->assertNotEmpty($datafeed->json);
});
