<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Sections;

use AbRouter\JsonApiFormatter\Document\Collections\IdentifiersCollection;
use AbRouter\JsonApiFormatter\Document\Interfaces\IdentifiersInterface;
use RuntimeException;

class Relationship
{
    private Identifier $identifier;

    private IdentifiersCollection $identifiersCollection;

    private bool $isCollection;

    private string $key;

    public function __construct(string $key, IdentifiersInterface $identifierOrCollection)
    {
        $this->key = $key;

        if ($identifierOrCollection->isCollection()) {
            /**
             * @var IdentifiersCollection $identifierOrCollection
             */
            $this->identifiersCollection = $identifierOrCollection;
            $this->isCollection = true;
        } else {
            /**
             * @var Identifier $identifierOrCollection
             */
            $this->identifier = $identifierOrCollection;
            $this->isCollection = false;
        }
    }

    /**
     * @return Identifier
     */
    public function getIdentifier(): Identifier
    {
        if (empty($this->identifier)) {
            throw new RuntimeException('Relationship: identifier is empty.');
        }

        return $this->identifier;
    }

    public function getIdentifiersCollection(): IdentifiersCollection
    {
        if (empty($this->identifiersCollection)) {
            throw new RuntimeException('Relationship: identifiers collection is empty.');
        }

        return $this->identifiersCollection;
    }

    public function isCollection(): bool
    {
        return $this->isCollection;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }
}
