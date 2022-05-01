<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Sections;

class IncludeSection
{
    private string $propertyName;

    /**
     * @var callable
     */
    private $callback;

    public function __construct(string $propertyName, callable $callback)
    {
        $this->propertyName = $propertyName;
        $this->callback = $callback;
    }

    /**
     * @return string
     */
    public function getPropertyName(): string
    {
        return $this->propertyName;
    }

    /**
     * @return callable
     */
    public function getCallback(): callable
    {
        return $this->callback;
    }
}
