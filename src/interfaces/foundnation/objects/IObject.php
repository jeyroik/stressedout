<?php
namespace strout\interfaces\foundation\objects;

use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IHasId;
use extas\interfaces\IItem;
use strout\interfaces\foundation\treasures\IHasTreasures;

interface IObject extends IItem, IHasTreasures, IDispatcherWrapper, IHasId
{
    public const SUBJECT = 'strout.object';
}
