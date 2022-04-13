<?php
namespace strout\components\foundation\treasures;

use extas\components\Item;
use extas\components\THasCreatedAt;
use extas\components\THasDescription;
use extas\components\THasId;
use extas\components\THasValue;
use strout\components\objects\ObjectBase;
use strout\interfaces\foundation\objects\IObject;
use strout\interfaces\foundation\treasures\ITreasure;

class Treasure extends Item implements ITreasure
{
    use THasDescription;
    use THasValue;
    use THasCreatedAt;
    use THasId;

    protected const FIELD__TMP = '__tmp';

    public function __construct(array $config)
    {
        if (!isset($config[static::FIELD__TMP])) {
            $config[static::FIELD__TMP] = [];
        }

        parent::__construct($config);
    }

    public function __toArray(): array
    {
        $config = $this->config;

        unset($this->config[static::FIELD__TMP]);
        $result = parent::__toArray();
        
        $this->config = $config;

        return $result;
    }

    public function __toArrayWithTmp(): array
    {
        return parent::__toArray();
    }

    public function getMinter(): IObject
    {
        return $this->getOrCreate(static::FIELD__MINTER);
    }

    public function getOwner(): IObject
    {
        return $this->getOrCreate(static::FIELD__OWNER);
    }

    public function getFrom(): IObject
    {
        return $this->getOrCreate(static::FIELD__FROM);
    }

    public function commitTransaction(IObject $to): bool
    {
        $this->config[static::FIELD__FROM] = $this->getOwner();
        $this->config[static::FIELD__OWNER] = $to;

        return true;
    }

    protected function createTmp($name, $value): Treasure
    {
        $this->config[static::FIELD__TMP][$name] = $value;

        return $this;
    }

    protected function getTmp($name, $default = null)
    {
        return $this->config[static::FIELD__TMP][$name] ?? $default;
    }

    protected function getOrCreate($fieldName): IObject
    {
        $object = $this->getTmp($fieldName);

        if (!$object) {
            $specs = $this->config[$fieldName];
            $object = new ObjectBase();
            $object->applySpecification($specs);
            $this->createTmp($fieldName, $object);
        }
        
        return $object;
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
