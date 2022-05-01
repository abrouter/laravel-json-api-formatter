<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\ParametersResolver\Resolvers;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\FrameworkBridge\RequestWrapper;

class IncludesResolver extends AbstractResolver
{
    public function resolve(DocumentSchema $documentSchema, RequestWrapper $requestWrapper): void
    {
        if (empty($requestWrapper->getIncludesList())) {
            return ;
        }

        foreach ($requestWrapper->getIncludesList() as $include) {
            $documentSchema->addInclude($include);
        }
    }
}
