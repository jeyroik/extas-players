<?php
namespace extas\interfaces\players;

use extas\interfaces\IHasAliases;
use extas\interfaces\IHasDescription;
use extas\interfaces\IHasIdentities;
use extas\interfaces\IHasName;
use extas\interfaces\IHasSettings;
use extas\interfaces\IItem;

/**
 * Interface IPlayer
 *
 * @package extas\interfaces\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IPlayer extends IItem, IHasName, IHasDescription, IHasAliases, IHasSettings, IHasIdentities
{
    public const SUBJECT = 'extas.player';
}
