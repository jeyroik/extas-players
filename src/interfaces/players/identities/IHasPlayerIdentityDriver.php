<?php
namespace extas\interfaces\players\identities;

use extas\components\exceptions\MissedOrUnknown;

/**
 * Interface IHasPlayerIdentityDriver
 *
 * @package extas\interfaces\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasPlayerIdentityDriver
{
    public const FIELD__DRIVER = 'identity_driver';

    /**
     * @return string
     */
    public function getDriverName(): string;

    /**
     * @return IPlayerIdentityDriver
     * @throws MissedOrUnknown
     */
    public function getDriver(): IPlayerIdentityDriver;

    /**
     * @param string $driver
     * @return $this
     */
    public function setDriverName(string $driver);
}
