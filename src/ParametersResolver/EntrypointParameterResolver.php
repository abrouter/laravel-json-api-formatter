<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\ParametersResolver;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\FrameworkBridge\RequestWrapper;

class EntrypointParameterResolver
{
    private ResolversChain $resolversChain;

    public function __construct(ResolversChain $resolversChain)
    {
        $this->resolversChain = $resolversChain;
    }

    public function resolve(DocumentSchema $documentSchema, RequestWrapper $request): void
    {
        $this->resolversChain->resolve($documentSchema, $request);
    }
}
