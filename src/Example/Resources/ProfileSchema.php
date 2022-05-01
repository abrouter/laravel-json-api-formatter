<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Example\Resources;

use AbRouter\JsonApiFormatter\Document\Collections\IdentifiersCollection;
use AbRouter\JsonApiFormatter\Document\Collections\RelationshipsCollection;
use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\Document\Sections\Attributes;
use AbRouter\JsonApiFormatter\Document\Sections\Identifier;
use AbRouter\JsonApiFormatter\Document\Sections\Relationship;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Model activeData
 */
class ProfileSchema extends DocumentSchema
{
    public function getId(): string
    {
        return $this->activeData->id;
    }

    public function getType(): string
    {
        return $this->activeData->type;
    }

    public function getIdentifier(): Identifier
    {
        return new Identifier('2', 'zalupa');
    }

    public function getRelationships(): RelationshipsCollection
    {
        return new RelationshipsCollection(...[
            new Relationship('zalupa11', new Identifier('id', 'test')),
            new Relationship(
                'zalupa12',
                new IdentifiersCollection(...[
                    new Identifier(uniqid(), 'qqq'),
                    new Identifier(uniqid(), 'qqq'),
                    new Identifier(uniqid(), 'qqq'),
                    new Identifier(uniqid(), 'qqq'),
                ])
            )
        ]);
    }

    public function getAttributes(): Attributes
    {
        return new Attributes([
            'test' => $this->activeData->zhopa,
        ]);
    }
}
