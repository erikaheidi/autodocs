<?php

declare(strict_types=1);

namespace Autodocs\Page;

interface ReferencePageInterface
{
    public function loadData(array $parameters = []): void;

    public function getName(): string;

    public function getSavePath(): string;

    public function getContent(): string;
}
