<?php

use Autodocs\Page\ExamplePage;
use Autodocs\Page\TestPage;
use Autodocs\PageBuilder;
use Autodocs\Storage;

it('registers and builds reference page', function () {
    $page = new ExamplePage();
    $page->loadData();

    $storage = Mockery::mock(Storage::class);
    $storage->shouldReceive('saveFile');

    $builder = new PageBuilder($storage);
    $builder->registerPage($page);

    $this->assertCount(1, $builder->referencePages);

    $builder->buildPages();
});

it('skips building when page is not listed', function () {
    $page = new ExamplePage();
    $page->loadData();

    $storage = Mockery::mock(Storage::class);
    $storage->shouldNotReceive('saveFile');

    $builder = new PageBuilder($storage);
    $builder->registerPage($page);

    $this->assertCount(1, $builder->referencePages);

    $builder->buildPages('page2,page3');
});

it('builds only designated page', function () {
    $page1 = new ExamplePage();
    $page1->loadData();

    $page2 = new TestPage();
    $page2->loadData();

    $storage = Mockery::mock(Storage::class);
    $storage->shouldReceive('saveFile')->once();

    $builder = new PageBuilder($storage);
    $builder->registerPages([$page1, $page2]);

    $this->assertCount(2, $builder->referencePages);

    $builder->buildPages('example');
});
