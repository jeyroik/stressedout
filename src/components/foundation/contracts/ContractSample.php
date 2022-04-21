<?php
namespace strout\components\founadtion\contracts;

use extas\components\Item;
use extas\components\THasClass;
use extas\components\samples\parameters\THasSampleParameters;

/**
 * @author jeyroik@gmail.com
 */
class ContractSample extends Item implements IContractSample
{
    use THasClass;
    use THasSampleParameters;

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}