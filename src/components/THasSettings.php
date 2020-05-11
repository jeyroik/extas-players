<?php
namespace extas\components;

use extas\components\samples\parameters\SampleParameter;
use extas\interfaces\IHasSettings;
use extas\interfaces\samples\parameters\ISampleParameter;

/**
 * Trait THasSettings
 *
 * @property $config
 * @method convertToItems(array $data, string $itemClass): array
 *
 * @package extas\components
 * @author jeyroik@gmail.com
 */
trait THasSettings
{
    /**
     * @return ISampleParameter[]
     */
    public function getSettings(): array
    {
        return $this->convertToItems(
            $this->config[IHasSettings::FIELD__SETTINGS] ?? [],
            SampleParameter::class
        );
    }

    /**
     * @param string $name
     * @return ISampleParameter|null
     */
    public function getSetting(string $name): ?ISampleParameter
    {
        $settings = $this->config[IHasSettings::FIELD__SETTINGS] ?? [];

        return isset($settings[$name]) ? new SampleParameter($settings[$name]) : null;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getSettingValue(string $name, $default = null)
    {
        $setting = $this->getSetting($name);

        return $setting ? $setting->getValue($default) : $default;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasSetting(string $name): bool
    {
        $settings = $this->config[IHasSettings::FIELD__SETTINGS] ?? [];

        return isset($settings[$name]);
    }

    /**
     * Return false if setting is not exist.
     *
     * @param string $name
     * @param string $value
     * @return bool
     */
    public function updateSettingValue(string $name, string $value): bool
    {
        $setting = $this->getSetting($name);

        if ($setting) {
            $setting->setValue($value);
            $this->setSetting($setting);
            return true;
        }

        return false;
    }

    /**
     * @param ISampleParameter $setting
     * @return $this
     */
    public function setSetting(ISampleParameter $setting)
    {
        $settings = $this->config[IHasSettings::FIELD__SETTINGS] ?? [];
        $settings[$setting->getName()] = $setting->__toArray();
        $this->config[IHasSettings::FIELD__SETTINGS] = $settings;

        return $this;
    }

    /**
     * Return false if setting is not exist.
     *
     * @param string $name
     * @return bool
     */
    public function removeSetting(string $name): bool
    {
        $setting = $this->getSetting($name);

        if ($setting) {
            unset($this->config[IHasSettings::FIELD__SETTINGS][$setting->getName()]);
            return true;
        }

        return false;
    }

    /**
     * @param ISampleParameter[]|array $settings
     *
     * @return $this
     */
    public function setSettings(array $settings)
    {
        $settingsData = [];
        foreach ($settings as $setting) {
            $name = is_array($setting) ? $setting[ISampleParameter::FIELD__NAME] : $setting->getName();
            $settingsData[$name] = is_array($setting) ? $setting : $setting->__toArray();
        }
        $this->config[IHasSettings::FIELD__SETTINGS] = $settingsData;

        return $this;
    }
}
