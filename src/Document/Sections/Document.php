<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Sections;

use AbRouter\JsonApiFormatter\Document\Collections\RelationshipsCollection;

class Document
{
    private Identifier $identifier;

    private Attributes $attributes;

    private RelationshipsCollection $relationshipsCollection;

    public function __construct(
        Identifier $identifier,
        Attributes $attributes,
        RelationshipsCollection $relationshipsCollection,
    ) {
        $this->identifier = $identifier;
        $this->attributes = $attributes;
        $this->relationshipsCollection = $relationshipsCollection;
    }

    /**
     * @return Identifier
     */
    public function getIdentifier(): Identifier
    {
        return $this->identifier;
    }

    /**
     * @return Attributes
     */
    public function getAttributes(): Attributes
    {
        return $this->attributes;
    }

    /**
     * @return RelationshipsCollection
     */
    public function getRelationshipsCollection(): RelationshipsCollection
    {
        return $this->relationshipsCollection;
    }
}
