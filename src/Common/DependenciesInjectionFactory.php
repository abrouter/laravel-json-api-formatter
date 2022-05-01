<?php
declare(strict_types = 1);

namespace AbRouter\JsonApiFormatter\Common;

use AbRouter\JsonApiFormatter\ParametersResolver\EntrypointParameterResolver;
use AbRouter\JsonApiFormatter\Render\Schema\MultiSchema;
use AbRouter\JsonApiFormatter\Render\Schema\SingleSchema;
use ReflectionClass;
use ReflectionParameter;

/**
 * Oversimplified version of standard laravel di
 * Making me own to use internally and don't depend on laravel di to use this library for another frameworks
 */
class DependenciesInjectionFactory
{
    private function make(string $class): object
    {
        $reflection = new ReflectionClass($class);

        if ($reflection->getConstructor() === null) {
            return new $class;
        }

        $argumentsNeeded = $reflection->getConstructor()->getParameters();
        $arguments = array_reduce($argumentsNeeded, function (array $acc, ReflectionParameter $reflectionParameter) {
            $acc[] = $this->make($reflectionParameter->getType()->getName());

            return $acc;
        }, []);


        return new $class(...$arguments);
    }

    public function makeSingleSchema(): SingleSchema
    {
        /**
         * @var SingleSchema $var
         */
        $var = $this->make(SingleSchema::class);
        return $var;
    }

    public function makeMultiSchema(): MultiSchema
    {
        /**
         * @var MultiSchema $var
         */
        $var = $this->make(MultiSchema::class);
        return $var;
    }

    public function makeEntrypointParameterResolver(): EntrypointParameterResolver
    {
        /**
         * @var EntrypointParameterResolver $var
         */
        $var = $this->make(EntrypointParameterResolver::class);
        return $var;
    }
}
