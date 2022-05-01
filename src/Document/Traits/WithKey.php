<?php
declare(strict_types=1);

namespace AbRouter\JsonApiFormatter\Document\Traits;

trait WithKey
{
    private string $key;

    public function withKey(string $key): self
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    public function hasKey(): bool
    {
        return !empty($this->key);
    }
}
