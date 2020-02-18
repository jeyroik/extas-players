<?php
namespace extas\interfaces\players;

/**
 * Interface IHasPlayer
 *
 * @package extas\interfaces\players
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasPlayer
{
    public const FIELD__PLAYER_NAME = 'player_name';

    /**
     * @return string
     */
    public function getPlayerName(): string;

    /**
     * @return IPlayer|null
     */
    public function getPlayer(): ?IPlayer;

    /**
     * @param string $playerName
     * @return $this
     */
    public function setPlayerName(string $playerName);
}
