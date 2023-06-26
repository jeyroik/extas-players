<?php
namespace extas\components\players;

use extas\components\Item;
use extas\components\parameters\THasParams;
use extas\components\THasAliases;
use extas\components\THasDescription;
use extas\components\THasName;
use extas\components\THasStringId;
use extas\interfaces\players\IPlayer;

/**
 * Class Player
 *
 * @package extas\components\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
class Player extends Item implements IPlayer
{
    use THasStringId;
    use THasName;
    use THasDescription;
    use THasAliases;
    use THasParams;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
