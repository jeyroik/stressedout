<?php

use strout\components\specifications\Specification;
use strout\interfaces\foundation\specifications\IHasSpecification;
use strout\interfaces\foundation\specifications\ISpecification;

/**
 * @property array $config
 */
trait THasSpecification
{
    public function getSpecs(): ISpecification
    {
        $specs = $this->config[IHasSpecification::FIELD__SPECS];
        $specsClass = $specs['class'] ?? Specification::class;

        return new $specsClass($specs);
    }

    public function applySpecification(ISpecification $specs): bool
    {
        $specs($this);

        return true;
    }
}
