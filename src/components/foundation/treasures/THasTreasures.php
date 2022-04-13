<?php
namespace strout\components\treasures;

use strout\interfaces\foundation\spaces\ISpace;
use strout\interfaces\foundation\treasures\IHasTreasures;
use strout\interfaces\foundation\treasures\ITreasureCollection;
use strout\interfaces\foundation\treasures\ITreasure;

trait THasTreasures 
{
    public function getTreasures(ISpace $space): ITreasureCollection
    {
        return new TreasureCollection($this->config[IHasTreasures::FIELD__TREASURES]);
    }

    public function recieveTreasure(ITreasure $treasure, ISpace $space): ITreasureCollection
    {
        $treasures = $this->getTreasures($space);
        $treasures->addItem($treasure);
        $this->config[IHasTreasures::FIELD__TREASURES] = $treasures->__toArray();

        return $treasures;
    }

    public function extractTreasure(int $amount, ISpace $space): ITreasure
    {
        $treasures = $this->getTreasures($space);
        $treasure = $treasures->extractTreasure($amount, $space);

        return $treasure;
    }
}
