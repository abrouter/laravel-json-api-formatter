<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Render;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\FrameworkBridge\RequestWrapper;
use AbRouter\JsonApiFormatter\Render\Schema\SchemaFactory;
use AbRouter\JsonApiFormatter\Common\DependenciesInjectionFactory;

class EntrypointRender
{
    private DependenciesInjectionFactory $dependenciesFactory;

    public function __construct(?DependenciesInjectionFactory $dependenciesFactory = null)
    {
        $this->dependenciesFactory = $dependenciesFactory ?? new DependenciesInjectionFactory();
    }

    public function render(DocumentSchema $documentSchema, ?RequestWrapper $request): array
    {
        $this->dependenciesFactory->makeEntrypointParameterResolver()->resolve($documentSchema, $request);

        return (new SchemaFactory($this->dependenciesFactory))
            ->factory($documentSchema->isCollection())
            ->render($documentSchema);
    }
}
