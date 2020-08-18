<?php
namespace extas\components\players\identities;

use extas\components\exceptions\AlreadyExist;
use extas\components\exceptions\MissedOrUnknown;
use extas\components\Item;
use extas\interfaces\players\identities\IPlayerIdentity;
use extas\interfaces\players\identities\IPlayerIdentityDriver;
use extas\interfaces\players\identities\IPlayerIdentityFactory;
use extas\interfaces\players\IPlayer;
use extas\interfaces\repositories\IRepository;

/**
 * Class PlayerIdentityFactory
 *
 * @method IRepository identityDrivers()
 *
 * @package extas\components\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
class PlayerIdentityFactory extends Item implements IPlayerIdentityFactory
{
    /**
     * @param IPlayer $player
     * @param string $driver
     * @param array $args
     * @return IPlayerIdentity
     * @throws AlreadyExist
     * @throws MissedOrUnknown
     */
    public function createIdentity(IPlayer $player, string $driver, array $args = []): IPlayerIdentity
    {
        $driver = $this->getDriver($driver);

        try {
            $driver->resolveIdentity($args);
            throw new AlreadyExist('identity');
        } catch (MissedOrUnknown $e) {
            return $driver->createIdentity($player, $args);
        }
    }

    /**
     * @param string $driver
     * @param array $args
     * @return IPlayerIdentity
     * @throws MissedOrUnknown
     */
    public function getIdentity(string $driver, array $args = []): IPlayerIdentity
    {
        return $this->getDriver($driver)->resolveIdentity($args);
    }

    /**
     * @param string $driver
     * @param array $args
     * @return bool
     * @throws MissedOrUnknown
     */
    public function deleteIdentity(string $driver, array $args = []): bool
    {
        return $this->getDriver($driver)->deleteIdentity($args);
    }

    /**
     * @param string $driver
     * @return IPlayerIdentityDriver
     * @throws MissedOrUnknown
     */
    protected function getDriver(string $driver): IPlayerIdentityDriver
    {
        $driver = $this->identityDrivers()->one([IPlayerIdentityDriver::FIELD__NAME => $driver]);

        if (!$driver) {
            throw new MissedOrUnknown('driver "' . $driver . '"');
        }

        return $driver;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
