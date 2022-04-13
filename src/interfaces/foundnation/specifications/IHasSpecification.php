<?php
namespace strout\interfaces\foundation\specifications;

interface IHasSpecification
{
    public const FIELD__SPECS = 'specs';

    public function getSpecs(): ISpecification;
    public function applySpecification(ISpecification $specs): bool;
}
