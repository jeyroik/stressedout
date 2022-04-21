<?php
namespace strout\interfaces\foundation\spaces;

use extas\interfaces\IItem;
use extas\interfaces\IHasId;
use strout\interfaces\foundation\contracts\IContract;
use strout\interfaces\foundation\transactions\ITransaction;

interface ISpace extends IItem, IHasId
{
    public const SUBJECT = 'strout.space';
    
    public function createContract(IContractSample $sample): IContract;
    public function createTransaction(ITransactionSample $sample): ITransaction;

    public function deactivateContract(IContract $contract): bool;

    public function oneContract(string $id): ?IContract;
    public function oneTransaction(string $id): ?ITransaction;
    
    /**
     * @param array $query [from => <id>, to => <id>]
     * @return ITransaction[]
     */
    public function allTransactions(array $query): array;
}
