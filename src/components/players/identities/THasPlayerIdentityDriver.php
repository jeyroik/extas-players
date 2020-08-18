<?php
namespace extas\components\players\identities;

use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\players\identities\IHasPlayerIdentityDriver;
use extas\interfaces\players\identities\IPlayerIdentityDriver;
use extas\interfaces\repositories\IRepository;

/**
 * Trait THasPlayerIdentityDriver
 *
 * @property array $config
 * @method IRepository identityDrivers()
 *
 * @package extas\components\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasPlayerIdentityDriver
{
    /**
     * @return string
     */
    public function getDriverName(): string
    {
        return $this->config[IHasPlayerIdentityDriver::FIELD__DRIVER] ?? '';
    }

    /**
     * @return IPlayerIdentityDriver
     * @throws MissedOrUnknown
     */
    public function getDriver(): IPlayerIdentityDriver
    {
        $driver = $this->identityDrivers()->one([IPlayerIdentityDriver::FIELD__NAME => $this->getDriverName()]);

        if ($driver) {
            return $driver;
        }

        throw new MissedOrUnknown('driver "' . $this->getDriverName() . '"');
    }

    /**
     * @param string $driver
     * @return $this|THasPlayerIdentityDriver
     */
    public function setDriverName(string $driver)
    {
        $this->config[IHasPlayerIdentityDriver::FIELD__DRIVER] = $driver;

        return $this;
    }
}
