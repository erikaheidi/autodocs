<?php

use Autodocs\Page\TestPage;
use Autodocs\Service\AutodocsService;

it('returns content using data from JsonDataFeed', function () {
    $autodocs = getAutodocs();

    $page = new TestPage($autodocs);
    $page->loadData();
    $content = $page->getContent();

    $this->assertEquals("test", $page->getName());
    $this->assertStringContainsString("pulumi", $content);
});
