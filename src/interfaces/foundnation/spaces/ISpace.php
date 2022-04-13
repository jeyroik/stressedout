<?php
namespace strout\interfaces\foundation\spaces;

use extas\interfaces\IItem;
use strout\interfaces\foundation\objects\IObject;
use strout\interfaces\foundation\objects\IObjectId;
use strout\interfaces\foundation\objects\IObjectSpecification;
use strout\interfaces\foundation\specifications\IHasSpecification;
use strout\interfaces\foundation\treasures\ITreasure;

interface ISpace extends IItem, IHasSpecification
{
    public const SUBJECT = 'strout.space';

    public function createObject(IObjectSpecification $specs, IObject $actor): IObject;
    public function getObject(IObjectId $objectId, IObject $actor): IObject;
    public function deleteObject(IObjectId $objectId, IObject $actor): bool;
    
    public function getState(): ISpaceState;
    public function setState(ISpaceState $state, IObject $actor): ISpace;

    public function mint(int $amount, IObject $actor): ITreasure;
    public function send(IObject $to, ITreasure $treasure, IObject $actor);
}
