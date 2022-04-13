<?php
namespace strout\interfaces\foundation\spaces;

use extas\interfaces\IHasDescription;
use extas\interfaces\IItem;
use strout\interfaces\foundation\objects\IObject;
use strout\interfaces\foundation\specifications\IHasSpecification;

interface ISpaceState extends IItem, IHasDescription, IHasSpecification
{
    public const SUBJECT = 'strout.space.state';

    public const FIELD__ACTOR = 'actor';

    public function getActor(): IObject;
}
