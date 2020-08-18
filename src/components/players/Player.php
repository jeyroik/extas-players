<?php
namespace extas\components\players;

use extas\interfaces\players\IPlayer;

/**
 * Class Player
 *
 * @package extas\components\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
class Player extends PlayerSample implements IPlayer
{
    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
