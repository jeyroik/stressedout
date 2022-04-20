<?php
namespace strout\interfaces\extensions\spaces;

use strout\interfaces\foundation\contracts\IContract;

/**
 * @package strout\interfaces\extensions\spaces
 * @author jeyroik@gmail.com
 */
interface IExtensionSpaceDefault
{
    /**
     * Return payment amount for an operation
     * 
     * @param IContract $contract
     * @param int $operation
     * @return int payment amount
     */
    public function calculatePayment(IContract $contract, int $operation): int;

    /**
     * Send $amount payment from $from to $to
     * 
     * @param IContract $from
     * @param IContract $to 
     * @param int $amount
     * @return bool successfully sent payment
     */
    public function send(IContract $from, IContract $to, int $amount): bool;
}
