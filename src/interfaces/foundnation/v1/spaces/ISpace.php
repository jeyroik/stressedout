<?php
namespace strout\interfaces\foundation\v1\spaces;

use extas\interfaces\IItem;
use strout\interfaces\foundation\v1\contracts\IContract;

interface ISpace extends IItem
{
    public const SUBJECT = 'strout.space';

    /**
     * This method is installing extensions/plugins for dispatching $contract basic actions/events.
     * Also set space instance into a $contract.
     *
     * @param IContract $contract
     * @return integer paying amount - which sum was gathered by space
     */
    public function register(IContract $contract): int;
}
