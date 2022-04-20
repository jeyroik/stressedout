<?php
namespace strout\interfaces\foundation\spaces;

use extas\interfaces\IItem;
use extas\interfaces\IHasId;
use strout\interfaces\foundation\contracts\IContract;

interface ISpace extends IItem, IHasId
{
    public const SUBJECT = 'strout.space';
    public const STAGE__CONTRACT_REGISTRATION = 'strout.contract.registration';

    /**
     * This method is installing extensions/plugins for dispatching $contract basic actions/events.
     * Also set space instance into a $contract.
     *
     * @param IContract $contract
     * @return integer paying amount - which sum was gathered by space
     */
    public function register(IContract $contract): int;
}
