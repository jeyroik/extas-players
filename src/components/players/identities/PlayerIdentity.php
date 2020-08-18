<?php
namespace extas\components\players\identities;

use extas\components\Item;
use extas\components\players\THasPlayer;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasName;
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
    use THasSampleParameters;
    use THasPlayer;
    use THasPlayerIdentityDriver;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
