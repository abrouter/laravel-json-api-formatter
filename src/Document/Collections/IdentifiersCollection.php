<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Collections;

use AbRouter\JsonApiFormatter\Document\Interfaces\IdentifiersInterface;
use AbRouter\JsonApiFormatter\Document\Sections\Identifier;

class IdentifiersCollection implements IdentifiersInterface
{
    /**
     * @var Identifier[]
     */
    private array $identifiers;

    public function __construct(Identifier...$identifiers)
    {
        $this->identifiers = $identifiers;
    }

    /**
     * @return Identifier[]
     */
    public function getIdentifiers(): array
    {
        return $this->identifiers;
    }

    public function isCollection(): bool
    {
        return true;
    }
}
