<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\ParametersResolver\Resolvers;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\FrameworkBridge\DB\ActiveDataModel;
use AbRouter\JsonApiFormatter\FrameworkBridge\RequestWrapper;

class FiltersResolver extends AbstractResolver
{
    public function resolve(DocumentSchema $documentSchema, RequestWrapper $requestWrapper): void
    {
        if (empty($requestWrapper->getFilter())) {
            return ;
        }

        $allowedSearchFields = array_intersect(
            array_keys($requestWrapper->getFilter()),
            $documentSchema->getAllowedSearchFields()
        );
        $searchFields = array_reduce($allowedSearchFields, function (array $acc, $key) use ($requestWrapper) {
            $acc[$key] = $requestWrapper->getFilter()[$key];
            return $acc;
        }, []);

        $collection = (new ActiveDataModel($documentSchema->getDataProvider()->getActiveData()))->whereAll(
            $this->buildConditions($searchFields)
        );

        if ($collection === null) {
            return ;
        }

        $documentSchema->replaceDataProvider($collection);
    }

    private function buildConditions(array $filters): array
    {
        $conditions = [];
        foreach ($filters as $key => $value) {
            if (is_string($value)) {
                $conditions[] = [
                  $key,
                  '=',
                  $value
                ];
            }
        }

        return $conditions;
    }
}
