<?php
namespace extas\interfaces\players\identities;

use extas\interfaces\IHasId;
use extas\interfaces\IItem;
use extas\interfaces\players\IHasPlayer;

/**
 * Interface IPlayerToIdentityMap
 *
 * @package extas\interfaces\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IPlayerToIdentityMap extends IItem, IHasPlayer, IHasPlayerIdentity, IHasId
{
    public const SUBJECT = 'extas.player.identity.map';
}
