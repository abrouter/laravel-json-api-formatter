<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\FrameworkBridge\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ActiveDataModel
{
    private Model $activeData;

    private bool $actionable;

    public function __construct($activeData)
    {
        $this->actionable = $this->isEloquent($activeData);
        if ($this->actionable) {
            $this->activeData = $this->extractModel($activeData);
        }
    }

    public function whereAll(array $conditions): ?Collection
    {
        if (!$this->actionable) {
            return null;
        }

        if (!($this->activeData instanceof Collection)) {
            return null;
        }

        return $this->activeData->whereAll($conditions)->get();
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
