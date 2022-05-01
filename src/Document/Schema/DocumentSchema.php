<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Schema;

use AbRouter\JsonApiFormatter\Document\Collections\RelationshipsCollection;
use AbRouter\JsonApiFormatter\Document\Sections\Attributes;
use AbRouter\JsonApiFormatter\Document\Sections\Identifier;
use AbRouter\JsonApiFormatter\Document\Sections\Meta;
use AbRouter\JsonApiFormatter\Document\Collections\IncludeSectionsCollection;
use AbRouter\JsonApiFormatter\FrameworkBridge\RequestWrapper;
use AbRouter\JsonApiFormatter\Render\EntrypointRender;

/**
 * @property mixed activeData
 */
abstract class DocumentSchema extends RootSchema
{
    private array $includes = [];

    abstract public function getIdentifier(): Identifier;

    abstract public function getAttributes(): Attributes;

    public function getRelationships(): RelationshipsCollection
    {
        return new RelationshipsCollection();
    }

    public function getMeta(): Meta
    {
        return new Meta([]);
    }

    public function getIncludes(): IncludeSectionsCollection
    {
        return new IncludeSectionsCollection();
    }

    public function toArray($request = null)
    {
        return (new EntrypointRender())->render($this, new RequestWrapper($request));
    }

    public function addInclude(string $includeName): self
    {
        $this->includes[] = $includeName;
        return $this;
    }

    public function getRequestedIncludes(): array
    {
        return $this->includes;
    }

    public function getAllowedSearchFields(): array
    {
        return [];
    }
}
