<?php
namespace strout\interfaces\foundation\objects;

use extas\interfaces\IHasDescription;
use strout\interfaces\foundation\specifications\ISpecification;

interface IObjectSpecification extends ISpecification, IHasDescription
{
    public const SUBJECT = 'strout.object.specification';
}
