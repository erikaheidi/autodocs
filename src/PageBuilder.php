<?php

declare(strict_types=1);

namespace Autodocs;

use Autodocs\Page\ReferencePageInterface;

class PageBuilder
{
    public function buildPage(ReferencePageInterface $page): string
    {
        return $page->getContent();
    }
}
