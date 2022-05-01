<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Render\Sections;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\Document\Sections\IncludeSection;

class IncludesRender
{
    private DocumentRender $documentRender;

    public function __construct(
        DocumentRender $documentRender,
    ) {
        $this->documentRender = $documentRender;
    }

    public function render(DocumentSchema $documentSchema): array
    {
        $requestedIncludes = $documentSchema->getRequestedIncludes();
        if (empty($requestedIncludes)) {
            return [];
        }

        $response = array_reduce(
            $documentSchema->getIncludes()->all(),
            function (array $acc, IncludeSection $includeSection) use ($documentSchema, $requestedIncludes) {

                if (!in_array($includeSection->getPropertyName(), $requestedIncludes, true)) {
                    return $acc;
                }

                /**
                 * @var DocumentSchema $document
                 */
                $document = $includeSection->getCallback()($documentSchema->getDataProvider());
                $acc[] = $this->documentRender->render($document);
                return $acc;
            },
            []
        );

        return $response;
    }

}
