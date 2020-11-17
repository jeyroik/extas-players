<?php
namespace extas\interfaces\players\identities;

/**
 * Interface IHasPlayerIdentity
 *
 * @package extas\interfaces\players\identities
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasPlayerIdentity
{
    public const FIELD__PLAYER_IDENTITY = 'player_identity';

    /**
     * @return string
     */
    public function getPlayerIdentityName(): string;

    /**
     * @return IPlayerIdentity|null
     */
    public function getPlayerIdentity(): ?IPlayerIdentity;

    /**
     * @param string $identityName
     * @return $this
     */
    public function setPlayerIdentity(string $identityName);
}
