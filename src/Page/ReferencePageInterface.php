<?php

namespace Autodocs\Page;

use Autodocs\DataFeed\JsonDataFeed;
use Autodocs\Service\AutodocsService;

interface ReferencePageInterface
{
    public function loadData(array $parameters = []): void;

    public function getName(): string;

    public function getSavePath(): string;

    public function getContent(): string;
}