<?php
namespace extas\interfaces\players;

use extas\interfaces\IHasAliases;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IHaveUUID;
use extas\interfaces\IItem;
use extas\interfaces\parameters\IHaveParams;

/**
 * Interface IPlayer
 *
 * @package extas\interfaces\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IPlayer extends IItem, IHaveUUID, IHasName, IHasDescription, IHasAliases, IHaveParams
{
    public const SUBJECT = 'extas.player';
}
