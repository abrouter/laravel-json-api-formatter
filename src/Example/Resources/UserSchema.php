<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Example\Resources;

use AbRouter\JsonApiFormatter\DataSource\DataProviders\SimpleDataProvider;
use AbRouter\JsonApiFormatter\Document\Collections\IncludeSectionsCollection;
use AbRouter\JsonApiFormatter\Document\Collections\IdentifiersCollection;
use AbRouter\JsonApiFormatter\Document\Collections\RelationshipsCollection;
use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\Document\Sections\Attributes;
use AbRouter\JsonApiFormatter\Document\Sections\Identifier;
use AbRouter\JsonApiFormatter\Document\Sections\IncludeSection;
use AbRouter\JsonApiFormatter\Document\Sections\Relationship;
use App\Models\User;

/**
 * @property User activeData
 */
class UserSchema extends DocumentSchema
{
    public function getIdentifier(): Identifier
    {
        return new Identifier((string) $this->activeData->id, 'users');
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
            'email' => $this->activeData->email,
            'name' => $this->activeData->email,
        ]);
    }

    public function getIncludes(): IncludeSectionsCollection
    {
        return new IncludeSectionsCollection(...[
            new IncludeSection('profile', function () {
                return new ProfileSchema(new SimpleDataProvider($this->activeData->profile));
            })
        ]);
    }

    public function getAllowedSearchFields(): array
    {
        return [
            'email',
        ];
    }
}
