<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Render\Schema;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\Render\Sections\DocumentRender;
use AbRouter\JsonApiFormatter\Render\Sections\IncludesRender;

class SingleSchema implements SchemaInterface
{
    private DocumentRender $documentRender;

    private IncludesRender $includesRender;

    public function __construct(
        DocumentRender $documentRender,
        IncludesRender $includesRender
    ) {
        $this->documentRender = $documentRender;
        $this->includesRender = $includesRender;
    }

    public function render(DocumentSchema $documentSchema): array
    {
        $response = [
            'data' => $this->documentRender->render($documentSchema),
        ];

        if (!$documentSchema->getMeta()->isEmpty()) {
            $response['meta'] = $documentSchema->getMeta()->getProperties();
        }

        $includes = $this->includesRender->render($documentSchema);

        if (!empty($includes)) {
            $response['included'] = $includes;
        }

        return $response;
    }
}
