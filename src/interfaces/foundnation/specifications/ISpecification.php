<?php
namespace strout\interfaces\foundation\specifications;

use extas\interfaces\IItem;

interface ISpecification extends IItem
{
    public const SUBJECT = 'strout.specification';
    
    public const FIELD__CLASS = 'class';

    public function __invoke(IItem $item): IItem;
}
