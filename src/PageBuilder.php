<?php

namespace Autodocs;

use Autodocs\Page\ReferencePage;

class PageBuilder
{
    public Storage $storage;
    public array $referencePages = [];

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function registerPages(array $referencePages): void
    {
        foreach ($referencePages as $referencePage) {
            $this->registerPage($referencePage);
        }
    }

    public function registerPage(ReferencePage $page): void
    {
        $page->loadData();
        $this->referencePages[] = $page;
    }

    public function buildPages(string $pages="all"): void
    {
        $buildPages = explode(",", $pages);
        /** @var ReferencePage $referencePage */
        foreach ($this->referencePages as $referencePage) {
            if ($pages === "all" || in_array($referencePage->getName(), $buildPages)) {
                $this->storage->saveFile($referencePage->getSavePath(), $this->buildPage($referencePage));
            }
        }
    }

    public function buildPage(ReferencePage $page): string
    {
        return $page->getContent();
    }
}
