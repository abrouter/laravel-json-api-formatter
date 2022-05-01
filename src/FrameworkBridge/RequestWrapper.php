<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\FrameworkBridge;

use Illuminate\Http\Request;

class RequestWrapper
{
    private ?Request $request;

    public function __construct(?Request $request)
    {
        $this->request = $request;
    }

    public function getIncludesList(): array
    {
        if ($this->request === null) {
            return [];
        }

        return explode(',', $this->request->get('include') ?? '');
    }

    public function getFilter(): array
    {
        return (array) $this->request->get('filter') ?? [];
    }
}

