<?php

declare(strict_types=1);

use Autodocs\DataFeed\JsonDataFeed;

it('loads JSON file', function (): void {

    $datafeed = new JsonDataFeed('test');
    $datafeed->loadFile(__DIR__.'/../Resources/images-tags.json');

    $this->assertNotEmpty($datafeed->json);
});

it('throws JSON exception with a broken JSON', function (): void {

    $datafeed = new JsonDataFeed('test');
    $datafeed->loadFile(__DIR__.'/../Resources/broken-json.json');

})->throws(\Autodocs\Exception\JsonException::class);

it('throws JSON Exception with an empty JSON', function (): void {

    $datafeed = new JsonDataFeed('test');
    $datafeed->loadFile(__DIR__.'/../Resources/empty-json.json');

})->throws(\Autodocs\Exception\JsonException::class);
