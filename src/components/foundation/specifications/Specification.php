<?php
namespace strout\components\specifications;

use extas\components\Item;
use extas\interfaces\IItem;
use strout\interfaces\foundation\specifications\ISpecification;

class Specification extends Item implements ISpecification
{
    public function __invoke(IItem $item): IItem
    {
        $attributes = $this->__toArray();

        foreach ($attributes as $name => $value) {
            $item[$name] = $value;
        }

        return $item;
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
