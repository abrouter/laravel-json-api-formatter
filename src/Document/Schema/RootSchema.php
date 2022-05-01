<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Document\Schema;

use AbRouter\JsonApiFormatter\DataSource\DataProviders\DataProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class RootSchema extends JsonResource
{
    /**
     * @var mixed
     */
    protected $activeData;

    private DataProvider $dataProvider;

    public function __construct(DataProvider $dataProvider)
    {
        $this->setDataProvider($dataProvider);

        parent::__construct($dataProvider->getActiveData());
    }

    public function setDataProvider(DataProvider $dataProvider): self
    {
        $this->dataProvider = $dataProvider;
        $this->activeData = $dataProvider->getActiveData();
        return $this;
    }

    public function getDataProvider(): DataProvider
    {
        return $this->dataProvider;
    }

    public function withResponse($request, $response): void
    {
        $response->header('Content-Type', 'application/vnd.api+json');
    }

    public function isCollection(): bool
    {
        return $this->dataProvider->isCollection();
    }


    public function setActiveData(mixed $activeData): self
    {
        $this->activeData = $activeData;
        return $this;
    }

    public function replaceDataProvider(mixed $activeData): self
    {
        $dataProviderClass = get_class($this->dataProvider);
        $this->dataProvider = new $dataProviderClass($activeData);
        return $this;
    }
}
