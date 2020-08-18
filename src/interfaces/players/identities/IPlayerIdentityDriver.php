<?php
namespace extas\interfaces\players\identities;

use extas\components\exceptions\AlreadyExist;
use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\IDispatcherWrapper;
use extas\interfaces\IItem;
use extas\interfaces\players\IPlayer;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface IPlayerIdentityDriver
 *
 * @package extas\interfaces\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IPlayerIdentityDriver extends IItem, IDispatcherWrapper, IHasSampleParameters
{
    public const SUBJECT = 'extas.player.identity.driver';

    /**
     * @param array $args
     * @return IPlayerIdentity
     * @throws MissedOrUnknown
     */
    public function resolveIdentity(array $args = []): IPlayerIdentity;

    /**
     * @param IPlayer $player
     * @param array $args
     * @return IPlayerIdentity
     * @throws AlreadyExist
     */
    public function createIdentity(IPlayer $player, array $args = []): IPlayerIdentity;

    /**
     * @param array $args
     * @return bool
     * @throws MissedOrUnknown
     */
    public function deleteIdentity(array $args = []): bool;
}
