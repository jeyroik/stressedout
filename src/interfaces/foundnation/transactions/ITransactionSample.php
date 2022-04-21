<?php
namespace strout\interfaces\foundation\transactions;

use extas\interfaces\IItem;
use extas\interfaces\IHasClass;
use extas\interfaces\samples\parameters\IHasSampleParameters;

interface ITransactionSample extends IItem, IHasClass, IHasSampleParameters
{
    public const SUBJECT = 'strout.transaction.sample';
}
