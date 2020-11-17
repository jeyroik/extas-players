<?php
namespace extas\components\players\identities;

use extas\components\Item;
use extas\components\players\THasPlayer;
use extas\components\THasId;
use extas\interfaces\players\identities\IPlayerToIdentityMap;

/**
 * Class PlayerToIdentityMap
 *
 * @package extas\components\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
class PlayerToIdentityMap extends Item implements IPlayerToIdentityMap
{
    use THasPlayer;
    use THasPlayerIdentity;
    use THasId;

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
