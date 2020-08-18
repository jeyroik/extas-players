<?php
namespace extas\components\players\identities;

use extas\components\exceptions\AlreadyExist;
use extas\components\Item;
use extas\components\samples\parameters\THasSampleParameters;
use extas\components\TDispatcherWrapper;
use extas\interfaces\players\identities\IPlayerIdentity;
use extas\interfaces\players\identities\IPlayerIdentityDriver;
use extas\interfaces\players\IPlayer;
use extas\components\exceptions\MissedOrUnknown;

/**
 * Class PlayerIdentityDriver
 *
 * @package extas\components\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
class PlayerIdentityDriver extends Item implements IPlayerIdentityDriver
{
    use TDispatcherWrapper;
    use THasSampleParameters;

    /**
     * @param array $args
     * @return IPlayerIdentity
     * @throws MissedOrUnknown
     */
    public function resolveIdentity(array $args = []): IPlayerIdentity
    {
        return $this->runWithParameters($this->getParametersValues(), 'resolve', $args);
    }

    /**
     * @param array $args
     * @return bool
     * @throws MissedOrUnknown
     */
    public function deleteIdentity(array $args = []): bool
    {
        return $this->runWithParameters($this->getParametersValues(), 'delete', $args);
    }

    /**
     * @param IPlayer $player
     * @param array $args
     * @return IPlayerIdentity
     * @throws MissedOrUnknown
     * @throws AlreadyExist
     */
    public function createIdentity(IPlayer $player, array $args = []): IPlayerIdentity
    {
        return $this->runWithParameters($this->getParametersValues(), 'create', $player, $args);
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
