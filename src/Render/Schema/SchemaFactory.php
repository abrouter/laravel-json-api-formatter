<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Render\Schema;

use AbRouter\JsonApiFormatter\Common\DependenciesInjectionFactory;

class SchemaFactory
{
    private DependenciesInjectionFactory $dependenciesInjectionFactory;

    public function __construct(DependenciesInjectionFactory $dependenciesInjectionFactory)
    {
        $this->dependenciesInjectionFactory = $dependenciesInjectionFactory;
    }

    public function factory(bool $isMultiData): SchemaInterface
    {
        if ($isMultiData) {
            return $this->dependenciesInjectionFactory->makeMultiSchema();
        }

        return $this->dependenciesInjectionFactory->makeSingleSchema();
    }
}
