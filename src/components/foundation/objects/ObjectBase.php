<?php
namespace strout\components\founadtion\objects;

use extas\components\Item;
use strout\interfaces\foundation\objects\IObject;
use strout\interfaces\foundation\objects\IObjectId;
use THasSpecification;

class ObjectBase extends Item implements IObject
{
    use THasSpecification;

    public function getId(): IObjectId
    {
        return new ObjectId([IObjectId::FIELD__ID_RAW => $this[static::FIELD__ID]]);
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
