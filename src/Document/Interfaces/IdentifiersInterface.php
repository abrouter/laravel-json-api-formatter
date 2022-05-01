<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Interfaces;

interface IdentifiersInterface
{
    public function isCollection(): bool;
}
