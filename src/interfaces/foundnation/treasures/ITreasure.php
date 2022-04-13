<?php
namespace strout\interfaces\foundation\treasures;

use extas\interfaces\IHasCreatedAt;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasId;
use extas\interfaces\IHasValue;
use extas\interfaces\IItem;
use strout\interfaces\foundation\objects\IObject;

/**
 * interface ITreasure
 *
 * @author jeyroik <jeyroik@gmail.com>
 */
interface ITreasure extends IItem, IHasId, IHasDescription, IHasValue, IHasCreatedAt
{
    public const SUBJECT = 'strout.treasure';

    /**
     * Кто произвёл
     */
    public const FIELD__MINTER = 'minter';

    /**
     * От кого получено
     */
    public const FIELD__FROM = 'from';

    /**
     * Кто текущий владелец
     */
    public const FIELD__OWNER = 'owner';

    public function getMinter(): IObject;

    public function getFrom(): IObject;

    public function getOwner(): IObject;

    /**
     * Записывает в from текущего овнера,
     * а в овнера помещает to.
     *
     * @param IObject $to
     * @return boolean
     */
    public function commitTransaction(IObject $to): bool;
}
