<?php
namespace extas\components;

use extas\components\samples\parameters\SampleParameter;
use extas\interfaces\IHasIdentities;
use extas\interfaces\samples\parameters\ISampleParameter;

/**
 * Trait THasIdentities
 *
 * @property $config
 *
 * @package extas\components
 * @author jeyroik@gmail.com
 */
trait THasIdentities
{
    use THasItemsData;

    /**
     * @return ISampleParameter[]
     */
    public function getIdentities(): array
    {
        return $this->convertToItems(
            $this->config[IHasIdentities::FIELD__IDENTITIES] ?? [],
            SampleParameter::class
        );
    }

    /**
     * @param string $name
     * @return ISampleParameter|null
     */
    public function getIdentity(string $name): ?ISampleParameter
    {
        $identities = $this->config[IHasIdentities::FIELD__IDENTITIES] ?? [];

        return isset($identities[$name]) ? new SampleParameter($identities[$name]) : null;
    }

    /**
     * @param string $name
     * @param string $default
     * @return string
     */
    public function getIdentityValue(string $name, string $default  = ''): string
    {
        $identity = $this->getIdentity($name);

        return $identity ? $identity->getValue($default) : $default;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasIdentity(string $name): bool
    {
        $identities = $this->config[IHasIdentities::FIELD__IDENTITIES] ?? [];

        return isset($identities[$name]);
    }

    /**
     * Return false if identity is not exist.
     *
     * @param string $identityName
     * @param string $value
     * @return bool
     */
    public function updateIdentityValue(string $identityName, string $value): bool
    {
        $identity = $this->getIdentity($identityName);

        if ($identity) {
            $identity->setValue($value);
            $this->setIdentity($identity);

            return true;
        }

        return false;
    }

    /**
     * Return false if identity is already exists.
     *
     * @param ISampleParameter $identity
     * @return $this
     */
    public function setIdentity(ISampleParameter $identity)
    {
        $identities = $this->config[IHasIdentities::FIELD__IDENTITIES] ?? [];
        $identities[$identity->getName()] = $identity->__toArray();
        $this->config[IHasIdentities::FIELD__IDENTITIES] = $identities;

        return $this;
    }

    /**
     * Return false if identity is not exist.
     *
     * @param string $name
     * @return bool
     */
    public function removeIdentity(string $name): bool
    {
        $identity = $this->getIdentity($name);

        if ($identity) {
            unset($this->config[IHasIdentities::FIELD__IDENTITIES][$identity->getName()]);
            return true;
        }

        return false;
    }

    /**
     * @param ISampleParameter[]|array $identities
     * @return $this
     */
    public function setIdentities(array $identities)
    {
        $identitiesData = [];
        foreach ($identities as $identity) {
            $name = is_array($identity) ? $identity[ISampleParameter::FIELD__NAME] : $identity->getName();
            $identitiesData[$name] = is_array($identity) ? $identity : $identity->__toArray();
        }
        $this->config[IHasIdentities::FIELD__IDENTITIES] = $identitiesData;

        return $this;
    }
}
