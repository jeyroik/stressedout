<?php
namespace strout\components\extensions\spaces;

use extas\components\extensions\Extension;
use strout\interfaces\extensions\spaces\IExtensionSpaceDefault;
use strout\components\foundation\transactions\Transaction;

/**
 * Class ExtensionSpaceDefault
 *
 * @method ITransactionsRepository $transactions()
 * 
 * @package strout\components\extensions\spaces
 * @author jeyroik@gmail.com
 */
class ExtensionSpaceDefault extends Extension implements IExtensionSpaceDefault
{
    protected const PAYMENT_AMOUNT__REGISTRATION = 5;

    /**
     * Return payment amount for an operation
     * 
     * @param IContract $contract
     * @param int $operation
     * @return int payment amount
     */
    public function calculatePayment(IContract $contract, int $operation, ISpace $space = null): int
    {
        return static::PAYMENT_AMOUNT__REGISTRATION;
    }

    /**
     * Send $amount payment from $from to $to
     * 
     * @param IContract $from
     * @param IContract $to 
     * @param int $amount
     * @return bool successfully sent payment
     */
    public function send(IContract $from, IContract $to, int $amount, ISpace $space = null): bool
    {
        $contractFrom = $from->buildClassWithParameters();
        $contractTo = $to->buildClassWithParameters();

        $contractFrom->decBalanceBy($amount);
        $contractTo->incBalanceBy($amount);

        try {
            $this->saveTransaction($from, $to, $amount, $space);
        } catch (\Exception $e) {
            $contractTo->decBalanceBy($amount);
            $contractFrom->incBalanceBy($amount);

            return false;
        }

        return true;
    }

    /**
     * Save transaction
     * 
     * @param IContract $from
     * @param IContract $to 
     * @param int $amount
     * @return bool successfully saved transaction
     */
    public function saveTransaction(IContract $from, IContract $to, int $amount, ISpace $space = null): bool
    {
        $this->transactions()->create(new Transaction([
            Transaction::FIELD__FROM => $from->getId(),
            Transaction::FIELD__TO => $to->getId(),
            Transaction::FIELD__AMOUNT => $amount,
            Transaction::FIELD__PROVIDER => $space->getId(),
            Transaction::FIELD__CREATED_AT => time()
        ]));

        return true;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'strout.extension.space.default';
    }
}
