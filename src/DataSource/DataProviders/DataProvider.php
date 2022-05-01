<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\DataSource\DataProviders;

use Illuminate\Support\Collection;
use Traversable;

abstract class DataProvider
{
    protected mixed $activeData;

    public function __construct(mixed $activeData)
    {
        $this->setActiveData($activeData);
    }

    /**
     * @return mixed
     */
    public function getActiveData()
    {
        return $this->activeData;
    }

    /**
     * @param mixed $activeData
     * @return DataProvider
     */
    public function setActiveData(mixed $activeData): self
    {
        $this->activeData = $activeData;
        return $this;
    }

    public function isCollection(): bool
    {
        if ($this->activeData instanceof Collection || is_array($this->activeData)) {
            return true;
        }
        
        return false;
    }
}
