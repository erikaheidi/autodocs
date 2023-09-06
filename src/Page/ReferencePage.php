<?php

namespace Autodocs\Page;

use Autodocs\Service\AutodocsService;

abstract class ReferencePage implements ReferencePageInterface
{
    public AutodocsService $autodocs;
    public function __construct(AutodocsService $autodocs)
    {
        $this->autodocs = $autodocs;
    }
}
