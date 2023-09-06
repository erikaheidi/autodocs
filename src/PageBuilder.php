<?php

namespace Autodocs;

use Autodocs\Page\ReferencePageInterface;
use Autodocs\Storage\FileStorage;

class PageBuilder
{
    public function buildPage(ReferencePageInterface $page): string
    {
        return $page->getContent();
    }
}
