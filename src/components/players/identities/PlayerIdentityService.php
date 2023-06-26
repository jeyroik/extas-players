<?php
namespace extas\components\players\identities;

use extas\components\Item;
use extas\components\players\Player;
use extas\interfaces\players\identities\IPlayerIdentity;
use extas\interfaces\players\identities\IPlayerIdentityProvider;
use extas\interfaces\players\identities\IPlayerIdentityService;
use extas\interfaces\players\IPlayer;
use extas\interfaces\repositories\IRepository;

/**
 * @method IRepository playersIdentities()
 * @method IRepository players()
 */
class PlayerIdentityService extends Item implements IPlayerIdentityService
{
    public function getIdentityByValue(string $providerName, string $value): ?IPlayerIdentity
    {
        return $this->playersIdentities()->one([
            IPlayerIdentity::FIELD__NAME => $providerName,
            IPlayerIdentity::FIELD__VALUE => $value
        ]);
    }

    public function createIdentity(IPlayerIdentityProvider $provider, string $playerName, string $value): IPlayerIdentity
    {
        $existed = $this->getIdentityByValue($provider->getName(), $value);

        if ($existed) {
            return $existed;
        }

        $player = $this->players()->one([IPlayer::FIELD__NAME => $playerName]);

        if (!$player) {
            $this->players()->create(new Player([
                IPlayer::FIELD__NAME => $playerName,
                IPlayer::FIELD__TITLE => $playerName,
                IPlayer::FIELD__DESCRIPTION => $playerName,
                IPlayer::FIELD__ALIASES => [$playerName],
                IPlayer::FIELD__PARAMS => []
            ]));
        }

        $identity = new PlayerIdentity([
            PlayerIdentity::FIELD__NAME => $provider->getName(),
            PlayerIdentity::FIELD__TITLE => $provider->getTitle(),
            PlayerIdentity::FIELD__DESCRIPTION => $provider->getDescription(),
            PlayerIdentity::FIELD__VALUE => $value,
            PlayerIdentity::FIELD__PLAYER_NAME => $playerName
        ]);

        return $this->playersIdentities()->create($identity);
    }

    protected function getSubjectForExtension(): string
    {
        return static::SUBJECT;
    }
}
