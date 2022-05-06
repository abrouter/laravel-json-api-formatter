<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Render\Schema;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;
use AbRouter\JsonApiFormatter\Render\Sections\DocumentRender;
use AbRouter\JsonApiFormatter\Render\Sections\IncludesRender;
use Illuminate\Support\Collection;

class MultiSchema implements SchemaInterface
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
        $activeData = $documentSchema->getDataProvider()->getActiveData();
        if ($activeData instanceof Collection) {
            $activeData = $activeData->all();
        }

        $includes = [];
        $response = [
            'data' => array_reduce(
                $activeData,
                function (array $acc, $activeData) use ($documentSchema, &$includes) {
                    $documentSchema->setActiveData($activeData);
                    $acc[] = $this->documentRender->render($documentSchema);
                    foreach($this->includesRender->render($documentSchema) as $include) {
                        $includes[] = $include;
                    }

                    return $acc;
                },
                []
            ),
        ];

        if (!$documentSchema->getMeta()->isEmpty()) {
            $response['meta'] = $documentSchema->getMeta()->getProperties();
        }

        if (!empty($includes)) {
            $response['included'] = $includes;
        }

        return $response;
    }
}
