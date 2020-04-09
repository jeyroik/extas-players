<?php
namespace extas\interfaces;

use extas\interfaces\samples\parameters\ISampleParameter;

/**
 * Interface IHasIdentities
 *
 * @package extas\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasIdentities
{
    public const FIELD__IDENTITIES = 'identities';

    /**
     * @return ISampleParameter[]
     */
    public function getIdentities(): array;

    /**
     * @param string $name
     * @return ISampleParameter|null
     */
    public function getIdentity(string $name): ?ISampleParameter;

    /**
     * @param string $name
     * @param string $default
     * @return string
     */
    public function getIdentityValue(string $name, string $default = ''): string;

    /**
     * @param string $name
     * @return bool
     */
    public function hasIdentity(string $name): bool;

    /**
     * Return false if identity is not exist.
     *
     * @param string $identityName
     * @param string $value
     * @return bool
     */
    public function updateIdentityValue(string $identityName, string $value): bool;

    /**
     * Return false if identity is already exists.
     *
     * @param ISampleParameter $identity
     * @return $this
     */
    public function setIdentity(ISampleParameter $identity);

    /**
     * Return false if identity is not exist.
     *
     * @param string $name
     * @return bool
     */
    public function removeIdentity(string $name): bool;

    /**
     * @param ISampleParameter[]|array $identities
     * @return $this
     */
    public function setIdentities(array $identities);
}
