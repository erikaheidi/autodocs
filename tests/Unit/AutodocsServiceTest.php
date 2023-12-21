<?php

declare(strict_types=1);

use Autodocs\Storage\FileStorage;

it('registers reference pages and lazy-loads json cache feeds', function (): void {
    $autodocs = getAutodocs();
    $this->assertCount(2, $autodocs->referencePages);
    $this->assertNotEmpty($autodocs->dataFeeds);
    $this->assertInstanceOf(\Autodocs\DataFeed\JsonDataFeed::class, $autodocs->dataFeeds['images-tags.json']);
    $this->assertEmpty($autodocs->dataFeeds['images-tags.json']->json);
    $data = $autodocs->getDataFeed('images-tags.json');

    $this->assertNotEmpty($data->json);
});

it('builds reference pages', function (): void {
    $autodocs = getAutodocs();
    $storage = Mockery::mock(FileStorage::class);
    $storage->shouldReceive('saveFile');
    $storage->shouldReceive('hasDir')->andReturn(false);
    $storage->shouldReceive('createDir');
    $autodocs->storage = $storage;

    $this->assertCount(2, $autodocs->referencePages);
    $autodocs->buildPages();
});

it('skips building when page is not listed', function (): void {
    $autodocs = getAutodocs();
    $storage = Mockery::mock(FileStorage::class);
    $storage->shouldNotReceive('saveFile');
    $autodocs->storage = $storage;

    $autodocs->buildPages('page2,page3');
});

it('builds only designated page', function (): void {
    $autodocs = getAutodocs();
    $storage = Mockery::mock(FileStorage::class);
    $storage->shouldReceive('saveFile')->once();
    $storage->shouldReceive('hasDir')->andReturn(false);
    $storage->shouldReceive('createDir');
    $autodocs->storage = $storage;

    $autodocs->buildPages('example');
});
