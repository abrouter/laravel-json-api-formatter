<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Collections;

use AbRouter\JsonApiFormatter\Document\Sections\Document;

class DocumentsCollection
{
    /**
     * @var Document[]
     */
    private array $documents;

    public function __construct(Document...$documents)
    {
        $this->documents = $documents;
    }

    /**
     * @return Document[]
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }
}
