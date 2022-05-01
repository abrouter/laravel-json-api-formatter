<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Sections;

use AbRouter\JsonApiFormatter\Document\Interfaces\IdentifiersInterface;

class Identifier implements IdentifiersInterface
{
    /**
     * @var string $id
     */
    private string $id;

    /**
     * @var string $type
     */
    private string $type;

    public function __construct(
        string $id,
        string $type
    ) {
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    public function isCollection(): bool
    {
        return false;
    }
}
