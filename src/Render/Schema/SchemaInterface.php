<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Render\Schema;

use AbRouter\JsonApiFormatter\Document\Schema\DocumentSchema;

interface SchemaInterface
{
    public function render(DocumentSchema $documentSchema): array;
}
