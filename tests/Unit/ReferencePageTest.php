<?php

use Autodocs\Page\TestPage;

it('returns content using data from json DataFeed', function () {
    $page = new TestPage();
    $page->loadData();
    $content = $page->getContent();

    $this->assertEquals("test", $page->getName());
    $this->assertStringContainsString("pulumi", $content);
});
