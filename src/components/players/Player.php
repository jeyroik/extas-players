<?php
namespace extas\components\players;

use extas\components\samples\parameters\THasSampleParameters;
use extas\components\THasAliases;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\players\IPlayer;
use extas\components\Item;

/**
 * Class Player
 *
 * @package extas\components\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
class Player extends Item implements IPlayer
{
    use THasName;
    use THasDescription;
    use THasAliases;
    use THasSampleParameters;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
