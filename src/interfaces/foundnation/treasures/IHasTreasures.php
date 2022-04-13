<?php
namespace strout\interfaces\foundation\treasures;

use strout\interfaces\foundation\spaces\ISpace;

interface IHasTreasures
{
    public const FIELD__TREASURES = 'treasures';

    public function getTreasures(ISpace $space): ITreasureCollection;
    public function recieveTreasure(ITreasure $treasure, ISpace $space): ITreasureCollection;
    public function extractTreasure(int $amount, ISpace $space): ITreasure;
}
