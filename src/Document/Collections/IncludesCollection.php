<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Collections;

class IncludesCollection
{
    /**
     * @var DocumentsCollection[]
     */
    private array $documents;

    public function __construct(DocumentsCollection...$documents)
    {
        $this->documents = $documents;
    }

    /**
     * @return DocumentsCollection[]
     */
    public function getDocuments(): array
    {
        return $this->documents;
    }
}
