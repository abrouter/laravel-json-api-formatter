<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\FrameworkBridge\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as CollectionDb;

class ActiveDataModel
{
    private Model $activeData;

    /**
     * @var Collection|CollectionDb|null
     */
    private $collection = null;

    private bool $actionable;

    public function __construct($activeData)
    {
        $this->actionable = $this->isEloquent($activeData);
        if ($this->actionable) {
            $this->activeData = $this->extractModel($activeData);
            $this->collection = $activeData;
        }
    }

    public function whereAll(array $conditions): ?Collection
    {
        if (!$this->actionable) {
            return null;
        }

        if (!($this->collection instanceof Collection)) {
            return null;
        }

        foreach ($conditions as $condition) {
            $this->collection = $this->collection->where($condition[0], $condition[1], $condition[2]);
        }

        return $this->collection;
    }

    private function isEloquent($activeData): bool
    {
        if ($activeData instanceof Model) {
            return true;
        }

        if ($activeData instanceof Collection) {
            return $this->isEloquent($activeData->first());
        }

        return false;
    }

    private function extractModel($activeData): Model
    {
        if ($activeData instanceof Model) {
            return $activeData;
        }

        /**
         * @var Collection $activeData
         */
        return $activeData->first();
    }

}
