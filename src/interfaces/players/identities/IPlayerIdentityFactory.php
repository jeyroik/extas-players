<?php
namespace extas\interfaces\players\identities;

use extas\components\exceptions\AlreadyExist;
use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\IItem;
use extas\interfaces\players\IPlayer;

/**
 * Interface IPlayerIdentityFactory
 *
 * @package extas\interfaces\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IPlayerIdentityFactory extends IItem
{
    public const SUBJECT = 'extas.player.identity.factory';

    /**
     * @param IPlayer $player
     * @param string $driver
     * @param array $args
     * @return IPlayer
     * @throws AlreadyExist
     */
    public function createIdentity(IPlayer $player, string $driver, array $args = []): IPlayerIdentity;

    /**
     * @param string $driver
     * @param array $args
     * @return IPlayerIdentity
     * @throws MissedOrUnknown
     */
    public function getIdentity(string $driver, array $args = []): IPlayerIdentity;

    /**
     * @param string $driver
     * @param array $args
     * @return bool
     * @throws MissedOrUnknown
     */
    public function deleteIdentity(string $driver, array $args = []): bool;
}
