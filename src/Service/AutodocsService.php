<?php

namespace Autodocs\Service;

use Autodocs\DataFeed\JsonDataFeed;
use Autodocs\Page\ReferencePageInterface;
use Autodocs\PageBuilder;
use Autodocs\Storage\FileStorage;
use Autodocs\Storage\StorageInterface;
use Minicli\App;
use Minicli\ServiceInterface;
use Minicli\Stencil;

class AutodocsService implements ServiceInterface
{
    public array $config;
    public StorageInterface $storage;
    public PageBuilder $builder;
    public Stencil $stencil;
    public array $dataFeeds = [];
    public array $referencePages = [];

    public function load(App $app): void
    {
        $this->config = $app->config->autodocs;
        $this->storage = new FileStorage();
        $this->stencil = new Stencil($this->config['templates_dir']);
        if (isset($this->config['storage'])) {
            $this->storage = new $this->config['storage'];
        }

        $this->builder = new PageBuilder();
        foreach ($this->config['pages'] as $page) {
            $page = new $page($this);
            $this->registerPage($page);
        }

        if (isset($this->config['cache_dir'])) {
            foreach (glob($this->config['cache_dir'] . '/*.json') as $jsonCache) {
                $this->registerDataFeed(basename($jsonCache), new JsonDataFeed());
            }
        }
    }
    protected function registerDataFeed(string $identifier, JsonDataFeed $dataFeed): void
    {
        $this->dataFeeds[$identifier] = $dataFeed;
    }

    public function getDataFeed(string $identifier): ?JsonDataFeed
    {
        if (isset($this->dataFeeds[$identifier])) {
            /** @var JsonDataFeed $dataFeed */
            $dataFeed = $this->dataFeeds[$identifier];
            $dataFeed->loadFile($this->config['cache_dir'] . '/' . $identifier);
            return $dataFeed;
        }
        return null;
    }

    public function getDataFeedsList(string $filter = ""): array
    {
        $cachedFiles = array_keys($this->dataFeeds);
        return array_filter($cachedFiles, function($var) use ($filter) {
           return str_starts_with($var, $filter);
        });
    }

    public function registerPage(ReferencePageInterface $page): void
    {
        $this->referencePages[] = $page;
    }

    public function buildPages(string $pages="all", array $parameters = []): void
    {
        $buildPages = explode(",", $pages);
        /** @var ReferencePageInterface $referencePage */
        foreach ($this->referencePages as $referencePage) {
            if ($pages === "all" || in_array($referencePage->getName(), $buildPages)) {
                $referencePage->loadData($parameters);
                $savePath = $this->config['output'] . '/' . $referencePage->getSavePath();
                if (!is_dir(dirname($savePath))) {
                    mkdir(dirname($savePath), 0755, true);
                }

                $this->storage->saveFile($savePath, $this->builder->buildPage($referencePage));
            }
        }
    }
}