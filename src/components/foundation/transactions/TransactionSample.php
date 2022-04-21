<?php
namespace strout\components\foundation\transactions;

use extas\components\Item;
use extas\components\THasClass;
use extas\components\samples\parameters\THasSampleParameters;

/**
 * @author jeyroik@gmail.com
 */
class TransactionSample extends Item implements ITransactionSample
{
    use THasClass;
    use THasSampleParameters;

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
