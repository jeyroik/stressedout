<?php
namespace strout\interfaces\foundation\contracts;

use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IItem;
use strout\interfaces\foundation\objects\IObject;

interface IContract extends IItem, IDispatcherWrapper
{
    public const SUBJECT = 'strout.contract';

    public const OPERATION__EXECUTE = 1;
    public const OPERATION__STORE = 2;
    public const OPERATION__REGISTRATION = 3;
    public const OPERATION__TRANSPORT = 4;

    /**
     * Execute some operations in a space
     *
     * @param [type] ...$args
     * @return integer payment amount
     */
    public function execute(...$args): int;

    /**
     * Place $objects into a space
     *
     * @param IObject[] ...$objects
     * @return integer payment amount
     */
    public function store(...$objects): int;
}
