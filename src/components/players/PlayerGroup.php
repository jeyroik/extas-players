<?php
namespace extas\components\players;

use extas\interfaces\players\IPlayerGroup;

/**
 * Class PlayerGroup
 *
 * @package extas\components\players
 * @author jeyroik <jeyroik@gmail.com>
 */
class PlayerGroup extends PlayerSample implements IPlayerGroup
{
    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
