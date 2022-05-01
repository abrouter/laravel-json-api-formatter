<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Example;

use AbRouter\JsonApiFormatter\DataSource\DataProviders\SimpleDataProvider;
use AbRouter\JsonApiFormatter\Example\Resources\UserSchema;

class TestController
{
    public function test()
    {
        $ad = new \stdClass();
        $ad->zhopa = 'zhopa2';
        $ad->profile = $ad;

        return (new UserSchema(new SimpleDataProvider(collect([$ad]))));
    }
}


$t = (new TestController())->test();
var_dump($t->toArray());
