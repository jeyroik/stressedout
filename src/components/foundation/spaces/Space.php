<?php
namespace strout\components\founadtion\spaces;

use extas\components\Item;
use extas\components\THasId;
use strout\interfaces\foundation\contracts\IContract;
use strout\interfaces\foundation\contracts\IContractSample;
use strout\interfaces\foundation\transactions\ITransaction;
use strout\interfaces\foundation\transactions\ITransactionSample;
use strout\interfaces\foundation\spaces\ISpace;

/**
 * @method IRepository contracts()
 * @method IRepository transactions()
 */
class Space extends Item implements ISpace
{
    use THasId;

    public function createContract(IContractSample $contractSample): IContract
    {
        $contract = $contractSample->buildClassWithParameters([
            IContract::FIELD__ID => Uuid::uuid6(),
            IContract::FIELD__PROVIDER => $this->getId()
        ]);

        $this->contracts()->create($contract);

        return $contract;
    }

    public function createTransaction(ITransactionSample $transactionSample): ITransaction
    {
        $transaction = $transactionSample->buildClassWithParameters([
            IContract::FIELD__ID => Uuid::uuid6(),
            IContract::FIELD__PROVIDER => $this->getId()
        ]);

        $this->transactions()->create($transaction);

        return $transaction;
    }

    public function deactivateContract(IContract $contract): bool
    {
        $contract->deactivate();

        $this->contracts()->update($contract);

        return true;
    }

    public function oneContract(string $id): ?IContract
    {
        return $this->contracts()->one([IContract::FIELD__ID => $id]);
    }

    public function oneTransaction(string $id): ?ITransaction
    {
        return $this->transactions()->one([ITransaction::FIELD__ID => $id]);
    }
    
    /**
     * @param array $query [from => <id>, to => <id>]
     * @return ITransaction[]
     */
    public function allTransactions(array $query): array
    {
        return $this->transactions()->all($query);
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
