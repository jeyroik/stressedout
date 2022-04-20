<?php
namespace strout\interfaces\foundation\objects;

use extas\interfaces\IHasId;
use extas\interfaces\IItem;
use extas\interfaces\samples\parameters\IHasSampleParameters;

interface IObject extends IItem, IHasId, IHasSampleParameters
{
    public const SUBJECT = 'strout.object';
}
