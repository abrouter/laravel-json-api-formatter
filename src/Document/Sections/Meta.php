<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Sections;

class Meta
{
    private array $properties;

    public function __construct(
        array $properties
    ) {
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function isEmpty(): bool
    {
        return empty($this->properties);
    }
}
