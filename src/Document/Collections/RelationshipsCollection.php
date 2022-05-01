<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Collections;

use AbRouter\JsonApiFormatter\Document\Sections\Relationship;
use AbRouter\JsonApiFormatter\Document\Traits\WithKey;

class RelationshipsCollection
{
    use WithKey;

    /**
     * @var Relationship[]
     */
    private array $relationships;

    public function __construct(Relationship...$relationships)
    {
        $this->relationships = $relationships;
    }

    /**
     * @return Relationship[]
     */
    public function getAll(): array
    {
        return $this->relationships;
    }
}
