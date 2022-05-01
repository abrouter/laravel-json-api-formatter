<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\ParametersResolver;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\FrameworkBridge\RequestWrapper;
use AbRouter\JsonApiFormatter\ParametersResolver\Resolvers\AbstractResolver;
use AbRouter\JsonApiFormatter\ParametersResolver\Resolvers\FiltersResolver;
use AbRouter\JsonApiFormatter\ParametersResolver\Resolvers\IncludesResolver;

class ResolversChain
{
    private const RESOLVERS = [
        IncludesResolver::class,
        FiltersResolver::class,
    ];

    public function resolve(DocumentSchema $documentSchema, RequestWrapper $requestWrapper)
    {
        foreach (self::RESOLVERS as $resolverClass) {
            /**
             * @var AbstractResolver $resolver
             */
            $resolver = new $resolverClass;
            $resolver->resolve($documentSchema, $requestWrapper);
        }
    }
}
