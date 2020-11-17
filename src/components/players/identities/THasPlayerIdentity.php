<?php
namespace extas\components\players\identities;

use extas\interfaces\players\identities\IHasPlayerIdentity;
use extas\interfaces\players\identities\IPlayerIdentity;
use extas\interfaces\repositories\IRepository;

/**
 * Trait THasPlayerIdentity
 *
 * @property array $config
 * @method IRepository playersIdentities()
 *
 * @package extas\components\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasPlayerIdentity
{
    /**
     * @return string
     */
    public function getPlayerIdentityName(): string
    {
        return $this->config[IHasPlayerIdentity::FIELD__PLAYER_IDENTITY] ?? '';
    }

    /**
     * @return IPlayerIdentity|null
     */
    public function getPlayerIdentity(): ?IPlayerIdentity
    {
        return $this->playersIdentities()->one([IPlayerIdentity::FIELD__NAME => $this->getPlayerIdentityName()]);
    }

    /**
     * @param string $identityName
     * @return $this
     */
    public function setPlayerIdentity(string $identityName)
    {
        $this->config[IHasPlayerIdentity::FIELD__PLAYER_IDENTITY] = $identityName;

        return $this;
    }
}
