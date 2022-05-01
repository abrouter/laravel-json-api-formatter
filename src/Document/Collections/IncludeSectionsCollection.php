<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Collections;

use AbRouter\JsonApiFormatter\Document\Sections\IncludeSection;

class IncludeSectionsCollection
{
    /**
     * @var IncludeSection[]
     */
    private array $includeSections;

    public function __construct(IncludeSection...$includeHandlerDTO)
    {
        $this->includeSections = $includeHandlerDTO;
    }

    /**
     * @return IncludeSection[]
     */
    public function all(): array
    {
        return $this->includeSections;
    }
}
