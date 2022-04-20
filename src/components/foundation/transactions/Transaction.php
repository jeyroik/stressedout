<?php
namespace strout\components\foundation\transactions;

use extas\components\Item;
use extas\components\THasCreatedAt;
use strout\interfaces\foundation\transactions\ITransaction;

class Transaction extends Item implements ITransaction
{
    use THasCreatedAt;

    public function getFromId(): string
    {
        return $this->config[static::FIELD__FROM_ID] ?? '';
    }

    public function setFromId(string $uuid): ITransaction
    {
        $this->config[static::FIELD__FROM_ID] = $uuid;

        return $this;
    }

    public function getToId(): string
    {
        return $this->config[static::FIELD__TO_ID] ?? '';
    }

    public function setToId(string $uuid): ITransaction
    {
        $this->config[static::FIELD__TO_ID] = $uuid;

        return $this;
    }

    public function getProviderId(): string
    {
        return $this->config[static::FIELD__PROVIDER_ID] ?? '';
    }

    public function setProviderId(string $uuid): ITransaction
    {
        $this->config[static::FIELD__PROVIDER_ID] = $uuid;

        return $this;
    }

    public function getAmount(): int
    {
        return $this->config[static::FIELD__AMOUNT] ?? 0;
    }

    public function setAmount(int $amount): ITransaction
    {
        $this->config[static::FIELD__AMOUNT] = $amount;

        return $this;
    }
}
