<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\ParametersResolver\Resolvers;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\FrameworkBridge\RequestWrapper;

abstract class AbstractResolver
{
    abstract public function resolve(DocumentSchema $documentSchema, ?RequestWrapper $requestWrapper): void;
}
