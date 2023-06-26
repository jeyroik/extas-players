<?php
namespace extas\interfaces\players\identities;

use extas\interfaces\IItem;

interface IPlayerIdentityService extends IItem
{
    public const SUBJECT = 'extas.player.identity.service';

    public function getIdentityByValue(string $providerName, string $value): ?IPlayerIdentity;

    public function createIdentity(IPlayerIdentityProvider $provider, string $playerName, string $value): IPlayerIdentity;
}
