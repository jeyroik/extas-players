<?php
namespace extas\components\players\identities;

use extas\components\Item;
use extas\components\players\THasPlayer;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\THasStringId;
use extas\components\THasValue;
use extas\interfaces\players\identities\IPlayerIdentity;

/**
 * Class PlayerIdentity
 *
 * @package extas\components\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
class PlayerIdentity extends Item implements IPlayerIdentity
{
    use THasName;
    use THasDescription;
    use THasStringId;
    use THasValue;
    use THasPlayer;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
