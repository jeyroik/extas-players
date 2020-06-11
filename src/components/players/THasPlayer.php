<?php
namespace extas\components\players;

use extas\interfaces\players\IHasPlayer;
use extas\interfaces\players\IPlayer;
use extas\interfaces\repositories\IRepository;

/**
 * Trait THasPlayer
 *
 * @property $config
 * @method IRepository playerRepository()
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
        return $this->playerRepository()->one([IPlayer::FIELD__NAME => $this->getPlayerName()]);
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
