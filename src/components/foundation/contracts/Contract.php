<?php
namespace strout\components\founadtion\contracts;

use extas\components\Item;
use extas\components\THasId;
use extas\components\samples\parameters\THasSampleParameters;
use strout\interfaces\foundation\contracts\IContract;
use strout\interfaces\foundation\transactions\ITransactionSample;

abstract class Contract extends Item implements IContract
{
    use THasSampleParameters;
    use THasId;

    public function getProviderId(): string
    {
        return $this->config[static::FIELD__PROVIDER_ID] ?? '';
    }

    public function setProviderId(string $uuid): IContract
    {
        $this->config[static::FIELD__PROVIDER_ID] = $uuid;

        return $this;
    }

    public function getBalance(): int
    {
        return $this->config[static::FIELD__BALANCE] ?? 0;
    }

    public function incBalance(int $amount): int
    {
        $this->config[static::FIELD__BALANCE] = $this->config[static::FIELD__BALANCE] + $amount;

        return $this->getBalance();
    }

    public function decBalance(int $amount): int
    {
        return $this->incBalance(-$amount);
    }

    public function isActive(): bool
    {
        return $this->config[static::FIELD__IS_ACTIVE] ?? false;
    }

    public function activate(): IContract
    {
        return $this->setIsActive(true);
    }

    public function deactivate(): IContract
    {
        return $this->setIsActive(false);
    }

    protected function setIsActive(bool $isActive): IContract
    {
        $this->config[static::FIELD__IS_ACTIVE] = $isActive;

        return $this
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT . '.' . $this->getName();
    }
}
