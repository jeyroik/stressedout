<?php
namespace strout\components\foundation\treasures;

use extas\components\Item;
use extas\components\THasValue;
use strout\components\exceptions\NotEnough;
use strout\components\founadtion\objects\ObjectBase;
use strout\interfaces\foundation\objects\IObject;
use strout\interfaces\foundation\spaces\ISpace;
use strout\interfaces\foundation\treasures\ITreasure;
use strout\interfaces\foundation\treasures\ITreasureCollection;

class TreasureCollection extends Item implements ITreasureCollection
{
    use THasValue;

    protected const MSG__EXTRACTED_TREASURE = 'Extracted treasure';

    public function __construct(array $config)
    {
        if (!isset($config[static::FIELD__ITEMS])) {
            $config[static::FIELD__ITEMS] = [];
        }

        parent::__construct($config);
    }

    /**
     * Return items
     *
     * @return ITreasure[]
     */
    public function getItems(): array
    {
        return $this->config[static::FIELD__ITEMS];
    }

    public function getOwner(): IObject
    {
        $owner = new ObjectBase();
        $owner->applySpecification($this->config[static::FIELD__OWNER]);

        return $owner;
    }

    public function addItem(ITreasure $treasure): int
    {
        $this->config[static::FIELD__ITEMS][$treasure->getId()] = $treasure;
        $this->setValue($this->getValue() + $treasure->getValue());

        return $this->getValue();
    }

    public function removeItem(ITreasure $treasure): int
    {
        if (isset($this->config[static::FIELD__ITEMS][$treasure->getId()])) {
            unset($this->config[static::FIELD__ITEMS][$treasure->getId()]);
            $this->setValue($this->getValue() - $treasure->getValue());
        }

        return $this->getValue();
    }

    public function extractTreasure(int $amount, ISpace $space, bool $riseExceptionIfNotEnough = true): ?ITreasure
    {
        if ($amount > $this->getValue()) {
            if ($riseExceptionIfNotEnough) {
                throw new NotEnough();
            } else {
                return new Treasure([
                    Treasure::FIELD__VALUE => 0,
                    Treasure::FIELD__TITLE => static::MSG__EXTRACTED_TREASURE,
                    Treasure::FIELD__DESCRIPTION => static::MSG__EXTRACTED_TREASURE,
                    Treasure::FIELD__MINTER => $space->getState()->getActor()->getSpecs(),
                    Treasure::FIELD__FROM => $this->getOwner()->getSpecs()
                ]);
            }
        }

        /**
         * @var ITreasure[] $items
         */
        $items = $this->getItems();
        $items = array_column($items, null, ITreasure::FIELD__VALUE);
        ksort($items, SORT_NUMERIC);

        try {
            $newTreasure = $this->extractIsLessThanOneTreasure($items, $amount);
        } catch (NotEnough $e) {
            $newTreasure = $this->extractIsBiggerThanOneTreasure($items, $amount, $space);
        }

        return $newTreasure;
    }

    /**
     * Extract treasure from several treasures.
     *
     * @param ITreasure[] $items
     * @param integer $amount
     * @param ISpace $space
     * @return ITreasure
     */
    protected function extractIsBiggerThanOneTreasure(array $items, int $amount, ISpace $space): ITreasure
    {
        $total = 0;
        $left = $amount;

        foreach ($items as $curAmount => $treasure) {
            if ($total < $amount) {
                $this->removeItem($treasure);

                if ($curAmount <= $left) {
                    $total += $curAmount;
                    $left -= $curAmount;
                } else {
                    $curLeft = $curAmount - $left;
                    $total += $left;
                    $left = 0;
                    
                    $treasure->setValue($curLeft);
                    $this->addItem($treasure);
                }
            }
        }

        return new Treasure([
            Treasure::FIELD__VALUE => $amount,
            Treasure::FIELD__TITLE => static::MSG__EXTRACTED_TREASURE,
            Treasure::FIELD__DESCRIPTION => static::MSG__EXTRACTED_TREASURE,
            Treasure::FIELD__MINTER => $space->getState()->getActor()->getSpecs(),
            Treasure::FIELD__FROM => $this->getOwner()->getSpecs()
        ]);
    }

    /**
     * Extract treasure if it less thann one trasure,
     * Rise exception otherwise.
     *
     * @param ITreasure[] $items
     * @param integer $amount
     * @return ITreasure
     *
     * @throws NotEnough
     */
    protected function extractIsLessThanOneTreasure(array $items, int $amount): ITreasure
    {
        foreach ($items as $curAmount => $treasure) {
            if ($curAmount < $amount) {
                continue;
            } elseif ($curAmount == $amount) {
                $this->removeItem($treasure);
                return $treasure;
            } else {
                $newTreasure = new Treasure($treasure->__toArray());
                $newTreasure->setValue($amount);
                
                $this->removeItem($treasure);
                $treasure->setValue($treasure->getValue() - $amount);
                $this->addItem($treasure);

                return $newTreasure;
            }
        }

        throw new NotEnough();
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
