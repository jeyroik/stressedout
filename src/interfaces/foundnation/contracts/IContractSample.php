<?php
namespace strout\interfaces\foundation\contracts;

use extas\interfaces\IItem;
use extas\interfaces\IHasClass;
use extas\interfaces\samples\parameters\IHasSampleParameters;

interface IContractSample extends IItem, IHasClass, IHasSampleParameters
{
    public const SUBJECT = 'strout.contract.sample';
}
