<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Render\Sections;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;

class DocumentRender
{
    public function render(DocumentSchema $document): array
    {
        $relationships = (new RelationshipsRender())->render($document->getRelationships());
        $response = [
            'id' => $document->getIdentifier()->getId(),
            'type' => $document->getIdentifier()->getType(),
            'attributes' => $document->getAttributes()->getProperties(),
        ];

        if (!empty($relationships)) {
            $response['relationships'] = $relationships;
        }

        return $response;
    }
}
