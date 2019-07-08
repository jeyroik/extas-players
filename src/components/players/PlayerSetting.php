<?php
namespace extas\components\players;

use extas\components\THasId;
use extas\components\THasName;
use extas\interfaces\players\IPlayerSetting;
use extas\components\Item;

/**
 * Class PlayerSetting
 *
 * @package extas\components\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
class PlayerSetting extends Item implements IPlayerSetting
{
    use THasId;
    use THasName;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
