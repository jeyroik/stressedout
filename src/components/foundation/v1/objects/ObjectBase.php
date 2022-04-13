<?php
namespace strout\components\founadtion\v1\objects;

use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasId;
use strout\interfaces\foundation\v1\objects\IObject;

class ObjectBase extends Item implements IObject
{
    use THasId;
    use THasSampleParameters;

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
