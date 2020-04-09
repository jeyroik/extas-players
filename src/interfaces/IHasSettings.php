<?php
namespace extas\interfaces;

use extas\interfaces\samples\parameters\ISampleParameter;

/**
 * Interface IHasSettings
 *
 * @package extas\interfaces
 * @author jeyroik@gmail.com
 */
interface IHasSettings
{
    public const FIELD__SETTINGS = 'settings';

    /**
     * @return ISampleParameter[]
     */
    public function getSettings(): array;

    /**
     * @param string $name
     * @return ISampleParameter|null
     */
    public function getSetting(string $name): ?ISampleParameter;

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getSettingValue(string $name, $default = null);

    /**
     * @param string $name
     * @return bool
     */
    public function hasSetting(string $name): bool;

    /**
     * Return false if setting is not exist.
     *
     * @param string $name
     * @param string $value
     * @return bool
     */
    public function updateSettingValue(string $name, string $value): bool;

    /**
     * @param ISampleParameter $setting
     * @return $this
     */
    public function setSetting(ISampleParameter $setting);

    /**
     * Return false if setting is not exist.
     *
     * @param string $name
     * @return bool
     */
    public function removeSetting(string $name): bool;

    /**
     * @param ISampleParameter[]|array $settings
     *
     * @return $this
     */
    public function setSettings(array $settings);
}
