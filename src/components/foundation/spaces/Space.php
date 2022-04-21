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
        $contractSample->setParameterValue(IContract::FIELD__ID, Uuid::uuid6())
                       ->setParameterValue(IContract::FIELD__PROVIDER_ID, $this->getId());

        $params   = $contractSample->getParametersValues();
        $contract = $contractSample->buildClassWithParameters($params);

        $this->contracts()->create($contract);

        return $contract;
    }

    public function createTransaction(ITransactionSample $transactionSample): ITransaction
    {
        $transactionSample->setParameterValue(ITransaction::FIELD__ID, Uuid::uuid6())
                          ->setParameterValue(ITransaction::FIELD__PROVIDER_ID, $this->getId());

        $params      = $transactionSample->getParametersValues();
        $transaction = $transactionSample->buildClassWithParameters($params);

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
