<?php
namespace extas\components\players;

use extas\components\THasDescription;
use extas\components\THasName;
use extas\interfaces\players\IPlayer;
use extas\interfaces\players\IPlayerIdentity;
use extas\interfaces\players\IPlayerSetting;
use extas\components\Item;

/**
 * Class Player
 *
 * @package extas\components\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
class Player extends Item implements IPlayer
{
    use THasName;
    use THasDescription;

    /**
     * @return array
     */
    public function getIdentities()
    {
        return $this->config[static::FIELD__IDENTITIES] ?? [];
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return $this->config[static::FIELD__ALIASES] ?? [];
    }

    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->config[static::FIELD__SETTINGS] ?? [];
    }

    /**
     * @param $id
     *
     * @return IPlayerIdentity|null
     */
    public function getIdentity($id)
    {
        $identities = $this->getIdentities();
        $byId = array_column($identities, null, IPlayerIdentity::FIELD__ID);
        $identity = $byId[$id] ?? false;

        return $identity ? new PlayerIdentity($identity) : null;
    }

    /**
     * @param $name
     *
     * @return IPlayerSetting|null
     */
    public function getSetting($name)
    {
        $settings = $this->getSettings();
        $byName = array_column($settings, null, IPlayerSetting::FIELD__NAME);
        $setting = $byName[$name] ?? false;

        return $setting ? new PlayerSetting($setting) : null;
    }

    /**
     * @param $identities
     *
     * @return $this
     */
    public function setIdentities($identities)
    {
        $this->config[static::FIELD__IDENTITIES] = $identities;

        return $this;
    }

    /**
     * @param $settings
     *
     * @return $this
     */
    public function setSettings($settings)
    {
        $this->config[static::FIELD__SETTINGS] = $settings;

        return $this;
    }

    /**
     * @param $aliases
     *
     * @return $this
     */
    public function setAliases($aliases)
    {
        $this->config[static::FIELD__ALIASES] = $aliases;

        return $this;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function addAlias($name)
    {
        $this->config[static::FIELD__ALIASES][] = $name;

        return $this;
    }

    /**
     * @param $id
     * @param $identity IPlayerIdentity|array
     *
     * @return $this
     */
    public function setIdentity($id, $identity)
    {
        $identities = $this->getIdentities();
        $byId = array_column($identities, null, IPlayerIdentity::FIELD__ID);
        $byId[$id] = $identity instanceof IPlayerIdentity
            ? $identity->__toArray()
            : $identity;

        $this->setIdentities(array_values($byId));

        return $this;
    }

    /**
     * @param $name
     * @param $setting IPlayerSetting|array
     *
     * @return $this
     */
    public function setSetting($name, $setting)
    {
        $settings = $this->getSettings();
        $byName = array_column($settings, null, IPlayerSetting::FIELD__NAME);
        $byName[$name] = $setting instanceof IPlayerSetting
            ? $setting->__toArray()
            : $setting;

        $this->setSettings(array_values($byName));

        return $this;
    }

    /**
     * @param $identity IPlayerIdentity|array
     *
     * @return $this
     */
    public function addIdentity($identity)
    {
        $this->config[static::FIELD__IDENTITIES][] = $identity instanceof IPlayerIdentity
            ? $identity->__toArray()
            : $identity;

        return $this;
    }

    /**
     * @param $setting IPlayerSetting|array
     *
     * @return $this
     */
    public function addSetting($setting)
    {
        $this->config[static::FIELD__SETTINGS][] = $setting instanceof IPlayerSetting
            ? $setting->__toArray()
            : $setting;

        return $this;
    }

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
