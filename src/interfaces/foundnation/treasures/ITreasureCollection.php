<?php
namespace strout\interfaces\foundation\treasures;

use extas\interfaces\IHasValue;
use extas\interfaces\IItem;
use strout\interfaces\foundation\objects\IObject;
use strout\interfaces\foundation\spaces\ISpace;

interface ITreasureCollection extends IItem, IHasValue
{
    public const SUBJECT = 'strout.treasure.collection';

    public const FIELD__ITEMS = 'items';
    public const FIELD__OWNER = 'owner';

    public function getItems(): array;

    public function getOwner(): IObject;

    /**
     * Add item to the current collection
     *
     * @param ITreasure $treasure
     * @return integer current items count
     */
    public function addItem(ITreasure $treasure): int;
    public function removeItem(ITreasure $treasure): int;
    public function extractTreasure(int $amount, ISpace $space, bool $riseExceptionIfNotEnough = true): ?ITreasure;
}
