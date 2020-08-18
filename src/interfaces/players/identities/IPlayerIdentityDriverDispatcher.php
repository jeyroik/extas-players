<?php
namespace extas\interfaces\players\identities;

use extas\components\exceptions\AlreadyExist;
use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\players\IPlayer;

/**
 * Interface IPlayerIdentityDriverDispatcher
 *
 * @package extas\interfaces\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IPlayerIdentityDriverDispatcher
{
    /**
     * @param array $args
     * @return IPlayerIdentity
     * @throws MissedOrUnknown
     */
    public function resolve(array $args = []): IPlayerIdentity;

    /**
     * @param IPlayer $player
     * @param array $args
     * @return IPlayerIdentity
     * @throws AlreadyExist
     */
    public function create(IPlayer $player, array $args = []): IPlayerIdentity;

    /**
     * @param array $args
     * @return bool
     * @throws MissedOrUnknown
     */
    public function delete(array $args = []): bool;
}
