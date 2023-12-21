<?php

declare(strict_types=1);

use Autodocs\Page\TestPage;

it('returns content using data from JsonDataFeed', function (): void {
    $autodocs = getAutodocs();

    $page = new TestPage($autodocs);
    $page->loadData();
    $content = $page->getContent();

    $this->assertEquals("test", $page->getName());
    $this->assertStringContainsString("pulumi", $content);
});
