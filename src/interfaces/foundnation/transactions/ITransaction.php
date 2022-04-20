<?php
namespace strout\interfaces\transactions;

use strout\interfaces\foundation\contracts\IContract;
use extas\interfaces\IItem;
use extas\interfaces\IHasCreatedAt;

interface ITransaction extends IItem, IHasCreatedAt
{
    public const SUBJECT = 'strout.transaction';

    public const FIELD__FROM_ID = 'from';
    public const FIELD__TO_ID = 'to';
    public const FIELD__PROVIDER_ID = 'provider';
    public const FIELD__AMOUNT = 'amount';

    public function getFromId(): string;
    public function setFromId(string $uuid): ITransaction;

    public function getToId(): string;
    public function setToId(string $uuid): ITransaction;

    public function getProviderId(): string;
    public function setProviderId(string $uuid): ITransaction;

    public function getAmount(): int;
    public function setAmount(int $amount): ITransaction;
}
