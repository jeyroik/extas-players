<?php
namespace extas\interfaces\players;

use extas\interfaces\IHasDescription;
use extas\interfaces\IHasName;
use extas\interfaces\IItem;

/**
 * Interface IPlayer
 *
 * @package extas\interfaces\players
 * @author Jeyroik <jeyroik@gmail.com>
 */
interface IPlayer extends IItem, IHasName, IHasDescription
{
    public const SUBJECT = 'extas.player';

    public const FIELD__IDENTITIES = 'identities';
    public const FIELD__SETTINGS = 'settings';
    public const FIELD__ALIASES = 'aliases';

    /**
     * @return array
     */
    public function getIdentities();

    /**
     * @return array
     */
    public function getSettings();

    /**
     * @return array
     */
    public function getAliases();

    /**
     * @param $id
     *
     * @return IPlayerIdentity|null
     */
    public function getIdentity($id);

    /**
     * @param $name
     *
     * @return IPlayerSetting|null
     */
    public function getSetting($name);

    /**
     * @param $identities
     *
     * @return IPlayer
     */
    public function setIdentities($identities);

    /**
     * @param $settings
     *
     * @return IPlayer
     */
    public function setSettings($settings);

    /**
     * @param $aliases
     *
     * @return IPlayer
     */
    public function setAliases($aliases);

    /**
     * @param $name
     *
     * @return IPlayer
     */
    public function addAlias($name);

    /**
     * @param $identity
     *
     * @return IPlayer
     */
    public function addIdentity($identity);

    /**
     * @param $id
     * @param $identity
     *
     * @return IPlayer
     */
    public function setIdentity($id, $identity);

    /**
     * @param $setting
     *
     * @return IPlayer
     */
    public function addSetting($setting);

    /**
     * @param $name
     * @param $setting
     *
     * @return IPlayer
     */
    public function setSetting($name, $setting);
}
