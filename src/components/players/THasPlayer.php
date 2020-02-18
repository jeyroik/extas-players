<?php
namespace extas\components\players;

use extas\components\SystemContainer;
use extas\interfaces\players\IHasPlayer;
use extas\interfaces\players\IPlayer;
use extas\interfaces\players\IPlayerRepository;

/**
 * Trait THasPlayer
 *
 * @property $config
 *
 * @package extas\components\players
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasPlayer
{
    /**
     * @return string
     */
    public function getPlayerName(): string
    {
        return $this->config[IHasPlayer::FIELD__PLAYER_NAME] ?? '';
    }

    /**
     * @return IPlayer|null
     */
    public function getPlayer(): ?IPlayer
    {
        /**
         * @var $repo IPlayerRepository
         */
        $repo = SystemContainer::getItem(IPlayerRepository::class);

        return $repo->one([IPlayer::FIELD__NAME => $this->getPlayerName()]);
    }

    /**
     * @param string $playerName
     * @return $this
     */
    public function setPlayerName(string $playerName)
    {
        $this->config[IHasPlayer::FIELD__PLAYER_NAME] = $playerName;

        return $this;
    }
}
