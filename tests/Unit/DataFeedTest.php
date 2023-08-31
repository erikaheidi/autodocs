<?php

use Autodocs\DataFeed;

it('loads JSON file', function () {

    $datafeed = new DataFeed('test');
    $datafeed->loadFile(__DIR__ . '/../Resources/images-tags.json');

    $this->assertNotEmpty($datafeed->json);
});
