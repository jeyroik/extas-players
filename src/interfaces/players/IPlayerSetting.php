<?php
namespace extas\interfaces\players;

use extas\interfaces\IHasId;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;

/**
 * Interface IPlayerSetting
 *
 * @package extas\interfaces\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IPlayerSetting extends IItem, IHasName, IHasId
{
    public const SUBJECT = 'extas.player.setting';
}
