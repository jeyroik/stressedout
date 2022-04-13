<?php
namespace strout\interfaces\foundation\v1\contracts;

use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IItem;
use strout\interfaces\foundation\v1\objects\IObject;

interface IContract extends IItem, IDispatcherWrapper
{
    public const SUBJECT = 'strout.contract';

    public const OPERATION__EXECUTE = 'execute';
    public const OPERATION__STORE = 'store';
    public const OPERATION__REGISTRATION = 'registration';
    public const OPERATION__TRANSPORT = 'transport';

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
