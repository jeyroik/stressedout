<?php
namespace strout\interfaces\foundation\contracts;

use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IItem;
use extas\interfaces\IHasId
use extas\interfaces\samples\parameters\IHasSampleParameters;;

interface IContract extends IItem, IHasId, IHasSampleParameters
{
    public const SUBJECT = 'strout.contract';

    public const FIELD__PROVIDER_ID = 'provider_id';
    public const FIELD__BALANCE = 'balance';
    public const FIELD__IS_ACTIVE = 'is_active';

    public function getProviderId(): string;
    public function setProviderId(string $uuid): IContract;

    public function getBalance(): int;
    public function incBalance(int $amount): int;
    public function decBalance(int $amount): int;

    public function isActive(): bool;
    public function activate(): IContract;
    public function deactivate(): IContract;
}
