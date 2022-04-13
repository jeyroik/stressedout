<?php
namespace strout\components\founadtion\v1\contracts;

use extas\components\Item;
use extas\components\TDispatcherWrapper;
use strout\interfaces\foundation\v1\contracts\IContract;
use strout\interfaces\foundation\v1\spaces\ISpace;

class Contract extends Item implements IContract
{
    use TDispatcherWrapper;

    /**
     * @var ISpace
     */
    protected $space = null;

    public function execute(...$args): int
    {
        return $this->runSpaceOperation(static::OPERATION__EXECUTE, ...$args);
    }

    public function store(...$objects): int
    {
        return $this->runSpaceOperation(static::OPERATION__STORE, ...$objects);
    }

    protected function runSpaceOperation($operationName, ...$args): int
    {
        $cost = 0;

        foreach ($this->getPluginsByStage('strout.contract.' . $this->getName() . '.' . $operationName) as $plugin) {
            $cost += $plugin($this, ...$args);
        }

        return $cost;
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT . '.' . $this->getName();
    }
}
