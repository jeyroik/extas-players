<?php
namespace extas\interfaces\players;

/**
 * Interface IHasPlayer
 *
 * @package extas\interfaces\players
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHavePlayer
{
    public const FIELD__PLAYER_NAME = 'player_name';

    public function getPlayerName(): string;

    public function getPlayer(): ?IPlayer;

    public function setPlayerName(string $playerName): static;
}
